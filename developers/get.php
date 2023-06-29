
<?php

include_once("../common/facade.php");

$limit = 2; 
$page = isset($_GET['page']) ? $_GET['page'] : 1; 
$search = isset($_GET['search']) ? $_GET['search'] : '';
$offset = ($page - 1) * $limit; 

$dao = $factory->getDeveloperDao();

$developers = $dao->findAll($offset, $limit, $search);

if ($developers) {
  echo "<div class='table-responsive'>";
  echo "<table class='table table-hover table-bordered'>";
	echo "<thead class='thead-light'>";
	echo "<tr>";
	echo "<th>Id</th>";
	echo "<th>Login</th>";
	echo "<th>Nome</th>";
	echo "<th>Email</th>";
  echo "<th>Instituição</th>";
  echo "<th>Admnistrador</th>";
  echo "<th>Ações</th>";
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";

	foreach ($developers as &$dev) {
    $adminText = $dev->getIsAdmin() ? 'True' : 'False';

		echo "<tr>";
		echo "<td>{$dev->getId()}</td>";
		echo "<td>{$dev->getLogin()}</td>";
		echo "<td>{$dev->getName()}</td>";
    echo "<td>{$dev->getEmail()}</td>";
    echo "<td>{$dev->getInstitution()}</td>";
    echo "<td>{$adminText}</td>";
    echo "<td>";
    echo "<a href='/developers/edit.php?id={$dev->getId()}' class='btn btn-info mr-1'>";
    echo "<span class='fas fa-edit'></span> Alterar";
    echo "</a>";
    echo "<a href='/developers/delete.php?id={$dev->getId()}' class='btn btn-danger ml-1'";
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
