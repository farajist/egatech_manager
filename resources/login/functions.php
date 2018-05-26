<?php
	
	function do_login()
	{
		global $connection;
	
		$guser = $gpasswd = '';

		if(isset($_POST['logi']))
		{
			require_once('../utils.php');
			session_start();
			if(isset($_POST['username'])) 
				$guser =  sanitizeMySQL($connection, $_POST['username']);
			if(isset($_POST['passwd'])) 
				$gpasswd =  sanitizeMySQL($connection, $_POST['passwd']);

			$query = "SELECT username FROM User WHERE username='$guser' AND password='".sha1($gpasswd)."';";
			// echo "Query is : ".$query;
			$result = execute_query($query);
			if ($result->num_rows > 0)
			{
				$_SESSION['login_user'] = $guser;
			} 
			else 
			{
				echo "<script> alert('Username or password invalid !'); </script>";
				if (session_destroy())
				{	
					echo "<script>alert('Session destroyed !')</script>";	
				}
			}
			echo "<script> location.href='../../public_html/index.php'</script>";
		}
	}

	function is_logged_in()
	{
		//session_start();
		return isset($_SESSION['login_user']);
	}

?>