<?php

// a- (1 pts.) AltaVenta.php: (por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,si el ítem existe en
// Pizza.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) y se
// debe descontar la cantidad vendida del stock .

include_once "Ventas.php";
include_once "Pizza.php";

$body = json_decode(file_get_contents("php://input"), true);

$email = $_POST["email"];
$sabor = $_POST["sabor"];
$tipo = $_POST["tipo"];
$cantidad = $_POST["cantidad"];
$file = $_FILES["file"];


function SellPizza($email, $sabor, $tipo, $cantidad, $file){
    $arrayPizza = Pizza::ReadJson();    
    $mensaje = "La pizza no se encuentra registrada o ya no hay stock";
    if(!empty($arrayPizza)) {
        foreach($arrayPizza as $pizza) {
            if($pizza->getSabor() == $sabor && $pizza->getTipo() == $tipo && $pizza->getCantidad() >= $cantidad) {
                $ventasAux = Ventas::CreateVenta($email, $sabor, $tipo, $cantidad );
                $ventasAux->SaveFilesVentas($file, "./ImagenesDeLaVenta/");
                Ventas::InsertarVentasParametros($email, $sabor, $tipo, $cantidad, rand(1, 10000000));
                $pizza->setCantidad($pizza->getCantidad() - $cantidad);                
                $mensaje = 'Datos insertados en la BDD y stock modificado';
            }
        }
    }
    Pizza::SaveToJson($arrayPizza);     
    return $mensaje;
}

echo SellPizza($email, $sabor, $tipo, $cantidad, $file);




?>