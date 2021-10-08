<?php

// B- (1 pt.) PizzaCarga.php: (por GET)se ingresa Sabor, precio, Tipo (“molde” o “piedra”), cantidad( de unidades). Se
// guardan los datos en en el archivo de texto Pizza.json, tomando un id autoincremental como
// identificador(emulado) .Sí el sabor y tipo ya existen , se actualiza el precio y se suma al stock existente.

include_once "Pizza.php";

function ValidateValues()
{
    if (isset($_POST["sabor"]) && isset($_POST["precio"]) && isset($_POST["tipo"]) && isset($_POST["cantidad"]) && isset($_FILES["image"]) ) {
        return new Pizza(rand(1, 100), $_POST["sabor"], floatval($_POST["precio"]), $_POST["tipo"], intval($_POST["cantidad"]), $_FILES["image"]);
    } else {
        return null;
    }
}

function UpdateJson(){    
    $exists = false;
    $mensaje = 'Datos invalidos';
    $pizza = ValidateValues();
    $arrayPizza = Pizza::ReadJson(); //Obtengo las pizzas desde el .json
    if($pizza != null){
        $pizza->SaveFilesPizza("./ImagenesDeLaVenta/");
        if(!empty($arrayPizza)) //Valido que el array no esté vacio
        {
            foreach ($arrayPizza as $item) //Si tiene elementos, lo recorro
            {
                if($item->equals($pizza)) //Valido que la pizza no exista
                {
                    //Actualizar datos de la pizza
                    $item->setPrecio($pizza->getPrecio());
                    $item->setCantidad($pizza->getCantidad() + $item->getCantidad());              
                    $exists = true;
                    $mensaje = "Se actualizó la pizza";
                }
            }
        }
        if(!$exists) //Si no existe la pizza, la agrego al array
        {
            array_push($arrayPizza, $pizza);
            $mensaje = "Se agregó la pizza";
        }
        Pizza::SaveToJson($arrayPizza); //Guardo el array en el .json
    }
    return $mensaje;
}

echo UpdateJson();

// function ConsultarPizza()
// {
//     $arrayPizza = $this->JsonToPizza();
//     if ($arrayPizza != null) {
//         for ($i = 0; $i < count($arrayPizza); $i++) {
//             if ($arrayPizza[$i]->sabor == $this->sabor && $arrayPizza[$i]->tipo == $this->tipo) {
//                 return "Si hay";
//             } else if ($arrayPizza[$i]->sabor == $this->sabor && $arrayPizza[$i]->tipo != $this->tipo) {
//                 return "No hay " . $this->tipo;
//             } else {
//                 return "No hay " . $this->sabor;
//             }
//         }
//     }
// }
