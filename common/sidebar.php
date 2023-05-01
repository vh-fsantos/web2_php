<?php 

$admin = FALSE;
$developer = FALSE;

if (isset($_SESSION["isAdmin"]))
    $admin = $_SESSION["isAdmin"];

if (isset($_SESSION["userType"]))
    $developer = $_SESSION["userType"] === "developer";
?>

<div class="col-md-2 bg-light">
    <nav class="navbar navbar-expand-md navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                <?php 
                if ($admin){
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="/developers">Elaboradores</a>';
                    echo '</li>';
                }
                ?>
                <?php
                if ($developer){
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="/quizzes/list.php">Questionários</a>';
                    echo '</li>';
                }?>
                <?php
                if ($developer){
                    echo '<li class="nav-item">';
                    echo '<a class="nav-link" href="/questions/list.php">Questões</a>';
                    echo '</li>';
                }?>
            </ul>
        </div>
    </nav>
</div>
