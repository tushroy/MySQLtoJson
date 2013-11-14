<?php
include_once("jsondbcfg.php");
header('Content-Type: application/json');
//$typ=$_GET['t']; //select
$typ='select';
$qry=$_GET['q']; // * from table1
$query= stripslashes($typ." ".$qry); //"SELECT * from table1";
//Establish connection to DB
$con = mysqli_connect($mySQLserver,$mySQLuser,$mySQLpass,$mySQLdb);
// Check connection
if (mysqli_connect_errno())
{
	$msg['error']="Failed to connect to mysql ".mysqli_connect_error();
	die(json_encode($msg));
}
//Perform query
if(!$rs= mysqli_query($con,$query))
{
	mysqli_close($con);
	$msg['error']="Error in query. ".$query;
	die(json_encode($msg));
}
//Fetching and Iterating Datas on select statement
if($typ=="select")
{
	$arr[]= array();
	while($obj = mysqli_fetch_assoc($rs))
	{
	$arr[] = $obj;
	}
//JSON Encode
	echo '{"data":'.json_encode($arr).'}';
}
//Close connection
mysqli_close($con);
?>
