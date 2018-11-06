function send(ip1,ip2)
{
	//ip1=document.getElementById("ip1");
	//ip2=document.getElementById("ip2");
	try
	{
		xhr=new XMLHttpRequest();
		xhr.open("GET","parser.php?ip1="+ip1 +"& ip2="+ip2,true);
		coeff1=[];
		coeff2=[];
		var eq=[]
		xhr.onreadystatechange=function ()
		{
			if(xhr.readyState==4 && xhr.status==200)
			{
				output=JSON.parse(xhr.responseText);
				coeff2=output;
				coeff1=coeff2.splice(0, 3);
				eq=coeff1.concat(coeff2);

				document.getElementById("ax1").value=eq[0];
				document.getElementById("ax2").value=eq[1];
				document.getElementById("ax3").value=eq[2];
				document.getElementById("bx1").value=eq[3];
				document.getElementById("bx2").value=eq[4];
				document.getElementById("bx3").value=eq[5];
				obj.solver();
			}
		};

		xhr.send();


	}
	catch(err)
	{

	}
	finally
	{
		
			return(eq);
		
	}
}