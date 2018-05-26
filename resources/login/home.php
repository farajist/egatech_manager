<?php  
	session_start();
	if (!isset($_SESSION['login_user'])){
		echo "<script> alert('Please login in first !'); </script>";
		echo "<script> location.href='login.php'</script>";
	}

?>
<html>
<head>
	<title>Home page</title>
</head>
<body>
	<h1>This is home page</h1><br>
	<h2>Welcome 
<?php  
	// session_start();
	$logged = $_SESSION['login_user'];
	echo $logged; 
?></h2><br>
	<a href="logout.php"> Logout now !</a>
</body>
</html>