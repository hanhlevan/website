<?php

function search_indices($content, $pattern){
    $lastPos = 0;
    $positions = array();

    while (($lastPos = strpos($content, $pattern, $lastPos))!== false) {
        $positions[] = $lastPos;
        $lastPos = $lastPos + strlen($pattern);
    }

    // Displays 3 and 10
    return $positions;
}