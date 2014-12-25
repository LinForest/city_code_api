<?php 
//本地库，内容从http://weather.raychou.com/中爬取城市对应的城市编码；
	$host="localhost";
	$dbuser="root";
	$dbpass="zhouailin";
	$dbname="citycode";
	$mysqli=new mysqli($host,$dbuser,$dbpass,$dbname);
	$mysqli->query("set names 'utf8'");

	$a = @$_GET['city'] ? $_GET['city'] : '';
	$rel=$mysqli->query("select * from code where city like '%$a%'");
	$row=$rel->fetch_assoc();
	//print_r($row);
	
	$doc = new DOMDocument('1.0', 'utf-8');  // 声明版本和编码 
	$doc->formatOutput = true; 
	
	$root = $doc->createElement('data');
	$root = $doc->appendChild($root);

	$title1 = $doc->createElement('city');
	$title1 = $root->appendChild($title1);

	$title2 = $doc->createElement('codeid');
	$title2 = $root->appendChild($title2);
	
	$text1 = $doc->createTextNode($row['city']);
	$text1 = $title1->appendChild($text1);

	$text2 = $doc->createTextNode($row['codeid']);
	$text2 = $title2->appendChild($text2);
	
	header('content-type: xml');
	echo $doc->saveXML();
?>