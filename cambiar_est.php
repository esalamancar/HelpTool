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


  if (!empty($_POST['cas'])) {    
    $sql = 'UPDATE casos SET estado = :e WHERE id_c = :c';
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':e', $_POST['est']);
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
      <h1>Cambiar estado</h1><br>
      <p id="alerta">
            <?php if(!empty($message)): ?>
            <?= $message ?>
        <?php endif; ?>
      </p>
    <form method="POST" action="cambiar_est.php">
      <h3>Numero de caso</h3>
      <input type="text" placeholder="Ingrese Numero de Caso" name="cas" required><br>
      <h3>Cambiar a</h3>
      <select name="est">
        <option value="----" selected>----</option> <!-- Opción por defecto -->
        <option value="En Curso">En Curso</option>
        <option value="Resuelto">Resuelto</option>
      </select><br>
    <input type="submit" name="Crear" value="Crear">
    </form>
    </div>
  
</body>
</html>
