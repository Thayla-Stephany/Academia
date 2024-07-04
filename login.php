<?php
ob_start();

include_once 'conexao.php';


if (isset($_POST['enviar'])) {
    // Obter as informações de login do formulário
    $nome = $_POST['nome_aluno'];
    $senha = $_POST['codigo_ident'];

    // Conectar ao banco de dados


    // Preparar a consulta SQL com prepared statements
    $query = "SELECT * FROM alunos WHERE nome_aluno = ? AND codigo_ident = ?";
    $stmt = mysqli_prepare($_SESSION['conexao'], $query);
    mysqli_stmt_bind_param($stmt, 'ss', $nome, $senha);
    mysqli_stmt_execute($stmt);

    // Obter o resultado da consulta
    $result = mysqli_stmt_get_result($stmt);

    // Verificar se as informações de login estão corretas
    if (mysqli_num_rows($result) == 1) {
        $usuario = mysqli_fetch_assoc($result);

        // Verificar o tipo de conta do usuário e redirecionar para a página apropriada
        if ($usuario['tipo_usuario'] == 'aluno') {
            $_SESSION['login'] = $usuario['id_aluno'];
            header('Location: usuarios/ficha_do_usuario');
            exit;
        } else if ($usuario['tipo_usuario'] == 'administrador') {
            $_SESSION['login_adm'] = $usuario['id_aluno'];
            header('Location: admin/administrador');
            exit;
        }
    } else {
        // As informações de login estão incorretas
        $_SESSION['mensagem'] = '<center><div class="p-2 mb-2 bg-primary text-white">Nome de usuário ou senha incorretos.</div></center>';
    }

    // Fechar a conexão com o banco de dados
    mysqli_close($_SESSION['conexao']);
}



if (isset($_SESSION['mensagem'])) {
    echo "<br>";
    echo '<div class="mensagem">' . $_SESSION['mensagem'] . '</div>';
    unset($_SESSION['mensagem']); // Limpa a variável da sessão para que a mensagem não seja exibida novamente na próxima vez que a página for carregada.
  };

ob_end_flush();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Academia BloodFit</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" type="imagem/png" href="logo.png" />


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">

    <script src="script_tst.js"></script>

</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sign In Start -->
        <div class="container-fluid">
            <div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
                <div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
                    <div class="bg-secondary rounded p-4 p-sm-5 my-4 mx-3">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <a href="index.html" class="">
                            <img src="bloodfit.png" alt="Academia" width="100" height="50">

                            </a>
                            <h3>Login</h3>
                        </div>
        <form action="login" method="post">

                        <div class="form-floating mb-3">
                            <input type="text" name="nome_aluno" class="form-control" id="floatingInput" placeholder="Nome">
                            <label for="floatingInput">Nome</label>
                        </div>
                        <div class="form-floating mb-4">
                            <input type="password" name="codigo_ident" class="form-control" id="floatingPassword" placeholder="Senha">
                            <label for="floatingPassword">Senha</label>
                        </div>
                    
                        <button type="submit" name="enviar" value="enviar" class="btn btn-primary py-3 w-100 mb-4">Entrar</button>
</form>

                        <!-- <p class="text-center mb-0">Don't have an Account? <a href="">Entrar</a></p> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Sign In End -->
    </div>
    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>
</html>