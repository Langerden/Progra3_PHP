<?php

switch ($_SERVER['REQUEST_METHOD']) {
    case 'POST':
        switch ($_GET["op"]) {
            case 'validate':
                include "PizzaConsultar.php";                
                break;
            case 'alta':
                include "AltaVenta.php";                
                break;
            case 'createPost':
                include "PizzaCarga.php";                
                break;
            }        
        break;
    case 'GET':
        switch ($_GET["op"]) {
            case 'create':
                include "PizzaCarga.php";                
                break;
            case 'consultas':
                    include "ConsultasVentas.php";                
                    break;
            }
            break;
    case 'PUT':             
        include "ModificarVenta.php";                
        break;            
    case 'DELETE':             
        include "BorraVenta.php";                
        break;            
}
