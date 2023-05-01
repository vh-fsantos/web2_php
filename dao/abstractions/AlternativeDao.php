<?php 

interface AlternativeDao 
{
    public function create($alternative);
    public function remove($alternative);
    public function removeById($id);
    public function update($alternative);
    public function findById($id);
    public function findAll();
}

?>