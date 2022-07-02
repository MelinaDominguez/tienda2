<?php
include 'global/config.php';
include 'global/conexion.php';
include 'carrito.php';
include 'templates/cabecera.php';
?>



    

        <center><b-alert class="alert alert-danger">
        <?php echo $mensaje; ?>
        <a href="#" class="badge badge-success"> Ver carrito </a>
    </div>
    <br>
    <br>
    <!--End Navbar-->
    
    <!--Productos-->
    <div class="row">
    <?php
        $sentencia=$pdo->prepare("SELECT * FROM `tblproductos`");
        $sentencia->execute();
        $listaProductos=$sentencia->fetchAll(PDO::FETCH_ASSOC);
      //  print_r($listaProductos);
    ?>
    <?php foreach($listaProductos as $producto) { ?>
        <div class="col-3">
            <div class="card">
                <img 
                title="<?php echo $producto['Nombre'];?>"
                alt="<?php echo $producto['Nombre'];?>"
                class="card-img-top" 
                src="<?php echo $producto['Imagen'];?>"
                data-bs-toggle="popover"
                data-bs-trigger="hover focus"              
                data-bs-content="<?php echo $producto['Descripcion'];?>"
                height="317px"
                >
            <div class="card-body">
                <span><?php echo $producto['Nombre'];?></span>
                <h5 class="card-tittle">$<?php echo $producto['Precio'];?></h5>
                <p class="card-text">Descripción</p>

                <form action="" method="POST">
                <input type="hidden" name="id" id="id" value="<?php echo openssl_encrypt($producto['ID'],COD,KEY);?>">
                <input type="hidden" name="nombre" id="nombre" value="<?php echo openssl_encrypt($producto['Nombre'],COD,KEY);?>">
                <input type="hidden" name="precio" id="precio" value="<?php echo openssl_encrypt($producto['Precio'],COD,KEY);?>">
                <input type="hidden" name="cantidad" id="cantidad" value="<?php echo openssl_encrypt(1,COD,KEY);?>">
                
                <button class="btn btn-primary" 
                name="btnAccion" 
                value="Agregar"
                type="submit"
                >
                Agregar al carrito
                </button>
                </form>
            </div>
        </div>   
    </div>
    <?php } ?>
</div>
    
    <script>
        $(function () {
        $('[data-bs-toggle="popover"]').popover()
        })
    </script>

<?php
include 'templates/pie.php';

?>

    
