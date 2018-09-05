<?php
if (!empty($_FILES['importfile']['name']))
	{
		$errFlg=0;
		$errMsg='';
		$valid_document_formats = array("csv");  // Only JPG,PNG and DOC Document formate allowed in this script
		$valid_document_size=524288; // 512 KB

		$documentName = $_FILES['importfile']['name'];    // Actual Document Name
		$documentSize = $_FILES['importfile']['size'];    // Actual Document Size

		list($txt, $ext) = explode(".", $documentName);       // Get Actual Document Formate
		if (in_array($ext, $valid_document_formats)) {    // Check Document Formate
			if ($documentSize < $valid_document_size) {      // Check Document Size
				$new_doc_name = time() . "." . $ext;    // Document New Name
				$tmpDoc = $_FILES['importfile']['tmp_name'];
			}else{
				$errMsg= "Document size max 512 KB";       // Error Message for max size
				$errFlg=1;
			}
		}else{
			$errMsg= "Invalid Document format";           // Error Message for Invalid format size4
			$errFlg=1;
		}
	}
	else
	{
		$errMsg= "Please select an Document";
		$errFlg=1;
	}
	/*CSV FILE Validation End*/
	
	
	/*CSV FILE Import Start*/
	if(!$errFlg)
	{
		$uploadedDocPath= "import";        // folder name  for document upload
		if(move_uploaded_file($tmpDoc, $uploadedDocPath.$new_doc_name)){
			if(($handle = fopen($uploadedDocPath.$new_doc_name , "r")) !== FALSE) 
			{
				$fileAdded=true;
				$intI = 0;
				while (($data = fgetcsv($handle, 1000000000, ",")) !== FALSE) 
				{
					if($intI == 0)
					{
						
					}
					else
					{
							$sqlInsert = "INSERT INTO test SET title = '".addslashes($data[0])."',description = '".addslashes($data[1])."'";
							mysql_query($sqlInsert);
					}
					$intI++;
				}
				fclose($handle);
			}
		}
		else
		{
			$errMsg= "Please Try after some time";
			$errFlg=1;
		}
	}
	/*CSV FILE Import End*/
?>
<form name="frm" id="frm" method="post" action="" enctype="multipart/form-data">
<input type="file" name="importfile" id="importfile" />
<input type="submit" name="submitimport" id="submitimport" value="Import" />
</form>