<?php

 require 'templates/OnSecret2.php';
 require 'templates/db.php';
 $message = '';
 $is ='';


if (!empty($_POST['em']) && !empty($_POST['pw1'])) {
	if (!empty($_POST['em'])) {
		if (!empty($_POST['pw1'])) {
			if ($_POST['pw1']===$_POST['pw2']) {

				try {
			  		$connect2 = new PDO("mysql:host=$svr2;dbname=$bd2;", $user2, $secret2);
			  		$connect2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

			  		$datos2 = $connect2->query('SELECT MAX(id_u) AS id FROM usuarios');
			  		foreach($datos2 as $row2){
			    		$is=$row2[0];
			    		$is=$is+1;
			    	}
				}
				catch(PDOException $e) {
					$message = 'Error conectando con la base de datos: '.$e->getMessage();
				}

				echo $is;


				$sql = "INSERT INTO usuarios (id_u, email, pw,Nombre,Apellido) VALUES (:idd, :em, :pw1,:no,:ape)";
			    $stmt = $connect->prepare($sql);
			    $stmt->bindParam(':idd', $is);
			    $stmt->bindParam(':em', $_POST['em']);
			    $pass = hash(sha256, $_POST['pw1']);
			    $stmt->bindParam(':pw1', $pass);
			    $stmt->bindParam(':no', $_POST['no']);
			    $stmt->bindParam(':ape', $_POST['ape']);
			    if ($stmt->execute()) {
			      $message = 'Creado!';
			      #header('Location: /login2');
			    } else {
			      $message = 'No se ha creado el usuario';
			    }
			}
			else{
				$message = 'Valide todos los campos';
				echo '<script language="javascript">';
			  	echo 'alert("Las contraseñas no coinciden")';
			  	echo '</script>';
			}
		}
		else{
			$message = 'Valide todos los campos';
			echo '<script language="javascript">';
		  	echo 'alert("Complete la Contraseña")';
		  	echo '</script>';
		}		
	}
	else{
		$message = 'Valide todos los campos';
		echo '<script language="javascript">';
	  	echo 'alert("Complete el Usuario")';
	  	echo '</script>';
	}
}

    


?>


<html>
  <head>
    <title>Registro | Erick Salamanca</title>
    <meta charset="UTF-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
<body>
    <div id="cont">
      <div id="pannel2">
        <div id="artic">
          <h1>Registro</h1>
          <form method="POST" action="registro.php">
              <input type="text" placeholder="Nombre" name="no" required>
              <input type="text" placeholder="Apellido" name="ape" required>
              <input type="text" placeholder="Email" name="em" required>
              <input type="password" placeholder="Ingrese Contraseña" name="pw1" required>
              <input type="password" placeholder="Confirme Contraseña" name="pw2" required>
              <input type="submit" name="registro" value="Registrarse">
          </form>
          <p id="alerta">
	          <?php if(!empty($message)): ?>
			      <?= $message ?>
			  <?php endif; ?>
			  <br>
			  <a href="/login2">Iniciar Sesion</a><br>
          </p>
        </div>
        
      </div>
    </div>
</body>

</html>