<?php 

include_once("../common/facade.php");

$date = @$_POST["date"];
$quiz_id = @$_POST["quiz_id"];
$respondent_id = @$_POST["respondent_id"];

$offer = new Offer(null, $date);
$offer->setQuiz(new Quiz($quiz_id, null, null, null, null));
$offer->setRespondent(new Respondent($respondent_id, null, null, null, null, null));

$dao = $factory->getOfferDao();
$dao->create($offer);

header("location: /offers/list.php");
exit;

?>