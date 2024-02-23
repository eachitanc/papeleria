<?php
class Tercero
{
    private $id_tdoc;
    private $no_doc;
    private $nombre1;
    private $nombre2;
    private $apellido1;
    private $apellido2;
    private $razon_social;
    private $genero;
    private $id_pais;
    private $id_dpto;
    private $id_municipio;
    private $direccion;
    private $correo;
    private $telefono;
    private $fec_reg;
    private $user_reg;
    private $id_tercero;
    public function __construct($datos)
    {
        $this->id_tdoc = $datos['id_tdoc'];
        $this->no_doc = $datos['no_doc'];
        $this->nombre1 = $datos['nombre1'];
        $this->nombre2 = $datos['nombre2'];
        $this->apellido1 = $datos['apellido1'];
        $this->apellido2 = $datos['apellido2'];
        $this->razon_social = $datos['razon social'];
        $this->genero = $datos['genero'];
        $this->id_pais = $datos['id_pais'];
        $this->id_dpto = $datos['id_dpto'];
        $this->id_municipio = $datos['id_municipio'];
        $this->direccion = $datos['direccion'];
        $this->correo = $datos['correo'];
        $this->telefono = $datos['telefono'];
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

            $sql = "INSERT INTO `seg_terceros` 
                        (`id_tdoc`,`no_doc`,`nombre1`,`nombre2`,`apellido1`,`apellido2`,`razon social`,`genero`,`id_pais`,`id_dpto`,`id_municipio`,`direccion`,`correo`,`telefono`,`fec_reg`,`user_reg`)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $sql = $cmd->prepare($sql);
            $sql->bindParam(1, $this->id_tdoc);
            $sql->bindParam(2, $this->no_doc);
            $sql->bindParam(3, $this->nombre1);
            $sql->bindParam(4, $this->nombre2);
            $sql->bindParam(5, $this->apellido1);
            $sql->bindParam(6, $this->apellido2);
            $sql->bindParam(7, $this->razon_social);
            $sql->bindParam(8, $this->genero);
            $sql->bindParam(9, $this->id_pais);
            $sql->bindParam(10, $this->id_dpto);
            $sql->bindParam(11, $this->id_municipio);
            $sql->bindParam(12, $this->direccion);
            $sql->bindParam(13, $this->correo);
            $sql->bindParam(14, $this->telefono);
            $sql->bindParam(15, $this->fec_reg);
            $sql->bindParam(16, $this->user_reg);
            $sql->execute();
            if ($cmd->lastInsertId() > 0) {
                $response['status'] = 'ok';
                $response['id'] = $cmd->lastInsertId();
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

            $sql = "UPDATE `seg_terceros` SET 
                        `id_tdoc` = ?,`no_doc` = ?,`nombre1` = ?,`nombre2` = ?,`apellido1` = ?,`apellido2` = ?,`razon social` = ?,`genero` = ?,`id_pais` = ?,`id_dpto` = ?,`id_municipio` = ?,`direccion` = ?,`correo` = ?,`telefono` = ?,`fec_reg` = ?,`user_reg` = ?
                    WHERE `id_tercero` = ?";
            $sql = $cmd->prepare($sql);
            $sql->bindParam(1, $this->id_tdoc);
            $sql->bindParam(2, $this->no_doc);
            $sql->bindParam(3, $this->nombre1);
            $sql->bindParam(4, $this->nombre2);
            $sql->bindParam(5, $this->apellido1);
            $sql->bindParam(6, $this->apellido2);
            $sql->bindParam(7, $this->razon_social);
            $sql->bindParam(8, $this->genero);
            $sql->bindParam(9, $this->id_pais);
            $sql->bindParam(10, $this->id_dpto);
            $sql->bindParam(11, $this->id_municipio);
            $sql->bindParam(12, $this->direccion);
            $sql->bindParam(13, $this->correo);
            $sql->bindParam(14, $this->telefono);
            $sql->bindParam(15, $this->fec_reg);
            $sql->bindParam(16, $this->user_reg);
            $sql->bindParam(17, $this->id_tercero);
            $sql->execute();
            if ($sql->rowCount() > 0) {
                $response['status'] = 'ok';
            } else {
            }
            return json_encode($response);
        } catch (PDOException $e) {
            $response['message'] = $e->getCode() == 2002 ? 'Sin Conexión a Mysql (Error: 2002)' : 'Error: ' . $e->getMessage();
        }
        $response['message'] = $sql->errorInfo()[2];
    }
}
