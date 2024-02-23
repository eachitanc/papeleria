<?php
class Usuario
{
    private $user;
    private $clave;
    private $id_rol;
    private $estado;
    private $id_tercero;
    private $fec_reg;
    private $user_reg;
    public function __construct($datos)
    {
        $this->user = $datos['user'];
        $this->clave = $datos['clave'];
        $this->id_rol = $datos['id_rol'];
        $this->estado = $datos['estado'];
        $this->fec_reg = $datos['fec_reg'];
        $this->user_reg = $datos['user_reg'];
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
                        (`user`, `clave`, `id_rol`, `estado`, `fec_reg`,`id_user_reg`, `id_tercero`)
                    VALUES (?, ?, ?, ?, ?, ?, ?)";
            $sql = $cmd->prepare($sql);
            $sql->bindParam(1, $this->user);
            $sql->bindParam(2, $this->clave);
            $sql->bindParam(3, $this->id_rol);
            $sql->bindParam(4, $this->estado);
            $sql->bindParam(5, $this->fec_reg);
            $sql->bindParam(6, $this->user_reg);
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
                        `user` = ?, `clave`= ?,  `id_rol`= ?, `estado`= ?, `fec_reg`= ?, `user_reg`
                    WHERE `id_tercero` = ?";
            $sql = $cmd->prepare($sql);
            $sql->bindParam(1, $this->user);
            $sql->bindParam(2, $this->clave);
            $sql->bindParam(3, $this->id_rol);
            $sql->bindParam(4, $this->estado);
            $sql->bindParam(5, $this->fec_reg);
            $sql->bindParam(6, $this->user_reg);
            $sql->bindParam(7, $this->id_tercero);
            $sql->execute();
            if ($sql->rowCount() > 0) {
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
