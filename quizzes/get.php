
<?php

include_once("../common/facade.php");

$limit = 2; 
$page = isset($_GET['page']) ? $_GET['page'] : 1; 
$search = isset($_GET['search']) ? $_GET['search'] : '';
$offset = ($page - 1) * $limit; 

$dao = $factory->getQuizDao();

$quizzes = $dao->findAll($offset, $limit, $search);

if ($quizzes) {
  echo "<div class='table-responsive'>";
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
	echo "</div>";

  // Pagination links
  $total = $dao->countAll($search); // Total number of offers
  $totalPages = ceil($total / $limit); // Calculate total number of pages
  echo '<ul class="pagination">';
 
  for ($i = 1; $i <= $totalPages; $i++) {
    echo '<li class="page-item' . ($i == $page ? ' active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
  }
  
  echo '</ul>';
} else {
  echo '<p>No data found for "'.$search.'".</p>';
}
?>
