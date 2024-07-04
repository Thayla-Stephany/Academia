<?php
include_once('include/header.php');
include_once('include/conexao.php');

if (isset($_SESSION['mensagem'])) {
    echo '<div class="mensagem">' . $_SESSION['mensagem'] . '</div>';
    unset($_SESSION['mensagem']); // Limpa a variável da sessão para que a mensagem não seja exibida novamente na próxima vez que a página for carregada.
    };
    
$quantidade = 10;
$pagina  = (isset($_GET['pagina'])) ? (int)$_GET['pagina'] : 1;
$inicio = ($quantidade * $pagina) - $quantidade;


if ($_SERVER['REQUEST_METHOD'] != 'POST' ) {

echo '<div class="container-fluid pt-4 px-4">
<div class="bg-secondary rounded h-80 p-4">
<div class="space">
    <div class="info-item"><br>
        <h6 class="mb-4">Alunos matriculados</h6>
        </div>
        <form method="post" action="administrador">
        <input class="form-control bg-dark border-0 test3" type="search" placeholder="Pesquisar aluno..." name="busca" id="busca">
        </form>
        </div>
        <div class="table-responsive">
            <table class="table">
  <thead>
          <tr>
              <th scope="col">Nome</th>
              <th scope="col">Código</th>
              <th scope="col">Informações</th>
          </tr>
      </thead>
              
              ';
              $_SESSION['conexao']->set_charset("utf8mb4");
              $sql = "SELECT * FROM alunos WHERE tipo_usuario = 'aluno' ORDER BY nome_aluno LIMIT ?, ?";
              $stmt = $_SESSION['conexao']->prepare($sql);
              $stmt->bind_param("ii", $inicio, $quantidade);
              $stmt->execute();
              $result = $stmt->get_result();
              while ($linha = $result->fetch_assoc()) {
echo'   
<tbody>
            <tr>
                <td>'.$linha['nome_aluno'].'</td>
                <td>'.$linha['codigo_ident'].'</td>
                <td><a href="perfil?id_aluno='.$linha['id_aluno'].'">Perfil do aluno</a></td>
</tr></tbody>
';

//                                        <select id="mySelect" onchange="location = this.value;">
//                                        <option value="">Selecione uma opção</option>
//                                        <option value="ficha?id_aluno='.$linha['id_aluno'].'">Cadastrar ficha</option>
//                                        <option value="editar_alunos?id_aluno='.$linha['id_aluno'].'">Editar</option>
//                                        <option value="deletar_alunos?id_aluno='.$linha['id_aluno'].'">Excluir</option>
//                                      </select>
// </td>


}
echo ' 

</table></div></div></div>';

}else{

  $busca = $_POST['busca'];
  $_SESSION['busca'] = $busca;
  
  echo '<head><link rel="stylesheet" src="adicionais.css"</head>
      <div class="container-fluid pt-4 px-4">
      <div class="bg-secondary rounded h-80 p-4">
      <div class="space">
      <div class="info-item"><br>
      <h6 class="mb-4">Alunos matriculados</h6>
      </div>
      <form method="post" action="administrador">
      <input class="form-control bg-dark border-0 test3" type="search" placeholder="Pesquisar aluno..." name="busca" id="busca">
      </form>
      </div>
      <div class="table-responsive">
          <table class="table">
          <thead>
              <tr>
                  <th scope="col">Nome</th>
                  <th scope="col">Código</th>
                  <th scope="col">Informações</th>
              </tr>
          </thead>
          ';
  $inicio = 0; // defina a variável $inicio aqui
  $quantidade = 10; // defina a variável $quantidade aqui
  
$_SESSION['conexao']->set_charset("utf8mb4");
  $sql = "SELECT * FROM alunos WHERE nome_aluno LIKE ? AND tipo_usuario = 'aluno' ORDER BY nome_aluno LIMIT ?, ?";
  $stmt = mysqli_prepare($_SESSION['conexao'], $sql);
  mysqli_stmt_bind_param($stmt, 'sii', $busca_sql, $inicio_sql, $quantidade_sql);
  $busca_sql = "%$busca%";
 
  $quantidade_sql = $quantidade;
  mysqli_stmt_execute($stmt);
  $resp_sql = mysqli_stmt_get_result($stmt);
  $num = mysqli_num_rows($resp_sql);
  
  if ($num > 0) {
      while ($linha = mysqli_fetch_array($resp_sql)) {
                  echo'   
                      <tbody>
                                                    <tr>
                                                        <td>'.$linha['nome_aluno'].'</td>
                                                        <td>'.$linha['codigo_ident'].'</td>
                                                        <td><a href="perfil?id_aluno='.$linha['id_aluno'].'">Perfil do aluno</a></td>
                </tr></tbody>
                ';
                
                //   <select id="mySelect" onchange="location = this.value;">
                // <option value="">Selecione uma opção</option>
                //                                        <option value="ficha?id_aluno='.$linha['id_aluno'].'">Cadastrar ficha</option>
                //                                        <option value="editar_alunos?id_aluno='.$linha['id_aluno'].'">Editar</option>
                //                                        <option value="deletar_alunos?id_aluno='.$linha['id_aluno'].'">Excluir</option>
                //                                      </select>
                // </td>
                
                
                }
              
              }else{
                echo '<center><p class="text4">Nenhum resultado encontrado</center></p>';

              }
              echo '
              </table></div></div></div>';
                
}

$_SESSION['conexao']->set_charset("utf8mb4");

$sql_total = "SELECT id_aluno FROM alunos";
$resp_total= mysqli_query($_SESSION['conexao'],$sql_total);
$num_total = mysqli_num_rows($resp_total);
$pagina_total = ceil($num_total/$quantidade);
$exibir = 3;  
$anterior  = (($pagina - 1) == 0) ? 1 : $pagina - 1;
$posterior = (($pagina+1) >= $pagina_total) ? $pagina_total : $pagina+1;

?>
<br><br>
<center>
<?php
echo '<center>';
echo '<br><nav id="pag"><ul class="pagination pagination-centered">
<li class="btn btn-primary"><a  href ="?pagina=1">Primeira</a></li>';
echo '<li class="btn btn-primary"><a aria-label="Previous"  href ="?pagina='.$anterior.'"><</a></li>';

for($i = $pagina-$exibir; $i <= $pagina-1; $i++){
if($i > 0 )
echo '<li class="btn btn-primary"><a  href ="?pagina='.$i.'" >'.$i.'</a></li>';
}

echo '<li class="btn btn-primary"><a  href="?pagina='.$pagina.'" ><strong>'.$pagina.'</strong></a></li>';

for($i = $pagina+1; $i < $pagina+$exibir; $i++){
if($i <= $pagina_total)
echo '<li class="btn btn-primary"><a  href="?pagina='.$i.'" >'.$i.'</a></li>';
}
echo '<li class="btn btn-primary"><a aria-label="Next" href="?pagina='.$posterior.'">></a></li>';
echo '<li class="btn btn-primary"><a href="?pagina='.$pagina_total.'" >Ultima</a></li></ul></nav>';
echo '</center>';

?>
<!-- Blank End -->
<script src="../script_tst.js">
</script>

<?php
include_once 'include/footer.php';
?>

<style>
   .info-item {
  display: inline-block;


}

.test3 {
  justify-content: space-between;

  display: inline-block;
 
}
.text4{
    color: #EB1616;
  }

      .space{
        display: flex;
  justify-content: space-between;
  align-items: center;
      }

</style>

