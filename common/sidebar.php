<?php 

$admin = FALSE;
$developer = FALSE;
$respondent = FALSE;

if (isset($_SESSION["isAdmin"]))
    $admin = $_SESSION["isAdmin"];

if (isset($_SESSION["userType"]))
    $developer = $_SESSION["userType"] === "developer";

if (isset($_SESSION["userType"]))
    $respondent = $_SESSION["userType"] === "respondent";
?>

<script>
    $(document).ready(function() {
    $('.navbar-toggler').click(function() {
    var navbar = $('.navbar-collapse');
    if (navbar.hasClass('show')) {
      navbar.removeClass('show');
    } else {
      navbar.addClass('show');
    }
  });
});
</script>

<div class="col-md-2 bg-light">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav flex-column">
                <?php 
                if ($admin){
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="/developers/list.php">Elaboradores</a>';
                    echo '</li>';
                }
                ?>
                <?php
                if ($developer){
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="/respondents/list.php">Respondentes</a>';
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="/quizzes/list.php">Questionários</a>';
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="/questions/list.php">Questões</a>';
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="/offers/list.php">Ofertas</a>';
                    echo '</li>';
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="/dashboard/list.php">Dashboard</a>';
                    echo '</li>';
                }?>
                <?php
                if ($respondent){
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="/offers/list_respondents.php">Ofertas</a>';
                    echo '</li>';
                }
                ?>

            </ul>
        </div>
    </nav>
</div>
