<?php
//error_reporting(E_ERROR | E_PARSE);

extract($_GET);

$matrix = array();
$matrix[0]=array();
$matrix[0][0]=intval($ax1);
$matrix[0][1]=intval($ax2);

$matrix[1]=array();
$matrix[1][0]=intval($bx1);
$matrix[1][1]=intval($bx2);

$res=array();
$res[0]=intval($ax3);
$res[1]=intval($bx3);

$out=equationSystem($matrix,$res);

echo json_encode($out);

/*function determinant($matrix=array()) { 
  /*
    $matrix must be 2-dimensional n x n array in following format
    $matrix=array(array(1,2,3),array(1,2,3),array(1,2,3))
  */
/*
  // dimension control - n x n
  foreach($matrix as $row){
    if(sizeof($matrix)!=sizeof($row)){
      return false;
    }
  }

  //count 1x1 and 2x2 manually - rest by recursive function
  $dimension=sizeof($matrix);
  if ($dimension == 1) { 
    return $matrix[0][0]; 
  }   
  if ($dimension == 2) { 
    return (($matrix[0][0]*$matrix[1][1]) - ($matrix[0][1]*$matrix[1][0])); 
  } 

  //cycles for submatrixes calculations
  $sum = 0;
  for ($i = 0; $i < $dimension; $i++) {
    // for each "$i", you will create a smaller matrix based on the original matrix 
    // by removing the first row and the "i"th column. 

    $smallMatrix=array(); 
    for ($j = 0; $j < $dimension-1; $j++) {
      $smallMatrix[$j]=array();
      for ($k = 0; $k < $dimension; $k++) {
        if ($k < $i) $smallMatrix[$j][$k] = $matrix[$j+1][$k]; 
        if ($k > $i) $smallMatrix[$j][$k - 1] = $matrix[$j+1][$k];
      } 
    }

    // after creating the smaller matrix, multiply the "i"th element in the first 
    // row by the determinant of the smaller matrix. 
    // Odd position is plus, even is minus - the index from 0 so it's oppositely

    if(($i%2)==0){
      $sum += ($matrix[0][$i])*(determinant($smallMatrix)); 
    } else {
      $sum -= ($matrix[0][$i])*(determinant($smallMatrix)); 
    }

  } 

  return $sum; 
}
*/
function equationSystem($leftMatrix=array(),$rightMatrix=array()){

  /*
    left side of equations - parameters:
    $leftMatrix must be 2-dimensional n x n array in following format
    $leftMatrix=array(array(1,2,3),array(1,2,3),array(1,2,3))

    right side of equations - results:
    $rightMatrix must be in format 
    $rightMatrix=array(1,2,3);
  */

  //matrixes and dimension check
  if(!is_array($leftMatrix) || !is_array($rightMatrix)){
    return false;
  }
  if(sizeof($leftMatrix)!=sizeof($rightMatrix)){
    return false;
  }

  //if($M=determinant($leftMatrix))
  $M=($leftMatrix[0][0]*$leftMatrix[1][1]) - ($leftMatrix[0][1]*$leftMatrix[1][0]);
  
  if($M){

  } else {
    return false;
  }


  $x=array();

  foreach($rightMatrix as $rk => $rv){
    $xMatrix=$leftMatrix;
    foreach($rightMatrix as $rMk => $rMv){
      $xMatrix[$rMk][$rk]=$rMv;
    }
    //$x[$rk]=determinant($xMatrix)/$M;
    $x[$rk]=(($xMatrix[0][0]*$xMatrix[1][1]) - ($xMatrix[0][1]*$xMatrix[1][0]))/$M;
  }

  return $x;
}

?>