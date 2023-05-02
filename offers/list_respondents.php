<?php 

$page_title = "Ofertas";

include_once("../common/facade.php");
include_once("../common/header.php");

$isAdmin = FALSE;

if (!isset($_SESSION["userType"]) || !($_SESSION["userType"] === "respondent"))
{
  header("location: /index.php");
  exit;
}

$isAdmin = $_SESSION["isAdmin"];

echo "<section class='container mt-4'>";

$offerDao = $factory->getOfferDao();
$quizDao = $factory->getQuizDao();
$respondentDao = $factory->getRespondentDao();

$offers = $offerDao->findAll();


if ($offers)
{
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
		echo "<tr>";
		echo "<td>{$offer->getId()}</td>";
		echo "<td>{$offer->getDate()}</td>";
		echo "<td>{$quizDao->findById($offer->getQuiz()->getId())->getName()}</td>";
    echo "<td>{$quizDao->findById($offer->getQuiz()->getId())->getMinimumScore()}</td>";
    echo "<td>";
    echo "<a href='/offers/quiz.php?id={$offer->getId()}' class='btn btn-info mr-1'>";
    echo "<span class='fas fa-edit'></span> Responder";
    echo "</a>";
    echo "</td>";
    echo "</tr>";
	}

    echo "</tbody>";
	echo "</table>";
}

echo "</section>";
include_once("../common/footer.php"); ?>