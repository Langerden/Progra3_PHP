<?php

// ModificarVenta.php(por PUT), debe recibir el número de pedido, el email del usuario, el sabor,tipo y
// cantidad, si existe se modifica , de lo contrario informar.

require_once "Ventas.php";


function UpdateValues()
{
    $body = json_decode(file_get_contents("php://input"), true);
    if (isset($body["numeroPedido"]) && isset($body["emailUser"]) && isset($body["sabor"]) && isset($body["tipo"]) && isset($body["cantidad"]) ) {
        $venta = Ventas::FindByNumPedido($body["numeroPedido"]);
        if ($venta != null) {
            Ventas::UpdateVenta($body["emailUser"], $body["sabor"], $body["tipo"], $body["cantidad"], date("Y-m-d"), $body["numeroPedido"]);
            echo "Venta modificada";        
        } else {
            echo "El numero de pedido no existe";
        }
    }
    else
    {
        echo "Faltan datos";
    }
}

UpdateValues();

// function UpdateValues()
// {
//     if (isset($body["numeroPedido"]) && isset($body["emailUser"]) && isset($body["sabor"]) && isset($body["tipo"]) && isset($body["cantidad"]) ) {
//         $venta = new Ventas();
//         $venta->emailUser = $body["emailUser"];
//         $venta->sabor = $sabor;
//         $venta->tipo = $tipo;
//         $venta->cantidad = $cantidad;
//         echo "Venta modificada";
//     }
//     else
//     {
//         echo json_encode(array("message" => "Faltan datos"));
//     }



?>