<?php 
include("../../bd.php"); 


//INSTRUCCION DE BORRAR//

if(isset( $_GET['txtID'] )){

    //almacenar el id
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:"";


    //instruccion sql
    $sentencia=$conexion->prepare("DELETE FROM tbl_estudiantes WHERE id=:id");
    //parametro para el borrado
    $sentencia->bindParam(":id",$txtID);
    //borrado
    $sentencia->execute();
    //redireccion
    $mensaje="Estudiante eliminado";


    //redireccion
    header("Location:index.php?mensaje=".$mensaje);
}


$sentencia=$conexion->prepare("SELECT *,(SELECT nombretitulada FROM tbl_tituladas WHERE tbl_tituladas.id=tbl_estudiantes.idtitulada limit 1) as titulada 
FROM `tbl_estudiantes`");
$sentencia->execute();
$lista_tbl_estudiantes=$sentencia->fetchALL(PDO::FETCH_ASSOC);

?>

<?php include("../../templates/header.php"); ?>

<br/>
<h3>Aprendices</h3>
<div class="card">
    <div class="card-header">
      
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Aprendiz</a>
    </div>
    <div class="card-body">

        <div class="table-responsive-sm">
            <table class="table" id="tabla_id">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Ficha</th>
                        <th scope="col">Numero Documento</th>
                        <th scope="col">Titulada</th>
                        <th scope="col">Fecha de ingreso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>

                <?php foreach ($lista_tbl_estudiantes as $registro) { ?>


                    <tr class="">
                        <td><?php echo $registro['id'] ?> </td>
                        <td scope="row">
                        <?php echo $registro['primernombre'];?>
                        <?php echo $registro['segundonombre'];?>
                        <?php echo $registro['primerapellido'];?>
                        <?php echo $registro['segundoapellido'];?></td>
                        <td><?php echo $registro['foto'] ?></td>
                        <td><?php echo $registro['cc'] ?> </td>
                        <td><?php echo $registro['titulada'] ?> </td>
                        <td><?php echo $registro['fechadeingreso'] ?> </td>

                        <td>
                        <a class="btn btn-success" href="editar.php?txtID=<?php echo $registro['id'] ?>" role="button">Editar</a>

                        <a class="btn btn-danger" href="javascript:borrar(<?php echo $registro['id']; ?>);" role="button">Eliminar</a>
                        
                    </tr>

                <?php } ?>
                    
                </tbody>
            </table>
        </div>
        


  
    </div>
</div>

<?php include("../../templates/footer.php"); ?>