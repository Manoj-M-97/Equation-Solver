obj={
	xhr: new XMLHttpRequest(),
	
	solver: function()
	{
		obj.xhr.onreadystatechange=obj.updateResponse;
		ax1=document.getElementById("ax1").value;
		ax2=document.getElementById("ax2").value;
		ax3=document.getElementById("ax3").value;
		bx1=document.getElementById("bx1").value;
		bx2=document.getElementById("bx2").value;
		bx3=document.getElementById("bx3").value;
		eq1 = ax1+"* x+"+ax2+"* y="+ax3;
		eq2 = bx1+"* x+"+bx2+"* y="+bx3;
		//alert(ax1+ '.'+ax2+'.'+bx1+'.'+bx2);
		obj.xhr.open("GET","http:homepage.php?ax1="+ax1+" & ax2="+ax2+" & ax3="+ax3+" & bx1="+bx1+" & bx2="+bx2+" & bx3="+bx3,true);
		obj.xhr.send();
		//draw(eq1);
	},

	updateResponse:function()
	{
		if(obj.xhr.readyState==4 && obj.xhr.status==200)
		{
			res=obj.xhr.responseText;
			res=JSON.parse(res);
			//alert(res);
			newdiv=document.getElementById("result");
			newdiv.innerHTML = "x1 = "+res[0]+"</br>"+"x2 = "+res[1];
			//document.body.appendChild(newdiv);
		}
	}

}