<?php

class User extends CI_Model {

    private $db;

    public function __construct(){
        parent::__construct();
        $instance = $this->mongodb->connection();
        $this->db = $instance["user"];
    }

    public function getUserById($id)
    {
        $item = $this->db->findOne(array(
            '_id' => new MongoDB\BSON\ObjectID($id))
        );
        return $item;
    }

    public function getHistory($username){
        $item = $this->db->findOne(array(
            "username" => $username
        ));
        return $item["histories"];
    }

    public function writeHistories($username, $histories){
        $this->db->updateOne(array( "username" => $username ), array(
            '$set' => [
                "histories" => $histories
            ] 
        ));
    }

    public function getUser($username, $password){
        if ($this->checkLogin($username, $password)){
            $item = $this->db->findOne(array(
                "username" => $username, 
                "password" => $password
            ));
            return $item;
        }
        return NULL;
    }

    public function pushUser($username, $password){
        if ($this->checkRegister($username, $password)){
            try {
                $this->db->insertOne(array(
                    "username" => $username, 
                    "password" => $password,
                    "histories" => ""
                ));
                return TRUE;
            } catch (Exception $e) {
                print_r("Has a trouble when inserting!", $e);
                return FALSE;
            }
        }
        return FALSE;
    }

    private function checkUsernameExist($username){
        $cnt = $this->db->count(array(
            "username" => $username
        ));
        return $cnt > 0;
    }

    private function checkUser($username, $password){
        if (! preg_match('/[a-z]+[0-9]*/', $username) ){
            return FALSE;
        }
        if ($this->checkUsernameExist($username)){
            return FALSE;
        }
        return TRUE;
    }

    private function checkRegister($username, $password){
        return $this->checkUser($username, $password);
    }

    private function checkLogin($username, $password){
        return TRUE;
    }
}

