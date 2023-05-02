<?php 

interface AnswerDao 
{
    public function create($answer);
    public function remove($answer);
    public function removeById($id);
    public function findAll();
}

?>