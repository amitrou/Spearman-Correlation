<?php
  include('SpearmanCorrelation.php');
  $data0 = array(1, 2, 6, 7, 7, 7, 7, 1, 6, 6, 6, 6, 6, 6, 6);
  $data1 = array(0.5, 1, 1.5, 2, 2.5, 3, 3.5, 4, 4.5, 5, 5.5, 6, 16.5, 18.8, 19.9);
  $data2 = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15);
  $data3 = array(3, 3, 3, 3, 3, 3, 8, 9, 10, 11, 12, 13, 14, 15, 16);
  $data4 = array(5, 4, 7, 3, 6, 8, 11, 12, 10, 9, 13, 100, 14, 15, 16);
  $matrix = array();
  array_push($matrix, $data0, $data1, $data2, $data3);

  $sp = new SpearmanCorrelation();
  #Correlation coefficient between two arrays
  $result = $sp->test($data4, $data3);
  $sp->drawResults();
  
  #Finding correlation within a matrix
  $result = $sp->testMatrix($matrix);
  
  #Displays resulting coefficient matrix
  $sp->drawResults();
  #As previous one, focusing on correlated variables
  $sp->drawResults(0.8, TRUE);
?>
