<?php

// a- (1 pts.) AltaVenta.php: (por POST)se recibe el email del usuario y el sabor,tipo y cantidad ,si el ítem existe en
// Pizza.json, y hay stock guardar en la base de datos( con la fecha, número de pedido y id autoincremental ) y se
// debe descontar la cantidad vendida del stock .

include_once "AccesoDatos.php";

class Ventas {
    public $emailUser;
    public $sabor;
    public $tipo;
    public $cantidad;
    public $fecha;
    public $numPedido;
    public $id;
    public $file;

    public function __construct()
    {
        
    }

    public static function CreateVenta($emailUser,$sabor,$tipo,$cantidad)
    {
        $venta = new Ventas();
        $venta->emailUser = $emailUser;
        $venta->sabor = $sabor;
        $venta->tipo = $tipo;
        $venta->cantidad = $cantidad;
        return $venta;
    }


    public function SaveFilesVentas ($file, $directorio)
    {        
        //Extensión del archivo
        $tipoArchivo = strtolower(pathinfo($file["name"], PATHINFO_EXTENSION));        
        
        //Nombre a settear al file
        $nombreModificado = $this->tipo . "_" . $this->sabor . "_" . explode('@', $this->emailUser)[0] . "_" . date('Y-m-d') . "." . $tipoArchivo;
        echo $nombreModificado . " <br>";
        
        $destino = $directorio . $nombreModificado;
        echo $destino . " <br>";
        
        move_uploaded_file($file["tmp_name"],$destino);
        
        $this->file =$destino;
    }


    public static function InsertarVentasParametros( $emailUser, $sabor, $tipo, $cantidad, $numPedido){
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("INSERT INTO ventas (email, sabor, tipo, cantidad, fecha, numPedido)
        VALUES (:email,:sabor,:tipo,:cantidad,:fecha, :numPedido);");
        $consulta->bindValue(':email', $emailUser, PDO::PARAM_STR);
        $consulta->bindValue(':sabor', $sabor, PDO::PARAM_STR);
        $consulta->bindValue(':tipo', $tipo, PDO::PARAM_STR);
        $consulta->bindValue(':cantidad', $cantidad, PDO::PARAM_INT);
        $consulta->bindValue(':fecha', date('Y/m/d') , PDO::PARAM_STR);
        $consulta->bindValue(':numPedido', $numPedido, PDO::PARAM_INT);
        $consulta->execute();
        return $objetoAccesoDato->RetornarUltimoIdInsertado();
    }

    public static function UpdateVenta( $emailUser, $sabor, $tipo, $cantidad, $fecha, $numPedido)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("UPDATE ventas SET
        email='$emailUser',
        sabor='$sabor',
        tipo='$tipo',
        cantidad='$cantidad',
        fecha ='$fecha'
        WHERE numPedido = $numPedido;");
        return $consulta->execute();        
    }

    public static function DeleteVenta($numPedido)
    {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("DELETE FROM ventas WHERE numPedido = $numPedido;");
        return $consulta->execute();        
    }

    //b- el listado de ventas entre dos fechas ordenado por sabor.
    //SELECT * FROM `ventas` WHERE ventas.fecha BETWEEN '2014/01/01' AND '2017-01-15' ORDER BY sabor;
    public static function ListBetweenDates($dateFrom, $dateTo) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT
        id as id,
        email as emailUser,
        sabor as sabor,
        tipo as tipo,
        cantidad as cantidad,
        fecha as fecha,
        numPedido as numPedido
        FROM ventas
        WHERE fecha BETWEEN '$dateFrom' AND '$dateTo'
        ORDER BY sabor;");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Ventas");        
    }
    
    // "Ventas entre dos fechas ordenado por sabor \n" .
    public static function PrintData($array, $mensaje){
        if(count($array) > 0){
            echo strtoupper($mensaje);
            foreach ($array as $value) {
                echo "\n";
                echo "id: ".$value->id."\n";
                echo "email: ".$value->emailUser."\n";
                echo "sabor: ".$value->sabor."\n";
                echo "tipo: ".$value->tipo."\n";
                echo "cantidad: ".$value->cantidad."\n";
                echo "fecha: ".$value->fecha."\n";
                echo "numPedido: ".$value->numPedido."\n";
            }          
        }
    }

    //c- el listado de ventas de un usuario ingresado
    public static function ListVentasByUser($email) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT
        id as id,
        email as emailUser,
        sabor as sabor,
        tipo as tipo,
        cantidad as cantidad,
        fecha as fecha,
        numPedido as numPedido
        FROM ventas
        WHERE email = '$email';");        
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Ventas");        
    }

    //d- el listado de ventas de un sabor ingresado
    public static function ListVentasBySabor($sabor) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT
        id as id,
        email as emailUser,
        sabor as sabor,
        tipo as tipo,
        cantidad as cantidad,
        fecha as fecha,
        numPedido as numPedido
        FROM ventas
        WHERE sabor = '$sabor';");        
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Ventas");        
    }

    public static function FindByNumPedido($numeroPedido) {
        $objetoAccesoDato = AccesoDatos::dameUnObjetoAcceso();
        $consulta = $objetoAccesoDato->RetornarConsulta("SELECT
        id as id,
        email as emailUser,
        sabor as sabor,
        tipo as tipo,
        cantidad as cantidad,
        fecha as fecha,
        numPedido as numPedido
        FROM ventas
        WHERE numPedido = '$numeroPedido';");
        $consulta->execute();
        return $consulta->fetchAll(PDO::FETCH_CLASS, "Ventas");        
    }

}


?>

