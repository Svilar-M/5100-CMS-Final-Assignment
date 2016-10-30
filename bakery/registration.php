<?php
 	include "include/header.php";
    include "include/menu.php";
	include "include/database.php";
	$register = false;
	if(isset($_POST['submit'])) {
		
		include_once("class/user.php");
		$data = $_POST;
		$user = new User();
		if($user->add($data) == true) {
			$register = true;
		}
		
	}
?>
<div id="registracija_forma">
	<?php if($register == false): ?>
	<form name="htmlform" method="post" action="">
		<table width="450px">
			<tr>
				<td valign="top"><label for="ime">Ime</label></td>
				<td valign="top"><input  type="text" name="name" maxlength="50" size="30"></td>
			</tr>
			<tr>
				<td valign="top"><label for="prezime">Prezime </label></td>
				<td valign="top"><input type="text" name="surname" maxlength="50" size="30"></td>
			</tr>
			<tr>
				<td valign="top"><label for="email">Email </label></td>
				<td valign="top"><input type="text" name="email" maxlength="80" size="30"></td>
			</tr>
			<tr>
				<td valign="top"><label for="lozinka">Lozinka </label></td>
				<td valign="top"><input type="text" name="password" maxlength="30" size="30"></td>
			</tr>
		</table>
		<br>
		<tr>
			<td colspan="2" style="text-align:center"><input type="submit" name="submit" value="Registrujte se"> </td>
		</tr>
	</form>
	<?php else: ?>
		<p>Uspesna registracija. <a href="login.php">Uloguj se ovde!</a></p>
	<?php endif; ?>
</div>
<?php include "include/footer.php"; ?>
