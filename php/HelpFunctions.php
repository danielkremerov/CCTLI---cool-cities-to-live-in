<?php
/*this file contains "help functions" for the Temperature and Cost Filter.
 as those two filters contain ranges - each selector in the dropdown is given an arbitary value
based on these values the help functions "decode" the min. and max. that are than returned and
later used in the respective sql queries */

function determineMinTemp($range){
  if($range == 1){
  return $minTemp = 0; }
  elseif ($range == 2) {
    return $minTemp = 10;
  }
  elseif ($range == 3) {
    return $minTemp = 20;
  }
  elseif ($range == 4) {
    return $minTemp = 30;
  }
}

function determineMaxTemp($range){
  if($range == 1) {
  return $maxTemp = 10; }
  elseif ($range == 2) {
    return $minTemp = 20;
  }
  elseif ($range == 3) {
    return $minTemp = 30;
  }
  elseif ($range == 4) {
    return $minTemp = 40;
  }
}

function determineMinCost($range){
  if($range == 1){
  return $minCost = 0; }
  elseif ($range == 2) {
    return $minCost = 1000;
  }
  elseif ($range == 3) {
    return $minCost = 2000;
  }
  elseif ($range == 4) {
    return $minCost = 3000;
  }
}

function determineMaxCost($range){
  if($range == 1) {
  return $maxCost = 1000; }
  elseif ($range == 2) {
    return $maxCost = 2000;
  }
  elseif ($range == 3) {
    return $maxCost = 3000;
  }
  elseif ($range == 4) {
    return $maxCost = 4000;
  }
}



 ?>
