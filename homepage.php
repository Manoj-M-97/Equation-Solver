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
    $x[$rk]=(($xMatrix[0][0]*$xMatrix[1][1]) - ($xMatrix[0][1]*$xMatrix[1][0]))/$M;
  }

  return $x;
}

?>