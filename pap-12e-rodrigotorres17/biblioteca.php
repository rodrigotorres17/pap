```html
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Biblioteca Escolar — Escola de Canelas</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
}

body{
    font-family:'Poppins', 'Segoe UI', sans-serif;
    background:#fff5f5;
    color:#333;
}

/* HEADER */

header{
    background:#b30000;
    color:white;
    padding:25px;
    text-align:center;
    font-size:30px;
    font-weight:700;
    box-shadow:0 4px 12px rgba(0,0,0,.2);
}

/* CONTAINER */

.container{
    max-width:1200px;
    margin:auto;
    padding:25px;
}

/* IMAGEM */

.hero{
    overflow:hidden;
    border-radius:25px;
    box-shadow:0 8px 20px rgba(0,0,0,.2);
    margin-bottom:30px;
}

.hero img{
    width:100%;
    height:auto;
    display:block;
}

/* DESCRIÇÃO */

.description{
    background:white;
    padding:30px;
    border-radius:20px;
    text-align:center;
    box-shadow:0 4px 12px rgba(0,0,0,.15);
    margin-bottom:35px;
}

.description h2{
    color:#b30000;
    font-size:32px;
    margin-bottom:15px;
}

.description p{
    font-size:18px;
    line-height:1.8;
    color:#555;
}

/* CARDS */

.menu-biblioteca{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(240px,1fr));
    gap:25px;
}

.card{
    background:white;
    border-radius:20px;
    padding:30px;
    text-align:center;
    cursor:pointer;
    transition:.3s;
    border-top:6px solid #b30000;
    box-shadow:0 6px 16px rgba(0,0,0,.12);
}

.card:hover{
    transform:translateY(-8px);
    box-shadow:0 12px 25px rgba(179,0,0,.25);
}

.emoji{
    font-size:55px;
}

.card h3{
    margin:15px 0 10px;
    color:#b30000;
    font-size:24px;
}

.card p{
    color:#666;
    font-size:16px;
}

/* SECÇÕES */

.info-section{
    display:none;
    background:white;
    margin-top:25px;
    padding:25px;
    border-radius:20px;
    box-shadow:0 4px 12px rgba(0,0,0,.15);
    animation:fade .3s ease;
}

.info-section h3{
    color:#b30000;
    font-size:28px;
    margin-bottom:15px;
}

.info-section ul{
    padding-left:20px;
    line-height:1.9;
}

.info-section p{
    line-height:1.8;
}

@keyframes fade{
    from{
        opacity:0;
        transform:translateY(15px);
    }
    to{
        opacity:1;
        transform:translateY(0);
    }
}

/* VOLTAR */

.back{
    text-align:center;
    margin-top:40px;
}

.back button{
    background:transparent;
    color:#b30000;
    border:2px solid #b30000;
    padding:14px 30px;
    font-size:18px;
    border-radius:14px;
    cursor:pointer;
    transition:.3s;
}

.back button:hover{
    background:#b30000;
    color:white;
}
</style>
</head>

<body>

<header>
📚 Biblioteca Escolar
</header>

<div class="container">

    <div class="hero">
        <img src="imgs/bibliotecafoto.jpg" alt="Biblioteca Escolar">
    </div>

    <div class="description">

        <h2>Bem-vindo à Biblioteca Escolar</h2>

        <p>
            A Biblioteca Escolar é um espaço dedicado ao conhecimento,
            à leitura, à pesquisa e ao desenvolvimento académico dos alunos.
            Aqui podes requisitar livros, utilizar computadores, estudar
            individualmente ou em grupo e participar em diversas atividades
            educativas num ambiente tranquilo, moderno e acolhedor.
        </p>

    </div>

    <div class="menu-biblioteca">

        <div class="card" onclick="showInfo('horario')">
            <div class="emoji">⏰</div>
            <h3>Horário</h3>
            <p>Consulta o horário de funcionamento.</p>
        </div>

        <div class="card" onclick="showInfo('regras')">
            <div class="emoji">📜</div>
            <h3>Regras</h3>
            <p>Normas de utilização da biblioteca.</p>
        </div>

        <div class="card" onclick="showInfo('localizacao')">
            <div class="emoji">🗺️</div>
            <h3>Localização</h3>
            <p>Onde encontrar a biblioteca.</p>
        </div>

        <div class="card" onclick="showInfo('contactos')">
            <div class="emoji">📞</div>
            <h3>Contactos</h3>
            <p>Informações para contacto.</p>
        </div>

    </div>

    <div id="horario" class="info-section">

        <h3>⏰ Horário da Biblioteca</h3>

        <p>
            Segunda a Sexta-feira: 08:15 às 17:30<br>
            Sábado e Domingo: Encerrado
        </p>

    </div>

    <div id="regras" class="info-section">

        <h3>📜 Regras da Biblioteca</h3>

        <ul>
            <li>Manter silêncio e um ambiente adequado ao estudo.</li>
            <li>Telemóveis devem permanecer em modo silencioso.</li>
            <li>É proibido comer junto dos livros ou equipamentos.</li>
            <li>Manusear livros e materiais com cuidado.</li>
            <li>Não dobrar páginas nem escrever nos livros.</li>
            <li>Respeitar os prazos de devolução dos empréstimos.</li>
            <li>Os computadores destinam-se apenas a fins educativos.</li>
            <li>Manter as mesas limpas e organizadas.</li>
            <li>Depositar resíduos nos recipientes apropriados.</li>
            <li>Não deslocar mobiliário sem autorização.</li>
            <li>Respeitar colegas, funcionários e professores.</li>
            <li>Reservar espaços de estudo antecipadamente quando necessário.</li>
            <li>Não retirar materiais sem registo de empréstimo.</li>
            <li>Comunicar imediatamente qualquer dano observado.</li>
            <li>Utilizar linguagem adequada dentro das instalações.</li>
            <li>Não correr nem provocar ruído excessivo.</li>
            <li>Proteger os equipamentos informáticos da biblioteca.</li>
            <li>Citar corretamente fontes utilizadas em trabalhos escolares.</li>
            <li>Participar de forma responsável nas atividades promovidas.</li>
            <li>Contribuir para que a biblioteca seja um espaço agradável para todos.</li>
        </ul>

    </div>

    <div id="localizacao" class="info-section">

        <h3>🗺️ Localização</h3>

        <p>
            Rua Delfim Lima, Apartado 512<br>
            4411-701 Vila Nova de Gaia
        </p>

        <br>

        <iframe
            width="100%"
            height="350"
            style="border:0;border-radius:15px;"
            loading="lazy"
            allowfullscreen
            src="https://maps.google.com/maps?q=Escola%20Secundaria%20de%20Canelas&t=&z=15&ie=UTF8&iwloc=&output=embed">
        </iframe>

    </div>

    <div id="contactos" class="info-section">

        <h3>📞 Contactos</h3>

        <p>
            Telefone: +351 223 456 789<br>
            Email: biblioteca@escoladecanelas.pt
        </p>

    </div>

    <div class="back">
        <button onclick="location.href='menuprimario.php'">
            ⬅ Voltar ao Menu
        </button>
    </div>

</div>

<script>

function showInfo(sectionId){

    const sections=document.querySelectorAll('.info-section');

    sections.forEach(section=>{
        section.style.display='none';
    });

    const selected=document.getElementById(sectionId);

    if(selected){

        selected.style.display='block';

        selected.scrollIntoView({
            behavior:'smooth',
            block:'start'
        });

    }
}

</script>

</body>
</html>
```
