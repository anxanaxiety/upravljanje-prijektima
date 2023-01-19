<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Upravljanje projektima</title>
  <link rel="icon" href="img/logo.webp">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <script src="https://kit.fontawesome.com/d283f0daf0.js" crossorigin="anonymous"></script>  
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Raleway:wght@400;700&family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">   <link rel="stylesheet" href="css/style.min.css">
<?php
if (isset($_SESSION["auth"])) {
  require_once("db_operacije.php");
  $operacijeBaze = new OperacijeBaze();
  $user = $operacijeBaze -> idUseraPoMail($_SESSION["auth"]) -> fetch_assoc();

  echo '<link rel="stylesheet" href="css/tema'. $user["tema"] . '.css">';

}
?>
</head>
<body>
