<?php 

include_once('include/conexao.php');


if(isset($_GET['id_aluno']) && isset($_GET['id_exercicio'])) {
  $id_aluno = $_GET['id_aluno'];
  $id_exercicio = $_GET['id_exercicio'];

  $_SESSION['mensagem'] = '<center><div class="p-2 mb-2 bg-warning text-dark">Exercício da ficha excluído!</div></center>';

  $sql = "DELETE FROM treino WHERE id_aluno = ? AND id_exercicio = ?";
  $stmt = $_SESSION['conexao']->prepare($sql);
  $stmt->bind_param("ii", $id_aluno, $id_exercicio);
  $resp_query = $stmt->execute();

  if($resp_query) {
      header('location:perfil?id_aluno='.$id_aluno);
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
>