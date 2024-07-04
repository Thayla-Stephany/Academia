<?php
include_once('include/header.php');
include_once('include/conexao.php');


mysqli_set_charset($_SESSION['conexao'], 'utf8'); 
$sql = "SELECT id_evento, nome_evento, descricao_evento, data_evento, data_final FROM eventos";
$stmt = mysqli_prepare($_SESSION['conexao'], $sql);
mysqli_stmt_execute($stmt);
$resp_query = mysqli_stmt_get_result($stmt);

if (isset($_SESSION['mensagem'])) {
    echo '<div class="mensagem">' . $_SESSION['mensagem'] . '</div>';
    unset($_SESSION['mensagem']); // Limpa a variável da sessão para que a mensagem não seja exibida novamente na próxima vez que a página for carregada.
}

echo '
<div class="container-fluid pt-5 px-4">
    <div class="bg-secondary rounded p-4">
        <center><h4> Eventos </h4><br><br></center>';


while ($linha = mysqli_fetch_array($resp_query, MYSQLI_ASSOC)) {
    $id_evento = $linha['id_evento'];
    $nome_evento = htmlspecialchars($linha['nome_evento']);
    $descricao_evento = htmlspecialchars($linha['descricao_evento']);
    $data_evento = date('d-m-Y', strtotime($linha['data_evento']));
    $data_final = date('d-m-Y', strtotime($linha['data_final']));

    echo '<div class="border rounded p-4 pb-0 mb-4">
            <div class="evento-item">
                <h6 class="mb-0">' . $nome_evento . '</h6>
            </div>
            <div class="evento-item">
                <a class="test3" href="editar_evento?id_evento=' . $id_evento . '">Editar evento</a>
            </div>
            <div class="evento-item">
                <a class="test3" href="excluir_evento?id_evento=' . $id_evento . '">Excluir</a>
            </div>
            <br><br>
            <tr>
                <td>' . $descricao_evento . '</td>
                <br>
                <td>Data de inicio: ' . $data_evento . '</td> 
                <br>
                <td>Data de encerramento: ' . $data_final . '</td> 
                <br>
            </tr>
        </div>';
}

echo '</div>
</div>';




include_once 'include/footer.php';  
?>
<script src="../script_tst.js"></script>
<style>   
      
      
        .evento-item {
  display: inline-block;
  vertical-align: middle;
  margin-right: 10px;
}

.test3 {
  display: inline-block;
  vertical-align: middle;
  color: #f5f84e;

}

      </style>