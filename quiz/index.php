<?php
require_once "../common/facade.php";

$id = @$_GET["id"];

$dao = $factory->getQuizDao();
$quiz = $dao->findById($id);
if($quiz==null) {
    $quiz = new Quiz(null,null, null, null);
}

$page_title = "Questionarios";
require_once "../common/header.php";

?>

  <div class="container">
    <h1 class="mt-4 mb-4">Registro de Questionários</h1>
    <form action="quiz/create_update.php" method=post>
      <div class="form-group">
        <label for="name">Nome:</label>
        <input name="name" type="text" class="form-control" id="name" placeholder="Digite o nome do questionário">
      </div>
      <div class="form-group">
        <label for="description">Descrição:</label>
        <textarea name="description" class="form-control" id="description" rows="3" placeholder="Digite a descrição do questionário"></textarea>
      </div>
      <div class="form-group">
        <label for="minimum_score">Nota para aprovação:</label>
        <input name="minimum_score" type="number" class="form-control" id="minimum_score" placeholder="Digite a nota para aprovação">
      </div>
      <button type="submit" class="btn btn-primary">Enviar</button>
    </form>
  </div>

<?php		  
  //  require_once "footer.php";
?>