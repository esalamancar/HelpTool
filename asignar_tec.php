<?php

 require 'templates/OnSecret2.php';
 require 'templates/db.php';
  session_start();
  $message = '';
  $is ='';


  if (isset($_SESSION['u_id'])) {
    $message='';
  }else{
    header('Location: /login2');
  }


  if (1!=$_POST['cas']) {    
    $sql = 'UPDATE casos SET id_t = :e, estado = \'En Curso\' WHERE id_c = :c';
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':e', $_POST['tec']);
    $stmt->bindParam(':c', $_POST['cas']);
    if ($stmt->execute()) {
      $message = 'Actualizado!';
    } else {
      $message = 'No se ha actualizado';
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
      <h1>Asignar Caso</h1><br>
      <p id="alerta">
            <?php if(!empty($message)): ?>
            <?= $message ?>
        <?php endif; ?>
      </p>
    <form method="POST" action="asignar_tec.php">
      <h3>Numero de caso</h3>
      <select name="cas">
        <?php
          try {
            $connect2 = new PDO("mysql:host=$svr2;dbname=$bd2;", $user2, $secret2);
            $connect2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $datos2 = $connect2->query('SELECT id_c, titulo FROM casos WHERE id_t = 1');
              foreach($datos2 as $row2){
                echo "<option value=\"".$row2[0]."\">".$row2[0]." - ".$row2[1]."</option>";
              }
          }catch(PDOException $e) {
              $message = 'Error conectando con la base de datos: ' . $e->getMessage();
          }

        ?>
      </select><br>



      <h3>Asignar a</h3>
      <select name="tec">
        <?php
          try {
            $connect2 = new PDO("mysql:host=$svr2;dbname=$bd2;", $user2, $secret2);
            $connect2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $datos2 = $connect2->query('SELECT id_t,NombreT,ApellidoT FROM tecnico');
              foreach($datos2 as $row2){
                echo "<option value=\"".$row2[0]."\">".$row2[1]." ".$row2[2]."</option>";
              }
          }catch(PDOException $e) {
              $message = 'Error conectando con la base de datos: ' . $e->getMessage();
          }

        ?>
      </select><br>
    <input type="submit" name="Crear" value="Crear">
    </form>
    </div>
  
</body>
</html>
