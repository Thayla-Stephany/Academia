<?php
include_once('include/header.php');
include_once('include/conexao.php'); 


if(isset($_GET['id_aluno'])){
  $id_aluno = $_GET['id_aluno'];
  $_SESSION['conexao']->set_charset("utf8mb4");
  
  $query = "SELECT * FROM alunos WHERE id_aluno = ?";
  $stmt = mysqli_prepare($_SESSION['conexao'], $query);
  mysqli_stmt_bind_param($stmt, "i", $id_aluno);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $resp_sql = mysqli_fetch_array($result, MYSQLI_ASSOC);
} else {
  $id_aluno = $_POST['id_aluno'];
  $codigo_ident  = $_POST['codigo_ident'];
  $nome_aluno = $_POST['nome_aluno'];
  
  
  $query = "UPDATE alunos SET codigo_ident = ?, nome_aluno = ? WHERE id_aluno = ?";
  $stmt = mysqli_prepare($_SESSION['conexao'], $query);
  mysqli_stmt_bind_param($stmt, "ssi", $codigo_ident, $nome_aluno, $id_aluno);
  $rodar_sql = mysqli_stmt_execute($stmt);

  if($rodar_sql === TRUE){
      $_SESSION['mensagem'] = '<center><div class="p-2 mb-2 bg-warning text-dark">Dados atualizados com sucesso!</div></center>';
  } else {
      $_SESSION['mensagem2'] = '<center><div class="p-2 mb-2 bg-warning text-dark"> Erro! Tente novamente!</div></center>';
  }
  $_SESSION['conexao']->set_charset("utf8mb4");
  $query = "SELECT * FROM alunos WHERE id_aluno = ?";
  $stmt = mysqli_prepare($_SESSION['conexao'], $query);
  mysqli_stmt_bind_param($stmt, "i", $id_aluno);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
  $resp_sql = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $id_aluno = $resp_sql['id_aluno'];
}

if (isset($_SESSION['mensagem'])) {
  echo '<div class="mensagem">' . $_SESSION['mensagem'] . '</div>';
  unset($_SESSION['mensagem']);
};


?>


<div class="container-fluid pt-4 px-4">

<div class="bg-secondary rounded h-80 p-4">
<div class="space">
    <div class="info-item"><br>
  <h6 class="mb-4">Informações do aluno</h6>
</div>

<div class="info-item">
  <a class="test3" href="ficha?id_aluno=<?= $resp_sql['id_aluno'] ?>"> Cadastrar ficha</a>
</div>

<div class="info-item">
 <a class="test3" href="deletar_alunos?id_aluno=<?= $resp_sql['id_aluno'] ?>">Excluir</a>
</div>
</div>
<form action="perfil" method="post">

            <input type="hidden" name="id_aluno" value="<?= $id_aluno ?>">


                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="name@example.com"  name="nome_aluno" value="<?=$resp_sql['nome_aluno']?>">
                                <label>Nome do Aluno</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" placeholder="Password" name="codigo_ident" value="<?=$resp_sql['codigo_ident']?>">
                                <label >Codigo de identificação</label>
                            </div>
                            <center><br><button type="submit" class="btn btn-outline-warning m-2" value="Atualizar">Atualizar dados</button></center>
        </form>
</div>
</div>



<?php 
  
  $_SESSION['conexao']->set_charset("utf8mb4");

  $stmt = mysqli_prepare($_SESSION['conexao'], "SELECT * FROM treino WHERE id_aluno=? ORDER BY musculo_exercicio");
  mysqli_stmt_bind_param($stmt, "i", $id_aluno);
  mysqli_stmt_execute($stmt);
  $resp_query = mysqli_stmt_get_result($stmt);
  
  echo '  
  <div class="container-fluid pt-4 px-4">
  <div class="bg-secondary text-center rounded p-4">
                        <div class="space">
      <div class="info-item"><br>
                      <h6 class="mb-0">Ficha do aluno</h6><br>
                    </div>
                  
      <div class="info-item">
      <a class="test3" href="deletar_ficha_comp?id_aluno='.$id_aluno.'">Deletar</a>
      </div>
      </div>
  
                  <div class="table-responsive">
                      <table class="table text-start align-middle table-bordered table-hover mb-0">
                          <thead>
                              <tr class="text-white">
                            
                                  <th scope="col">Exercicio</th>
                                  <th scope="col">Series</th>
                                  <th scope="col">Repetições</th>
                                  <th scope="col">Dia da semana</th>
                                  <th scope="col">Opçoes</th>
                              </tr>   
                          </thead>
                          <tbody> ';
  
  while($linha=mysqli_fetch_array($resp_query)){
  
  echo '
  
  <tr>
  <td>'.$linha['exercicio'].'</td>
  <td>'.$linha['serie'].'</td>
  <td>'.$linha['repeticoes'].'</td>
  <td>'.$linha['dia_semana'].'</td>
  
  <td><select id="mySelect" onchange="location = this.value;">
  <option value="">Selecionar</option>
  <option value="editar_ficha?id_aluno='.$id_aluno.'&id_exercicio='.$linha['id_exercicio'].'">Editar ficha</option>
  <option value="deletar_ficha?id_aluno='.$id_aluno.'&id_exercicio='.$linha['id_exercicio'].'">Deletar</option>
  
  </select></td>
  
  </tr>
  </tbody> ';
  }
  
  echo '                          
  </table>
  </div>
  </div></div>';
  

include_once 'include/footer.php';
?>


<script src="script_tst.js"></script>
<style>
     select {
      font-family: Arial, sans-serif;
      font-size: 16px;
      color: #ffd700;
      background-color: #191c24;
      border: 2px solid #ffd700;
      border-radius: 5px;
      padding: 8px;
      width: 200px;
      }
      
      select:focus {
      border-color: #ffd700;
      box-shadow: 0 0 5px #ffd700;
      }
      
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
      
      .info-item {
  display: inline-block;


}

.test3 {
  justify-content: space-between;

  display: inline-block;
 
}

      .space{
        display: flex;
  justify-content: space-between;
  align-items: center;
      }
       
</style>