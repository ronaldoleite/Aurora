<?php
ob_start();
if (!isset($_SESSION)) {
    session_start();
}
use App\Configurations\Formater;
$Formater = new Formater();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ar3 Soluções - pdv </title>
 
        <!-- ARQUIVOS JAVA SCRIPT-->
    <script type="text/javascript" src="lib/js/jquery-3.6.4.min.js"></script>
    <script type="text/javascript" src="lib/js/Animations.js"></script>
    <script type="text/javascript" src="lib/js/ajax.js" ></script>
    <script type="text/javascript" src="lib/js/jquery-latest.js" ></script>
    <script type="text/javascript" src="lib/js/jquery.quicksearch.js" ></script>
    <script type="text/javascript" src="lib/js/jquery.tablesorter.js" ></script>
  
    
    <!-- ARQUIVOS CSS -->
    <link rel="stylesheet" href="lib/css/aurora.css">
    <link rel="stylesheet" href="lib/css/site.css">
    <link rel="stylesheet" href="lib/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.2/animate.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" href="lib/css/site.css">
    <!-- IMPORTANDO FONTES -->
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Condensed:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
</head>
<body>