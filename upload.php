
<?php
	//echo $_FILES['file'];
	//echo implode(" ",$_FILES['file']);
	if(!empty($_FILES['file']))
	{
		$file=$_FILES['file'];
		$fileName=$_FILES['file']['name'];
		$fileTmpName=$_FILES['file']['tmp_name'];
		$fileSize=$_FILES['file']['size'];
		$fileError=$_FILES['file']['error'];
		$fileType=$_FILES['file']['type'];
		
		$fileExt=explode('.',$fileName);
		$fileActualExt=strtolower(end($fileExt));
		//echo $fileName;
		$allowed=array('jpg','png','jpeg');
		if(in_array($fileActualExt,$allowed))
		{
			if($fileError==0)
			{
				$fileNameNew=uniqid('',true).".".$fileActualExt;
				$fileDestination='uploads/'.$fileNameNew;
				move_uploaded_file($fileTmpName, $fileDestination);
				//header('Location: homepage.php?uploadsuccess');
				$path= 'uploads/'.$fileNameNew;

				echo $path;
				//convert($path);
				/*$path= 'uploads/'.$fileNameNew;
				//$ocr->image($path);
				echo (new TesseractOCR($path))
    			->executable('C:\ProgramData\chocolatey\bin/tesseract')
    			->run();*/
			}
			else
			{
				echo "There was an error uploading the file";
			}
		}
		else
		{
			echo "You cannot upload files of this type";
		}
	}
?>