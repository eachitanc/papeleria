<?php
class Usuario
{
    private $user;
    private $clave;
    private $id_rol;
    private $estado;
    private $id_tercero;
    private $id_usuario;
    private $fecha;
    private $usuario;
    public function __construct($datos)
    {
        $this->user = $datos['user'];
        $this->clave = $datos['clave'];
        $this->id_rol = $datos['id_rol'];
        if (isset($datos['estado'])) {
            $this->estado = $datos['estado'];
        }
        if (isset($datos['id_usuario'])) {
            $this->id_usuario = $datos['id_usuario'];
        }
        $this->fecha = $datos['fecha'];
        $this->usuario = $datos['usuario'];
        if (isset($datos['id_tercero'])) {
            $this->id_tercero = $datos['id_tercero'];
        }
    }

    public function Registrar(): string
    {
        try {
            $response = ['status' => 'Error', 'message' => ''];
            $conexion = new Conexion();
            $cmd = $conexion->PDO();

            $sql = "INSERT INTO `seg_usuarios` 
                        (`user`, `clave`, `id_rol`, `estado`, `fec_reg`,`user_reg`, `id_tercero`)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $sql = $cmd->prepare($sql);
            $sql->bindParam(1, $this->user);
            $sql->bindParam(2, $this->clave);
            $sql->bindParam(3, $this->id_rol);
            $sql->bindParam(4, $this->estado);
            $sql->bindParam(5, $this->fecha);
            $sql->bindParam(6, $this->usuario);
            $sql->bindParam(7, $this->id_tercero);
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
    public function Modificar(): string
    {
        try {
            $response = ['status' => 'Error', 'message' => ''];
            $conexion = new Conexion();
            $cmd = $conexion->PDO();

            $sql = "UPDATE `seg_usuarios` SET 
                        `user` =  ?, `clave`= ?,  `id_rol`= ?
                    WHERE `id_user` = ?";
            $sql = $cmd->prepare($sql);
            $sql->bindParam(1, $this->user);
            $sql->bindParam(2, $this->clave);
            $sql->bindParam(3, $this->id_rol);
            $sql->bindParam(4, $this->id_usuario);
            if (!($sql->execute())) {
                $response['message'] = $sql->errorInfo()[2];
            } else {
                $response['status'] = 'ok';
                if ($sql->rowCount() > 0) {
                    $sql = "UPDATE `seg_usuarios` SET 
                               `fec_act`= ?, `user_act` = ?
                            WHERE `id_user` = ?";
                    $sql = $cmd->prepare($sql);
                    $sql->bindParam(1, $this->fecha);
                    $sql->bindParam(2, $this->usuario);
                    $sql->bindParam(3, $this->id_usuario);
                    $sql->execute();
                    $response['message'] = '1';
                } else {
                    $response['message'] = '0';
                }
            }
        } catch (PDOException $e) {
            $response['message'] = $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getMessage();
        }
        return json_encode($response);
    }
    public function Eliminar(): string
    {
        try {
            $response = ['status' => 'Error', 'message' => ''];
            $conexion = new Conexion();
            $cmd = $conexion->PDO();

            $sql = "DELETE FROM `seg_usuarios` WHERE `id_user` = ?";
            $sql = $cmd->prepare($sql);
            $sql->bindParam(1, $this->id_usuario);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $response['status'] = 'ok';
                $response['message'] = '1';
            } else {
                $response['message'] = '0';
            }
        } catch (PDOException $e) {
            $response['message'] = $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getMessage();
        }
        return json_encode($response);
    }
}
