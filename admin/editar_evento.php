<?php
ob_start();
include_once('include/header.php');
include_once('include/conexao.php');


if(isset($_GET['id_evento'])){

	$id_evento = $_GET['id_evento'];
	
$_SESSION['conexao']->set_charset("utf8mb4");

	$sql = "SELECT * FROM eventos WHERE id_evento = ?";
	$stmt = mysqli_prepare($_SESSION['conexao'], $sql);
	mysqli_stmt_bind_param($stmt, "i", $id_evento);
	mysqli_stmt_execute($stmt);
	$resp_sql = mysqli_stmt_get_result($stmt);
	$resp_sql = mysqli_fetch_array($resp_sql, MYSQLI_ASSOC);
	mysqli_stmt_close($stmt);

}else{
	$id_evento= $_POST['id_evento'];
	$nome_evento  = $_POST['nome_evento'];
	$descricao_evento = $_POST['descricao_evento'];
  $data_evento = $_POST['data_evento'];
  $data_final = $_POST['data_final'];
	
$_SESSION['conexao']->set_charset("utf8mb4");

	$sql = "UPDATE eventos SET nome_evento = ?, descricao_evento = ?, data_evento = ?, data_final = ? WHERE id_evento = ?";
	$stmt = mysqli_prepare($_SESSION['conexao'], $sql);
	mysqli_stmt_bind_param($stmt, "ssssi", $nome_evento, $descricao_evento, $data_evento, $data_final, $id_evento);
	$rodar_sql = mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	if($rodar_sql === TRUE){
		$_SESSION['mensagem'] = '<center><div class="p-2 mb-2 bg-warning text-dark">Dados atualizados com sucesso!</div></center>';
		header('Location: lista_eventos');
	}else{
		$_SESSION['mensagem2'] = '<center><div class="p-2 mb-2 bg-warning text-dark"> Erro! Tente novamente!</div></center>';
	}

$_SESSION['conexao']->set_charset("utf8mb4");

	$sql = "SELECT * FROM eventos WHERE id_evento = ?";
	$stmt = mysqli_prepare($_SESSION['conexao'], $sql);
	mysqli_stmt_bind_param($stmt, "i", $id_evento);
	mysqli_stmt_execute($stmt);
	$resp_sql = mysqli_stmt_get_result($stmt);
	$resp_sql = mysqli_fetch_array($resp_sql, MYSQLI_ASSOC);
	mysqli_stmt_close($stmt);
	$id_evento = $resp_sql['id_evento'];
	
}


?>

<br><br>
<div class="container-fluid pt-4 px-4">

<div class="bg-secondary rounded h-80 p-4">
                            <h6 class="mb-4">Atualizar evento</h6>
  <form action="editar_evento" method="post">
<input type="hidden" name="id_evento" value="<?= $id_evento ?>">
<div class="form-floating mb-3">
                                <input name="nome_evento" type="text" class="form-control"  placeholder="Nome do evento" value="<?=$resp_sql['nome_evento']?>">
                                <label>Nome do evento</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" name="descricao_evento" class="form-control" placeholder="Descrição do evento" value="<?=$resp_sql['descricao_evento']?>">
                                <label>Descrição do evento</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="date" name="data_evento" class="form-control" placeholder="Data do evento" value="<?=$resp_sql['data_evento']?>">
                                <label>Data de inicio</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="date" name="data_final" class="form-control" placeholder="Data final" value="<?=$resp_sql['data_final']?>">
                                <label>Data de encerramento </label>
                            </div>

                           
                           <center> <br><button type="submit" class="btn btn-outline-warning m-2" value="Atualizar">Atualizar</button></center>

                        </div>
                        </form>
</div>

<?php
include_once 'include/footer.php';
ob_end_flush();
?>
