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

	  		$datos = $connect->query('SELECT * FROM CasosTodos');

	  		echo "<thead><tr><th>No. Caso</th><th>Detalle</th><th>Estado</th><th>Solicitante</th><th>Técnico Asignado</th><th>Fecha Creado</th><th>Inicio Ejecucion</th><th>Fecha Solucion</th><th>Tiempo Total</th></tr></thead><tbody>";

	  		foreach($datos as $row){
	  			echo "<tr>";
	    		echo "<td>".$row[0]."</td>";
	    		echo "<td>Titulo: ".$row[1]."<br>Descripcion: ".$row[2]."</td>";
	    		$trow=$row[3];
	    		if ($trow==='Nuevo') {
	    			echo "<td bgcolor=\"DB6556\">".$trow."</td>";
	    		}
	    		if ($trow==='En Curso') {
	    			echo "<td bgcolor=\"DBD14D\">".$trow."</td>";
	    		}
	    		if ($trow==='Resuelto') {
	    			echo "<td>".$trow."</td>";
	    		}
	    		echo "<td>".$row[4]." ".$row[5]."</td>";
	    		echo "<td>".$row[6]." ".$row[7]."</td>";
	    		echo "<td>".$row[8]."</td>";
	    		echo "<td>".$row[9]."</td>";
	    		echo "<td>".$row[10]."</td>";
	    		echo "<td>Dias: ".$row[11]." Horas: ".$row[12]."</td>";
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
  	<h1>Casos Registrados</h1>
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

