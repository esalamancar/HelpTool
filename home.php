<?php

  require 'templates/db.php';
  session_start();

  $message = '';
  

  if (isset($_SESSION['u_id'])) {
  	$stmt = $connect->prepare('SELECT id_u,Nombre FROM usuarios WHERE id_u = :id');
    $stmt->bindParam(':id', $_SESSION['u_id']);
    $stmt->execute();
    $res=$stmt->fetch(PDO::FETCH_ASSOC);
    $message = $res['Nombre'];
  }
  else{
    header('Location: /login2');
  }

?>

<!doctype html>
<html lang="es-LA">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
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

  <section class="hero" id="hero">
    <img class="logos" src="img/logo.png">
    <h2 class="hero_header"><?php echo "$message";?>,<span class="light"> BIENVENIDO</span></h2>
    <p class="tagline">Proyecto Software ITMS</p>
  </section>
  <!-- About Section -->
  <section class="about" id="about">
    <h2 class="hidden">About</h2>
    <p class="text_column">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
    <p class="text_column">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
    <p class="text_column">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. </p>
  </section>
  <!-- Stats Gallery Section -->
  <div class="gallery">
    <div class="thumbnail">
      <h1 class="stats">1500</h1>
      <h4>TITLE</h4>
      <p>One line description</p>
    </div>
    <div class="thumbnail">
      <h1 class="stats">2300</h1>
      <h4>TITLE</h4>
      <p>One line description</p>
    </div>
    <div class="thumbnail">
      <h1 class="stats">7500</h1>
      <h4>TITLE</h4>
      <p>One line description</p>
    </div>
    <div class="thumbnail">
      <h1 class="stats">9870</h1>
      <h4>TITLE</h4>
      <p>One line description</p>
    </div>
  </div>
  <!-- Parallax Section -->
  <section class="banner">
    <h2 class="parallax">Admin Options</h2>
    <p class="parallax_description">Estas opciones son reservadas para manipular los casos.<br>Ver todos los casos: <a class="adminopc" href="todos.php">aqui</a> | Cambiar estado de caso: <a class="adminopc" href="cambiar_est.php">aqui</a> | Asignar Tecnico: <a class="adminopc" href="asignar_tec.php">aqui</a></p>
  </section>
</body>
</html>
