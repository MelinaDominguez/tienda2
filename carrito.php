<?php
session_start();

$mensaje="";

if (isset($_POST['btnAccion'])){
    
    switch($_POST['btnAccion']){

        case 'Agregar';

            if(is_numeric( openssl_decrypt($_POST['id'],COD,KEY))){
                $ID=openssl_decrypt($_POST['id'],COD,KEY);
                $mensaje.="Ok ID correcto".$ID;

            }else{
                $mensaje.="Upss.... ID Incorrecto".$ID;
            }
            if(is_string(openssl_decrypt($_POST['nombre'],COD,KEY))){
                $NOMBRE=openssl_decrypt($_POST['nombre'],COD,KEY);
                $mensaje.="Ok el nombre es: ".$NOMBRE;
            }else{ $mensaje.="Upss.... hay un error con el nombre"; break;}

                if(is_numeric(openssl_decrypt($_POST['cantidad'],COD,KEY))){
                    $CANTIDAD=openssl_decrypt($_POST['cantidad'],COD,KEY);
                    $mensaje.="Ok la cantidad es: ".$CANTIDAD;
                }else{ $mensaje.="Upss.... hay un error con la cantidad"; break;}

                    if(is_numeric(openssl_decrypt($_POST['precio'],COD,KEY))){
                        $PRECIO=openssl_decrypt($_POST['precio'],COD,KEY);
                        $mensaje.="Ok el precio es: ".$PRECIO;
                    }else{ $mensaje.="Upss.... hay un error con el precio"; break;}

        if(!isset($_SESSION['CARRITO'])){

            $producto=array(
                'ID'=>$ID,
                'NOMBRE'=>$NOMBRE,
                'CANTIDAD'=>$CANTIDAD,
                'PRECIO'=>$PRECIO
            );
            $_SESSION['CARRITO'][0]=$producto;
        
        }else{
            $NumeroProductos=count($_SESSION['CARRITO']);
            $producto=array(
                'ID'=>$ID,
                'NOMBRE'=>$NOMBRE,
                'CANTIDAD'=>$CANTIDAD,
                'PRECIO'=>$PRECIO,
            );

            $_SESSION['CARRITO'][$NumeroProductos]=$producto;
        }
        $mensaje=print_r($_SESSION,true);

        break;
        case "Eliminar":
        if(is_numeric( openssl_decrypt($_POST['id'],COD,KEY))){
            $ID=openssl_decrypt($_POST['id'],COD,KEY);
            
            
            foreach($_SESSION['CARRITO'] as $indice=>$producto){
                if($producto['ID']==$ID){
                    unset($_SESSION['CARRITO'][$indice]);
                    echo "<script>alert('Elemento eliminado bro...');</script>";
                }
            }

        }else{
            $mensaje.="Upss.... ID Incorrecto".$ID;
        }
    break;
    }
}

?>