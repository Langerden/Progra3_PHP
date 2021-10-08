<?php

class Pizza
{
    public $id;
    public $sabor;
    public $precio;
    public $tipo;
    public $cantidad;
    public $image;

    public function __construct($id, $sabor, $precio, $tipo, $cantidad, $image = "")
    {
        $this->id = $id;
        $this->sabor = $sabor;
        $this->precio = $precio;
        $this->tipo = $tipo;
        $this->cantidad = $cantidad;
        $this->image = $image;    
    }

    
    public function getId()
    {
        return $this->id;
    }
    
    public function getSabor()
    {
        return $this->sabor;
    }
    
    public function getPrecio()
    {
        return $this->precio;
    }
    
    public function getTipo()
    {
        return $this->tipo;
    }
    
    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function getImage(){
        return $this->image;    
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setSabor($sabor)
    {
        $this->sabor = $sabor;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    
    public function setImage($image)
    {
        $this->image = $image;
    }

    public function __toString()
    {
        return $this->id . " - " . $this->sabor . " - " . $this->precio . " - " . $this->tipo . " - " . $this->cantidad;
    }

    //Equals
    public function equals($pizza)
    {
        return $this->sabor == $pizza->sabor && $this->tipo == $pizza->tipo;
    }
    
public static function SaveToJson($array, $filename = "Pizza.json")
{
    try {
        $file = fopen($filename, "w");
        $json = json_encode($array, JSON_PRETTY_PRINT);
        fwrite($file, $json);
        return true;
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } finally {
        fclose($file);
    }
    return false;
}

public static function ReadJson($filename = "Pizza.json")
{
    $pizzas = array();
    try {
        if (file_exists($filename)) {
            $archivo = fopen($filename, 'r');
            $json = fread($archivo, filesize($filename));
            $arrayJson = json_decode($json, true);
            foreach ($arrayJson as $pizza) {
                array_push($pizzas, new Pizza($pizza['id'], $pizza['sabor'], $pizza['precio'], $pizza['tipo'], $pizza['cantidad']));
            }
            fclose($archivo);
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    } 
    return $pizzas;
}

public function SaveFilesPizza ($directorio)
{        
    //Extensión del archivo
    $tipoArchivo = strtolower(pathinfo($this->image["name"], PATHINFO_EXTENSION));        
    
    //Nombre a settear al file
    $nombreModificado = $this->tipo . "+" . $this->sabor . "+" . "." . $tipoArchivo;
    // echo $nombreModificado . " <br>";
    
    $destino = $directorio . $nombreModificado;
    // echo $destino . " <br>";
    
    move_uploaded_file($this->image["tmp_name"],$destino);
    
    $this->image =$destino;
}


}
?>