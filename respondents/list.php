<?php 

$page_title = "Respondentes";

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

$dao = $factory->getRespondentDao();
$respondents = $dao->findAll();

if ($isAdmin)
{
  echo "<a href='/respondents/new.php' class='btn btn-primary mb-3'>";
  echo "<span class='fas fa-plus'></span> Criar";
  echo "</a>";
}

if ($respondents)
{
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
      echo "<a href='/respondents/update.php?id={$resp->getId()}' class='btn btn-info mr-1'>";
      echo "<span class='fas fa-edit'></span> Alterar";
      echo "</a>";
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
}

echo "</section>";
include_once("../common/footer.php"); 
?>



