<?php
include_once("jsondbcfg.php");
header('Content-Type: application/json');
//$typ=$_GET['t']; //select
$typ='select';
$qry=$_GET['q']; // * from table1
$query= stripslashes($typ." ".$qry); //"SELECT * from table1";
//Establish connection
$con = mysql_connect($mySQLserver,$mySQLuser,$mySQLpass);
// Check connection
if (mysqli_connect_errno())
{
	$errorR['name']="Failed to connect to mysql ".mysqli_connect_error();
	//echo json_encode(errorR);
	die(json_encode(errorR));
}
//Select Database
mysql_select_db($mySQLdb, $con);
//Perform query
$rs= mysql_query($query);
//Fetching and Iterating Datas
$arr[]= array();
while($obj = mysql_fetch_assoc($rs)) // or mysql_fetch_object();
{
	$arr[] = $obj;
}
//Close connection
mysql_close($con);
//JSON Encode
echo '{"data": '.json_encode($arr).'}'; //for returning as an json object of json array. array name "data"
//echo json_encode($arr); //for returning as an json array of json objects
?>