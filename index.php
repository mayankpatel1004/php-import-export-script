<?php
require_once("connection.php");
ini_set("memory_limit","512M");
ob_start();
$select = "SELECT * FROM test";
$res = mysql_query($select);
$num=mysql_num_rows($res);
if($num > 0){
	echo 'Page ID,Title,Description';
	echo "\r\n";
	$i=1;
	while($row=mysql_fetch_array($res)){
		echo $row['id'].','.addslashes($row['title']).','.mysql_real_escape_string($row['description']);
		echo "\r\n";
		$i++;
	}
}else{
	echo 'No Data Found';
}
$strFilanme = date("Y-m-d-h-i-s")."_Test.csv";
header( 'Content-Type: text/csv' ); 
header( 'Content-Disposition: attachment;filename='.$strFilanme);

/*$desc = mysql_real_escape_string('<p><span style="font-size: medium;"><strong>About Test</strong></span></p>
<p><span style="font-size: small;"><strong><br /></strong></span></p>
<h2>All Time</h2>
<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
<div class="clear">&nbsp;</div>
<p>&nbsp;</p>
<h2>Two</h2>
<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>
<div class="clear">&nbsp;</div>
<p>&nbsp;</p>
<h2>Test 3</h2>
<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>
<div class="clear">&nbsp;</div>
<p>&nbsp;</p>');
$sqlUpdate = "UPDATE test set description = '$desc'";
mysql_query($sqlUpdate);*/
?>