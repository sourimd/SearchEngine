<?php

$data = file_get_contents("ohsumed87.txt");

$newdata = str_replace("&", "", $data);
$newdata = "<data>".$newdata."</data>";

file_put_contents("data.xml", $newdata);

$docid = $_GET['docid'];
$docid = (int)$docid;

$docxml=simplexml_load_file("data.xml");
echo "<html><body>";
foreach ($docxml->I as $I){
	
	$uid = (int)$I->U;
	//echo $uid."<br/>";
	 if($uid==$docid){
	 	//echo "here";
		echo "<h4>TITLE:</h4>&nbsp".$I->T."<br/><br/>";
		echo "<h4>AUTHOR:</h4>&nbsp".$I->A."<br/><br/>";
		echo "<h4>SOURCE:</h4>&nbsp".$I->S."<br/><br/>";
		echo "<h4>KEY WORDS:</h4>&nbsp".$I->M."<br/><br/>";
		echo "<h4>ABSTRACT:</h4>&nbsp".$I->W."<br/><br/>";
		break;
	 }
	
}
echo "<button onclick='window.history.back()'>GO BACK</button>";
echo "</body></html>";





?>
