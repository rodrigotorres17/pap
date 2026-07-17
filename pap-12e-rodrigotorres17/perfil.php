<?php
session_start();
/* Dados de exemplo */
if (!isset($_SESSION['utilizador']))
    $_SESSION['utilizador']="Utilizador";
if (!isset($_SESSION['email']))
    $_SESSION['email']="utilizador@email.pt";
if (!isset($_SESSION['tipo']))
    $_SESSION['tipo']="Utilizador";
if (!isset($_SESSION['foto']))
    $_SESSION['foto']="imgs/default.png";
/* Atualizar perfil */
if(isset($_POST['guardar'])){
    $_SESSION['utilizador']=trim($_POST['nome']);
    $_SESSION['email']=trim($_POST['email']);
    if(isset($_FILES['foto']) && $_FILES['foto']['error']==0){
        $nome=time()."_".$_FILES['foto']['name'];
        move_uploaded_file(
            $_FILES['foto']['tmp_name'],
            "uploads/".$nome
        );
        $_SESSION['foto']="uploads/".$nome;
    }
    $mensagem="Perfil atualizado com sucesso!";
}
?>
<!DOCTYPE html>
<html lang="pt">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>O Meu Perfil</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
<style>
/* ============================================================
   RESET E BASE
   ============================================================ */
* { margin:0; padding:0; box-sizing:border-box; font-family:'Poppins', sans-serif; }

:root {
    --vermelho: #b30000;
    --vermelho-escuro: #8a0000;
    --vermelho-claro: #ffeaea;
    --vermelho-hover: #d60000;
    --cinza-texto: #333;
    --cinza-suave: #777;
    --sombra: 0 10px 30px rgba(179,0,0,.12);
}

body {
    background: linear-gradient(135deg, #fff 0%, #ffeaea 100%);
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-bottom: 40px;
}

/* ============================================================
   BARRA SUPERIOR (com botão voltar)
   ============================================================ */
.topbar {
    width: 100%;
    background: linear-gradient(90deg, var(--vermelho), var(--vermelho-escuro));
    color: #fff;
    padding: 16px 24px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 4px 14px rgba(0,0,0,.15);
    position: sticky;
    top: 0;
    z-index: 10;
}

.topbar-title {
    font-size: 1.2rem;
    font-weight: 700;
}

.btn-voltar {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255,255,255,.15);
    color: #fff;
    text-decoration: none;
    padding: 8px 16px;
    border-radius: 20px;
    font-weight: 500;
    font-size: 0.9rem;
    transition: background .2s ease, transform .2s ease;
}

.btn-voltar:hover {
    background: rgba(255,255,255,.28);
    transform: translateX(-3px);
}

/* ============================================================
   CARTÃO DE PERFIL
   ============================================================ */
.profile-card {
    width: 92%;
    max-width: 620px;
    background: #fff;
    border-radius: 24px;
    box-shadow: var(--sombra);
    margin-top: 40px;
    overflow: visible;
    animation: subirCartao .6s ease;
}

