```html
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cantina — Escola de Canelas</title>

<style>
body {
    margin: 0;
    font-family: Poppins, Arial, sans-serif;
    background: #fff5f5;
    color: #333;
}

/* HEADER */
header {
    background: #b30000;
    color: white;
    padding: 25px;
    text-align: center;
    font-size: 28px;
    font-weight: 600;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

/* CONTAINER */
.container {
    padding: 25px;
    max-width: 1200px;
    margin: auto;
}

/* IMAGEM */
.hero {
    width: 100%;
    overflow: hidden;
    border-radius: 25px;
    box-shadow: 0 6px 16px rgba(0,0,0,0.25);
    margin-bottom: 30px;
}

.hero img {
    width: 100%;
    display: block;
}

/* DESCRIÇÃO */
.description {
    background: white;
    padding: 25px;
    border-radius: 20px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    margin-bottom: 35px;
    text-align: center;
}

.description h2 {
    color: #b30000;
    margin-top: 0;
}

.description p {
    font-size: 18px;
    line-height: 1.6;
}

/* MENU TEMÁTICO */
.menu-cantina {
    display: grid;
    grid-template-columns: repeat(auto-fit,minmax(250px,1fr));
    gap: 25px;
}

.menu-card {
    background: white;
    border-radius: 20px;
    padding: 30px;
    text-align: center;
    cursor: pointer;
    transition: 0.3s;
    box-shadow: 0 6px 16px rgba(0,0,0,0.12);
    border-top: 6px solid #b30000;
}

.menu-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 12px 25px rgba(179,0,0,0.25);
}

.menu-card h3 {
    color: #b30000;
    margin: 15px 0 10px;
    font-size: 22px;
}

.menu-card p {
    color: #666;
    margin: 0;
}

.emoji {
    font-size: 55px;
}

/* SECÇÕES */
.info-section {
    background: white;
    padding: 25px;
    border-radius: 20px;
    margin-top: 25px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    display: none;
}

.info-section h3 {
    color: #b30000;
    margin-top: 0;
}

/* VOLTAR */
.back {
    text-align: center;
    margin-top: 40px;
}

.back button {
    background: transparent;
    color: #b30000;
    border: 2px solid #b30000;
    padding: 14px 30px;
    border-radius: 14px;
    font-size: 18px;
    cursor: pointer;
    transition: 0.3s;
}

.back button:hover {
    background: #b30000;
    color: white;
}
</style>
</head>

<body>

<header>
🍽️ Cantina Escolar
</header>

<div class="container">

    <div class="hero">
        <img src="imgs/cantinafoto.jpg" alt="Cantina Escolar">
    </div>

    <div class="description">
        <h2>Bem-vindo à Cantina Escolar</h2>

        <p>
            A cantina da Escola de Canelas oferece refeições equilibradas,
            saudáveis e preparadas diariamente para toda a comunidade escolar.
        </p>

        <p>
            Consulta os horários, ementas, preços e contactos através dos painéis abaixo.
        </p>
    </div>

    <div class="menu-cantina">

        <div class="menu-card" onclick="showInfo('horario')">
            <div class="emoji">⏰</div>
            <h3>Horários</h3>
            <p>Consulta os horários de funcionamento.</p>
        </div>

        <div class="menu-card" onclick="showInfo('ementa')">
            <div class="emoji">🍲</div>
            <h3>Ementa</h3>
            <p>Descobre os pratos da semana.</p>
        </div>

        <div class="menu-card" onclick="showInfo('precos')">
            <div class="emoji">💰</div>
            <h3>Preçário</h3>
            <p>Consulta os preços das refeições.</p>
        </div>

        <div class="menu-card" onclick="showInfo('contactos')">
            <div class="emoji">📞</div>
            <h3>Contactos</h3>
            <p>Informações úteis da cantina.</p>
        </div>

    </div>

    <div id="horario" class="info-section">
        <h3>⏰ Horário de Funcionamento</h3>

        <p>
            Pequeno-almoço: 08:00 - 10:00<br>
            Almoço: 12:00 - 14:30<br>
            Lanche: 15:30 - 17:00
        </p>
    </div>

    <div id="ementa" class="info-section">
        <h3>🍲 Ementa da Semana</h3>

        <p><strong>Segunda-feira</strong><br>
        Sopa de legumes<br>
        Frango assado com arroz<br>
        Fruta da época</p>

        <p><strong>Terça-feira</strong><br>
        Creme de cenoura<br>
        Pescada cozida com batata<br>
        Gelatina</p>

        <p><strong>Quarta-feira</strong><br>
        Sopa juliana<br>
        Massa à bolonhesa<br>
        Maçã</p>

        <p><strong>Quinta-feira</strong><br>
        Creme de abóbora<br>
        Hambúrguer no prato com arroz<br>
        Iogurte</p>

        <p><strong>Sexta-feira</strong><br>
        Sopa de legumes<br>
        Filetes de peixe com arroz de tomate<br>
        Pera</p>
    </div>

    <div id="precos" class="info-section">
        <h3>💰 Preçário</h3>

        <ul>
            <li>Refeição Completa (Aluno): 1,46€</li>
            <li>Refeição Vegetariana (Aluno): 1,68€</li>
            <li>Refeição Completa (Professor): 4,20€</li>
            <li>Refeição Vegetariana (Professor): 4,80€</li>
            <li>Extras:</li>
            <ul>
                <li>Salada: 0,40€</li>
                <li>Sobremesa Extra: 0,90€</li>
                <li>Sumo de Fruta: 0,30€</li>


        </ul>
    </div>

    <div id="contactos" class="info-section">
        <h3>📞 Contactos</h3>

        <p>
            Telefone: +351 227 000 000<br>
            Email: cantina@aecan.pt
        </p>
    </div>

    <div class="back">
        <button onclick="location.href='menuprimario.php'">
            ⬅ Voltar ao Menu
        </button>
    </div>

</div>

<script>
function showInfo(sectionId) {

    const sections = document.querySelectorAll('.info-section');

    sections.forEach(section => {
        section.style.display = 'none';
    });

    const selected = document.getElementById(sectionId);

    if(selected){
        selected.style.display = 'block';

        selected.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}
</script>

</body>
</html>
```
