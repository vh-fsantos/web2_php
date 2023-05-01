<?php

// include "verifica.php";

$page_title = "Listagem de Questões";

include_once "../common/header.php";
include_once "../common/facade.php";

echo "<section class='container mt-4'>";

// procura questões

$dao = $factory->getQuestionDao();
$questions = $dao->findAll();

// exibe as questões, se houver alguma

echo "<a href='/questions/new.php' class='btn btn-primary mb-3'>";
echo "<span class='fas fa-plus'></span> Novo";
echo "</a>";

if ($questions) {
 
	echo "<table class='table table-hover table-bordered'>";
	echo "<thead class='thead-light'>";
	echo "<tr>";
	echo "<th>Id</th>";
	echo "<th>Descrição</th>";
	echo "<th>Tipo</th>";
	echo "<th>Ações</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";

	foreach ($questions as $question) {

		echo "<tr>";
		echo "<td>{$question->getId()}</td>";
		echo "<td>{$question->getDescription()}</td>";
		echo "<td>{$question->getQuestionType()}</td>";
		echo "<td>";
		// botão para alterar uma questão
		echo "<a href='modifica_question.php?id={$question->getId()}' class='btn btn-info'>";
		echo "<span class='fas fa-edit'></span> Alterar";
		echo "</a>";
		// botão para remover uma questão
		echo "<a href='remove_question.php?id={$question->getId()}' class='btn btn-danger'";
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
