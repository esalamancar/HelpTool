<?php
	session_start();

	if (!(isset($_SESSION['u_id']))) {
		header('Location: /login2');
	}

	function printResult(){
		require 'templates/OnSecret.php';
		try {
	  		$connect = new PDO("mysql:host=$svr;dbname=$bd;", $user, $secret);
	  		$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	  		$datos = $connect->query('SELECT * FROM CasosResueltosTotal WHERE id_u = '.$_SESSION['u_id']);

	  		echo "<thead><tr><th>No. Caso</th><th>Detalle</th><th>Técnico Asignado</th><th>Resuelto en</th></tr></thead><tbody>";

	  		foreach($datos as $row){
	  			echo "<tr>";
	    		echo "<td>".$row[0]."</td>";
	    		echo "<td>Titulo: ".$row[1]."<br>Descripcion: ".$row[12]."</td>";
	    		echo "<td>".$row[7]." ".$row[8]."</td>";
	    		echo "<td>"."Dias: ".$row[10]." - Horas: ".$row[11]."</td>";
	    		echo "</tr>";
	  		}
	  		
		}
		catch(PDOException $e) {
			echo 'Error conectando con la base de datos: ' . $e->getMessage();
		}
	}

?>


<!doctype html>
<html lang="es-LA">

<head>
	<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Home | HelpTool</title>
  <link rel="stylesheet" type="text/css" href="css/singlePageTemplate.css">

  <!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
  <script>var __adobewebfontsappname__="dreamweaver"</script>
  <script src="http://use.edgefonts.net/source-sans-pro:n2:default.js" type="text/javascript"></script>
</head>

<body>
<!-- Main Container -->
<div class="container"> 
  <?php require 'templates/header.php' ?>


  <div class="resp">
  <section class="about" id="about">
  	<h1>Casos Pendientes</h1>
  </section>
  </div>
  <div class="centrarTabla">
  	<table class="yellow">
  	<?php printResult(); ?>
  	</tbody>
	</tr>
	</table>
  </div> 
</body>
</html>

