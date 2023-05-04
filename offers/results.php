<?php 
$page_title = "Resultados Questionário";




include_once("../common/facade.php");
include_once("../common/header.php");

if (!$respondent)
{
  header("location: /index.php");
  exit;
}
?>

<?php 
if (isset($_SESSION['results_html'])) {
  $results_html = $_SESSION['results_html'];
  echo $results_html;
} else {
  echo "Results not available";
}

?>


<?php include_once("../common/footer.php"); ?>