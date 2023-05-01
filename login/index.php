<?php 
$page_title = "Login";

include_once("../common/facade.php");
include_once("../common/header.php");

?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Developer Login</h2>
                </div>
                <div class="card-body">
                    <form action="developer-login.php" method="post">
                        <div class="form-group">
                            <label for="developerLogin">Login:</label>
                            <input type="text" name="developerLogin" id="developerLogin" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="developerPassword">Password:</label>
                            <input type="password" name="developerPassword" id="developerPassword" class="form-control" required>
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
                    <form action="respondent-login.php" method="post">
                        <div class="form-group">
                            <label for="respondentLogin">Login:</label>
                            <input type="text" name="respondentLogin" id="respondentLogin" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="respondentPassword">Password:</label>
                            <input type="password" name="respondentPassword" id="respondentPassword" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once("../common/footer.php"); ?>