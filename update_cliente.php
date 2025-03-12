<?php

include_once'conexion.php';
if(isset($_GET['id'])){
    $id=(int) $_GET['id'];
    $buscar_id=$con->prepare('SELECT * FROM cliente where id=:id');
    $buscar_id->execute(array(
        ':id'=>$id    ));
        
    $resultado=$buscar_id->fetch();
} else {
    header('location: index_cliente .php');
}

if (isset($_POST['guardar'])){
    $nombre=$_POST['NOMBRE'];
    $apellido=$_POST['Apellido'];
    $id=(int) $_GET['id'];

    
    if (!empty($id) && !empty($nombre) && !empty ($apellido)) {

        {
            $consulta_update=$con->prepare('UPDATE cliente SET
            nombre=:nombre,
            apellido=:apellido,

            where id=:id;'
         );
        $consulta_update->excute(array(
            ':nombre' => $nombre,
            ':apellido' =>$apellido,
            ':id'=> $id 
        ));
        header('location: index_cliente.php');
        }        
        
    } else {

        echo "<script> alert ('los campos estan vacios'); </script>";
    }    
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Informacion</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="contenedor">
        <h2>Editar Informacion</h2>
        <form action="" method="post">
            <div class="form-group">
                <input type="text" name="nombre" placeholder="Nombre" class="input_text">
            </div>
            <div class="form-group">
                <input type="text" name="apellido" placeholder="Apellido" class="input_text">
            </div>
            <div class="form-group">
                <label for="ciudad">Ciudad:</label>
                <select name="ciudad" id="ciudad" required>
                    <option value="Bogotá">Bogotá</option>
                    <option value="Medellín">Medellín</option>
                    <option value="Cali">Cali</option>
                    <option value="Ibagué">Ibagué</option>
                    <option value="Barranquilla">Barranquilla</option>
                    <option value="Bucaramanga">Bucaramanga</option>
                    <option value="Pasto">Pasto</option>
                </select>
            </div>
            
            <div class="btn_group">
                <a href="index_cliente.php" class="btn btn_danger">Cancelar</a>
                <input type="submit" name="guardar" value="Guardar" class="btn btn_primary">
            </div>
        </form>
    </div>
</body>
</html>
