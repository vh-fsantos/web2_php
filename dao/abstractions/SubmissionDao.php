<?php 

interface SubmissionDao 
{
    public function create($submission);
    public function remove($submission);
    public function removeById($id);
    public function findAll();
    public function findById($id);
}

?>