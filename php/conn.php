<?php

//Defining connection variables
//Host
//Username
//Password
//Database name

$_host = 'localhost:3306';
$_usr = 'root';
$_ps = '';
$_dbname = 'earlybird';

//Declaring connection variable

$_conn = mysqli_connect($_host, $_usr, $_ps, $_dbname);

//Handling connection error

$_connerr = mysqli_connect_errno();

if(mysqli_connect_errno())
{
	echo 'Error number: ' . $_connerr;
	die 
	('
		<script>
			alert("Connection refused!");
		</script>
	');
}

?>