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


  if(!empty($_POST['tit'])){
    try {
      $connect2 = new PDO("mysql:host=$svr2;dbname=$bd2;", $user2, $secret2);
      $connect2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      $datos2 = $connect2->query('SELECT MAX(id_c) AS maxid FROM casos');
        foreach($datos2 as $row2){
          $is=$row2[0];
          $is=$is+1;
        }
    }catch(PDOException $e) {
        $message = 'Error conectando con la base de datos: ' . $e->getMessage();
    }

    $sql = 'INSERT INTO casos (id_c,titulo, descripcion,categoria,estado,id_u) VALUES (:iu,:t,:d,:c,:e,:i)';
    $stmt = $connect->prepare($sql);
    $stmt->bindParam(':iu', $is);
    $stmt->bindParam(':t', $_POST['tit']);
    $stmt->bindParam(':d', $_POST['des']);
    $stmt->bindParam(':c', $_POST['cat']);
    $stmt->bindParam(':e', $_POST['est']);
    $stmt->bindParam(':i', $_SESSION['u_id']);
    if ($stmt->execute()) {
      $message = 'Su caso ha sido creado y sera atendido proximamente<br>Numero de caso: '.$is;
    } else {
      $message = 'No se ha creado el caso';
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
      <h1>Crear caso</h1><br>
      <p id="alerta">
            <?php if(!empty($message)): ?>
            <?= $message ?>
        <?php endif; ?>
      </p>
    <form method="POST" action="crear.php">
      <h3>Titulo</h3>
      <input type="text" placeholder="Nombre de caso" name="tit" required><br>
      <h3>Descripcion</h3>
      <input type="text" placeholder="Detalle su problema/requerimiento" name="des" required><br>
      <h3>Categoría</h3>
      <select name="cat">
        <option value="No especificado" selected>No especificado</option> <!-- Opción por defecto -->
        <option value="Internet">Internet</option>
        <option value="PC">PC</option>
        <option value="Telefonia">Telefonia</option>
        <option value="Correo">Correo</option>
      </select><br>
      <h3>Estado</h3>
      <select name="est">
        <option value="Nuevo" selected>Nuevo</option>
        <option value="En curso">En curso</option>
        <option value="Resuelto">Resuelto</option>
      </select>
    <input type="submit" name="Crear" value="Crear">
    </form>
    </div>
  
</body>
</html>
