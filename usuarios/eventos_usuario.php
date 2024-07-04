<?php
include_once('include/header_usuario.php');
include_once('include/conexao.php');

$_SESSION['conexao']->set_charset("utf8mb4");

$sql = "SELECT * FROM eventos";
$stmt = mysqli_prepare($_SESSION['conexao'], $sql);
mysqli_stmt_execute($stmt);
$resp_query = mysqli_stmt_get_result($stmt);

if (isset($_SESSION['mensagem'])) {
    echo '<div class="mensagem">' . $_SESSION['mensagem'] . '</div>';
    unset($_SESSION['mensagem']); // Limpa a variável da sessão para que a mensagem não seja exibida novamente na próxima vez que a página for carregada.
};

echo '
<div class="container-fluid pt-5 px-4">
<div class="bg-secondary rounded p-4">

    <center><h4> Eventos </h4><br><br></center>';

$_SESSION['conexao']->set_charset("utf8mb4");

while($linha = mysqli_fetch_array($resp_query, MYSQLI_ASSOC)){

    echo '<div class="border rounded p-4 pb-0 mb-4">
        <div class="evento-item">
        <h6 class="mb-0">'.$linha['nome_evento'].'</h6>
      </div>

      <tr>
            <td>'.$linha['descricao_evento'].' </td>
            <br>

            <td>Data de inicio: ' . date('d-m-Y', strtotime($linha['data_evento'])) .'  </td> 
            <br>
            <td>Data de encerramento: ' . date('d-m-Y', strtotime($linha['data_final'])) .'</td> 
            <br>

         
      </tr>
    </div> ';
}

echo '

</div>
</div>
';



include_once 'include/footer.php';  
?>
<script src="../script_tst.js"></script>