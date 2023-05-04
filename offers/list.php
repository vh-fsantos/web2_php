<?php 

$page_title = "Ofertas";

include_once("../common/facade.php");
include_once("../common/header.php");

$isAdmin = FALSE;

if (!$developer)
{
  header("location: /index.php");
  exit;
}


$isAdmin = $_SESSION["isAdmin"];

echo "<section class='container mt-4'>";

$offerDao = $factory->getOfferDao();
$quizDao = $factory->getQuizDao();
$respondentDao = $factory->getRespondentDao();

$offers = $offerDao->findAllWithSubmissionInfo();


echo "<a href='/offers/new.php' class='btn btn-primary mb-3'>";
echo "<span class='fas fa-plus'></span> Criar";
echo "</a>";

if ($offers)
{
    echo "<table class='table table-hover table-bordered'>";
	echo "<thead class='thead-light'>";
	echo "<tr>";
	echo "<th>Id</th>";
	echo "<th>Data</th>";
	echo "<th>Questionário</th>";
	echo "<th>Respondente</th>";
    echo "<th>Enviado</th>";
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
        echo "<td>{$respondentDao->findById($offer->getRespondent()->getId())->getName()}</td>";
        if ($offer->getSubmission() !== null) {
            echo '<td><i class="fas fa-check text-success"></i></td>';
        } else {
            echo '<td><i class="fas fa-times text-danger"></i></td>';
        }
        echo "<td>";
        if ($offer->getSubmission() !== null) {
            // Disable the button if offer has a submission
            echo "<button class='btn btn-info mr-1' disabled>";
            echo "<span class='fas fa-edit'></span> Alterar";
            echo "</button>";
        } else {
            // Enable the button if offer does not have a submission
            echo "<a href='/offers/update.php?id={$offer->getId()}' class='btn btn-info mr-1'>";
            echo "<span class='fas fa-edit'></span> Alterar";
            echo "</a>";
        }
        echo "<a href='/offers/delete.php?id={$offer->getId()}' class='btn btn-danger mr-1'";
        echo "onclick=\"return confirm('Tem certeza que quer excluir?')\">";
        echo "<span class='fas fa-trash'></span> Excluir";
        echo "</a>";
        echo "</td>";
        echo "</tr>";
	}

    echo "</tbody>";
	echo "</table>";
}

echo "</section>";
include_once("../common/footer.php"); ?>