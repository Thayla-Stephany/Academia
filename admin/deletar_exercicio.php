<?php 

include_once('include/conexao.php');


if(isset($_GET['id_exercicio'])){
  $id_exercicio = $_GET['id_exercicio'];
  $_SESSION['mensagem'] = '<center><div class="p-2 mb-2 bg-warning text-dark"> Exercício excluído!</div></center>';

  $sql = "DELETE FROM exercicios WHERE id_exercicio = ?";
  $stmt = $_SESSION['conexao']->prepare($sql);
  $stmt->bind_param("i", $id_exercicio);
  $resp_query = $stmt->execute();

  if($resp_query){
     header('location:lista_exercicios');
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
<?php
include_once 'include/footer.php';
?>