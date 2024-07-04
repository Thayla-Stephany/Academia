<?php

include_once 'conexao.php';

if (isset($_GET['logout']) && $_GET['logout'] == 'true') {

    $_SESSION['nome'] = null;
    $_SESSION['senha'] = null;
    $_SESSION['conexao'] = null;
    session_destroy();

}
header('Location:../index');


?>