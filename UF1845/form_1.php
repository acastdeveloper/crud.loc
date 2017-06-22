<!--
ACTIVITAT 2
Tot seguit amb l'arxiu form.html i la base de dades anterior, crear a un únic fitxer php una pàgina per gestionar un llistat. El formulari permet la inserció d'empleats en la BBDD i sempre en sortirà el llistat obtingut de la taula al final de la pàgina. Efectua algun tipus de validació PHP (no Javascript) en el camp d'entrada per fer la inserció més segura. Distingir si la petició és de tipus POST per efectuar la inserció per PHP.
 -->

<?php
require_once('connexio.php');

if(isset($_POST['reg'])){
	$nombre=$_POST['nom'];
	$apellido=$_POST['cognom'];
	$naix=$_POST['datanaix'];

	if(strlen($nombre)>0 &&  is_string($nombre) && strlen($apellido)>0 && is_string($apellido) && strlen($naix)>0) {

	$sql = "INSERT INTO empleados (nom,cognoms,data_naixement)
	VALUES(:nom,:cognoms,:dnaix)";

	$resultado=$conn->prepare($sql);
        
        
        
	$resultado->execute(array(":nom"=>$nombre,":cognoms"=>$apellido,":dnaix"=>$naix));
	header("Location:form.php");
} else {
	echo "Falta añadir algún campo";
}

}


 ?>


<!DOCTYPE html>
<html>
<title>Examen Final Prova Practica Modul 2</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta charset="UTF-8">

<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">
<body>
	<div class="w3-card-4">

	<div class="w3-container w3-brown">
	  <h2>Registre d'empleats</h2>
	</div>
	<form class="w3-container" method="POST" action="form.php">

	<p>
	<label class="w3-label w3-text-brown"><b>Nom</b></label>
	<input class="w3-input w3-border w3-sand" name="nom" type="text" required></p>

	<p>
	<label class="w3-label w3-text-brown"><b>Cognom</b></label>
	<input class="w3-input w3-border w3-sand" name="cognom" type="text" required></p>
	<p>

	<p>
	<label class="w3-label w3-text-brown"><b>Data Naix.</b><i> (format: 2016-07-17)</i></label>
	<input class="w3-input w3-border w3-sand" name="datanaix" type="date" required datetime="YYYY-MM-DD"></p>

	<p><input type="submit" class="w3-btn w3-brown" value="Enregistrar" name="reg"></p>

	</form>
</div>

<div class="w3-container w3-responsive">

<table class="w3-table w3-bordered w3-striped w3-large">
	<tr>
	  <th>Id</th>
	  <th>Nom</th>
	  <th>Cognoms</th>
	  <th>Data Naix.</th>
	</tr>

	<?php
	$sql = 'SELECT * FROM empleados';
	$conexion=$conn->query($sql);
	$registros =$conexion->fetchAll(PDO::FETCH_OBJ);

	foreach ($registros as $persona):
	?>
	<tr>
		<td><?php echo $persona->id; ?></td>
		<td><?php echo $persona->nom; ?></td>
		<td><?php echo $persona->cognoms; ?></td>
		<td><?php echo $persona->data_naixement; ?></td>
	</tr><?php
	endforeach;
	$conn = null;
	 ?>
</table>
</div>


</body>
</html>
