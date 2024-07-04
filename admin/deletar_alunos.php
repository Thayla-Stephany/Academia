<?php 

include_once('include/conexao.php');


if (isset($_GET['id_aluno'])) {
  $id_aluno = $_GET['id_aluno'];
  $_SESSION['mensagem'] = '<center><div class="p-2 mb-2 bg-warning text-dark">Aluno excluido!</div></center>';
  
  $sql = "DELETE FROM alunos WHERE id_aluno = ?";
  $stmt = $_SESSION['conexao']->prepare($sql);
  $stmt->bind_param("i", $id_aluno);
  $resp_query = $stmt->execute();
  
  if ($resp_query) {
  header('location:administrador');
  } else {
  $_SESSION['mensagem'] = '<center><div class="p-2 mb-2 bg-primary text-white">Erro ao excluir! </div></center>';
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
<?php
include_once 'include/footer.php';
?>