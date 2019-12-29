<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php'; // include Composer's autoloader

class Mongodb {
    protected $CI;

    // We'll use a constructor, as you can't directly call a function
    // from a property definition.
    public function __construct($param=[])
    {
        // Assign the CodeIgniter super-object
        $this->CI = &get_instance();
        
        // if the values from param exist, then assign them to variables for later usage
        $this->p_host = isset($param['host']) ? $param['host'] : \NULL;
        $this->p_port = isset($param['port']) ? $param['port'] : \NULL;
        $this->p_db = isset($param['db']) ? $param['db'] : \NULL;
        $this->p_collection = isset($param['collection']) ? $param['collection'] : \NULL;
        
        //test the values from param by using the echo statement below, if needed
        //echo "$p_host,$p_port, $p_db, $p_collection <br>" ;

    }
    public function connection() {
        $this->CI->config->load('config_mongo');
        $host = $this->CI->config->item('host','mongodb','config_mongo');
        $port = $this->CI->config->item('port','mongodb','config_mongo');
        $db = $this->CI->config->item('db','mongodb','config_mongo');
        $post = $this->CI->config->item('postCol','mongodb','config_mongo');
        $prepostCol = $this->CI->config->item('prepostCol','mongodb','config_mongo');
        $userCol = $this->CI->config->item('userCol','mongodb','config_mongo');
        $mongo['connection'] = new MongoDB\Client("mongodb://$host:$port/$db");
        $mongo['post'] = $mongo['connection']->$db->$post; 
        $mongo['prepost'] = $mongo['connection']->$db->$prepostCol; 
        $mongo['user'] = $mongo['connection']->$db->$userCol; 
        return $mongo ;
    }

}