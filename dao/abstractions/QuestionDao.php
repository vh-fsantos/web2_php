<?php 

interface QuestionDao {
    public function create($quiz);
    public function remove($quiz);
    public function removeById($id);
    public function update($quiz);
    public function findById($id);
    public function findAll($offset, $limit, $search);
    public function countAll($search);
    public function findAllByQuizId($quiz_id);
    
}

?>