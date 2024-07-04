<?php 
include_once('include/conexao.php');


if(isset($_GET['id_evento'])){
  $id_evento = $_GET['id_evento'];
  $_SESSION['mensagem'] = '<center><div class="p-2 mb-2 bg-warning text-dark"> Evento excluído!</div></center>';

  $sql = "DELETE FROM eventos WHERE id_evento = ?";
  $stmt = mysqli_prepare($_SESSION['conexao'], $sql);
  mysqli_stmt_bind_param($stmt, "i", $id_evento);
  $resp_query = mysqli_stmt_execute($stmt);

  if($resp_query){
      header('location:lista_eventos');
  }else{
      $_SESSION['mensagem'] = '<center><div class="p-2 mb-2 bg-primary text-white">Erro ao excluir!</div></center>';
  }
}


?>
<style>
    a {
      text-decoration: none;
      color: white;
    }

    a:hover {
      color: white;
    }
  </style>
