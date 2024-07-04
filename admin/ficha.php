<?php
ob_start();
include_once('include/header.php');
include_once('include/conexao.php'); 

// Verificar se o formulário de pesquisa foi enviado
if ($_SERVER['REQUEST_METHOD'] != 'POST' ) {
    // Formul ário de pesquisa
   
    $_SESSION['aluno'] = $_GET['id_aluno'];
    // Verificar se o parâmetro id_aluno foi recebido corretamente
  
?>
<?php if (isset($_SESSION['mensagem'])) {
    echo "<br>";
    echo '<div class="mensagem">' . $_SESSION['mensagem'] . '</div>';
  
    unset($_SESSION['mensagem']); // Limpa a variável da sessão para que a mensagem não seja exibida novamente na próxima vez que a página for carregada.
  };?>
<div class="container-fluid pt-4 px-4">
<div class="bg-secondary rounded h-80 p-4">

    <form method="post" action="ficha">
       
        <input class="form-control bg-dark border-0" type="search" placeholder="Pesquisar exercicio..." name="termo" id="termo">
   
    </form>
    <center><br><button class="btn btn-outline-warning m-2"><a href="perfil?id_aluno=<?php echo $_SESSION["aluno"]; ?>">Voltar</a></button></center>

    </div>
  </div>
    <?php
} else {
    // Recupera o termo de pesquisa enviado pelo usuário
    $termo = $_POST['termo'];
    $_SESSION['termo'] = $termo;  
    $_SESSION['conexao']->set_charset("utf8mb4");

$sql= "SELECT * FROM exercicios WHERE musculo_exercicio LIKE '%$termo%' OR nome_exercicio LIKE '%$termo%'";
$resp_sql = mysqli_query($_SESSION['conexao'], $sql);
$num = mysqli_num_rows($resp_sql);

if($num > 0){


    // Redireciona o usuário para a página de pesquisa
    header('Location: pesquisa_exer?id_aluno='. $_SESSION['aluno']);
    exit;

}else{
    
   
    header('Location: ficha?id_aluno='. $_SESSION['aluno']);
 

}
}

include_once 'include/footer.php';
ob_end_flush();
?>

<script src="../script_tst.js"></script>
