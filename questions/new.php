<?php
require_once "../common/facade.php";

$page_title = "Questões - Criar";
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
  <h1 class="mt-4 mb-4">Criar Questão</h1>
		<form method="POST" action="/questions/create_update.php" enctype="multipart/form-data">
			<div class="form-group">
				<label for="description">Descrição:</label>
				<textarea class="form-control" id="description" name="description" required></textarea>
			</div>
			<div class="form-group">
				<label for="question_type">Tipo de resposta:</label>
				<select class="form-control" id="question_type" name="question_type" required>
					<option value="">Selecione um tipo de resposta</option>
					<option value="essay">Dissertativa</option>
					<option value="single_choice">Escolha Única</option>
					<option value="multiple_choice">Escolha Múltipla</option>
				</select>
			</div>

      <div class="form-group" id="alternatives">
					<label>Alternatives:</label>
          <button type="button" class="add_button btn btn-success">Adicionar alternativa</button>
          <ul class="list-group">
          </ul>
			</div>
			
			<div class="form-group">
				<label for="image">Imagem:</label>
				<input type="file" class="form-control-file" id="image" name="image">
			</div>
			<button type="submit" class="btn btn-primary">Criar</button>
		</form>
  </div>

		<script>
		$(document).ready(function() {
			// Esconde a div de alternatives no carregamento da página
			$('#alternatives').hide();

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