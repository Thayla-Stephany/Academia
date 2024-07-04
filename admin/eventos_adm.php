<?php
include_once('include/header.php');
include_once('include/conexao.php');


if (isset($_POST['Enviar'])) {

    $nome_evento = $_POST['nome_evento'];
    $descricao_evento = $_POST['descricao_evento'];
    $data_evento = $_POST['data_evento'];
    $data_final = $_POST['data_final'];

    mysqli_set_charset($_SESSION['conexao'], 'utf8');
    // prepare statement
    $stmt = mysqli_prepare($_SESSION['conexao'], "INSERT INTO eventos (nome_evento, descricao_evento, data_evento, data_final) VALUES (?, ?, ?, ?)");

    // bind parameters
    mysqli_stmt_bind_param($stmt, "ssss", $nome_evento, $descricao_evento, $data_evento, $data_final);

    // execute statement
    $resp_sql = mysqli_stmt_execute($stmt);

    // check if statement executed successfully
    if ($resp_sql === TRUE) {
        $_SESSION['mensagem'] = '<center><div class="p-2 mb-2 bg-warning text-dark">Cadastro do evento realizado com sucesso!</div></center>';
    } else {
        $_SESSION['mensagem'] = 'center><div class="p-2 mb-2 bg-primary text-white"> Erro! Tente novamente</div></center>';
    }

    // close statement
    mysqli_stmt_close($stmt);
}


  
  if (isset($_SESSION['mensagem'])) {
      echo "<br>";
      echo '<div class="mensagem">' . $_SESSION['mensagem'] . '</div>';
      unset($_SESSION['mensagem']); // Limpa a variável da sessão para que a mensagem não seja exibida novamente na próxima vez que a página for carregada.
    };

?>
<head>
<script>
        // Atrasar a remoção da mensagem por 5 segundos
        setTimeout(function() {
            var mensagem = document.querySelector('.mensagem');
            if (mensagem) {
                mensagem.remove(); // Remover o elemento que contém a mensagem
            }
        }, 5000); // 5000 milissegundos = 5 segundos
    </script>
</head>
<div class="container-fluid pt-4 px-4">

<div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Cadastro de evento</h6>
  <form action="eventos_adm" method="post">

                            <div class="form-floating mb-3">
                                <input name="nome_evento" type="text" class="form-control"  placeholder="Nome do evento">
                                <label>Nome do evento</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" name="descricao_evento" class="form-control" placeholder="Descrição do evento">
                                <label>Descrição do evento</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="date" name="data_evento" class="form-control" placeholder="Data do evento">
                                <label>Data de inicio</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="date" name="data_final" class="form-control" placeholder="Data final">
                                <label>Data de encerramento </label>
                            </div>

                            <center><button type="submit" class="btn btn-outline-warning m-2" name="Enviar" value="Enviar">Cadastrar</button></center>

                        </div>
                        </form>
</div>

<?php

include_once('include/footer.php');

?>