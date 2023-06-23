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
    echo "<button class='update-button btn btn-info mr-1' data-value={$dev->getId()} data-toggle='modal' data-target='#modal'>";
    echo "<span class='fas fa-edit'></span> Alterar";
    echo "</button>";
    echo "<a href='/developers/delete.php?id={$dev->getId()}' class='btn btn-danger mr-1'";
    echo "onclick=\"return confirm('Tem certeza que quer excluir?')\">";
    echo "<span class='fas fa-trash'></span> Excluir";
    echo "</a>";
    echo "</td>";
		echo "</tr>";
	}

  echo "</tbody>";
	echo "</table>";
  echo "</div>";
}

echo "</section>";

$idForm = "update-form";
$modalTitle = "Atualizar Cadastro";
$modalAction = "/developers/update.php";
$modalSubmitText = "Atualizar";
$modalInputs = [ array("label" => "Login", "type" => "text", "name" => "login"),
                array("label" => "Password", "type" => "password", "name" => "password"),
                array("label" => "Email", "type" => "email", "name" => "email"),
                array("label" => "Nome", "type" => "text", "name" => "name"),
                array("label" => "Instituição", "type" => "text", "name" => "institution")
];

include_once("../common/modal.php");

include_once("../common/footer.php"); 
?>