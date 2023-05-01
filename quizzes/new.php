<?php
require_once "../common/facade.php";

$page_title = "Questionários - Novo";
require_once "../common/header.php";

?>

  <div class="container">
    <h1 class="mt-4 mb-4">Registro de Questionários</h1>
    <form action="/quizzes/create_update.php" method=post>
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
    
      <button type="submit" class="btn btn-primary">Criar</button>
    </form>
  </div>

<?php		  
  //  require_once "footer.php";
?>