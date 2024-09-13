<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Reservation Page</title>
</head>

<body>
<?PHP
$name=$_POST['name'];
$email=$_POST['email'];
$person=$_POST['person'];
$date=$_POST['input_date'];
$time=$_POST['input_time'];
$phone=$_POST['phone'];

$hn="Localhost";
$un="root";
$up="";
$dn="rmsd";

$con = mysqli_connect($hn,$un,$up,$dn);
if(! $con){
	die("database not coneccted.............").mysqli_error();
	}
$query = "insert into reservation values('$name','$email','$person','$date','$time','$phone')";
mysqli_select_db($con,$dn);
$insert = mysqli_query($con,$query);
if(! $insert){
	die("not connect............").mysqli_error();	
	}
	echo "insert succesfully";
	header ("refresh:0.5;url=reservation.html");
mysqli_close($con);
error_reporting(0);
?>


</body>
</html>