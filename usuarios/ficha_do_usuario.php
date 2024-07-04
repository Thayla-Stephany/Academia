<?php

include_once('include/header_usuario.php');
include_once('include/conexao.php');


  if(!isset($_POST['selecao'])){
  
        echo '
        <div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
        <form method="post" action="ficha_do_usuario">
  <label for="selecao" class="text-white">Selecione um dia de semana</label><br><br>
  <select name="selecao" id="selecao">
    <option value="">Selecione</option>
    <option value="Segunda">Segunda</option>
    <option value="Terça">Terça</option>
    <option value="Quarta">Quarta</option>
    <option value="Quinta">Quinta</option>
    <option value="Sexta">Sexta</option>
  </select>
  <br><br>
  <button  class="btn btn-outline-warning m-2"  type="submit">Buscar</button>
</form>
';
echo '<br>';
echo '<label class="text-white">Nenhum dia selecionado ainda</label>';
    echo '
</div></div>
';
    }else{
        $selecao = $_POST['selecao'];
    $_SESSION['conexao']->set_charset("utf8mb4");
        $sql = "SELECT * FROM treino WHERE id_aluno=? AND dia_semana=?";
        $stmt = mysqli_prepare($_SESSION['conexao'], $sql);


echo '

<div id="resultado">
<div class="container-fluid pt-4 px-4">
<div class="bg-secondary text-center rounded p-4">
<form method="post" action="ficha_do_usuario">
  <label for="selecao" class="text-white">Selecione um dia de semana</label><br><br>
  <select name="selecao" id="selecao">
    <option value="">Selecione</option>
    <option value="Segunda">Segunda</option>
    <option value="Terça">Terça</option>
    <option value="Quarta">Quarta</option>
    <option value="Quinta">Quinta</option>
    <option value="Sexta">Sexta</option>
  </select><br><br>
  <button class="btn btn-outline-warning m-2" type="submit">Buscar</button>
</form>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Ficha de treino</h6>
                    </div>
                    <div class="table-responsive">
                    <table id="table-row-selected" class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-white">
                                    <th scope="col"></th>
                                    <th scope="col">Exercicio</th>
                                    <th scope="col">Series</th>
                                    <th scope="col">Repetições</th>
                                    <th scope="col">Vídeo</th>
                                    <th scope="col">Musculo</th>
                                </tr>
                            </thead>
                            <tbody> ';
                            if ($stmt) {
                              mysqli_stmt_bind_param($stmt, 'is', $_SESSION['login'], $selecao);
                              mysqli_stmt_execute($stmt);
                              $resp_query = mysqli_stmt_get_result($stmt);
                              if ($resp_query) {
                                  while ($linha = mysqli_fetch_assoc($resp_query)) {

    echo '
    <tr data-row-id="row'.$linha['id_treino'].'">
    <td><input class="form-check-input" type="checkbox" id="row'.$linha['id_treino'].'" ></td>
    <td>'.$linha['exercicio'].'</td>
    <td>'.$linha['serie'].'</td>
    <td>'.$linha['repeticoes'].'</td>
    <td><a href="'.$linha['link_exercicio'].'" target="_blank">Link</a></td>
    <td>'.$linha['musculo_exercicio'].'</td>

    </tr>
     ';
    }
  } else {
      echo "Erro na consulta: " . mysqli_error($_SESSION['conexao']);
  }
  mysqli_stmt_close($stmt);
} else {
  echo "Erro na preparação da consulta: " . mysqli_error($_SESSION['conexao']);
}

echo '  </tbody>                        
</table>
</div>
</div></div>';

}
?>

<?php
include_once 'include/footer.php';
?>
<script src="test.js"></script>


<style>

input[type=checkbox]:checked ~ td {
        text-decoration: line-through;
      }
      
      .table-row-selected {
        text-decoration: line-through;
      }

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