<?php

    if(isset($_POST['submit']))
    {

        include_once('config.php');

        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $matricula = $_POST['matricula'];
        $perfil = $_POST['perfil'];

        $result = mysqli_query($conexao, "INSERT INTO usuario(nome,email,senha,matricula,perfil) VALUES ('$nome','$email','$senha','$matricula','$perfil')");
    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script src="https://estacio.br/" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="app.css" />
    <title>Estácio Opina</title>
</head>

<body>
    <div class="container">
        <div class="forms-container">
            <div class="signin-signup">
                <form action="testelogin.php" method="post" class="sign-in-form">
                    <h2 class="title">Entrar</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Login" name="matricula" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Senha" name="senha" required />
                    </div>
                    <button type="submit" name="submit_login" value="enviar" class="btn solid">Entrar</button>
                </form>

                <form action="index.php" method="POST" class="sign-up-form">
                    <h2 class="title">Cadastrar</h2>
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                        <input type="text" placeholder="Nome de Usuário" name="nome" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="email" placeholder="E-mail" name="email" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="Senha"  name="senha" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-id-card"></i>
                        <input type="text" placeholder="Matrícula" name="matricula" required />
                    </div>
                    <div class="input-field">
                        <i class="fas fa-graduation-cap"></i>
                        <select name="perfil" required>
                            <option value="" disabled selected>Selecione seu perfil</option>
                            <option value="aluno">Aluno</option>
                            <option value="professor">Professor</option>
                        </select>
                    </div>

                    <button type="submit" name="submit" id="submit" class="btn solid">Salvar</button>
                </form>
            </div>
        </div>

        <div class="panels-container">
            <div class="panel left-panel">
                <div class="content">
                    <h3>É novo por aqui?</h3>
                    <p>
                        Faça o cadastro e envie sua reclamação!
                    </p>
                    <button class="btn transparent" id="sign-up-btn">
                        Cadastre-se
                    </button>
                </div>
                <img src="img/log.svg" class="image" alt="" />
            </div>
            <div class="panel right-panel">
                <div class="content">
                    <h3>Já tem uma conta?</h3>
                    <p>
                        Faça login e continue com sua reclamação!
                    </p>
                    <button class="btn transparent" id="sign-in-btn">
                        Entrar
                    </button>
                </div>
                <img src="img/register.svg" class="image" alt="" />
            </div>
        </div>
    </div>

    <script>
        function entrar(event) {
            event.preventDefault();
            window.location.href = 'reclamacoes.html';
        }
    </script>
    <script src="script.js"></script>
</body>

</html>
