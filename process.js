function upload()
{
	var xhr = new XMLHttpRequest();
	xhr.onreadystatechange=function()
	{
		if(xhr.readyState==4 && xhr.status==200)
		{
			path=xhr.responseText;
			convert(path);
		}
	};
	xhr.open("POST", "upload.php",true);
	var formData = new FormData(); 
	fl=document.getElementById('file');
	fileName = fl.value.replace(/.*[\/\\]/, '');
	formData.append("file",fl.files[0],fileName);
	xhr.send(formData);
}

function check(e)
{
	e.preventDefault();
}

function convert(path)
{
	//alert(path);
	var testImage = new Image();
	testImage.src = path;
	var stringResult="";
	testImage.onload = function ()
	{
        stringResult = OCRAD(testImage);
        output=stringResult.split("\n");
        
        //alert(output);


		send(output[0],output[1]);
		

    	/*for(i=0;i<stringResult.length;i++)
    	{
    		if(!checkType(stringResult[i]))
    		{
    			alert("there it is");
    		}
    	}*/
	};
	//path='uploads/img2.png';
	/*image.src=path;
	//image.display="none";
	var output=OCRAD(image);
	alert(output);
	console.log(output);*/
}