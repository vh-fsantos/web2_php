<?php
require_once "../common/facade.php";

$id = @$_GET["id"];

$dao = $factory->getQuizDao();
$quiz = $dao->findById($id);
if($quiz==null) {
    $quiz = new Quiz(null,null, null, null);
}

$titulo_pagina = "Questionarios";
// require_once "header.php";

?>

  <div class="container">
    <h1 class="mt-4 mb-4">Registro de Questionários</h1>
    <form>
      <div class="form-group">
        <label for="nome">Nome:</label>
        <input type="text" class="form-control" id="nome" placeholder="Digite o nome do questionário">
      </div>
      <div class="form-group">
        <label for="descricao">Descrição:</label>
        <textarea class="form-control" id="descricao" rows="3" placeholder="Digite a descrição do questionário"></textarea>
      </div>
      <div class="form-group">
        <label for="nota">Nota para aprovação:</label>
        <input type="number" class="form-control" id="nota" placeholder="Digite a nota para aprovação">
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>

<?php		  
  //  require_once "footer.php";
?>