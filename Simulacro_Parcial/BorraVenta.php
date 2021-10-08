<?php

// 7- (2 pts.) borrarVenta.php(por DELETE), debe recibir un número de pedido,se borra la venta y la foto se mueve a
// la carpeta /BACKUPVENTAS

require_once "Ventas.php";


function DeleteVenta()
{
    $body = json_decode(file_get_contents("php://input"), true);
    if (isset($body["numeroPedido"])) {
        $venta = Ventas::FindByNumPedido($body["numeroPedido"]);
        if ($venta != null) {
            Ventas::DeleteVenta($body["numeroPedido"]);
            echo "Venta Eliminada";        
        } else {
            echo "El numero de pedido no existe";
        }
    }
    else
    {
        echo "Faltan datos";
    }
}

DeleteVenta();

?>