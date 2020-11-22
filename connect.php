<?php
	error_reporting(0);
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 mysql_select_db('test',$con);
 mysql_query('SET NAMES utf8;');
?>