@keyframes subirCartao {
    from { opacity: 0; transform: translateY(25px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* Banner decorativo por trás do avatar */
.profile-banner {
    height: 120px;
    border-radius: 24px 24px 0 0;
    background: linear-gradient(120deg, var(--vermelho) 0%, var(--vermelho-escuro) 60%, #5c0000 100%);
    position: relative;
    overflow: hidden;
}

/* Padrão decorativo subtil no banner */
.profile-banner::before {
    content: "";
    position: absolute;
    inset: 0;
    background-image: radial-gradient(circle at 20% 30%, rgba(255,255,255,.12) 0, transparent 45%),
                       radial-gradient(circle at 85% 70%, rgba(255,255,255,.10) 0, transparent 40%);
}

/* ============================================================
   AVATAR SOBREPOSTO AO BANNER + PREVIEW/UPLOAD
   ============================================================ */
.avatar-wrap {
    display: flex;
    justify-content: center;
    margin-top: -75px;
    position: relative;
    z-index: 2;
}

.avatar-clickable {
    position: relative;
    width: 150px;
    height: 150px;
    border-radius: 50%;
    cursor: pointer;
}

.avatar-clickable img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    border: 6px solid #fff;
    box-shadow: 0 8px 20px rgba(0,0,0,.18);
    display: block;
    background: #eee;
}

/* Overlay "trocar foto" ao passar o rato */
.avatar-overlay {
    position: absolute;
    inset: 6px;
    border-radius: 50%;
    background: rgba(179,0,0,.72);
    color: #fff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 4px;
    font-size: 0.72rem;
    font-weight: 600;
    text-align: center;
    opacity: 0;
    transition: opacity .25s ease;
    pointer-events: none;
}

.avatar-clickable:hover .avatar-overlay { opacity: 1; }
.avatar-overlay svg { width: 22px; height: 22px; }

/* Input de ficheiro escondido, acionado pelo clique no avatar */
.avatar-input { display: none; }

/* ============================================================
   NOME E TIPO DE CONTA (debaixo do avatar)
   ============================================================ */
.profile-heading {
    text-align: center;
    padding: 14px 24px 0;
}

.profile-heading h1 {
    font-size: 1.4rem;
    color: var(--cinza-texto);
    font-weight: 700;
}

.badge-tipo {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: var(--vermelho-claro);
    color: var(--vermelho);
    font-weight: 600;
    font-size: 0.78rem;
    padding: 5px 14px;
    border-radius: 20px;
    margin-top: 8px;
}

/* ============================================================
   MENSAGEM DE SUCESSO
   ============================================================ */
.msg {
    margin: 20px 32px 0;
    background: #e6f7ed;
    color: #1a7f4e;
    border: 1px solid #b7ebd0;
    padding: 12px 16px;
    border-radius: 12px;
    text-align: center;
    font-weight: 600;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    animation: apareceMsg .4s ease;
}

@keyframes apareceMsg {
    from { opacity: 0; transform: translateY(-8px); }
    to   { opacity: 1; transform: translateY(0); }
}

/* ============================================================
   FORMULÁRIO
   ============================================================ */
form { padding: 28px 32px 34px; }

.field { margin-bottom: 20px; position: relative; }

.field label {
    display: flex;
    align-items: center;
    gap: 6px;
    font-weight: 600;
    font-size: 0.85rem;
    color: var(--cinza-texto);
    margin-bottom: 6px;
}

.field input[type="text"],
.field input[type="email"],
.field input[type="password"] {
    width: 100%;
    padding: 13px 14px;
    border-radius: 12px;
    border: 1.5px solid #e3e3e8;
    font-size: 0.95rem;
    background: #fafafc;
    transition: border-color .2s ease, box-shadow .2s ease, background .2s ease;
}

.field input:focus {
    outline: none;
    border-color: var(--vermelho);
    background: #fff;
    box-shadow: 0 0 0 4px rgba(179,0,0,.08);
}

.field small {
    display: block;
    margin-top: 5px;
    color: var(--cinza-suave);
    font-size: 0.75rem;
}

/* Campo de password com botão mostrar/ocultar */
.password-wrap { position: relative; }

.toggle-pass {
    position: absolute;
    right: 12px;
    top: 50%;
    transform: translateY(-50%);
    background: none;
    border: none;
    cursor: pointer;
    color: var(--cinza-suave);
    font-size: 0.8rem;
    font-weight: 600;
    padding: 4px 6px;
}

.toggle-pass:hover { color: var(--vermelho); }

/* Duas colunas em ecrãs largos (Nome + Email) */
.grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
}

/* ============================================================
   BOTÃO GUARDAR
   ============================================================ */
button.btn-guardar {
    width: 100%;
    background: linear-gradient(90deg, var(--vermelho), var(--vermelho-hover));
    color: #fff;
    border: none;
    padding: 15px;
    font-size: 1rem;
    font-weight: 600;
    border-radius: 14px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-shadow: 0 8px 18px rgba(179,0,0,.28);
    transition: transform .2s ease, box-shadow .2s ease;
    margin-top: 6px;
}

button.btn-guardar:hover {
    transform: translateY(-2px);
    box-shadow: 0 12px 24px rgba(179,0,0,.35);
}

button.btn-guardar:active { transform: translateY(0); }

/* ============================================================
   RESPONSIVIDADE
   ============================================================ */
@media (max-width: 560px) {
    .grid-2 { grid-template-columns: 1fr; gap: 0; }
    .profile-card { margin-top: 28px; }
    form { padding: 24px 20px 28px; }
    .avatar-clickable { width: 120px; height: 120px; }
    .avatar-wrap { margin-top: -60px; }
}
</style>
</head>
<body>

<!-- ==================== BARRA SUPERIOR ==================== -->
<div class="topbar">
    <span class="topbar-title">👤 O Meu Perfil</span>
    <a href="menuprimario.php" class="btn-voltar">⬅ Voltar ao Menu</a>
</div>

<!-- ==================== CARTÃO DE PERFIL ==================== -->
<div class="profile-card">

    <div class="profile-banner"></div>

    <form method="post" enctype="multipart/form-data" id="formPerfil">

        <!-- Avatar clicável: clicar na foto abre o seletor de ficheiro -->
        <div class="avatar-wrap">
            <label class="avatar-clickable" for="inputFoto">
                <img src="<?php echo $_SESSION['foto']; ?>" id="previewFoto" alt="Foto de perfil">
                <div class="avatar-overlay">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M4 16l4-4a3 3 0 014 0l4 4M14 10l2-2a3 3 0 014 0l0 0"/>
                        <rect x="3" y="4" width="18" height="16" rx="2"/>
                        <circle cx="8" cy="9" r="1.5"/>
                    </svg>
                    Trocar foto
                </div>
            </label>
            <input type="file" name="foto" id="inputFoto" class="avatar-input" accept="image/*">
        </div>

        <div class="profile-heading">
            <h1><?php echo htmlspecialchars($_SESSION['utilizador']); ?></h1>
            <span class="badge-tipo">🏷️ <?php echo htmlspecialchars($_SESSION['tipo']); ?></span>
        </div>

        <?php if (isset($mensagem)): ?>
            <div class="msg">✅ <?php echo $mensagem; ?></div>
        <?php endif; ?>

        <div style="padding: 0 32px;">

            <div class="grid-2" style="margin-top: 26px;">
                <div class="field">
                    <label for="nome">🧑 Nome</label>
                    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($_SESSION['utilizador']); ?>" required>
                </div>

                <div class="field">
                    <label for="email">✉️ Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($_SESSION['email']); ?>" required>
                </div>
            </div>

            <div class="field password-wrap">
                <label for="password">🔒 Nova Palavra-passe</label>
                <input type="password" id="password" name="password" placeholder="Deixa em branco para manter a atual">
                <button type="button" class="toggle-pass" id="btnTogglePass">Mostrar</button>
                <small>Só é alterada se preencheres este campo.</small>
            </div>

        </div>

        <div style="padding: 0 32px;">
            <button type="submit" name="guardar" class="btn-guardar">
                💾 Guardar Alterações
            </button>
        </div>

    </form>
</div>

<script>
/* ============================================================
   Pré-visualização instantânea da foto escolhida, antes de submeter
   ============================================================ */
document.getElementById("inputFoto").addEventListener("change", function (e) {
    const ficheiro = e.target.files[0];
    if (!ficheiro) return;

    const leitor = new FileReader();
    leitor.onload = function (evento) {
        document.getElementById("previewFoto").src = evento.target.result;
    };
    leitor.readAsDataURL(ficheiro);
});

/* ============================================================
   Mostrar / ocultar a palavra-passe introduzida
   ============================================================ */
document.getElementById("btnTogglePass").addEventListener("click", function () {
    const campo = document.getElementById("password");
    const aMostrar = campo.type === "password";
    campo.type = aMostrar ? "text" : "password";
    this.textContent = aMostrar ? "Ocultar" : "Mostrar";
});
</script>

</body>
</html>