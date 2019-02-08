
<?php $pagina_attuale='Prenota.php'; ?>
<!DOCTYPE  html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" >

    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="description" content=" Ambulatorio veterinario di Archimedeo Torre per la cura di animali d'affezione, quali cani e gatti" />
      <meta name="keywords" content="ambulatorio, veterinario, Archimedeo, Torre, animali, cani, gatti, pets, dogs, cats, vet" />
      <meta name="language" content="italian it"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/style2.css">
        <link rel="stylesheet" type="text/css" href="print.css" media="print">
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <title>Ambulatorio Veterinario Archimedeo Torre</title>
    </head>

<body>

<?php include_once"header.php"?>

<!--menu di navigazione-->
<?php include_once"navbar.php"?>

<div id="page" class="container">
<!--breadcrumb-->

<ul class="breadcrumb">
  <li>Ti trovi in: </li>
  <li><a href="index2.php"><span xml:lang="en" lang="en">Home</span></a></li>
  <li><a href="AreaPersonale.php">Area Personale</span></a></li>
  <li class="bc_here">Gestione prenotazioni</li>
</ul>
  
<br/>
<br/>
<div id="content">
  <div id="title"><h3>Prenota qui la tua visita:</h3></div>
<form name="prenota" action="">
  Data: <input type="date" id="data">
  Ora: <input type="time" id="ora">
</br></br>Tipo di visita:
  <select id="prestazione">
    <?php
        $connection = mysqli_connect("localhost","root","","clinica");
        if(!$connection) die("Errore nella connessione.");
        $query="SELECT id, nome FROM prestazione";
        $result=mysqli_query($connection, $query) or die("Impossibile ottenere la lista delle prestazioni");

        while($row=mysqli_fetch_assoc($result)){
          echo "<option value=".$row['id'].">".$row['nome']."</option>";
        }

        $id=$_SESSION['username'];
    ?>
  </select></br></br></br>
  Tipo di animale:</br>
  <input type="radio" name="tipo" value=0>cane</br>
  <input type="radio" name="tipo" value=1 checked="checked">gatto</br></br>
  <textarea rows="5" cols="50" name="note" placeholder="Inserisci qui eventuali note aggiuntive"></textarea></br>
  <input type="submit" name="invia">
</form>




</div> <!--chiusura tag page-->

<?php include_once"footer.php"?>

</body>
</html>
