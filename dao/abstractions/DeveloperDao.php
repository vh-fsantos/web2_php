<?php 

interface DeveloperDao {
    public function insere($developer);
    public function remove($developer);
    public function removePorId($id);
    public function altera(&$developer);
    public function buscaPorId($id);
    public function buscaPorLogin($login);
    public function buscaTodos();
}

?>