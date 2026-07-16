<?php
session_start();

/*==========================================
    VERIFICAÇÃO DA SESSÃO
==========================================*/

if (!isset($_SESSION['utilizador'])) {
    $_SESSION['utilizador'] = "Utilizador";
}

if (!isset($_SESSION['tipo'])) {
    $_SESSION['tipo'] = "utilizador";
}

/*==========================================
    LOGOUT
==========================================*/

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt">

<head>

<meta charset="UTF-8">

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Mapa Interativo | Escola Básica e Secundária de Canelas</title>

<link rel="stylesheet" href="style.css">

<script src="script.js" defer></script>

<link rel="preconnect" href="https://fonts.googleapis.com">

<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

</head>

<body>

<!-- ==========================================================
                        HEADER
=========================================================== -->

<header>

<div class="logo">

<img src="imgs/logo.png" alt="Logo Escola">

<div>

<h1>Escola Básica e Secundária de Canelas</h1>

<p>Mapa Interativo</p>

</div>

</div>



<div class="user-area">

<div class="user">

👤 Olá,

<strong>

<?php echo htmlspecialchars($_SESSION['utilizador']); ?>

</strong>

</div>



<a href="perfil.php" class="profile">

⚙ Perfil

</a>



<?php if($_SESSION['tipo']=="admin"){ ?>

<a href="admin.php" class="admin">

👑 Administração

</a>

<?php } ?>



<form method="GET">

<button class="logout" name="logout">

🔐 Logout

</button>

</form>

</div>

</header>

<!-- ==========================================================
                    TITULO
=========================================================== -->

<section class="hero">

<h2>

Mapa Interativo da Escola

</h2>

<p>

Clique diretamente sobre um edifício para obter mais informações.

</p>

</section>

<!-- ==========================================================
                    MAPA
=========================================================== -->

<section class="map-section">

<div class="map-container">

<img
src="imgs/planta.png"
class="map-image"
alt="Mapa da Escola">

<!-- ===========================================
            HOTSPOTS
=========================================== -->

<!-- Biblioteca -->

<div class="hotspot biblioteca"

onclick="abrirPagina('biblioteca.php')"

data-name="Biblioteca">

<span class="tooltip">

📚 Biblioteca

</span>

</div>


<!-- Bloco A -->

<div class="hotspot blocoA"

onclick="abrirPagina('blocos/blocoA.php')"

data-name="Bloco A">

<span class="tooltip">

Bloco A

</span>

</div>


<!-- Bloco B -->

<div class="hotspot blocoB"

onclick="abrirPagina('blocos/blocoB.php')"

data-name="Bloco B">

<span class="tooltip">

Bloco B

</span>

</div>


<!-- Bloco F -->

<div class="hotspot blocoF"

onclick="abrirPagina('blocos/blocoF.php')"

data-name="Bloco F">

<span class="tooltip">

Bloco F

</span>

</div>


<!-- Bloco G -->

<div class="hotspot blocoG"

onclick="abrirPagina('blocos/blocoG.php')"

data-name="Bloco G">

<span class="tooltip">

Bloco G

</span>

</div>
        <!-- ===========================================
                    CANTINA
        =========================================== -->

        <div class="hotspot cantina"

        onclick="abrirPagina('cantina.php')"

        data-name="Cantina">

            <span class="tooltip">

                🍽️ Cantina

            </span>

        </div>


        <!-- ===========================================
                    PAVILHÃO
        =========================================== -->

        <div class="hotspot pavilhao"

        onclick="abrirPagina('pavilhao.php')"

        data-name="Pavilhão">

            <span class="tooltip">

                🏀 Pavilhão

            </span>

        </div>


        <!-- ===========================================
                    COBERTO
        =========================================== -->

        <div class="hotspot coberto"

        onclick="abrirPagina('coberto.php')"

        data-name="Coberto">

            <span class="tooltip">

                🏟 Coberto

            </span>

        </div>

    </div>

</section>

<!-- ======================================================
                    PAINEL LATERAL
====================================================== -->

<section class="info-panel">

<div class="panel">

<h2>

🏫 Escola Básica e Secundária de Canelas

</h2>

<p>

Bem-vindo ao mapa interativo oficial.

Seleciona qualquer edifício diretamente sobre a planta para visualizar informações detalhadas.

</p>

<div class="stats">

<div class="stat">

<h3>8</h3>

<p>Locais</p>

</div>

<div class="stat">

<h3>100%</h3>

<p>Interativo</p>

</div>

<div class="stat">

<h3>2025</h3>

<p>PAP</p>

</div>

</div>

</div>

</section>


<!-- ======================================================
                    LEGENDA
