<?php
require_once "../common/facade.php";

$id = @$_GET["id"];

$dao = $factory->getQuestionDao();
$question = $dao->findById($id);
if($question==null) {
    $question = new Question(null,null, null, null, null, null);
}

$dao_alternative = $factory->getAlternativeDao();
$alternatives = $dao_alternative->findAllByQuestionId($id);


$page_title = "Questões - Editar";
require_once "../common/header.php";

?>

  <style>
    #alternatives ul {
      margin-top: 20px;
    }

    #alternatives li {
      display: flex;
      gap: 15px;
    }
  </style>

  <div class="container">
  <h1 class="mt-4 mb-4">Editar Questão</h1>
		<form method="POST" action="/questions/create_update.php" enctype="multipart/form-data">
			<div class="form-group">
				<label for="description">Descrição:</label>
				<textarea class="form-control" id="description" name="description" required><?php echo $question->getDescription();?></textarea>
			</div>
			<div class="form-group">
				<label for="question_type">Tipo de resposta:</label>
				<select class="form-control" id="question_type" name="question_type" required>
					<option value="">Selecione um tipo de resposta</option>
					<option value="essay" <?php if ($question->getQuestionType() == "essay") echo "selected"; ?>>Dissertativa</option>
					<option value="single_choice" <?php if ($question->getQuestionType() == "single_choice") echo "selected"; ?>>Escolha Única</option>
					<option value="multiple_choice" <?php if ($question->getQuestionType() == "multiple_choice") echo "selected"; ?>>Escolha Múltipla</option>
				</select>
			</div>

      <div class="form-group" id="alternatives">
					<label>Alternatives:</label>
          <button type="button" class="add_button btn btn-success">Adicionar alternativa</button>
          <ul class="list-group">
					<?php foreach ($alternatives as $index => $alternative) { ?>
							<li class="list-group-item alternative">
									<?php if ($question->getQuestionType() === 'single_choice') { ?>
											<input type="radio" name="is_correct[]" value="<?= $index ?>" <?= $alternative->getIsCorrect() ? 'checked' : '' ?>>
									<?php } else if ($question->getQuestionType() === 'multiple_choice') { ?>
											<input type="checkbox" name="is_correct[]" value="<?= $index ?>" <?= $alternative->getIsCorrect() ? 'checked' : '' ?>>
									<?php } ?>
									<input type="text" class="form-control" name="alternatives[]" value="<?= $alternative->getDescription() ?>" placeholder="Digite uma alternative">
									<button type="button" class="remove_button btn btn-danger">Remover</button>
							</li>
					<?php } ?>
          </ul>
			</div>
			
			<div class="form-group">
				<?php if ($question->getImage() != '') { ?>
					<p>Imagem atual:</p>
					<image src="/images/<?php echo $question->getImage(); ?>" style="margin-block-end: 15px; max-height: 200px;"/>
				<?php } ?>
				<div>
				<label for="image">Imagem:</label>
				<input type="file" class="form-control-file" id="image" name="image" accept="image/*">
				</div>
			</div>
			<input type='hidden' name='id' value='<?php echo $question->getId();?>'/>
			<button type="submit" class="btn btn-primary">Salvar</button>
		</form>
  </div>

		<script>
		$(document).ready(function() {
			// Esconde a div de alternatives no carregamento da página
			<?php if ($question->getQuestionType() !== 'single_choice' && $question->getQuestionType() !== 'multiple_choice') { ?>
				$('#alternatives').hide();
			<?php } ?>
			

			// Mostra ou esconde a div de alternatives quando o tipo de resposta é escolha única ou múltipla
			$('#question_type').on('change', function() {
				if ($(this).val() === 'single_choice') {
					// Remove o atributo "multiple" dos checkboxes e adiciona a classe "radio" para transformá-los em radio buttons
					$('input[type="checkbox"]').removeAttr('multiple').addClass('radio').attr('type', 'radio');
					$('#alternatives').show();
				} else if ($(this).val() === 'multiple_choice') {
          $('input[type="radio"]').removeClass('radio').attr('type', 'checkbox').attr('multiple', 'multiple');
          $('#alternatives').show();
          } else {
          $('#alternatives').hide();
          }
      });
      $(document).on('click', '.add_button', function() {
			var html = '';
			html += '<li class="list-group-item alternative">';
      if ($('#question_type').val() === 'single_choice') {
				html += '<input type="radio" class="radio" name="is_correct[]" value="' + $('.alternative').length + '">';
			} else {
				html += '<input type="checkbox" class="checkbox" name="is_correct[]" value="' + $('.alternative').length + '">';
			}
			html += '<input type="text" class="form-control" name="alternatives[]" placeholder="Digite uma alternative">';
			
			html += '<button type="button" class="remove_button btn btn-danger">Remover</button></li>';
			$('#alternatives .list-group').append(html);
		});

		// Remove um campo de alternative
		$(document).on('click', '.remove_button', function() {
			$(this).closest('.alternative').remove();
		});
	});
</script>