<?php
$connect = mysqli_connect("localhost","root","","lms");
if( $connect )
{
	// echo "database is connected";
}
else
{
	die("database failed".mysqli_error($connect));
}
?>