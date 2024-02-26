<?php
class Category
{
    private $nombre;
    private $descripcion;
    private $estado;
    

    public function __construct($datos)
    {
        $this->nombre = $datos['nombre'];
        $this->descripcion = $datos['descripcion'];
        $this->estado = $datos['estado'];
                
    }

    public function RegistrarCategory(): string
    {
        try {
            $response = ['status' => 'Error', 'message' => ''];
            $conexion = new Conexion();
            $cmd = $conexion->PDO();

            $sql = "INSERT INTO `tb_categorias` 
                        (`nombre`, `descripcion`, `estado`)
                    VALUES (?, ?, ?)";
            $sql = $cmd->prepare($sql);
            $sql->bindParam(1, $this->nombre);
            $sql->bindParam(2, $this->descripcion);
            $sql->bindParam(3, $this->estado);
            $sql->execute();
            if ($cmd->lastInsertId() > 0) {
                $response['status'] = 'ok';
            } else {
                $response['message'] = $sql->errorInfo()[2];
            }
        } catch (PDOException $e) {
            $response['message'] = $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getMessage();
        }
        return json_encode($response);
    }
}    


