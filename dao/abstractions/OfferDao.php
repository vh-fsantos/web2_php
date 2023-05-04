<?php 

interface OfferDao 
{
    public function create($offer);
    public function remove($offer);
    public function removeById($id);
    public function update($offer);
    public function findById($id);
    public function findAll();
    public function findAllWithSubmissionInfo();
}

?>