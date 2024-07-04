<?php
ob_start();
include_once('include/header.php');
include_once('include/conexao.php'); 


  if (isset($_SESSION['mensagem'])) {
    echo "<br>";
    echo '<div class="mensagem">' . $_SESSION['mensagem'] . '</div>';
    unset($_SESSION['mensagem']); // Limpa a variável da sessão para que a mensagem não seja exibida novamente na próxima vez que a página for carregada.
  };
  
// Verificar se o formulário de pesquisa foi enviado
if ($_SESSION['termo'] AND $_SESSION['aluno']) {
    // Formulário de pesquisa

  ?>



  
<div class="container-fluid pt-4 px-4">
        <div class="bg-secondary text-center rounded p-4">
            <div class="d-flex align-items-center justify-content-between mb-4">
               <center><h6 class="mb-0">Exercícios</h6></center>
            </div>
            <div class="table-responsive">
            <form method="post" action="pesquisa_exer">
                <input type="hidden" name="id_aluno" value='<?php echo $_SESSION['aluno'];?>'>
                    <table id="valores-dinamicos" class="table text-start align-middle table-bordered table-hover mb-0">
                        <thead>
                            <tr class="text-white">
                                <th scope="col"></th>
                                <th scope="col">Nome exércicio</th>
                                <th scope="col">Descrição</th>
                                <th scope="col">Músculo</th>
                                <th scope="col">Link</th>
                                <th scope="col">Séries</th>
                                <th scope="col">Repetições</th>
                                <th scope="col">Dia da semana</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        //Recupera o dado do banco em utf-8
              $_SESSION['conexao']->set_charset("utf8mb4");
  
// Recupera o termo de pesquisa enviado pelo usuário
$stmt = mysqli_prepare($_SESSION['conexao'], "SELECT * FROM exercicios WHERE musculo_exercicio LIKE ? OR nome_exercicio LIKE ?");
$search_term = '%' . $_SESSION['termo'] . '%';
mysqli_stmt_bind_param($stmt, 'ss', $search_term, $search_term);
mysqli_stmt_execute($stmt);
$resp_query = mysqli_stmt_get_result($stmt);

while ($linha = mysqli_fetch_array($resp_query, MYSQLI_ASSOC)) {
    echo '
        <tr>
            <td><input class="form-check-input" name="selecionados[]" value="'.$linha['id_exercicio'].'" type="checkbox"></td>
            <td>'.$linha['nome_exercicio'].'</td>
            <td>'.$linha['descricao_exercicio'].'</td>
            <td>'.$linha['musculo_exercicio'].'</td>
            <td><a href="'.$linha['link_exercicio'].'" target="_blank">'.$linha['nome_exercicio'].' </a></td>
            <td><input type="number" class="gray" name="serie'.$linha['id_exercicio'].'"></td>
            <td><input type="number" name="repeticoes'.$linha['id_exercicio'].'"></td>
            <td>
                <select id="dia_semana" name="dia_semana'.$linha['id_exercicio'].'">
                    <option value="">Dia da semana</option>
                    <option value="Segunda">Segunda</option>
                    <option value="Terça">Terça</option>
                    <option value="Quarta">Quarta</option>
                    <option value="Quinta">Quinta</option>
                    <option value="Sexta">Sexta</option>
                </select>
            </td>
        </tr>';
}

echo '
        </table>
        <center><br><button type="submit" class="btn btn-outline-warning m-2" name="enviar" value="enviar">Cadastrar ficha</button></center>
    </form>
</div>
</div>
</div>';

   
if (isset($_POST['enviar'])) {
    // Verificar quais linhas de dados foram selecionadas
    $selecionados = $_POST['selecionados'];
    
    // Selecionar os dados selecionados da tabela A
    $query = "SELECT * FROM exercicios WHERE id_exercicio IN (".implode(",", array_fill(0, count($selecionados), "?")).")";
    $stmt = mysqli_prepare($_SESSION['conexao'], $query);
    mysqli_stmt_bind_param($stmt, str_repeat("i", count($selecionados)), ...$selecionados);
    mysqli_stmt_execute($stmt);
    $resultado = mysqli_stmt_get_result($stmt);

    // Inserir os dados selecionados na tabela B
    while ($linha = mysqli_fetch_assoc($resultado)) {
        // Pegar o valor de série e repetição correspondente à linha atual
        $semana = $_POST['dia_semana'.$linha['id_exercicio']];
        $serie = $_POST['serie'.$linha['id_exercicio']];
        $repeticoes = $_POST['repeticoes'.$linha['id_exercicio']];
        $id= $_POST['id_aluno'];
        $id_exercicio = $linha['id_exercicio'];

        // Inserir na tabela B
        $query2 = "INSERT INTO treino (exercicio, serie, repeticoes, dia_semana, descricao_exercicio, musculo_exercicio, link_exercicio, id_aluno, id_exercicio)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt2 = mysqli_prepare($_SESSION['conexao'], $query2);
        mysqli_stmt_bind_param($stmt2, "siissssii", $linha['nome_exercicio'], $serie, $repeticoes, $semana, $linha['descricao_exercicio'], $linha['musculo_exercicio'], $linha['link_exercicio'], $id, $id_exercicio);
        mysqli_stmt_execute($stmt2);

        $_SESSION['mensagem'] = '<center><div class="p-2 mb-2 bg-warning text-dark">Ficha cadastrada com sucesso!</div></center>';
        header('location:ficha?id_aluno='.$id);
    }
}

// Fechar a conexão com o banco de dados
mysqli_close($_SESSION['conexao']);
}

include_once 'include/footer.php';
ob_end_flush();
?>

<script>
 setTimeout(function() {
            var mensagem = document.querySelector('.mensagem');
            if (mensagem) {
                mensagem.remove(); // Remover o elemento que contém a mensagem
            }
        }, 5000); // 5000 milissegundos = 5 segundos
 

</script>


<style>
         select {
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #fff;
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
          
          
          input {
            width: 100px;
            border-radius: 10px;
            background-color: #000000;
            color: #fff;
          }
          
    </style>