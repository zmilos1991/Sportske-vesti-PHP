<?php
session_start();
if(!isset($_SESSION['username'])|| $_SESSION['password']!= "admin" ){
	header("location: ../index.php");
}
?>
<html>
<head>
  <meta charset="UTF-8">
  <title>Sportske vesti-Admin</title>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
<div id="wrapper">
	<h1 class="naslov">Sportske Vesti</h1>
	<h2 class="naslov">Ovo je strana o administraciji sajta</h2>
	<h2 class="naslov">Ubacite novu vest</h2>
<main>
	<?php
		require "../config.php";
		$conn = mysqli_connect(System::_DBHOST,System::_DBUSER,System::_DBPASS,System::_DBNAME);


		if(isset($_POST['btn_submit'])){
			$odabrana_kategorija = $_POST['sel_kategorija'];
			$novi_naslov = $_POST['tb_naslov'];
			$novi_sadrzaj = $_POST['ta_sadrzaj'];
			$nova_slika = $_POST['tb_slika'];

			mysqli_query($conn,"insert into news values (null,'{$novi_naslov}','{$nova_slika}','{$odabrana_kategorija}','{$novi_sadrzaj}')");
		}

		if(isset($_POST['btn_submitkat'])){
			$naziv_kategorije = $_POST['tb_nazivkat'];
			mysqli_query($conn,"insert into kategorije values (null,'{$naziv_kategorije}')");
		}

	?>
	<form action="" method="post" id="forma-unosvesti">
	Kategorija vesti: <br>
	<select name="sel_kategorija">
		<option value="-1">Izaberi kategoriju</option>
		<?php
		$qKat = mysqli_query($conn,"select * from kategorije");
		while($row=mysqli_fetch_object($qKat)){
			echo "<option value='{$row->id}'>{$row->imekat}</option>";
		}
		?>
	</select><br>

	<p>Naslov vesti</p>
	<input type="text" name="tb_naslov"/>

	<p>Sadrzaj vesti</p>
	<textarea name="ta_sadrzaj"></textarea>

	<p>Slika-unesite URL:</p>
	<input type="text" name="tb_slika"/><br>
	<input type="submit" name="btn_submit" value="Unesi novu vest" />
	</form>

	<form action="" method="post" id="forma-unoskat">
	<p>Naziv kategorije</p>
	<input type="text" name="tb_nazivkat"/>
	<input type="submit" name="btn_submitkat" value="Unesi novu kategoriju" />
	</form>
</main>


<aside>
	<div>
		<dd class="menu"><a href="../home.php">Naslovna</a></dd>
		<dd class="menu"><a href="logout.php">Logout</a></dd>
	</div>
</aside>
</div><!-- end of #wrapper -->

</body>
</html>