<?php

class Post extends CI_Model {

    public function get_post_with_id($id)
    {
        $instance = $this->mongodb->connection();
        $postCol = $instance["post"];
        $item = $postCol->findOne(array(
            '_id' => new MongoDB\BSON\ObjectID($id))
        );
        return $item;
    }
}

