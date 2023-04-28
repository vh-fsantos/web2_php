<?php 

interface QuizDao {
    public function insert($quiz);
    public function remove($quiz);
    public function removeById($id);
    public function update($quiz);
    public function findById($id);
    public function findAll();
}

?>