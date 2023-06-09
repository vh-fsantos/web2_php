<?php 
$page_title = "Elaboradores - Editar";

include_once("../common/facade.php");
include_once("../common/header.php");

$id = @$_GET["id"];

$dao = $factory->getDeveloperDao();
$developer = $dao->findById($id);

?>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <h2 class="mb-4">Editar Elaborador</h2>
          <form action="/developers/update.php" method="post">
            <input type='hidden' name='id' value='<?php echo $developer->getId();?>'/>
            <div class="form-group">
              <label for="login">Login</label>
              <input type="text" class="form-control" id="login" name="login" required value="<?php echo $developer->getLogin();?>">
            </div>
            <div class="form-group">
              <label for="password">Senha</label>
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="form-group">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" required value="<?php echo $developer->getEmail();?>">
            </div>
            <div class="form-group">
              <label for="name">Nome</label>
              <input type="text" class="form-control" id="name" name="name" required value="<?php echo $developer->getName();?>">
            </div>
            <div class="form-group">
              <label for="institution">Instituição</label>
              <input type="text" class="form-control" id="institution" name="institution" required value="<?php echo $developer->getInstitution();?>">
            </div>
            <button type="submit" class="btn btn-primary">Editar</button>
          </form>
        </div>
      </div>
    </div>
<?php include_once("../common/footer.php"); ?>