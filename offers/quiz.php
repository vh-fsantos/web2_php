<?php
require_once "../common/facade.php";

$id = @$_GET["id"];

$dao = $factory->getQuizDao();
$offer = $dao->findById($id);
if($offer==null) {
    $offer = new Offer(null,null, null, null, null, null);
}


$dao_offer = $factory->getOfferDao();
$offer = $dao_offer->findById($id);

$dao_question = $factory->getQuestionDao();
$questions = $dao_question->findAllByQuizId($offer->getQuiz()->getId());


$page_title = "Oferta - Questionário";
require_once "../common/header.php";

?>

<form action="/offers/submit.php" method="post">
  <?php foreach ($questions as $index => $question) { ?>
    <input type='hidden' name='id' value='<?php echo $offer->getId();?>'/>
    <input type='hidden' name='quiz_id' value='<?php echo $offer->getQuiz()->getId();?>'/>
    <div class="form-group">
      <h4>Question <?= $index+1 ?>: <?= $question->getDescription() ?></h4>
      <hr>
      <?php if ($question->getImage() != '') { ?>
        <image src="/images/<?php echo $question->getImage(); ?>" style="margin-block-end: 15px; max-height: 200px;"/>
      <?php } ?>
      <?php if ($question->getQuestionType() === 'essay') { ?>
        <textarea class="form-control" name="question_<?= $question->getId() ?>"></textarea>
      <?php } else { 
        foreach ($question->getAlternatives() as $alternative) { ?>
          <div class="form-check">
            <?php if ($question->getQuestionType() === 'single_choice') { ?>
              <input class="form-check-input" type="radio" name="question_<?= $question->getId() ?>" id="question_<?= $question->getId() ?>_<?= $alternative->getId() ?>" value="<?= $alternative->getId() ?>">
            <?php } else if ($question->getQuestionType() === 'multiple_choice') { ?>
              <input class="form-check-input" type="checkbox" name="question_<?= $question->getId() ?>[]" id="question_<?= $question->getId() ?>_<?= $alternative->getId() ?>" value="<?= $alternative->getId() ?>">
            <?php } ?>
            <label class="form-check-label" for="question_<?= $question->getId() ?>_<?= $alternative->getId() ?>"><?= $alternative->getDescription() ?></label>
          </div>
        <?php } ?>
      <?php } ?>
    </div>
  <?php } ?>
  <button type="submit" class="btn btn-primary">Enviar</button>
</form>
