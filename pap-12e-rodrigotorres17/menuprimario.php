<?php
/* ============================================================
   menuprimario.php
   Página principal do sistema de mapa interativo da escola.
   - Legenda de cores transformada em painel de botões clicáveis
   - Pins reposicionados sobre o mapa (ajustar % conforme a planta real)
   - Biblioteca / Cantina / Bar Alunos são links de navegação
     para páginas próprias (Pavilhão continua a ser um local
     do mapa, distinto do Bar Alunos)
   - Origem e destino são ambos escolhidos pelo utilizador
     (1º clique = origem, 2º clique = destino e traça o percurso)
   ============================================================ */

session_start();

$nomeUtilizador = isset($_SESSION['nome']) ? htmlspecialchars($_SESSION['nome']) : "Utilizador";
?>
<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mapa da Escola - Menu Principal</title>

    <style>
    * { margin:0; padding:0; box-sizing:border-box; font-family:'Segoe UI', Roboto, Arial, sans-serif; }

    :root {
        --vermelho-principal: #b30000;
        --vermelho-escuro: #8a0000;
        --vermelho-claro: #ffeaea;
        --vermelho-hover: #d60000;
        --cinza-fundo: #f4f5f7;
        --cinza-texto: #333;
        --branco: #ffffff;
        --vermelho: #e53e3e;
        --sombra: 0 4px 12px rgba(179,0,0,0.12);

        /* Mantidas apenas para a linha do percurso (requisito do enunciado: "linha roxa") */
        --roxo: #7c3aed;
        --roxo-escuro: #5b21b6;

        /* Cor para marcar a origem escolhida pelo utilizador */
        --verde-origem: #10b981;
        --verde-origem-escuro: #047857;
    }

    body { background:linear-gradient(135deg, #fff 0%, #ffeaea 100%); color:var(--cinza-texto); min-height:100vh; }

    /* ---------- HEADER ---------- */
    .header {
        display:flex; justify-content:space-between; align-items:center;
        background:linear-gradient(90deg, var(--vermelho-principal), var(--vermelho-escuro));
        color:var(--branco); padding:14px 30px; box-shadow:var(--sombra);
        position:sticky; top:0; z-index:100;
    }
    .logo { font-size:1.3rem; letter-spacing:0.5px; }
    .header-right { display:flex; align-items:center; gap:14px; }
    .user-name { font-weight:500; }
    .btn { border:none; padding:8px 16px; border-radius:20px; cursor:pointer; font-size:0.9rem; transition:transform .15s ease, background .2s ease; }
    .btn:hover { transform:translateY(-2px); }
    .btn-perfil { background:var(--branco); color:var(--vermelho-escuro); }
    .btn-perfil:hover { background:var(--vermelho-claro); }
    .btn-logout { background:#7a0000; color:var(--branco); }
    .btn-logout:hover { background:#5c0000; }

    /* ---------- BARRA DE NAVEGAÇÃO RÁPIDA (páginas próprias) ---------- */
    .nav-quick {
        display:flex; align-items:center; flex-wrap:wrap; gap:10px;
        background:var(--branco); padding:12px 30px; box-shadow:var(--sombra);
    }
    .nav-quick-title { font-weight:600; color:#555; margin-right:6px; }
    .btn-nav {
        border:1px solid var(--vermelho-principal); background:var(--vermelho-claro); color:var(--vermelho-escuro);
        padding:8px 14px; border-radius:18px; cursor:pointer; font-size:0.85rem; font-weight:500;
        text-decoration:none; transition:all .2s ease; display:inline-flex; align-items:center; gap:6px;
    }
    .btn-nav:hover { background:var(--vermelho-principal); color:var(--branco); }

    /* ---------- BARRA DE FERRAMENTAS DO MAPA ---------- */
    .map-toolbar {
        display:flex; justify-content:space-between; align-items:center; padding:10px 30px 0; gap:10px; flex-wrap:wrap;
    }
    .map-toolbar-hint { font-size:0.8rem; color:#666; }
    .btn-clear {
        border:1px solid var(--vermelho-principal); background:var(--vermelho-claro); color:var(--vermelho-principal);
        padding:8px 14px; border-radius:18px; cursor:pointer; font-size:0.85rem; font-weight:500;
        transition:all .2s ease;
    }
    .btn-clear:hover { background:var(--vermelho-principal); color:var(--branco); }

    /* ---------- LAYOUT MAPA + LEGENDA ---------- */
    .map-wrapper {
        display:flex; gap:20px; align-items:flex-start;
        padding:16px 24px 24px; max-width:1200px; margin:0 auto; flex-wrap:wrap;
    }

    .map-container {
        position:relative; flex:1 1 640px; min-width:300px;
        aspect-ratio:16/10; background:var(--branco); border-radius:16px;
        overflow:hidden; box-shadow:var(--sombra);
    }

    .map-image { width:100%; height:100%; object-fit:cover; display:block; user-select:none; pointer-events:none; }

    .route-svg { position:absolute; top:0; left:0; width:100%; height:100%; pointer-events:none; }

    .route-line { fill:none; stroke:var(--roxo); stroke-width:5; stroke-linecap:round; filter:drop-shadow(0 0 4px rgba(124,58,237,.6)); }
    .route-dot { fill:var(--roxo-escuro); stroke:var(--branco); stroke-width:2; }

    /* ---------- Pins no mapa ---------- */
    .hotspot { position:absolute; transform:translate(-50%,-50%); display:flex; flex-direction:column; align-items:center; cursor:pointer; z-index:5; }
    .hotspot-marker { width:16px; height:16px; border:3px solid var(--branco); border-radius:50%; box-shadow:0 0 0 rgba(179,0,0,.4); animation:pulse 2s infinite; transition:transform .2s ease; }
    .hotspot:hover .hotspot-marker { transform:scale(1.25); }

    /* Origem escolhida pelo utilizador (verde) */
    .hotspot.origem-selecionada .hotspot-marker { transform:scale(1.4); outline:3px solid var(--verde-origem-escuro); animation:none; }
    /* Destino escolhido pelo utilizador (vermelho, como antes) */
    .hotspot.selected .hotspot-marker { transform:scale(1.4); outline:3px solid var(--vermelho-principal); animation:none; }

    .hotspot-label {
        margin-top:4px; background:var(--branco); padding:2px 8px; border-radius:10px;
        font-size:0.7rem; font-weight:600; box-shadow:var(--sombra); white-space:nowrap;
    }

    /* Pin mais pequeno (ex: Bar Alunos) */
    .hotspot-marker-small { width:10px; height:10px; border-width:2px; }
    .hotspot-label-small { font-size:0.6rem; padding:1px 6px; }

    /* Item de legenda mais pequeno / secundário */
    .legend-item-small { font-size:0.75rem; opacity:0.85; }
    .legend-item-small .legend-swatch { width:12px; height:12px; }

    @keyframes pulse {
        0% { box-shadow:0 0 0 0 rgba(179,0,0,.4); }
        70% { box-shadow:0 0 0 10px rgba(179,0,0,0); }
        100% { box-shadow:0 0 0 0 rgba(179,0,0,0); }
    }

    /* ---------- Painel de legenda clicável ---------- */
    .legend-panel {
        flex:0 0 220px; background:var(--branco); border-radius:16px; box-shadow:var(--sombra);
        padding:14px; display:flex; flex-direction:column; gap:6px;
    }
    .legend-title { font-weight:700; font-size:0.9rem; margin-bottom:2px; color:#444; }
    .legend-subtitle { font-size:0.72rem; color:#888; margin-bottom:6px; }
    .legend-item {
        display:flex; align-items:center; gap:10px; border:none; background:transparent;
        padding:8px 10px; border-radius:10px; cursor:pointer; text-align:left; font-size:0.85rem;
        font-weight:500; color:var(--cinza-texto); transition:background .15s ease;
    }
    .legend-item:hover { background:var(--vermelho-claro); }
    .legend-item.selected { background:#ffd8d8; }
    .legend-item.origem-selected { background:#d1fae5; }
    .legend-swatch { width:16px; height:16px; border-radius:4px; flex-shrink:0; border:1px solid rgba(0,0,0,.15); }

    /* ---------- Caixa de informação ---------- */
    .info-box {
        margin:0 24px 20px; background:var(--branco); padding:10px 20px; border-radius:12px;
        box-shadow:var(--sombra); font-size:0.9rem; text-align:center; max-width:1152px; margin-left:auto; margin-right:auto;
    }

    /* Indicador de coordenadas (modo de calibração com Alt+clique) */
    .coord-helper {
        position:fixed; bottom:14px; left:14px; background:rgba(0,0,0,.75); color:#fff;
        padding:6px 12px; border-radius:8px; font-size:0.75rem; z-index:999; display:none;
    }

    /* ---------- RESPONSIVIDADE ---------- */
    @media (max-width:900px) {
        .map-wrapper { flex-direction:column; }
        .legend-panel { flex:1 1 auto; width:100%; flex-direction:row; flex-wrap:wrap; }
        .legend-item { flex:1 1 45%; }
    }
    @media (max-width:768px) {
        .header { flex-direction:column; gap:10px; padding:12px 16px; }
        .header-right { flex-wrap:wrap; justify-content:center; }
        .nav-quick { justify-content:center; padding:12px; }
        .hotspot-label { font-size:0.6rem; padding:1px 6px; }
    }
    @media (max-width:480px) {
        .map-wrapper { padding:10px; }
        .map-container { border-radius:10px; aspect-ratio:3/4; }
        .legend-item { flex:1 1 100%; }
    }
    </style>
</head>
<body>

    <!-- ==================== HEADER ==================== -->
    <header class="header">
        <div class="header-left"><span class="logo">🏫 <strong>EscolaMap</strong></span></div>
        <div class="header-right">
            <span class="user-name">Olá, <?php echo $nomeUtilizador; ?></span>
            <button class="btn btn-perfil" onclick="window.location.href='perfil.php'">👤 Perfil</button>
            <button class="btn btn-logout" onclick="window.location.href='index.php'">🚪 Logout</button>
        </div>
    </header>

    <!-- ==================== NAVEGAÇÃO RÁPIDA (páginas próprias) ==================== -->
    <section class="nav-quick">
        <span class="nav-quick-title">Ir para:</span>
        <a class="btn-nav" href="biblioteca.php">📚 Biblioteca</a>
        <a class="btn-nav" href="cantina.php">🍽️ Cantina</a>
        <a class="btn-nav" href="baralunos.php">🥤 Bar Alunos</a>
    </section>

    <!-- ==================== FERRAMENTAS DO MAPA ==================== -->
    <div class="map-toolbar">
        <span class="map-toolbar-hint">🟢 1º clique = origem &nbsp;·&nbsp; 🔴 2º clique = destino</span>
        <button class="btn-clear" id="btnLimpar">🧹 Limpar Percurso</button>
    </div>

    <!-- ==================== MAPA + LEGENDA ==================== -->
    <main class="map-wrapper">

        <div class="map-container" id="mapContainer">

            <img src="imgs/planta_editada.png" alt="Planta da Escola" class="map-image" id="mapImage">

            <svg id="routeSvg" class="route-svg"></svg>

            <!-- Entrada: agora é um ponto normal, tal como os outros -->
            <div class="hotspot" data-nome="entrada" style="top:35%; left:78%;">
                <div class="hotspot-marker" style="background:#10b981;"></div>
                <span class="hotspot-label">Entrada</span>
            </div>

            <!-- ============ PINS ============
                 Posições estimadas a partir do print enviado.
                 Usa Alt+clique no mapa (em modo de teste) para
                 leres a percentagem exata e ajustares aqui. -->

            <div class="hotspot" data-nome="direcao" style="top:20%; left:68%;">
                <div class="hotspot-marker" style="background:#e63946;"></div>
                <span class="hotspot-label">Direção</span>
            </div>

            <div class="hotspot" data-nome="biblioteca" style="top:46%; left:70%;">
                <div class="hotspot-marker" style="background:#4caf50;"></div>
                <span class="hotspot-label">Biblioteca</span>
            </div>

            <div class="hotspot" data-nome="blocob" style="top:72%; left:68%;">
                <div class="hotspot-marker" style="background:#7ec8e3;"></div>
                <span class="hotspot-label">Bloco B</span>
            </div>

            <div class="hotspot" data-nome="blocoa" style="top:83%; left:68%;">
                <div class="hotspot-marker" style="background:#f2a6c9;"></div>
                <span class="hotspot-label">Bloco A</span>
            </div>

            <div class="hotspot" data-nome="blocoamarelo" style="top:83%; left:38%;">
                <div class="hotspot-marker" style="background:#f4c430;"></div>
                <span class="hotspot-label">Bloco Amarelo/C3</span>
            </div>

            <div class="hotspot" data-nome="pista" style="top:52%; left:37%;">
                <div class="hotspot-marker" style="background:#f4a261;"></div>
                <span class="hotspot-label">Pista de Corrida</span>
            </div>

            <div class="hotspot" data-nome="blocof" style="top:54%; left:52%;">
                <div class="hotspot-marker" style="background:#9d8ec9;"></div>
                <span class="hotspot-label">Bloco F</span>
            </div>

            <div class="hotspot" data-nome="blocog" style="top:29%; left:52%;">
                <div class="hotspot-marker" style="background:#4a6fa5;"></div>
                <span class="hotspot-label">Bloco G</span>
            </div>

            <div class="hotspot" data-nome="cantina" style="top:12%; left:49%;">
                <div class="hotspot-marker" style="background:#a8c66c;"></div>
                <span class="hotspot-label">Cantina</span>
            </div>

            <div class="hotspot" data-nome="recinto" style="top:13%; left:23%;">
                <div class="hotspot-marker" style="background:#6b8e23;"></div>
                <span class="hotspot-label">Recinto Superior</span>
            </div>

            <div class="hotspot" data-nome="pavilhao" style="top:33%; left:19%;">
                <div class="hotspot-marker" style="background:#ffffff; border-color:#333;"></div>
                <span class="hotspot-label">Pavilhão</span>
            </div>

            <!-- Bar Alunos: pin mais pequeno, local diferente do Pavilhão -->
            <div class="hotspot hotspot-mini" data-nome="baralunos" style="top:34%; left:48%;">
                <div class="hotspot-marker hotspot-marker-small" style="background:#fb923c;"></div>
                <span class="hotspot-label hotspot-label-small">Bar Alunos</span>
            </div>

            <div class="hotspot" data-nome="coberto" style="top:57%; left:19%;">
                <div class="hotspot-marker" style="background:#b0b0b0;"></div>
                <span class="hotspot-label">Coberto</span>
            </div>

        </div>

        <!-- ============ PAINEL DE LEGENDA CLICÁVEL ============ -->
        <aside class="legend-panel">
            <span class="legend-title">Legenda / Locais</span>
            <span class="legend-subtitle">1º clique define a origem, 2º clique define o destino</span>

            <button class="legend-item" data-nome="entrada"><span class="legend-swatch" style="background:#10b981;"></span> Entrada</button>
            <button class="legend-item" data-nome="direcao"><span class="legend-swatch" style="background:#e63946;"></span> Direção</button>
            <button class="legend-item" data-nome="biblioteca"><span class="legend-swatch" style="background:#4caf50;"></span> Biblioteca</button>
            <button class="legend-item" data-nome="blocob"><span class="legend-swatch" style="background:#7ec8e3;"></span> Bloco B (B-0, Bloco Musical)</button>
            <button class="legend-item" data-nome="blocoa"><span class="legend-swatch" style="background:#f2a6c9;"></span> Bloco A</button>
            <button class="legend-item" data-nome="blocoamarelo"><span class="legend-swatch" style="background:#f4c430;"></span> Bloco Amarelo/C3</button>
            <button class="legend-item" data-nome="pista"><span class="legend-swatch" style="background:#f4a261;"></span> Pista de Corrida</button>
            <button class="legend-item" data-nome="blocof"><span class="legend-swatch" style="background:#9d8ec9;"></span> Bloco F</button>
            <button class="legend-item" data-nome="blocog"><span class="legend-swatch" style="background:#4a6fa5;"></span> Bloco G</button>
            <button class="legend-item" data-nome="cantina"><span class="legend-swatch" style="background:#a8c66c;"></span> Cantina</button>
            <button class="legend-item" data-nome="recinto"><span class="legend-swatch" style="background:#6b8e23;"></span> Recinto Superior</button>
            <button class="legend-item" data-nome="pavilhao"><span class="legend-swatch" style="background:#ffffff; border:1px solid #333;"></span> Pavilhão</button>
            <button class="legend-item" data-nome="coberto"><span class="legend-swatch" style="background:#b0b0b0;"></span> Coberto</button>
            <button class="legend-item legend-item-small" data-nome="baralunos"><span class="legend-swatch" style="background:#fb923c;"></span> Bar Alunos</button>
        </aside>

    </main>

    <div class="info-box" id="infoBox">👆 Clica num pin ou item da legenda para escolheres a <strong>origem</strong>. Depois clica noutro para escolheres o <strong>destino</strong>.</div>

    <div class="coord-helper" id="coordHelper"></div>

    <script>
    document.addEventListener("DOMContentLoaded", function () {

        const mapContainer = document.getElementById("mapContainer");
        const routeSvg      = document.getElementById("routeSvg");
        const infoBox       = document.getElementById("infoBox");
        const btnLimpar     = document.getElementById("btnLimpar");
        const hotspots      = document.querySelectorAll(".hotspot");
        const legendItems   = document.querySelectorAll(".legend-item");
        const coordHelper   = document.getElementById("coordHelper");

        let origemSelecionada   = null;
        let destinoSelecionado  = null;
        let elementosRota       = [];
        let animacaoId          = null;

        function nomeLabel(elemento) {
            return elemento.querySelector(".hotspot-label").textContent;
        }

        function obterCentro(elemento) {
            const rectHotspot   = elemento.getBoundingClientRect();
            const rectContainer = mapContainer.getBoundingClientRect();
            return {
                x: rectHotspot.left + rectHotspot.width / 2 - rectContainer.left,
                y: rectHotspot.top + rectHotspot.height / 2 - rectContainer.top
            };
        }

        function atualizarLegenda() {
            legendItems.forEach(li => {
                li.classList.toggle("origem-selected", origemSelecionada && li.dataset.nome === origemSelecionada.dataset.nome);
                li.classList.toggle("selected", destinoSelecionado && li.dataset.nome === destinoSelecionado.dataset.nome);
            });
        }

        function limparPercurso() {
            elementosRota.forEach(el => el.remove());
            elementosRota = [];
            if (animacaoId) { cancelAnimationFrame(animacaoId); animacaoId = null; }
        }

        function limparTudo() {
            limparPercurso();
            hotspots.forEach(h => h.classList.remove("selected", "origem-selecionada"));
            legendItems.forEach(li => li.classList.remove("selected", "origem-selected"));
            origemSelecionada  = null;
            destinoSelecionado = null;
            infoBox.textContent = "👆 Clica num pin ou item da legenda para escolheres a origem. Depois clica noutro para escolheres o destino.";
        }

        function definirOrigem(elemento) {
            limparPercurso();
            hotspots.forEach(h => h.classList.remove("selected", "origem-selecionada"));
            origemSelecionada  = elemento;
            destinoSelecionado = null;
            elemento.classList.add("origem-selecionada");
            atualizarLegenda();
            infoBox.textContent = `🟢 Origem: ${nomeLabel(elemento)}. Agora clica noutro ponto para definires o destino.`;
        }

        function definirDestino(elemento) {
            destinoSelecionado = elemento;
            elemento.classList.add("selected");
            atualizarLegenda();
            desenharPercurso(origemSelecionada, destinoSelecionado);
        }

        function desenharPercurso(elementoOrigem, elementoDestino) {
            limparPercurso();

            const origem  = obterCentro(elementoOrigem);
            const destino = obterCentro(elementoDestino);
            const svgNS = "http://www.w3.org/2000/svg";

            const meioX = (origem.x + destino.x) / 2;
            const meioY = (origem.y + destino.y) / 2 - 30;
            const d = `M ${origem.x} ${origem.y} Q ${meioX} ${meioY} ${destino.x} ${destino.y}`;

            const path = document.createElementNS(svgNS, "path");
            path.setAttribute("d", d);
            path.setAttribute("class", "route-line");
            routeSvg.appendChild(path);
            elementosRota.push(path);

            const comprimentoTotal = path.getTotalLength();
            path.style.strokeDasharray = comprimentoTotal;
            path.style.strokeDashoffset = comprimentoTotal;
            path.getBoundingClientRect();
            path.style.transition = "stroke-dashoffset 1.2s ease-in-out";
            path.style.strokeDashoffset = "0";

            const bolinha = document.createElementNS(svgNS, "circle");
            bolinha.setAttribute("r", "7");
            bolinha.setAttribute("class", "route-dot");
            routeSvg.appendChild(bolinha);
            elementosRota.push(bolinha);

            const duracao = 1200;
            let inicio = null;

            function animarBolinha(timestamp) {
                if (!inicio) inicio = timestamp;
                const progresso = Math.min((timestamp - inicio) / duracao, 1);
                const pontoAtual = path.getPointAtLength(progresso * comprimentoTotal);
                bolinha.setAttribute("cx", pontoAtual.x);
                bolinha.setAttribute("cy", pontoAtual.y);
                if (progresso < 1) animacaoId = requestAnimationFrame(animarBolinha);
            }
            animacaoId = requestAnimationFrame(animarBolinha);

            infoBox.textContent = `✅ Percurso traçado de ${nomeLabel(elementoOrigem)} até ${nomeLabel(elementoDestino)}.`;
        }

        // Lógica comum a pins do mapa e itens da legenda:
        // 1º clique num ponto = origem; 2º clique noutro ponto = destino (traça logo);
        // clicar de novo na origem (sem destino ainda) = desseleciona;
        // clicar num 3º ponto depois de já ter origem+destino = começa um novo trajeto.
        function clicarPonto(elemento) {
            if (origemSelecionada === elemento && !destinoSelecionado) {
                limparTudo();
                return;
            }
            if (origemSelecionada && destinoSelecionado) {
                limparTudo();
            }
            if (!origemSelecionada) {
                definirOrigem(elemento);
            } else if (elemento !== origemSelecionada) {
                definirDestino(elemento);
            }
        }

        hotspots.forEach(hotspot => {
            hotspot.addEventListener("click", function () {
                clicarPonto(hotspot);
            });
        });

        legendItems.forEach(item => {
            item.addEventListener("click", function () {
                const alvo = document.querySelector(`.hotspot[data-nome="${item.dataset.nome}"]`);
                if (alvo) clicarPonto(alvo);
            });
        });

        btnLimpar.addEventListener("click", limparTudo);

        window.addEventListener("resize", function () {
            if (origemSelecionada && destinoSelecionado) desenharPercurso(origemSelecionada, destinoSelecionado);
        });

        /* ============================================================
           MODO DE CALIBRAÇÃO (apenas para ajudar a afinar posições)
           Alt+clique no mapa mostra a percentagem exata (top/left)
           desse ponto, para copiares para o "style" do hotspot certo.
           ============================================================ */
        mapContainer.addEventListener("click", function (e) {
            if (!e.altKey) return;
            const rect = mapContainer.getBoundingClientRect();
            const leftPct = (((e.clientX - rect.left) / rect.width) * 100).toFixed(1);
            const topPct  = (((e.clientY - rect.top) / rect.height) * 100).toFixed(1);
            const texto = `top:${topPct}%; left:${leftPct}%;`;
            coordHelper.textContent = texto;
            coordHelper.style.display = "block";
            console.log(texto);
        });
    });
    </script>
</body>
</html>