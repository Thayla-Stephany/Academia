<?php


include_once 'conexao.php';

if ($_SESSION['login_adm'] == null || $_SESSION['login_adm'] == '') {

    header('Location: ../login');
  }
  header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html lang="portuguese">

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
    <link href="../lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="../lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.css" rel="stylesheet">


    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
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


       
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3"> 
       
        <br><br> 
            <nav class="navbar bg-secondary navbar-dark">
                <a href="#" class="navbar-brand mx-4 mb-3">
                    <!-- <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>BloodFit</h3> -->
                    <img src="../bloodfit.png" alt="Academia" width="120%" height="50%" >
                </a>       
      
                <div class="navbar-nav w-100">
                    <a href="administrador" class="nav-item nav-link"><i class="fa fa-home me-2"></i>Principal</a>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-clipboard-check me-2"></i>Exercicio</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="cadastrar_exercicio" class="dropdown-item">Cadastrar exercício</a>
                            <a href="lista_exercicios" class="dropdown-item">Lista de exercícios</a>
                        </div>
                    </div>
                    <a href="cadastro_aluno" class="nav-item nav-link"><i class="bi bi-person-plus me-2"></i>Cadastrar aluno</a>
                    <div class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="bi bi-calendar-check me-2"></i>Eventos</a>
                    <div class="dropdown-menu bg-transparent border-0">
                        <a href="eventos_adm" class="dropdown-item">Cadastrar evento</a>
                        <a href="lista_eventos" class="dropdown-item">Lista de eventos</a>
                </div>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->
        <!-- Content Start -->
<div class="content">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand bg-secondary navbar-dark sticky-top px-4 py-0">
        <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
            <h2 class="text-primary mb-0"></h2>
        </a>
        <a href="#" class="sidebar-toggler flex-shrink-0">
            <i class="fa fa-bars"></i>
        </a>
        <div class="navbar-nav align-items-center ms-auto">
            <div class="nav-item dropdown">
                <a href="#" data-bs-toggle="dropdown">
                    <img class="rounded me-lg-2" src="../img/info.png" alt="" style="width: 20px; height: 20px;">
                    <span class="d-none d-lg-inline-flex"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-secondary border-0 rounded-0 rounded-bottom m-0">
                    <a href="#" class="dropdown-item">FAQ</a>
                    <a href="logout?logout=true" class="dropdown-item">Sair</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->