<?php
	include "include/header.php";
	include "include/menu.php";
	include "include/database.php";
	
	if(isset($_POST['submit'])) {
		$email 		= $_POST['email'];
		$password	= $_POST['password'];
		
		$statement = $pdo->prepare("SELECT * FROM users WHERE user_email = :email AND user_password = :password AND user_status<>0");
		$statement->execute(array(
								':email' => $email,
								':password' => md5($password)
							));
		$row = $statement->fetch();
		if($row != null) {
			session_start();
			if($row['user_status'] == 1 || $row['user_status'] == 2) {
				$_SESSION['user_id'] 		= $row['user_id'];
				$_SESSION['user_name']		= $row['user_name'];
				$_SESSION['user_surname']	= $row['user_surname'];
				$_SESSION['user_email']		= $row['user_email'];
				$_SESSION['user_status']	= $row['user_status'];
				if($row['user_status'] == 1) {
					$_SESSION['is_admin']	= true;
				} else {
					$_SESSION['is_admin']	= false;
				}	
				
				header('Location: index.php');
			} else {
				echo "You are not approve yet";
			}
			
		}
	}
	
?>
<form name="htmlform" method="post">
	<table width="450px">
		<tr>
			<td valign="top"><label for="email">Email adresa</label></td>
			<td valign="top"><input  type="text" name="email" maxlength="50" size="30"></td>
		</tr>
		<tr>
			<td valign="top"><label for="lozinka">Lozinka </label></td>
			<td valign="top"><input  type="password" name="password" maxlength="50" size="30"></td>
		</tr>
	</table>
	<tr><br>
	<td style="text-align:center">
		<input type="submit" name="submit" id="login-dugme" value="Prijavi se" />
	</tr>
</form>
<br>
<div id="registrujse">
	<a href="registration.php">Registrujte se</a>
</div>
<?php include "include/footer.php"; ?>