<?php
session_start();
print_r($_SESSION);
?>
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
	<h2 class="naslov">Home page</h2>
	
	<main>
		<?php
		require "config.php";
		 $conn = mysqli_connect(System::_DBHOST,System::_DBUSER,System::_DBPASS,System::_DBNAME);
		 $id =  isset ($_GET['cid'])&& is_numeric($_GET['cid'])?$_GET['cid']:0;
		 $q = mysqli_query($conn,"select * from news where kategorija={$id}");
		 $qAll = mysqli_query($conn,"select * from news order by news.id DESC");
		 if($id!=0){
		 while($rw=mysqli_fetch_object($q)){
			echo "
				<div class='vest'>
					<p>Kategorija: {$rw->kategorija}</p>
					<img src='{$rw->slika}' alt='' />
					<a href='vest.php?vid={$rw->id}'><h4>{$rw->naslov}</h4></a>
				</div>
				 ";
		 	}
		}else{
			while($row=mysqli_fetch_object($qAll)){
			echo "
				<div class='vest'>
					<p>Kategorija: {$row->kategorija}</p>
					<img src='{$row->slika}' alt='' />
					<a href='vest.php?vid={$row->id}'><h4>{$row->naslov}</h4></a>
				</div>
				 ";
			}
		}
		?>
	</main>
	
	<aside>
		<div>
			<?php
			if($_SESSION['username'] = "admin" && $_SESSION['password'] = "admin" ){
				 	echo "<dd class='menu'><a href='administracija/administracija.php'>Administracija</a></dd>";
			}else{
				echo "<dd class='menu'></dd>";
			}
			?>
			<dd class="menu"><a href="home.php">Naslovna</a></dd>
			<?php
			 $upit = mysqli_query($conn,"select * from kategorije");
			 while($rw=mysqli_fetch_object($upit)){
				?>
				  <dd class="menu"><a href="home.php?cid=<?php echo $rw->id; ?>"><?php echo $rw->imekat; ?></a></dd>
				<?php
			  }
			 ?>
		<div>
	</aside>

</div><!-- end of wrapper -->
</body>
</html>