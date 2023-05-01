<?php 

interface DeveloperDao 
{
    public function insert($developer);
    public function remove($developer);
    public function removeById($id);
    public function update($developer);
    public function findById($id);
    public function findByLogin($login);
    public function findAll();
}

?>