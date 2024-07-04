
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
                  
                              <div class="table-responsive">
                              <div class="test2">
                        <h6 class="mb-4">Lista dos exercicíos</h6>
                        <form method="post" action="lista_exercicios">
  <input class="form-control bg-dark border-0 test3" type="search" placeholder="Pesquisar exercício..." name="busca" id="busca">
  </form>
  </div>              
                                  <table class="table">
  
                        <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">Descrição</th>
                                    <th scope="col">Músculo</th>
                                    <th scope="col">Vídeo(Link)</th>
                                    <th scope="col">Opções</th>
                                </tr>
                            </thead>
                            
                            ';
                            $_SESSION['conexao']->set_charset("utf8mb4");
  
      $sql = "SELECT * FROM exercicios ORDER BY nome_exercicio LIMIT ?, ?";
      $stmt = mysqli_prepare($_SESSION['conexao'], $sql);

      $quantidade = 10;
      mysqli_stmt_bind_param($stmt, "ii", $inicio, $quantidade);
      mysqli_stmt_execute($stmt);
      $resp_sql = mysqli_stmt_get_result($stmt);
  
      while($linha= mysqli_fetch_array($resp_sql)){
  
          echo'   
              <tbody>
              <tr>
                  <td>'.$linha['nome_exercicio'].'</td>
                  <td>'.$linha['descricao_exercicio'].'</td>
                  <td>'.$linha['musculo_exercicio'].'</td>
                  <td><a href="'.$linha['link_exercicio'].'" target="_blank">'.$linha['nome_exercicio'].' </a></td>
                  <td>
                  <select id="mySelect" onchange="location = this.value;">
                  <option value="">Selecionar</option>
                  <option value="editar_exercicio?id_exercicio='.$linha['id_exercicio'].'">Editar</option>
                  <option value="deletar_exercicio?id_exercicio='.$linha['id_exercicio'].'">Excluir</option>
                  </select>
                  </td>
              </tr>
              </tbody>';
      }
  
      echo '</table></div></div>';
  } else {
      $busca = $_POST['busca'];
      $_SESSION['busca'] = $busca;
  
      echo '<div class="container-fluid pt-4 px-4">
          <div class="bg-secondary rounded h-80 p-4">
              <div class="table-responsive">
                  <div class="test2">
                      <h6 class="mb-4">Lista dos exercicíos</h6>
                      <form method="post" action="lista_exercicios">
                          <input class="form-control bg-dark border-0 test3" type="search" placeholder="Pesquisar exercício..." name="busca" id="busca">
                      </form>
                  </div>              
                  <table class="table">
                      <thead>
                          <tr>
                              <th scope="col">Nome</th>
                              <th scope="col">Descrição</th>
                              <th scope="col">Músculo</th>
                              <th scope="col">Vídeo(Link)</th>
                              <th scope="col">Opções</th>
                          </tr>
                      </thead>';

  
                      $_SESSION['conexao']->set_charset("utf8mb4");

                      $sql = "SELECT * FROM exercicios WHERE nome_exercicio LIKE ? ORDER BY nome_exercicio LIMIT ?, ?";
                      $stmt = mysqli_prepare($_SESSION['conexao'], $sql);
                      $busca = "%$busca%";
                      mysqli_stmt_bind_param($stmt, "sii", $busca, $inicio, $quantidade);
                      mysqli_stmt_execute($stmt);
                      $resp_sql = mysqli_stmt_get_result($stmt);
                      $num = mysqli_num_rows($resp_sql);
                      if ($num > 0) {
                      while ($linha = mysqli_fetch_array($resp_sql)) {
                      echo '
                      <tbody>
                      <tr>
                      <td>' . $linha['nome_exercicio'] . '</td>
                      <td>' . $linha['descricao_exercicio'] . '</td>
                      <td>' . $linha['musculo_exercicio'] . '</td>
                      <td><a href="' . $linha['link_exercicio'] . '" target="_blank">' . $linha['nome_exercicio'] . '</a></td>
                      <td>
                      <select id="mySelect" onchange="location = this.value;">
                      <option value="">Selecionar</option>
                      <option value="editar_exercicio?id_exercicio=' . $linha['id_exercicio'] . '">Editar</option>
                      <option value="deletar_exercicio?id_exercicio=' . $linha['id_exercicio'] . '">Excluir</option>
                      </select>
                      </td>
                      </tr>
                      </tbody>
                      ';
                      }
                      } else {
                      echo '<center><p class="text3">Nenhum resultado encontrado</center></p>';
                      }
                      
                      echo '
                      
                        </table>
                      </div>
                      </div>';
                          }
$sql_total = 'SELECT id_exercicio FROM exercicios';
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
<script src="../script_tst.js"></script>

    <?php
include_once 'include/footer.php';
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
  width: 117px;
}

select:focus {
  border-color: #ffd700;
  box-shadow: 0 0 5px #ffd700;
}

    .test2{
        display: flex;
        align-items: center;
        justify-content: space-between;

    }

   .teste3{
      top: 15px;
      margin-bottom: 50px;
    }

    .text3{
    color: #EB1616;
  }

</style>

