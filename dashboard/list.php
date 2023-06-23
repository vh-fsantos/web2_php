<?php 

$page_title = "Dashboard";

include_once("../common/facade.php");
include_once("../common/header.php");

$quizDao = $factory->getQuizDao();
$quizzes = $quizDao->findAll(null, null , '');

$offerDao = $factory->getOfferDao();
$offers = $offerDao->findAll();

$submissionDao = $factory->getSubmissionDao();
$submissions = $submissionDao->findAll();

echo "<section class='container mt-4'>";
echo "<div class='table-responsive'>";
echo "<table class='table table-hover table-bordered'>";
echo "<thead class='thead-light'>";
echo "<tr>";
echo "<th>Questionário</th>";
echo "<th>Ofertas</th>";
echo "<th>Submissões</th>";
echo "</tr>";
echo "</thead>";
echo "<tbody>";

foreach ($quizzes as &$quiz) {
    $quizId = $quiz->getId();
	echo "<tr>";
	echo "<td>{$quiz->getName()}</td>";
    $count = 0;
    foreach ($offers as &$offer){
        if ($offer->getQuiz()->getId() == $quizId){
            $count++;
        }
    }
	echo "<td>$count</td>";
    $count = 0;
    foreach ($submissions as &$submission){
        if ($submission->getOffer()->getQuiz()->getId() == $quizId){
            $count++;
        }
    }
	echo "<td>$count</td>";
    echo "</tr>";
}

echo "</tbody>";
echo "</table>";
echo "</div>";
echo "</section>";

include_once("../common/footer.php"); 
?>