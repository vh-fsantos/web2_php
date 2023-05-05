<?php 

$page_title = "Listagem de Ofertas";

include_once("../common/facade.php");
include_once("../common/header.php");

$isAdmin = FALSE;

if (!isset($_SESSION["userType"]) || !($_SESSION["userType"] === "respondent"))
{
  header("location: /index.php");
  exit;
}

$isAdmin = $_SESSION["isAdmin"];
$userId = $_SESSION["userId"];

echo "<section class='container mt-4'>";

$offerDao = $factory->getOfferDao();
$quizDao = $factory->getQuizDao();
$respondentDao = $factory->getRespondentDao();

$offers = $offerDao->findAllWithSubmissionInfoAndFilterByDate($userId);


if ($offers)
{
	echo "<div class='table-responsive'>";
    echo "<table class='table table-hover table-bordered'>";
	echo "<thead class='thead-light'>";
	echo "<tr>";
	echo "<th>Id</th>";
	echo "<th>Data</th>";
	echo "<th>Questionário</th>";
	echo "<th>Nota para aprovação</th>";
  echo "<th>Ações</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";

	foreach ($offers as &$offer) {
		$date = date('d/m/Y H:i', strtotime($offer->getDate()));
		echo "<tr>";
		echo "<td>{$offer->getId()}</td>";
		echo "<td>{$date}</td>";
		echo "<td>{$quizDao->findById($offer->getQuiz()->getId())->getName()}</td>";
    echo "<td>{$quizDao->findById($offer->getQuiz()->getId())->getMinimumScore()}</td>";
		echo "<td>";
		if ($offer->getSubmission()) {
				echo "Enviado em " . date('d/m/Y H:i', strtotime($offer->getSubmission()->getDate()));
		} else {
				echo "<a href='/offers/quiz.php?id={$offer->getId()}' class='btn btn-info mr-1'>";
				echo "<span class='fas fa-edit'></span> Responder";
				echo "</a>";
		}
		echo "</td>";
    echo "</tr>";
	}

    echo "</tbody>";
	echo "</table>";
	echo "</div>";
}

echo "</section>";
include_once("../common/footer.php"); ?>