<?php
ob_start();
include_once('include/header.php');
include_once('include/conexao.php');

if(isset($_GET['id_aluno']) && isset($_GET['id_exercicio'])){
    $id_aluno = $_GET['id_aluno'];
    $id_exercicio = $_GET['id_exercicio'];
  
    $sql = "SELECT * FROM treino WHERE id_aluno=? AND id_exercicio=?";
    $stmt = mysqli_prepare($_SESSION['conexao'], $sql);
    mysqli_stmt_bind_param($stmt, "ii", $id_aluno, $id_exercicio);
    mysqli_stmt_execute($stmt);
    $resp_query = mysqli_stmt_get_result($stmt);
    $linha = mysqli_fetch_array($resp_query);
  
  }else{
    $id_aluno = $_POST['id_aluno'];
    $id_exercicio = $_POST['id_exercicio'];
    $exercicio = $_POST['exercicio'];
    $serie = $_POST['serie'];
    $repeticoes = $_POST['repeticoes'];
    $dia_semana = $_POST['dia_semana'];
  
    $sql = "UPDATE treino SET exercicio=?, serie=?, repeticoes=?, dia_semana=? WHERE id_aluno=? AND id_exercicio=?";
    $stmt = mysqli_prepare($_SESSION['conexao'], $sql);
    mysqli_stmt_bind_param($stmt, "ssssii", $exercicio, $serie, $repeticoes, $dia_semana, $id_aluno, $id_exercicio);
    $resp_query = mysqli_stmt_execute($stmt);
  
    $_SESSION['mensagem'] = '<center><div class="p-2 mb-2 bg-warning text-dark">Dados atualizados com sucesso!</div></center>';
  
    header("Location: perfil?id_aluno=$id_aluno");
  
    $sql = "SELECT * FROM treino WHERE id_aluno=? AND id_exercicio=?";
    $stmt = mysqli_prepare($_SESSION['conexao'], $sql);
    mysqli_stmt_bind_param($stmt, "ii", $id_aluno, $id_exercicio);
    mysqli_stmt_execute($stmt);
    $resp_query = mysqli_stmt_get_result($stmt);
    $linha = mysqli_fetch_array($resp_query);
    $id_aluno = $linha['id_aluno'];
    $id_exercicio = $linha['id_exercicio'];
  }
  
?>

<div class="container-fluid pt-4 px-4">
<div class="bg-secondary rounded h-80 p-4">
<form method="POST" action="editar_ficha">
            <input type="hidden" name="id_aluno" value="<?= $id_aluno ?>">
            <input type="hidden" name="id_exercicio" value="<?= $id_exercicio; ?>">
            <div class="row">
            <div class="form-floating mb-3">
                    <div class="form-floating mb-3">
                        <input name="exercicio" type="text" class="form-control" value="<?=$linha['exercicio'];?>">
                        <label>Nome do exercicio</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="serie" class="form-control" value="<?=$linha['serie'];?>">
                        <label>Série</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" name="repeticoes" class="form-control" value="<?=$linha['repeticoes'];?>">
                        <label>Repetições</label>
                    </div>
                </div>
                <!-- <div class="form-floating mb-3">
                    <div class="form-floating mb-3">
                        <input type="text" name="dia_semana" class="form-control" value="<?=$linha['dia_semana'];?>">
                        <label>Dia de Semana</label> -->
                    <div class="select">
                        <select id="dia_semana" name="dia_semana">
                                       <option value="">Dia da semana</option>
                                       <option value="segunda">Segunda</option>
                                       <option value="terca">Terça</option>
                                       <option value="quarta">Quarta</option>
                                       <option value="quinta">Quinta</option>
                                       <option value="sexta">Sexta</option>
                                     </select>
                                     </div>
                    </div>
                    </div>
                    </div>
            <center><br><button type="submit" class="btn btn-outline-warning m-2" value="Atualizar">Atualizar dados</button></center>
        </form>
</div>
</div>

<?php
include_once 'include/footer.php';
ob_end_flush();
?>
<style>
    
select {
      font-family: Arial, sans-serif;
      font-size: 16px;
      color: #ffd700;
      background-color: #191c24;
      border: 2px solid #ffd700;
      border-radius: 5px;
      padding: 8px;
      width: 150px;
      }
      
      select:focus {
      border-color: #ffd700;
      box-shadow: 0 0 5px #ffd700;
      }
      
</style>

