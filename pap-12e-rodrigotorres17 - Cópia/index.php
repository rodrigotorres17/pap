<!doctype html>
<html lang="pt">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Escola de Canelas — Início de Sessão</title>
  <link rel="stylesheet" href="style.css">
  <style>
    /* ======== BASE ======== */
    body {
      font-family: 'Poppins', Arial, sans-serif;
      background: linear-gradient(135deg, #fff 0%, #ffeaea 100%);
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
    }

    header {
      text-align: center;
      margin-bottom: 2rem;
      animation: fadeInDown 1s ease;
    }

    #logo {
      width: 130px;
      height: auto;
      margin-bottom: 0.8rem;
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
      width: 90%;
      max-width: 360px;
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
  </style>
</head>
<body>

  <header>
    <img src="imgs/biblioteca.jpg" alt="Logotipo da Escola de Canelas" width="100%">
    <h1>Escola de Canelas</h1>
    <p>Bem-vindo ao portal do mapa interativo oficial da escola</p>
  </header>

  <main>
    <img src="imgs/agrcanelas.png" alt="Logotipo da Escola de Canelas" style="margin-left: 18px;">

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
