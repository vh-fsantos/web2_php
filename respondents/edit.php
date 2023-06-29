<?php 
$page_title = "Elaboradores - Editar";

include_once("../common/facade.php");
include_once("../common/header.php");

$id = @$_GET["id"];

$dao = $factory->getRespondentDao();
$respondent = $dao->findById($id);

?>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <h2 class="mb-4">Editar Respondente</h2>
          <form action="/respondents/update.php" method="post">
          <input type='hidden' name='id' value='<?php echo $respondent->getId();?>'/>
            <div class="form-group">
              <label for="login">Login</label>
              <input type="text" class="form-control" id="login" name="login" required value="<?php echo $respondent->getLogin();?>">
            </div>
            <div class="form-group">
              <label for="password">Senha</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" required value="<?php echo $respondent->getEmail();?>">
            </div>
            <div class="form-group">
              <label for="name">Nome</label>
              <input type="text" class="form-control" id="name" name="name" required value="<?php echo $respondent->getName();?>">
            </div>
            <div class="form-group">
              <label for="phone">Telefone</label>
              <input type="text" class="form-control" id="phone" name="phone" required value="<?php echo $respondent->getPhone();?>">
            </div>
            <button type="submit" class="btn btn-primary">Editar</button>
          </form>
        </div>
      </div>
    </div>
<?php include_once("../common/footer.php"); ?>