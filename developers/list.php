<?php 

$page_title = "Listagem de Elaboradores";

include_once("../common/facade.php");
include_once("../common/header.php");

if (!isset($_SESSION["isAdmin"]) || !$_SESSION["isAdmin"])
{
  header("location: /index.php");
  exit;
} 

echo "<section class='container mt-4'>";

$dao = $factory->getDeveloperDao();
$developers = $dao->findAll();

echo "<a href='/developers/new.php' class='btn btn-primary mb-3'>";
echo "<span class='fas fa-plus'></span> Criar";
echo "</a>";

if ($developers)
{
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
    // echo "<a href='/developers/update.php?id={$dev->getId()}' class='btn btn-info mr-1'>";
    echo "<button class='btn btn-info mr-1' disabled>";
    echo "<span class='fas fa-edit'></span> Alterar";
    echo "</button>";
    // echo "</a>";
    echo "<a href='/developers/delete.php?id={$dev->getId()}' class='btn btn-danger mr-1'";
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
include_once("../common/footer.php"); 
?>



