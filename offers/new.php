<?php 
$page_title = "Ofertas - Criar";




include_once("../common/facade.php");
include_once("../common/header.php");

if (!$developer)
{
  header("location: /index.php");
  exit;
}

$daoQuiz = $factory->getQuizDao();
$daoRespondent = $factory->getRespondentDao();

$allQuizzes = $daoQuiz->findAll();
$allRespondents = $daoRespondent->findAll();

?>
    <script>
      $(document).ready(function(){
        $('.datetimepicker').datetimepicker({
          format: 'd/m/Y H:i a',
        });
        
      });
    </script>

    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <h2 class="mb-4">Criar Oferta</h2>
          <form action="/offers/create.php" method="post">
            <div class="form-group">
              <label for="date">Data</label>
              <input type="text" class="form-control datetimepicker" id="date" name="date" required>
            </div>
            <div class="form-group">
              <label for="quiz_id">Selecione um Questionário</label>
              <select name="quiz_id" class="form-control" required>
                <option value="">--</option>
                <?php 
                foreach ($allQuizzes as &$quiz)
                    echo '<option value="' . $quiz->getId() . '">' . $quiz->getName() . '</option>';
                ?>
              </select>
            </div>
            <div class="form-group">
                <label for="respondent_id">Selecione um Respondente</label>
                <select name="respondent_id" class="form-control" required>
                <option value="">--</option>
                <?php 
                foreach ($allRespondents as &$resp)
                    echo '<option value="' . $resp->getId() . '">' . $resp->getName() . '</option>';
                ?>
              </select>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
          </form>
        </div>
      </div>
    </div>
<?php include_once("../common/footer.php"); ?>