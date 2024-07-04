<?php
include_once('include/header.php');
include_once('include/conexao.php');

if (isset($_POST['nome_exercicio'])) {
 
  $nome_exercicio  = htmlspecialchars($_POST['nome_exercicio']);
  $descricao_exercicio = htmlspecialchars($_POST['descricao_exercicio']);
  $musculo_exercicio = htmlspecialchars($_POST['musculo_exercicio']);
  $link_exercicio = htmlspecialchars($_POST['link_exercicio']);

$_SESSION['conexao']->set_charset("utf8mb4");
  $exercicios = "SELECT * FROM exercicios WHERE nome_exercicio = ?";
  $stmt = $_SESSION['conexao']->prepare($exercicios);
  $stmt->bind_param("s", $nome_exercicio);
  $stmt->execute();
  $result = $stmt->get_result();

  if (mysqli_num_rows($result) > 0) {
    $_SESSION['mensagem'] = ' <center><div class="p-2 mb-2 bg-warning text-dark">O exercício ' . $nome_exercicio . ' já está cadastrado. </div></center> ';
  } else {
    $sql = "INSERT INTO exercicios (nome_exercicio,descricao_exercicio, musculo_exercicio, link_exercicio) VALUES (?, ?, ?, ?)";
    $stmt = $_SESSION['conexao']->prepare($sql);
    $stmt->bind_param("ssss", $nome_exercicio, $descricao_exercicio, $musculo_exercicio, $link_exercicio);
    $resp_sql = $stmt->execute();
    
    if ($resp_sql === TRUE) {   
      $_SESSION['mensagem'] = '<center><div class="p-2 mb-2 bg-warning text-dark">Cadastro do exercício feito com sucesso!</div></center>';
    } else {
      $_SESSION['mensagem'] = 'center><div class="p-2 mb-2 bg-primary text-white">Erro! Tente novamente!</div></center>';
    };
  }
}

if (isset($_SESSION['mensagem'])) {
  echo '<div class="mensagem">' . $_SESSION['mensagem'] . '</div>';
  unset($_SESSION['mensagem']); // Limpa a variável da sessão para que a mensagem não seja exibida novamente na próxima vez que a página for carregada.
};


?>
<head>
<script src="../script_tst.js"></script>
</head>
<div class="container-fluid pt-4 px-4">

<div class="bg-secondary rounded h-80 p-4">
                            <h6 class="mb-4">Cadastrar exercício</h6>
  <form action="cadastrar_exercicio" method="post">

                            <div class="form-floating mb-3">
                                <input type="text" name="nome_exercicio" class="form-control">
                                <label>Nome do exercicio</label>
                           
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" name="descricao_exercicio" class="form-control">
                                <label>Descrição</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" name="musculo_exercicio" class="form-control">
                                <label>Músculo</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="url" name="link_exercicio" class="form-control">
                                <label>Vídeo</label>
                            </div>

                           <center> <br><button type="submit" class="btn btn-outline-warning m-2" value="Cadastrar">Cadastrar</button> </center>

                        </div>
                        </form>
</div>

  <br>
  <?php
  include_once('include/footer.php');
  ?>
  
