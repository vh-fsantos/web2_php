<?php

// include "verifica.php";

$page_title = "Listagem de Questionários";

include_once "../common/header.php";
include_once "../common/facade.php";

echo "<section class='container mt-4'>";

// procura questionários

$dao = $factory->getQuizDao();
$quizzes = $dao->findAll();

echo "<a href='/quizzes/new.php' class='btn btn-primary mb-3'>";
echo "<span class='fas fa-plus'></span> Criar";
echo "</a>";

// exibe os questionários, se houver algum
if ($quizzes) {
 
	echo "<table class='table table-hover table-bordered'>";
	echo "<thead class='thead-light'>";
	echo "<tr>";
	echo "<th>Id</th>";
	echo "<th>Nome</th>";
	echo "<th>Nota para aprovação</th>";
	echo "<th>Ações</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";

	foreach ($quizzes as $quiz) {

		echo "<tr>";
		echo "<td>{$quiz->getId()}</td>";
		echo "<td>{$quiz->getName()}</td>";
		echo "<td>{$quiz->getMinimumScore()}</td>";
		echo "<td>";
		// botão para alterar um questionário
		echo "<a href='/quizzes/edit.php?id={$quiz->getId()}' class='btn btn-info mr-1'>";
		echo "<span class='fas fa-edit'></span> Alterar";
		echo "</a>";
		// botão para remover um questionário
		echo "<a href='/quizzes/delete.php?id={$quiz->getId()}' class='btn btn-danger'";
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

// layout do rodapé
include_once "../common/footer.php";
?>
