
<?php

include_once('include/header.php');
include_once('include/conexao.php');


if(isset($_GET['id_aluno'])){

	$id_aluno = $_GET['id_aluno'];
	
	$sql = "SELECT * FROM alunos WHERE id_aluno = ?";
	$stmt = mysqli_prepare($_SESSION['conexao'], $sql);
	mysqli_stmt_bind_param($stmt, "i", $id_aluno);
	mysqli_stmt_execute($stmt);
	$resp_sql = mysqli_stmt_get_result($stmt)->fetch_assoc();

}else{
	//echo 'Clicou no btn enviar';
  $id_aluno= $_POST['id_aluno'];
	$codigo_ident  = $_POST['codigo_ident'];
	$nome_aluno = $_POST['nome_aluno'];
  $genero = $_POST['genero'];
  $data_nascimento = $_POST['data_nascimento'];
	$altura = $_POST['altura'];	
  $peso = $_POST['peso'];
	$descricao_aluno = $_POST['descricao_aluno'];
	$data_cadastro = $_POST['data_cadastro'];

	$sql = "UPDATE alunos SET codigo_ident = ?, nome_aluno = ?, genero = ?, data_nascimento = ?, altura = ?, peso = ?, descricao_aluno = ?, data_cadastro = ? WHERE id_aluno = ?";
	$stmt = mysqli_prepare($_SESSION['conexao'], $sql);
	mysqli_stmt_bind_param($stmt, "ssssddssi", $codigo_ident, $nome_aluno, $genero, $data_nascimento, $altura, $peso, $descricao_aluno, $data_cadastro, $id_aluno);
	$rodar_sql = mysqli_stmt_execute($stmt);

	
  if($rodar_sql === TRUE){ // IGUAL A LIKE
 
    $_SESSION['mensagem'] = '<center><div class="p-2 mb-2 bg-warning text-dark">Dados atualizados com sucesso!</div></center>';

  }else{
    $_SESSION['mensagem2'] = '<center><div class="p-2 mb-2 bg-warning text-dark"> Erro! Tente novamente!</div></center>';
  }
	
	$sql = "SELECT * FROM alunos WHERE id_aluno = ?";
	$stmt = mysqli_prepare($_SESSION['conexao'], $sql);
	mysqli_stmt_bind_param($stmt, "i", $id_aluno);
	mysqli_stmt_execute($stmt);
	$resp_sql = mysqli_stmt_get_result($stmt)->fetch_assoc();
	$id_aluno = $resp_sql['id_aluno'];
	
}

if (isset($_SESSION['mensagem'])) {
  echo "<br>";
  echo '<div class="mensagem">' . $_SESSION['mensagem'] . '</div>';

  unset($_SESSION['mensagem']); // Limpa a variável da sessão para que a mensagem não seja exibida novamente na próxima vez que a página for carregada.
};

?>

<br><br>
<div class="container-fluid pt-4 px-4">
<div class="bg-secondary rounded h-80 p-4">
                            <h6 class="mb-4">Atualizar dados</h6>
  <form action="editar_alunos" method="post">
<input type="hidden" name="id_aluno" value="<?= $id_aluno ?>">
          <div class="form-floating mb-3">
              <input name="nome_aluno" type="text" class="form-control"  value="<?=$resp_sql['nome_aluno']?>">

              <label>Nome do aluno</label>
          </div>

          <div class="form-floating mb-3">
              <select class="form-select"  aria-label="Floating label select example" name="genero"  value="<?=$resp_sql['genero']?>">
                  <option selected="">Escolha uma opção</option>
                  <option value="Masculino">Masculino</option>
                  <option value="Feminino">Feminino</option>
              </select>
              <label>Gênero</label>
          </div>

          <div class="form-floating mb-3">
              <input type="text" name="altura" class="form-control" value="<?=$resp_sql['altura']?>">
              <label>Altura</label>
          
          </div>

          <div class="form-floating mb-3">
              <input type="text" name="data_nascimento" class="form-control"  value="<?=$resp_sql['data_nascimento']?>">
              <label>Data de nascimento</label>
          </div>

          <div class="form-floating mb-3">
              <input type="text" name="peso" class="form-control" value="<?=$resp_sql['peso']?>">
              <label>Peso</label>
          </div>

          <div class="form-floating mb-3">
              <input type="date" name="data_cadastro" class="form-control"  value="<?=$resp_sql['data_cadastro']?>">
              <label>Data de cadastro</label>
          </div>

          <div class="form-floating mb-3">
              <input name="codigo_ident" type="text" class="form-control"  value="<?=$resp_sql['codigo_ident']?>">
              <label>Código de identificação</label>
          </div>

          <div class="form-floating">
          <textarea name="descricao_aluno" class="form-control" style="height: 150px;" ><?=$resp_sql['descricao_aluno']?></textarea>
              <label>Descrição</label>
          </div>
          <center> <br><button type="submit" class="btn btn-outline-warning m-2" value="Atualizar">Atualizar</button></center>

      </div>
      </form>
</div>

<?php

include_once 'include/footer.php';

?>
<script src="../script_tst.js"></script>