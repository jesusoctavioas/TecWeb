<?php $pagina_attuale='index2.php'; ?>

<!DOCTYPE  html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="it" lang="it" >

    <head>
        <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
        <meta name="description" content=" Ambulatorio veterinario di Archimedeo Torre per la cura di animali d'affezione (cani e gatti). L'ambulatorio si trova aPadova, via delle Mele 420" />
  		<meta name="keywords" content="ambulatorio, veterinario, Archimedeo, Torre, animali, cani, gatti, pets, dogs, cats, vet" />
  		<meta name="language" content="italian it"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/style2.css">
        <link rel="stylesheet" type="text/css" href="print.css" media="print">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
    <li class="bc_here">Home</li>
</ul>

<!--un po' di separazione-->
<br/>
<br/>

<!-- contenuto -->

    <div id="content">
    	<h2>Benvenuto nel sito dell'ambulatorio veterinario Archimedeo Torre!</h2>
    	<img src="img/dog-hug.jpg" alt="" />
    	<p> L'ambulatorio Archimedeo Torre si propone da sempre come punto di riferimento per la cura e il benessere animale (... bla bla)</p>

    	<div id="Orari">
    		<h2>Orari ambulatorio</h2>
    	<!--funzione php che riempie tabella orari-->


        <div id="box1">
            <h2>Prenota ora una visita</h2>
            <p><a href="Contattaci.php" class="link-style">Contattaci</a></p>
        </div>
        </div>

        <!---richiamo php a Galleria, Emergenze e pagina personale--->

    
</div>

<?php include_once"footer.php"?>

</body>
</html>