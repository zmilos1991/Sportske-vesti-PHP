<html>
<head>
  <meta charset="UTF-8">
  <title>Sportske vesti</title>
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<div id="wrapper">
	<h1 class="naslov">Sportske Vesti</h1>
	<h2 class="naslov">Dobrodosli na sajt o sportskim vestima</h2>
	
	<div class="forma" id="login-forma">
		<h3>Ulogujte se</h3>
		<form method="post" action="">
		<label>Username: </label><br>
		<input type="text" name="tb_username" /><br>
		<label>Password: </label><br>
		<input type="text" name="tb_password" /><br><br>
		<input type="submit" name="btn_submit" value="Ulaz" />
		</form>
	</div>

	<div class="forma" id="login-forma">
		<h3>Registruj se</h3>
		<form method="post" action="">
		<label>Ime - vase ime ce biti vas Username : </label><br>
		<input type="text" name="ime" /><br>
		<label>Prezime: </label><br>
		<input type="text" name="prezime" /><br>
		<label>Password: </label><br>
		<input type="text" name="password" /><br><br>
		<input type="submit" name="registruj" value="Registruj se" />
		</form>
	</div>

	<?php
	require "config.php";
	
	if(isset($_POST['registruj'])){
		if(!empty($_POST['ime']) && !empty($_POST['prezime']) && !empty($_POST['password'])){
			$user = new User;
			$user->firstname = $_POST['ime'];
			$user->lastname = $_POST['prezime'];
			$user->password = $_POST['password'];
			$user->Insert();
		}else {
			echo "Polja ne smeju biti prazna!";
		}
	}
	
	if(isset($_POST['btn_submit'])){
		$username = $_POST['tb_username'];
		$username = str_replace("-","",$username);
		$username = str_replace("'","",$username);
		$password = $_POST['tb_password'];
		
		$korisnik = User::CheckUser($username,$password);
	
		if(!$korisnik){
			echo "Korisnik nije registrovan!<br>";
			echo "Molim vas registrujte se za ulazak na sajt.";
		}else{
			session_start();
			$_SESSION['username'] = $korisnik->firstname;
			$_SESSION['password'] = $korisnik->password;
			header("location: home.php");
		}
		
		if($username=="admin" && $password=="admin"){
			session_start();
			$_SESSION['username'] = $korisnik->firstname;
			$_SESSION['password'] = $korisnik->password;
			header("location: administracija/administracija.php");
		}else{
			if($korisnik){
			session_start();
			$_SESSION['username'] = $korisnik->firstname;
			$_SESSION['password'] = $korisnik->password;
			}
		}
	}
	?>
	
</div><!-- end of wrapper -->
</body>
</html>