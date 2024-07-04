<?php

include_once 'conexao.php';

if ( $_SESSION['login'] == null ||  $_SESSION['login'] == '') {

    header('Location: ../ficha_do_usuario');
  }

?>

<!DOCTYPE html>
<html lang="portuguese">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Academia BloodFit</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" type="imagem/png" href="../logo.png" />


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
    <script src="test.js"></script>

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-dark position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Carregando...</span>
            </div>
        </div>
        <!-- Spinner End -->



        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-secondary navbar-dark">
                <a href="#" class="navbar-brand mx-4 mb-3">
                    <!-- <h3 class="text-primary"><i class="fa fa-user-edit me-2"></i>BloodFit</h3> -->
                    <img src="../bloodfit.png" alt="Academia" width="200" height="70" >
                </a>
                <div class="navbar-nav w-100">
                    <a href="ficha_do_usuario" class="nav-item nav-link"><i class="fa fa-home me-2"></i>Principal</a>
                    <div class="nav-item dropdown">
                        <div class="dropdown-menu bg-transparent border-0">
                        </div>
                    </div>
                    <a href="eventos_usuario" class="nav-item nav-link"><i class="bi bi-calendar-check me-2"></i>Eventos</a>
                    <!--<a href="table.html" class="nav-item nav-link"><i class="fa fa-table me-2"></i>Tables</a>
                     <a href="chart.html" class="nav-item nav-link"><i class="fa fa-chart-bar me-2"></i>Charts</a> -->
                    <div class="nav-item dropdown">
                        <!-- <a href="#" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="far fa-file-alt me-2"></i>Pages</a> -->
              
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
            <h2 class="text-primary mb-0"><i class="fa fa-user-edit"></i></h2>
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
                    <a href="logout_usuario?logout=true"  onclick="logout()" class="dropdown-item">Sair</a>
                </div>
            </div>
        </div>
    </nav>
    <!-- Navbar End -->


   