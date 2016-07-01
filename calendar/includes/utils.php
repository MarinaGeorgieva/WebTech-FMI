<?php

function redirect_to($location = NULL) {
  if ($location != NULL) {
    header("Location: {$location}");
    exit;
  }
}

function is_null_or_empty($str){
    return (!isset($str) || trim($str) === '');
}

?>