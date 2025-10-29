<?php

class Bug{


    private $id;
    private $projectId;
    private $ownerId;
    private $assignedToId;
    private $statusId;
    private $priorityId;
    private $summary;
    private $description;
    private $fixDescription;
    private $dateRaised;
    private $targetDate;
    private $dateClosed;


    public function __construct($db) {
        $this->db = $db;
    }

    public function createBug(){
        //create new bug and insert into table 
    }

    public function getBugByID(){
        //get bug by id from table
    }

    public function getBugByProject(){
        //get bugs for a specific project
    }

    public function deleteBug(){
        //delete a bug
    }
    
    public function updateBug(){
        //updateBug
    }



}








?>