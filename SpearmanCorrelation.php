<?php
/** 
 * SpearmanCorrelation
 * Discovers linear and non-linear monotonic trends between your database variables applying Spearman Rank Correlation.
 * 
 * @author ALEJANDRO MITROU
 * @email alejandro@WiseTonic.com
 * @copyright (c) 2013
 * @license : GNU General Public License (GPL) 
 * @access public 
 */ 

class SpearmanCorrelation{
  private $result = NULL; #Last produced result
  
  public function __construct(){    
  }

  public function test($data1, $data2){
     if (count($data1) != count($data2)){ return null; }
    $relation1 = $this->getTrivialRelation(count($data1));
    $relation2 = $relation1;
    array_multisort($data1, $relation1); #keeping index associations
    array_multisort($data2, $relation2);    

    $ranking1 = $this->getRanking($data1);
    $ranking2 = $this->getRanking($data2);
    
    array_multisort($relation1, $ranking1); #Back to prevous orders/relationships
    array_multisort($relation2, $ranking2);

    if (!isset($ranking1) || !isset($ranking2)){ return null; }
    $distances2 = $this->getDistances2($ranking1, $ranking2);
    $this->result = $this->getCoefficient($distances2);
    return $this->result;
  }
  
  public function testMatrix(&$matrix){
    $result  = array();
    $columns = count($matrix);
    for ($outer=0; $outer<$columns; $outer++){
      for ($inner=0; $inner<$columns; $inner++){
        if (isset($result[$inner][$outer])){
          $result[$outer][$inner] = $result[$inner][$outer];
          continue;
        }
        if ($inner == $outer){
          $result[$outer][$inner] = 1;
          continue;
        }        
        $result[$outer][$inner] = $this->test($matrix[$outer], $matrix[$inner]);
        if ($result[$outer][$inner] == NULL) return NULL;
      }
    }
    $this->result = $result;
    return $result;
  }
  
  public function drawResults($minAbsCoefficient = 0, $mirrorless = FALSE){
    $sp0 = 5;
    $sp1 = 8;
    if (is_numeric($this->result)){ print $this->result ."\n\n"; return; }
    $columns = count($this->result);
    if(php_sapi_name() != "cli") print "<pre>\n";
    print str_pad('', $sp0);
    for ($outer=0; $outer<$columns; $outer++) print str_pad($outer, $sp1+1);
    print "\n";
    print str_pad('', $columns*($sp1+1)+$sp0, '-') . "\n";
    
    for ($outer=0; $outer<$columns; $outer++){
      print str_pad($outer, 2) .' | ';
      for ($inner=0; $inner<$columns; $inner++){
        if (abs($this->result[$outer][$inner]) >= $minAbsCoefficient  && (($mirrorless && $outer < $inner) || !$mirrorless)){
          if ($this->result[$outer][$inner]<0) $signSpace = '-'; else $signSpace = ' ';
          print $signSpace . str_pad(round(abs($this->result[$outer][$inner]), 4), $sp1);
        } else print str_pad('', $sp1+1);
      }
      print "\n";
    }
    print "\n";
  }
  
  private function getRelation($data1, $data2){
    $relation = $vkeys1 = $vkeys2 = array();
    
    foreach($data1 as $key => $value) $vkeys1[] = $key;
    foreach($data2 as $key => $value) $vkeys2[] = $key;
    for ($i=0; $i<count($data1); $i++){ $relation[$vkeys1[$i]] = $vkeys2[$i]; }
    return $relation;
  }
  
  private function getTrivialRelation($size){
    $relation = array();
    for ($i=0; $i<$size; $i++){ $relation[] = $i; }
    return $relation;
  }
  
  private function getRanking(&$data){
    $ranking    = array();
    $prevValue  = '';
    $eqCount    = 0;
    $eqSum      = 0;
    $rankingPos = 1;
    foreach($data as $key=>$value){
      if ($value == '') return null;

      if ($value != $prevValue){
        if ($eqCount > 0){
          #Go back to set mean as ranking
          for ($j=0; $j<=$eqCount; $j++) $ranking[$rankingPos - 2 - $j] = $eqSum / ($eqCount+1);
        }
        $eqCount = 0;
        $eqSum   = $rankingPos;
      } else{ $eqCount++; $eqSum += $rankingPos; }

      #Keeping $data after sorting order
      $ranking[] = $rankingPos;
      $prevValue = $value;
      $rankingPos++;
    }
    #Go back to set mean as ranking in case last value has repetitions
    for ($j=0; $j<=$eqCount; $j++) $ranking[$rankingPos - 2 - $j] = $eqSum / ($eqCount+1);
    return $ranking;
  }

  private function getDistances2(&$ranking1, &$ranking2){
    $distances2 = array();
    for ($key=0; $key<count($ranking1); $key++){
      $distances2[] = pow($ranking1[$key] - $ranking2[$key], 2);
    }
    return $distances2;
  }
  
  private function getCoefficient(&$distances2){
    $size = count($distances2);
    $sum  = 0;
    for ($i=0; $i<$size; $i++) $sum += $distances2[$i];
    return 1 - ( 6 * $sum / (pow($size, 3) - $size) );
  }
}

?>
