
<?php

include_once("../common/facade.php");

$limit = 2; 
$page = isset($_GET['page']) ? $_GET['page'] : 1; 
$isAdmin = isset($_GET['isAdmin']) ? $_GET['isAdmin'] : false; 
$search = isset($_GET['search']) ? $_GET['search'] : '';
$offset = ($page - 1) * $limit; 

$dao = $factory->getRespondentDao();

$respondents = $dao->findAll($offset, $limit, $search);

if ($respondents) {
  echo "<div class='table-responsive'>";
  echo "<table class='table table-hover table-bordered'>";
	echo "<thead class='thead-light'>";
	echo "<tr>";
	echo "<th>Id</th>";
	echo "<th>Login</th>";
	echo "<th>Nome</th>";
	echo "<th>Email</th>";
  echo "<th>Telefone</th>";
  if ($isAdmin)
  {
    echo "<th>Ações</th>";
  }
	echo "</tr>";
	echo "</thead>";
	echo "<tbody>";

	foreach ($respondents as &$resp) {
		echo "<tr>";
		echo "<td>{$resp->getId()}</td>";
		echo "<td>{$resp->getLogin()}</td>";
		echo "<td>{$resp->getName()}</td>";
    echo "<td>{$resp->getEmail()}</td>";
    echo "<td>{$resp->getPhone()}</td>";

    if ($isAdmin)
    {
      echo "<td>";
      // echo "<a href='/respondents/update.php?id={$resp->getId()}' class='btn btn-info mr-1'>";
      echo "<button class='btn btn-info mr-1' disabled>";
      echo "<span class='fas fa-edit'></span> Alterar";
      echo "</button>";
      // echo "</a>";
      echo "<a href='/respondents/delete.php?id={$resp->getId()}' class='btn btn-danger mr-1'";
      echo "onclick=\"return confirm('Tem certeza que quer excluir?')\">";
      echo "<span class='fas fa-trash'></span> Excluir";
      echo "</a>";
      echo "</td>";
    }

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
