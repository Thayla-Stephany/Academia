<?php
session_start();
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    $_SESSION['nome_aluno'] = null;
    $_SESSION['codigo_ident'] = null;
    $_SESSION['conexao'] = null;
    session_destroy();
    header('Location: ../index');
    exit();
}
?>
