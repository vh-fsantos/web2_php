<?php 

interface RespondentDao 
{
    public function create($respondent);
    public function remove($respondent);
    public function removeById($id);
    public function update($respondent);
    public function findById($id);
    public function findByLogin($login);
    public function findAll();
    
}

?>