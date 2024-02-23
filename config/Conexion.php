<?php
class Conexion
{
    private $bd_driver = "mysql";
    private $bd_servidor = "localhost:3308";
    private $bd_base = "contable";
    private $charset = "charset=utf8";
    private $bd_usuario = "root";
    private $bd_clave = "12345";
    private $conexion;
    public $urlin = '/papeleria';

    public function __construct()
    {
        try {
            $this->conexion = new PDO(
                $this->bd_driver . ":host=" . $this->bd_servidor . ";dbname=" . $this->bd_base . ";" . $this->charset,
                $this->bd_usuario,
                $this->bd_clave
            );
            $this->conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        } catch (PDOException $e) {
            throw new Exception("Error de conexión a la base de datos: " . $e->getMessage());
        }
    }

    public function PDO()
    {
        $this->conexion->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $this->conexion;
    }
    public function Cerrar()
    {
        $this->conexion = null;
    }
}
