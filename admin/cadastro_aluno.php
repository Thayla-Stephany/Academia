<?php
include_once('include/header.php');
include_once('include/conexao.php');

if (isset($_POST['nome_aluno'])) {
 
    $nome_aluno = $_POST['nome_aluno'];
    $codigo_ident = $_POST['codigo_ident'];

   
  
    $stmt = $_SESSION['conexao']->prepare("SELECT * FROM alunos WHERE codigo_ident = ?");
    $stmt->bind_param("s", $codigo_ident);
    $stmt->execute();
    $result = $stmt->get_result();
  
    if ($result->num_rows > 0) {
  
      $resp_alunos = $result->fetch_array(MYSQLI_ASSOC);
     
      $_SESSION['mensagem'] = ' <center><div class="p-2 mb-2 bg-primary text-white">O aluno ' . $resp_alunos['nome_aluno'] . ' já foi cadastrado e o seu código de identificação é: ' . $codigo_ident . '</div></center> ';
  
    } else {
  
      $stmt = $_SESSION['conexao']->prepare("INSERT INTO alunos (codigo_ident,nome_aluno, tipo_usuario) VALUES ( ?, ?, 'aluno')");
      $stmt->bind_param("ss", $codigo_ident, $nome_aluno);
      $resp_sql = $stmt->execute();
  
      if ($resp_sql === TRUE) {   
        $_SESSION['mensagem'] = '<center><div class="p-2 mb-2 bg-warning text-dark">Cadastro realizado com sucesso!</div></center>';
      } else {
        $_SESSION['mensagem'] = '<center><div class="p-2 mb-2 bg-primary text-white"> Erro! Tente novamente</div></center>';
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

<div class="bg-secondary rounded h-100 p-4">
                            <h6 class="mb-4">Cadastro de alunos</h6>
  <form action="cadastro_aluno" method="post">

                            <div class="form-floating mb-3">
                                <input name="nome_aluno" type="text" class="form-control"  placeholder="Nome do aluno">

                                <label>Nome do aluno</label>
                            </div>

                            <div class="form-floating mb-3">
                                <input name="codigo_ident" type="text" class="form-control" placeholder="Código">
                                <label>Código de identificação</label>
                            </div>

                            <center><button type="submit" class="btn btn-outline-warning m-2" value="Enviar">Cadastrar</button></center>

                        </div>
                        </form>
</div>

  <br>
  <?php
  include_once('include/footer.php');
  ?>
  

