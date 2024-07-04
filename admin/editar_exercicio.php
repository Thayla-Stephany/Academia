<?php
ob_start();
include_once('include/header.php');
include_once('include/conexao.php');


if(isset($_GET['id_exercicio'])){

  $id_exercicio = $_GET['id_exercicio'];
  
  $sql = "SELECT * FROM exercicios WHERE id_exercicio = ?";
  $stmt = mysqli_prepare($_SESSION['conexao'], $sql);
  mysqli_stmt_bind_param($stmt, "i", $id_exercicio);
  mysqli_stmt_execute($stmt);
  $rodar_sql = mysqli_stmt_get_result($stmt);
  $resp_sql = mysqli_fetch_array($rodar_sql, MYSQLI_ASSOC);

}else{
  $id_exercicio= $_POST['id_exercicio'];
  $nome_exercicio  = $_POST['nome_exercicio'];
  $descricao_exercicio = $_POST['descricao_exercicio'];
  $musculo_exercicio = $_POST['musculo_exercicio'];
  $link_exercicio = $_POST['link_exercicio'];
  
  $sql = "UPDATE exercicios SET nome_exercicio = ?, descricao_exercicio = ?, musculo_exercicio = ?, link_exercicio = ? WHERE id_exercicio = ?";
  $stmt = mysqli_prepare($_SESSION['conexao'], $sql);
  mysqli_stmt_bind_param($stmt, "sssii", $nome_exercicio, $descricao_exercicio, $musculo_exercicio, $link_exercicio, $id_exercicio);
  $rodar_sql = mysqli_stmt_execute($stmt);

  if($rodar_sql === TRUE){
    $_SESSION['mensagem'] = '<center><div class="p-2 mb-2 bg-warning text-dark">Atualizado com sucesso!</div></center>';
    header('Location: lista_exercicios');
  }else{
    $_SESSION['mensagem2'] = '<center><div class="p-2 mb-2 bg-primary text-white"> Erro! Tente novamente!</div></center>';
  }
  
  $sql = "SELECT * FROM exercicios WHERE id_exercicio = ?";
  $stmt = mysqli_prepare($_SESSION['conexao'], $sql);
  mysqli_stmt_bind_param($stmt, "i", $id_exercicio);
  mysqli_stmt_execute($stmt);
  $rodar_sql = mysqli_stmt_get_result($stmt);
  $resp_sql = mysqli_fetch_array($rodar_sql, MYSQLI_ASSOC);
  $id_exercicio = $resp_sql['id_exercicio'];
  
}



?>

<br><br>
<div class="container-fluid pt-4 px-4">

<div class="bg-secondary rounded h-80 p-4">
                            <h6 class="mb-4">Editar exercício</h6>
  <form action="editar_exercicio" method="post">
<input type="hidden" name="id_exercicio" value="<?= $id_exercicio ?>">
                          

                  <div class="form-floating mb-3">
                      <input type="text" name="nome_exercicio" class="form-control" value="<?=$resp_sql['nome_exercicio']?>">
                      <label>Nome do exercicio</label>
                  
                  </div>

                  <div class="form-floating mb-3">
                      <input type="text" name="descricao_exercicio" class="form-control"  value="<?=$resp_sql['descricao_exercicio']?>">
                      <label>Descrição</label>
                  </div>

                  <div class="form-floating mb-3">
                      <input type="text" name="musculo_exercicio" class="form-control" value="<?=$resp_sql['musculo_exercicio']?>">
                      <label>Músculo</label>
                  </div>

                  <div class="form-floating mb-3">
                      <input type="text" name="link_exercicio" class="form-control"  value="<?=$resp_sql['link_exercicio']?>">
                      <label>Vídeo</label>
                  </div>

                  <center> <br><button type="submit" class="btn btn-outline-warning m-2" value="Atualizar">Atualizar</button> </center>

              </div>
              </form>
</div>

<?php
include_once 'include/footer.php';
ob_end_flush();
?>
<script src="../script_tst.js"></script>
