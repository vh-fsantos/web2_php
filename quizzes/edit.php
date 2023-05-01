<?php
require_once "../common/facade.php";

$id = @$_GET["id"];

$dao = $factory->getQuizDao();
$quiz = $dao->findById($id);
if($quiz==null) {
    $quiz = new Quiz(null,null,null, null, null);
}

$page_title = "Questionários";
require_once "../common/header.php";
?>


<div class="container">
  <h1 class="mt-4 mb-4">Registro de Questionários</h1>
  <form action="/quizzes/create_update.php" method=post>
    <div class="form-group">
      <label for="name">Nome:</label>
      <input value='<?php echo $quiz->getName();?>' name="name" type="text" class="form-control" id="name" placeholder="Digite o nome do questionário">
    </div>
    <div class="form-group">
      <label for="description">Descrição:</label>
      <textarea  name="description" class="form-control" id="description" rows="3" placeholder="Digite a descrição do questionário"><?php echo $quiz->getDescription();?></textarea>
    </div>
    <div class="form-group">
      <label for="minimum_score">Nota para aprovação:</label>
      <input value='<?php echo $quiz->getMinimumScore();?>' name="minimum_score" type="number" class="form-control" id="minimum_score" placeholder="Digite a nota para aprovação">
    </div>
    <input type='hidden' name='id' value='<?php echo $quiz->getId();?>'/>

    <!-- Tabela de questões -->
    <div class="form-group">
      <label for="question_list">Questões:</label>
       
      <table class="table table-striped" id="question-table">
        <thead>
          <tr>
            <th>Selecionar</th>
            <th>ID</th>
            <th>Descrição</th>
            <th>Tipo</th>
          </tr>
        </thead>
        <tbody>
          <?php 
          $dao_question = $factory->getQuestionDao();
          $questions = $dao_question->findAll();
          foreach ($questions as $question) {
              echo "<tr>";
              echo "<td><input type='checkbox' name='question_ids[]' value='{$question->getId()}'></td>";
              echo "<td>{$question->getId()}</td>";
              echo "<td>{$question->getDescription()}</td>";
              echo "<td>{$question->getQuestionType()}</td>";
              echo "</tr>";
          }
          ?>
        </tbody>
      </table>
    </div>

    <button type="submit" class="btn btn-primary">Editar</button>
  </form>
</div>
