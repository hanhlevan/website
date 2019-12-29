<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model(['post', 'prepost', "user"]);
		$this->load->helper('string');
	}

    public function index() {
		if ($query = $this->input->get("query")){
			$histories = ",";
			if ($this->session->userdata("logged")){
				$username = $this->session->userdata("username");
				$histories = $this->user->getHistory($username);
				$this->user->writeHistories($username, $histories.",$query");
			}
			$results = $this->search($query, $histories);
			$this->show($results);
		} else {
			$this->display->run('home', []);
		}
	}
	
	private function show($results){
		$posts = array();
		$listIDs = $results->listIDs;
		$dataQuery = $results->dataQuery;
		foreach ($listIDs as $id){
			$postItem = $this->post->get_post_with_id($id->rootId);
			$prepostItem = $this->prepost->get_post_with_id($id->_id);
			array_push($posts, [
				"id" => $id->rootId,
				"title" => str_replace("_", " ", $postItem["title"]),
				"update" => $postItem["update_time"],
				"content" => $this->get_content($prepostItem["content"], $dataQuery->extension)
			]);
		}
		$this->session->set_userdata("query", $results->raw_query);
		$this->session->set_userdata("search_time", $results->time);
		$this->session->set_userdata("count", count($posts));
		$this->display->run("search", [
			"query" => $results->raw_query,
			"posts" => $posts, 
			"search_time" => $results->time,
			"count" => count($posts)
		]);
	}

	private function search($query, $histories){
		$url = $this->config->item("search_api");
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, "query=$query&histories=$histories");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$server_output = curl_exec($ch);
		curl_close ($ch);
		$results = json_decode($server_output);
		return $results->data;
	}

	private function get_content($content, $terms, $maxSize=200){
		$words = explode(" ", $content); $countList = [0]; $count = 0;
		for ($i=0; $i<count($words); $i++){
			if (in_array($words[$i], $terms)){
				$words[$i] = sprintf("<span class=\"check\">%s</span>", $words[$i]);
				$count += 1;
			}
			array_push($countList, $count);
		}

		$nsize = count($words); $currentSize = 0;
		$checkList = [];
		for ($i=0; $i<$nsize; $i++){
			$right = min($i + 5, $nsize - 1); $left = max($i - 5, 0);
			$currentCheck = ($countList[$right + 1] - $countList[$left]);
			if ($currentCheck > 0){
				$currentSize += mb_strlen($words[$i]);
				array_push($checkList, TRUE);
			} else {
				array_push($checkList, FALSE);
			}
		}
		if ($currentSize < $maxSize) {
			for ($i=0; $i<$nsize; $i++){
				if ($currentSize >= $maxSize) break;
				if ($checkList[$i] === FALSE){
					$checkList[$i] = TRUE;
					$currentSize += mb_strlen($words[$i]);
				}
			}
		}
		$result = ""; $lastTrue = TRUE;
		for ($i=0; $i<$nsize; $i++){
			if ($checkList[$i] === TRUE){
				$currentString = ($lastTrue === FALSE ? "..... " : " ");
				$result .= $currentString. str_replace("_", " ", $words[$i]);
				$lastTrue = TRUE;
			} else {
				$lastTrue = FALSE;
			}
		}
		return $result;
	}

	public function read($id){
        $post = $this->post->get_post_with_id($id);
        $this->display->run("detail", [
            "title" => str_replace("_", " ", $post->title),
            "paragraphs" => $this->separate($post->content),
			"update" => $post->update_time,
			"query" => $this->session->userdata("query"),
			"search_time" => $this->session->userdata("search_time"),
			"count" => $this->session->userdata("count")
        ]);
	}

	private function separate($content, $perLine=4){
		$results = []; $currentLine = "";
		$paragraphs = explode(". ", $content);
		for ($i=0; $i<count($paragraphs); $i++){
			$paragraphs[$i] .= ". ";
			if (($i % $perLine == 0) || ($i == count($paragraphs) - 1)) {
				array_push($results, $currentLine);
				$currentLine = "";
			} else {
				$currentLine .= $paragraphs[$i];
			}
		}
		return $results;
	}

}
