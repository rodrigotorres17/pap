/* ============================================================
   script.js
   Controla a interação com o mapa:
   - 1º clique num hotspot -> seleciona o destino
   - 2º clique no mesmo hotspot -> desenha o percurso animado
   - Botão "Limpar Percurso" -> remove a linha e reinicia estado
   - Botões rápidos -> selecionam e traçam o percurso de imediato
   ============================================================ */

document.addEventListener("DOMContentLoaded", function () {

    // ---------- Referências a elementos do DOM ----------
    const mapContainer = document.getElementById("mapContainer");
    const routeSvg      = document.getElementById("routeSvg");
    const pontoPartida  = document.getElementById("pontoPartida");
    const infoBox       = document.getElementById("infoBox");
    const btnLimpar     = document.getElementById("btnLimpar");
    const hotspots      = document.querySelectorAll(".hotspot:not(.start-point)");
    const botoesRapidos = document.querySelectorAll(".btn-quick");

    // Guarda o hotspot atualmente selecionado (destino)
    let destinoSelecionado = null;

    // Guarda os elementos SVG do percurso atual (para poder limpar depois)
    let elementosRota = [];

    // ID da animação da bolinha (para poder cancelar se necessário)
    let animacaoId = null;

    /* ============================================================
       Função auxiliar: devolve o centro (x, y) em pixels de um
       hotspot, relativo ao map-container (necessário porque os
       hotspots estão posicionados em percentagem).
       ============================================================ */
    function obterCentro(elemento) {
        const rectHotspot   = elemento.getBoundingClientRect();
        const rectContainer = mapContainer.getBoundingClientRect();

        return {
            x: rectHotspot.left + rectHotspot.width / 2 - rectContainer.left,
            y: rectHotspot.top + rectHotspot.height / 2 - rectContainer.top
        };
    }

    /* ============================================================
       Seleciona visualmente um hotspot como destino
       ============================================================ */
    function selecionarDestino(elemento) {
        // Remove seleção anterior, se existir
        hotspots.forEach(h => h.classList.remove("selected"));

        elemento.classList.add("selected");
        destinoSelecionado = elemento;

        const nomeDestino = elemento.querySelector(".hotspot-label").textContent;
        infoBox.textContent = `📍 Destino selecionado: ${nomeDestino}. Clica novamente para traçar o percurso.`;
    }

    /* ============================================================
       Limpa o percurso desenhado (linha + bolinha) do SVG
       ============================================================ */
    function limparPercurso() {
        elementosRota.forEach(el => el.remove());
        elementosRota = [];

        if (animacaoId) {
            cancelAnimationFrame(animacaoId);
            animacaoId = null;
        }
    }

    /* ============================================================
       Limpa tudo: percurso + seleção de destino
       ============================================================ */
    function limparTudo() {
        limparPercurso();
        hotspots.forEach(h => h.classList.remove("selected"));
        destinoSelecionado = null;
        infoBox.textContent = "👆 Clica num local para o selecionar. Clica novamente para traçar o percurso.";
    }

    /* ============================================================
       Desenha o percurso animado (linha roxa) entre a origem
       (ponto de partida) e o destino escolhido, e faz uma
       bolinha percorrer essa linha.
       ============================================================ */
    function desenharPercurso(elementoDestino) {

        limparPercurso(); // remove percurso anterior, se existir

        const origem  = obterCentro(pontoPartida);
        const destino = obterCentro(elementoDestino);

        // Namespace obrigatório para criar elementos SVG via JS
        const svgNS = "http://www.w3.org/2000/svg";

        // Cria um caminho (path) com uma pequena curva para parecer
        // mais natural do que uma linha reta (ponto médio deslocado)
        const meioX = (origem.x + destino.x) / 2;
        const meioY = (origem.y + destino.y) / 2 - 30; // curva ligeira para cima

        const d = `M ${origem.x} ${origem.y} Q ${meioX} ${meioY} ${destino.x} ${destino.y}`;

        const path = document.createElementNS(svgNS, "path");
        path.setAttribute("d", d);
        path.setAttribute("class", "route-line");
        routeSvg.appendChild(path);
        elementosRota.push(path);

        // ---------- Animação da linha a "desenhar-se" ----------
        const comprimentoTotal = path.getTotalLength();
        path.style.strokeDasharray = comprimentoTotal;
        path.style.strokeDashoffset = comprimentoTotal;

        // Força reflow para garantir que a transição CSS funciona
        path.getBoundingClientRect();

        path.style.transition = "stroke-dashoffset 1.2s ease-in-out";
        path.style.strokeDashoffset = "0";

        // ---------- Bolinha que percorre a linha ----------
        const bolinha = document.createElementNS(svgNS, "circle");
        bolinha.setAttribute("r", "7");
        bolinha.setAttribute("class", "route-dot");
        routeSvg.appendChild(bolinha);
        elementosRota.push(bolinha);

        const duracao = 1200; // duração da animação em ms (igual à da linha)
        let inicio = null;

        function animarBolinha(timestamp) {
            if (!inicio) inicio = timestamp;
            const progresso = Math.min((timestamp - inicio) / duracao, 1);

            const pontoAtual = path.getPointAtLength(progresso * comprimentoTotal);
            bolinha.setAttribute("cx", pontoAtual.x);
            bolinha.setAttribute("cy", pontoAtual.y);

            if (progresso < 1) {
                animacaoId = requestAnimationFrame(animarBolinha);
            }
        }

        animacaoId = requestAnimationFrame(animarBolinha);

        const nomeDestino = elementoDestino.querySelector(".hotspot-label").textContent;
        infoBox.textContent = `✅ Percurso traçado até ${nomeDestino}.`;
    }

    /* ============================================================
       Evento de clique em cada hotspot:
       - 1º clique -> seleciona
       - 2º clique (no mesmo hotspot já selecionado) -> traça percurso
       ============================================================ */
    hotspots.forEach(hotspot => {
        hotspot.addEventListener("click", function () {
            if (destinoSelecionado === hotspot) {
                // já estava selecionado -> segundo clique = desenhar percurso
                desenharPercurso(hotspot);
            } else {
                // primeiro clique -> apenas seleciona
                selecionarDestino(hotspot);
            }
        });
    });

    /* ============================================================
       Botão "Limpar Percurso"
       ============================================================ */
    btnLimpar.addEventListener("click", limparTudo);

    /* ============================================================
       Botões de acesso rápido (Biblioteca, Cantina, Pavilhão)
       Selecionam e traçam o percurso imediatamente, num só clique.
       ============================================================ */
    botoesRapidos.forEach(botao => {
        botao.addEventListener("click", function () {
            const nomeDestino = botao.dataset.destino;
            const hotspotAlvo = document.querySelector(`.hotspot[data-nome="${nomeDestino}"]`);

            if (hotspotAlvo) {
                selecionarDestino(hotspotAlvo);
                desenharPercurso(hotspotAlvo);
            }
        });
    });

    /* ============================================================
       Redesenha o percurso automaticamente se a janela for
       redimensionada (as posições em % mudam de pixels).
       ============================================================ */
    window.addEventListener("resize", function () {
        if (destinoSelecionado && elementosRota.length > 0) {
            desenharPercurso(destinoSelecionado);
        }
    });

});