====================================================== -->

<section class="legend">

<h2>

Legenda

</h2>

<div class="legend-grid">

<div class="legend-item">

<div class="legend-dot"></div>

<span>Biblioteca</span>

</div>

<div class="legend-item">

<div class="legend-dot"></div>

<span>Bloco A</span>

</div>

<div class="legend-item">

<div class="legend-dot"></div>

<span>Bloco B</span>

</div>

<div class="legend-item">

<div class="legend-dot"></div>

<span>Bloco F</span>

</div>

<div class="legend-item">

<div class="legend-dot"></div>

<span>Bloco G</span>

</div>

<div class="legend-item">

<div class="legend-dot"></div>

<span>Cantina</span>

</div>

<div class="legend-item">

<div class="legend-dot"></div>

<span>Pavilhão</span>

</div>

<div class="legend-item">

<div class="legend-dot"></div>

<span>Coberto</span>

</div>

</div>

</section>

<!-- ======================================================
                ACESSO RÁPIDO
====================================================== -->

<section class="quick-links">

<h2>

Acesso Rápido

</h2>

<div class="quick-grid">

<a href="biblioteca.php">

📚 Biblioteca

</a>

<a href="cantina.php">

🍽️ Cantina

</a>

<a href="pavilhao.php">

🏀 Pavilhão

</a>

<a href="blocos/blocoA.php">

🏫 Bloco A

</a>

<a href="blocos/blocoB.php">

🎵 Bloco B

</a>

<a href="blocos/blocoF.php">

📖 Bloco F

</a>

<a href="blocos/blocoG.php">

🧪 Bloco G

</a>

</div>

</section>
<!-- ======================================================
                SOBRE A ESCOLA
====================================================== -->

<section class="about-school">

<div class="about-card">

<h2>🏫 Sobre a Escola</h2>

<p>

A Escola Básica e Secundária de Canelas dispõe de vários edifícios
dedicados ao ensino, desporto, alimentação e lazer.

Este mapa interativo foi desenvolvido para facilitar a localização
dos diferentes espaços escolares de forma simples, intuitiva e moderna.

</p>

</div>

<div class="about-card">

<h2>🎯 Objetivo</h2>

<p>

Pretende-se que qualquer aluno, professor ou visitante consiga
encontrar rapidamente qualquer edifício da escola apenas clicando
sobre a planta.

</p>

</div>

<div class="about-card">

<h2>💻 Projeto PAP</h2>

<p>

Projeto desenvolvido no âmbito da Prova de Aptidão Profissional.

Mapa interativo com tecnologia PHP, HTML, CSS e JavaScript.

</p>

</div>

</section>


<!-- ======================================================
                BOTÕES RÁPIDOS
====================================================== -->

<section class="bottom-buttons">

<button onclick="abrirPagina('biblioteca.php')">

📚 Biblioteca

</button>

<button onclick="abrirPagina('cantina.php')">

🍽 Cantina

</button>

<button onclick="abrirPagina('pavilhao.php')">

🏀 Pavilhão

</button>

<button onclick="abrirPagina('blocos/blocoA.php')">

🏫 Bloco A

</button>

<button onclick="abrirPagina('blocos/blocoB.php')">

🎵 Bloco B

</button>

<button onclick="abrirPagina('blocos/blocoF.php')">

📖 Bloco F

</button>

<button onclick="abrirPagina('blocos/blocoG.php')">

🧪 Bloco G

</button>

</section>


<!-- ======================================================
                CAIXA INFORMATIVA
====================================================== -->

<section class="information">

<div class="info-box">

<h2>ℹ Informação</h2>

<p>

Passe o rato sobre qualquer ponto vermelho da planta.

Clique para abrir a página respetiva.

</p>

</div>

<div class="info-box">

<h2>🖱 Navegação</h2>

<p>

Todos os edifícios possuem acesso direto.

O mapa encontra-se totalmente interativo.

</p>

</div>

<div class="info-box">

<h2>⭐ Dica</h2>

<p>

Utilize um computador para uma melhor experiência de navegação.

</p>

</div>

</section>


<!-- ======================================================
                    RODAPÉ
====================================================== -->

<footer>

<div class="footer-left">

<h3>

Escola Básica e Secundária de Canelas

</h3>

<p>

Mapa Interativo Oficial

</p>

</div>

<div class="footer-center">

<p>

© 2025 Todos os direitos reservados

</p>

</div>

<div class="footer-right">

<p>

Projeto PAP

</p>

</div>

</footer>


<script>

/* Pequena animação de entrada */

window.addEventListener("load",()=>{

document.body.classList.add("loaded");

});

</script>

</body>

</html>
