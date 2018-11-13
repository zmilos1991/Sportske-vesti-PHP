<?php
session_start();
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
		<a href="home.php" class="backbtn">&larr; Back</a>
		<?php
		require "config.php";
		 $conn = mysqli_connect(System::_DBHOST,System::_DBUSER,System::_DBPASS,System::_DBNAME);
		 $id =  isset ($_GET['vid'])&& is_numeric($_GET['vid'])?$_GET['vid']:0;
		 $q = mysqli_query($conn,"select * from news where id={$id}");
		 while($rw=mysqli_fetch_object($q)){
			echo "
				<div class='vest'>
					<img src='{$rw->slika}' alt='' />
					<h4>{$rw->naslov}</h4><br>
					<p>{$rw->sadrzaj}</p>
				</div>
				 ";
				 if($_SESSION['username'] && $_SESSION['password'] = "admin" ){
				 	echo "<a href='administracija/delete.php?vid={$rw->id}'>Delete</a>";
				 }
		 }
		?>
		<br>
		<?php
		$upitKomentar = mysqli_query($conn,"select * from komentari where zavest={$id}");
		 while($red=mysqli_fetch_object($upitKomentar)){
			echo "
				<div class='komentar'><p>{$red->tekstKomentara}</p></div>
				";
				}
		?>
		<br>
		<?php
		if(isset($_POST['btn_submit'])){
			$comment = $_POST['comment'];
			$comment = htmlspecialchars($comment);
			$zaVest = $_GET['vid'];

			mysqli_query($conn,"insert into komentari values (null,'{$comment}','{$zaVest}')");
		}
		?>
		<form id="forma-komentar" method="post" action="vest.php?vid=<?php echo $_GET['vid']; ?>">
		<textarea name="comment"></textarea><br>
		<input type="submit" name="btn_submit" value="Komentarisi" />
		</form>
		<br>
	</main>
	
	<aside>
		<div>
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