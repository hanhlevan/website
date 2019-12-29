<?php

class Prepost extends CI_Model {

    public function get_post_with_id($id)
    {
        $instance = $this->mongodb->connection();
        $prepostCol = $instance["prepost"];
        $item = $prepostCol->findOne(array(
            '_id' => new MongoDB\BSON\ObjectID($id))
        );
        return $item;
    }
}

