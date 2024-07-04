<?php
session_start();
$_SESSION['conexao'] = mysqli_connect("localhost", "root", "", "academia");

if (mysqli_connect_errno()) {
  echo "Erro ao conectar ao banco: " . mysqli_connect_error();
  exit();
}

mysqli_set_charset($_SESSION['conexao'], "utf8mb4");
?>  

<!-- <?php
// session_start();
// $_SESSION['conexao'] = mysqli_connect("sql106.epizy.com","epiz_33854758","xeY3kKqhiKwOH","epiz_33854758_academia");

// if (mysqli_connect_errno()) {
//   echo "Erro ao conectar ao banco: " . mysqli_connect_error();
//   exit();
// }
// mysqli_set_charset($_SESSION['conexao'], "utf8mb4");
?>   -->