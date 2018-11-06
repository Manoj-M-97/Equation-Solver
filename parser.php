<?php
extract($_GET);

function parse($inp)
{
	//echo sizeof($inp);

	$arr=array();
	$eq1=array(0,0,0);

	$count=0;
	$count1=0;


	$negative=false;
	$coeff=0;
	$num=false;

	for ($i = 0; $i < sizeof($inp); $i++) 
	{
		//echo "--".$inp[$i]."--/";

		if($inp[$i]=='-')
		{
			$negative=true;
		}
		else if($inp[$i]=='+')
		{
			$negative=false;
		}
		else if(is_numeric($inp[$i]) && $num==false)
		{
			$arr=array();
			$count=0;
			$arr[$count++]=$inp[$i];
			//array_push($arr,$inp[$i]);
			$num=true;
		}
		else if(is_numeric($inp[$i]) && $num==true)
		{
			$arr[$count++]=$inp[$i];
			//array_push($arr,$inp[$i]);

		}
    	else if($inp[$i]=='x')
    	{

    		
    		if($i==0 || $num==false)
    		{
    			//$arr[0]=1;
    			
    			if($negative)
    			{
    				$coeff=-1;
    				//array_push($eq1,$coeff);
    				$eq1[0]=$coeff;
    				$negative=false;
    			}
    			else
    			{
    				$coeff=1;
    				$eq1[0]=$coeff;
    				//array_push($eq1,1);
    				//echo "inside:".$coeff;
    				//echo "inside";
    			}
    		}
    		else if($num)
    		{
    			$coeff=convertToNum($arr,$count);
    			$num=false;
    			$count=0;
    			if($negative)
    			{
    				$coeff=(-1)*$coeff;
    				$negative=false;
    			}
    			$eq1[0]=$coeff;
    			//array_push($eq1,$coeff);
    		}
    	}
    	else if($inp[$i]=='y')
    	{
    		if($i==0 || $num==false)
    		{
    			//$arr[0]=1;
    			if($negative)
    			{
    				$coeff=-1;
    				$eq1[1]=$coeff;
    				//array_push($eq1,$coeff);
    				$negative=false;
    			}
    			else
    			{
    				$coeff=1;
    				$eq1[1]=$coeff;
    				//array_push($eq1,$coeff);
    			}
    			
    		}
    		else if($num)
    		{
    			$coeff=convertToNum($arr,$count);
    			$num=false;
    			$count=0;
    			if($negative)
    			{
    				$coeff=(-1)*$coeff;
    				$negative=false;
    			}
    			$eq1[1]=$coeff;
    			//array_push($eq1,$coeff);
    		}
    	}
    	elseif($inp[$i]=='=')
    	{
    		$arr=array();
    		$count=0;
    		$num=false;
    	}
	}
	
	$coeff=convertToNum($arr,$count);
	if($negative)
	{
		$coeff=(-1)*$coeff;
		$negative=false;
	}
	$eq1[2]=$coeff;
	//array_push($eq1,$coeff);
	//print_r($eq1);
	return($eq1);
}

function convertToNum($arr,$count)
{
	$exp=0;
	$num=0;
	//echo sizeof($arr);
	//echo $count;
	$count=sizeof($arr);
	for($i=$count-1;$i>=0;$i--)
	{
		$mul=pow(10,$exp);
		$exp++;
		$num=$num+$mul*$arr[$i];
	}
	//echo $num;
	return($num);
}

$x1=parse(str_split($ip1));
$x2=parse(str_split($ip2));
$out=array_merge($x1,$x2);
echo json_encode($out);
?>