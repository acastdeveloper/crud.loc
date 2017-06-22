<?php
require_once('connexio.php');

function netejar($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

//CREATE
//Només insereix el registre si s'ha premut el botó que es diu 'reg'
if (isset($_POST['reg'])) {

    $nombre = netejar($_POST['nom']);
    $apellido = netejar($_POST['cognom']);
    $naix = netejar($_POST['datanaix']);

    if (strlen($nombre) > 0 && is_string($nombre) && strlen($apellido) > 0 && is_string($apellido) && strlen($naix) > 0) {

        $sql = "INSERT INTO empleados (nom,cognoms,data_naixement)
        VALUES(:nom,:cognoms,:dnaix)";

        $resultado = $conn->prepare($sql);
        $resultado->bindparam(":nom", $nombre);
        $resultado->bindparam(":cognoms", $apellido);
        $resultado->bindparam(":dnaix", $naix);
        $resultado->execute();
        //$resultado->execute(array(":nom"=>$nombre,":cognoms"=>$apellido,":dnaix"=>$naix));

        $lastId = $conn->lastInsertId();
        header("Location:form.php?ed=" . $lastId);
        //Un cop s'ha inserit carrega l'arxiu de nou
    } else {

        echo "Falta añadir algún campo";
    }
}
 

//DELETE
if (isset($_GET['del'])) {
    $id = netejar($_GET['del']);
    $sql = 'DELETE FROM empleados WHERE id=' . $id;
    $conn->exec($sql);
    header("Location:form.php");
}

 

//READ CURRENT
if (isset($_GET['ed'])) {
    $ed = netejar($_GET['ed']);
    $sql = 'SELECT * FROM empleados WHERE id=' . $ed;
    $conexion = $conn->query($sql);
    $persona = $conexion->fetch(PDO::FETCH_OBJ);

    $nombre = $persona->nom;
    $apellido = $persona->cognoms;
    $naix = $persona->data_naixement;
    $titol = "Modificar empleat";
    $textBoto = "Modificar";
    $nomBoto = "upd";
} else {
    $titol = "Afegir empleat";
    $textBoto = "Afegir";
    $nomBoto = "reg";
}

//UPDATE
//Només insereix el registre si s'ha premut el botó que es diu 'upd'
if (isset($_POST['upd'])) {
  

    $nombre = netejar($_POST['nom']);
    $apellido = netejar($_POST['cognom']);
    $naix = netejar($_POST['datanaix']);
    $id = netejar($_POST['id']);
    

    if (strlen($nombre) > 0 && is_string($nombre) && strlen($apellido) > 0 && is_string($apellido) && strlen($naix) > 0) {

        $sql = "UPDATE `empleados` SET `nom`=:nom, `cognoms`=:cognoms, `data_naixement`=:dnaix WHERE `id`=" . $id;
    
        $resultado = $conn->prepare($sql);
        $resultado->bindparam(":nom", $nombre);
        $resultado->bindparam(":cognoms", $apellido);
        $resultado->bindparam(":dnaix", $naix);
        $resultado->execute();
 
        header("Location:form.php?ed=".$id);
        //Un cop s'ha inserit carrega l'arxiu de nou
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .fa {text-decoration: none;}
    </style>
    <body>
        <div class="w3-card-4">

            <div class="w3-container w3-brown">
                <h2><?php echo $titol; ?></h2>
            </div>
            <form class="w3-container" method="POST" action="form.php">
                <input type="hidden" name="id" value="<?php echo $ed; ?>">

                <p>
                    <label class="w3-label w3-text-brown"><b>Nom</b></label>
                    <input class="w3-input w3-border w3-sand" name="nom" type="text" required value="<?php echo $nombre; ?>"></p>

                <p>
                    <label class="w3-label w3-text-brown"><b>Cognom</b></label>
                    <input class="w3-input w3-border w3-sand" name="cognom" type="text" required value="<?php echo $apellido; ?>"></p>
                <p>

                <p>
                    <label class="w3-label w3-text-brown"><b>Data Naix.</b><i> (format: 2016-07-17)</i></label>
                    <input class="w3-input w3-border w3-sand" name="datanaix" type="date" required datetime="YYYY-MM-DD" value="<?php echo $naix; ?>"></p>

                <p>
                    <input type="submit" class="w3-btn w3-brown" value="<?php echo $textBoto; ?>" name="<?php echo $nomBoto; ?>">
                </p>

            </form>
        </div>

        <div class="w3-container w3-responsive">

            <table class="w3-table w3-bordered w3-striped w3-large">
                <tr>
                    <th>Id</th>
                    <th>Nom</th>
                    <th>Cognoms</th>
                    <th>Data Naix.</th>
                    <th>Eliminar</th>
                    <th>Editar</th>
                </tr>

<?php
//READ

$sql = 'SELECT * FROM empleados';
$conexion = $conn->query($sql);
$registros = $conexion->fetchAll(PDO::FETCH_OBJ);
foreach ($registros as $persona):
    ?>
                    <tr>
                        <td><?php echo $persona->id; ?></td>
                        <td><?php echo $persona->nom; ?></td>
                        <td><?php echo $persona->cognoms; ?></td>
                        <td><?php echo $persona->data_naixement; ?></td>
                        <td><a href="?del=<?php echo $persona->id; ?>" class="fa fa-trash-o"></a></td>
                        <td><a href="?ed=<?php echo $persona->id; ?>" class="fa fa-pencil"></a></td>


                    </tr><?php
                endforeach;
                $conn = null;
                ?>
            </table>
        </div>


    </body>
</html>
