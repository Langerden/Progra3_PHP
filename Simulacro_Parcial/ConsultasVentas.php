<?php

require_once "AccesoDatos.php";
require_once "Ventas.php";

function GetCountPizzasSelled(){        
    $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
    $consulta = $objetoAccesoDato->RetornarConsulta("SELECT SUM(cantidad) AS TOTAL FROM ventas;");
    $consulta->execute();
    return $consulta->fetch(PDO::FETCH_ASSOC);        
}

echo "Cantidad de pizzas vendidas: " . GetCountPizzasSelled()["TOTAL"] . "\n" . "\n";

echo Ventas::PrintData(Ventas::ListBetweenDates("2014/01/01" ,"2017-01-15"), "Ventas entre dos fechas ordenado por sabor");

echo Ventas::PrintData(Ventas::ListVentasByUser("sql@prueba.org"),"\n" . "Ventas de un Usuario por Email");

echo Ventas::PrintData(Ventas::ListVentasBySabor("Calabreza"),"\n" . "Lista de ventas segun sabor");


?>