<?php 
$page_title = "Login";

include_once("../common/facade.php");
include_once("../common/header.php");

if (isset($_SESSION["username"]))
{
    echo $_SESSION["userId"] . "<br>";
    echo $_SESSION["username"] . "<br>";
    echo $_SESSION["userType"] . "<br>";
    echo $_SESSION["isAdmin"] . "<br>";
}

?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Developer Login</h2>
                </div>
                <div class="card-body">
                    <form action="/login/developer-login.php" method="post">
                        <div class="form-group">
                            <label for="login">Login:</label>
                            <input type="text" name="login" id="login" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Respondent Login</h2>
                </div>
                <div class="card-body">
                    <form action="/login/respondent-login.php" method="post">
                        <div class="form-group">
                            <label for="login">Login:</label>
                            <input type="text" name="login" id="login" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once("../common/footer.php"); ?>