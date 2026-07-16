<!doctype html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Escola de Canelas — Início de Sessão</title>
  <style>
    * {
      box-sizing: border-box;
    }

    /* ======== BASE ======== */
    body {
      font-family: 'Poppins', Arial, sans-serif;
      background: linear-gradient(135deg, #fff 0%, #ffeaea 100%);
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      min-height: 100vh;
      overflow-x: hidden;
    }

    header {
      width: 100%;
      max-width: 1340px;
      text-align: center;
      margin-bottom: 1.5rem;
      animation: fadeInDown 1s ease;
    }

    .school-photo {
      display: block;
      width: 100%;
      height: clamp(180px, 32vw, 300px);
      object-fit: cover;
      margin-bottom: 0.4rem;
    }

    h1 {
      color: #b30000;
      margin: 0;
      font-size: 2rem;
    }

    p {
      color: #555;
      margin: 0.3rem 0 0;
    }

    main {
      width: 100%;
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 0 1rem;
    }

    .school-logo {
      display: block;
      width: min(410px, 100%);
      height: auto;
      margin-bottom: 0.4rem;
    }

    .photo {
      width: 90%;
      max-width: 600px;
      border-radius: 12px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.2);
      margin-bottom: 2rem;
      animation: fadeIn 1.2s ease;
    }

    /* ======== LOGIN BOX ======== */
    .login-box {
      background: #fff;
      padding: 2rem;
      border-radius: 12px;
      box-shadow: 0 6px 18px rgba(179, 0, 0, 0.25);
      width: min(100%, 425px);
      text-align: left;
      animation: slideUp 1s ease;
      border-top: 5px solid #b30000;
    }

    .login-box h2 {
      text-align: center;
      color: #b30000;
      margin-bottom: 1.5rem;
    }

    label {
      font-weight: 600;
      color: #333;
      display: block;
      margin-top: 1rem;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 0.7rem;
      margin-top: 0.5rem;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 1rem;
      transition: border 0.3s;
    }

    input:focus {
      outline: none;
      border-color: #b30000;
      box-shadow: 0 0 5px rgba(179, 0, 0, 0.3);
    }

    button {
      width: 100%;
      margin-top: 1.5rem;
      padding: 0.8rem;
      background-color: #b30000;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 1rem;
      cursor: pointer;
      transition: all 0.3s ease;
    }

    button:hover {
      background-color: #d60000;
      transform: scale(1.03);
      box-shadow: 0 4px 10px rgba(179,0,0,0.4);
    }

    .links {
      text-align: center;
      margin-top: 1rem;
    }

    .links a {
      color: #b30000;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s;
    }

    .links a:hover {
      color: #d60000;
      text-decoration: underline;
    }

    footer {
      margin-top: 2rem;
      color: #777;
      font-size: 0.9rem;
      text-align: center;
      padding: 0 1rem 1.5rem;
    }

    /* ======== ANIMAÇÕES ======== */
    @keyframes fadeIn {
      from { opacity: 0; transform: scale(0.95); }
      to { opacity: 1; transform: scale(1); }
    }

    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes slideUp {
      from { opacity: 0; transform: translateY(50px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 600px) {
      h1 { font-size: 1.65rem; }
      header { margin-bottom: 1rem; }
      .login-box { padding: 1.5rem; }
      footer { margin-top: 1.5rem; }
    }
  </style>
</head>
<body>

  <header>
    <img class="school-photo" src="imgs/biblioteca.jpg" alt="Edifício da Escola de Canelas">
    <h1>Escola de Canelas</h1>
    <p>Bem-vindo ao portal do mapa interativo oficial da escola</p>
  </header>

  <main>
    <img class="school-logo" src="imgs/agrcanelas.png" alt="Logotipo do Agrupamento de Escolas de Canelas">

    <div class="login-box">
      <h2>Iniciar Sessão</h2>

      <!-- AGORA ENVIA PARA menuprimario.php -->
      <form action="menuprimario.php" method="post">
        <label for="username">Utilizador:</label>
        <input id="username" name="username" type="text" required>

        <label for="password">Palavra-passe:</label>
        <input id="password" name="password" type="password" required>

        <button type="submit">Entrar</button>
      </form>

      <div class="links">
        <p><a href="registar.html">Registar nova conta</a> | <a href="recuperar.html">Esqueceu a palavra-passe?</a></p>
      </div>
    </div>
  </main>

  <footer>
    &copy; 2025 Escola de Canelas — Todos os direitos reservados
  </footer>

</body>
</html>
