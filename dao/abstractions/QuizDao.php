<?php 

interface QuizDao {
    public function create($quiz);
    public function remove($quiz);
    public function removeById($id);
    public function update($quiz);
    public function findById($id);
    public function findAll();
}

?>