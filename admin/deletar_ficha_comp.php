<?php 
include_once('include/conexao.php');


if (isset($_GET['id_aluno'])) {
  $id_aluno = $_GET['id_aluno'];

  $_SESSION['mensagem'] = '<center><div class="p-2 mb-2 bg-warning text-dark">Ficha excluída!</div></center>';

  $sql = "DELETE FROM treino WHERE id_aluno = ?";
  $stmt = $_SESSION['conexao']->prepare($sql);
  $stmt->bind_param("i", $id_aluno);
  $resp_query = $stmt->execute();

  if ($resp_query) {
      header('location:perfil?id_aluno=' . $id_aluno);
  } else {
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