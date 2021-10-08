<?php

// (1pt.) PizzaConsultar.php: (por POST)Se ingresa Sabor,Tipo, si coincide con algún registro del archivo Pizza.json,
// retornar “Si Hay”. De lo contrario informar si no existe el tipo o el sabor

include_once "Pizza.php";

function ConsultarPizza()
{
    $body = json_decode(file_get_contents("php://input"), true);
    $mensaje = "No hay una pizza del sabor " . $body["sabor"];
    $arrayPizza = Pizza::ReadJson();    
    if (!empty($arrayPizza)) {        
        foreach ($arrayPizza as $item) //Si tiene elementos, lo recorro
        {
            if ($item->sabor == $body["sabor"] && $item->tipo == $body["tipo"]) {
                $mensaje = "Hay una pizza sabor " . $body["sabor"] . " del tipo " . $body["tipo"];                    
                break;
            } else if ($item->sabor == $body["sabor"] && $item->tipo != $body["tipo"]) {
                $mensaje = "Hay una pizza de " .$body["sabor"] . " pero no del tipo " . $body["tipo"];
                break;
            }
        }
    }    
    return $mensaje;
}

echo ConsultarPizza();
