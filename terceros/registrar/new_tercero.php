<?php
require '../../config/autoload.php';
include_once '../../config/Conexion.php';
$datos = [
    'id_tdoc'       =>  '1',
    'no_doc'        =>  '123456780',
    'nombre1'       =>  'nombre1',
    'nombre2'       =>  'nombre2',
    'apellido1'     =>  'apellido1',
    'apellido2'     =>  'apellido2',
    'razon social'  =>  'razon social',
    'genero'        =>  'M',
    'id_pais'       =>  '1',
    'id_dpto'       =>  '1',
    'id_municipio'  =>  '1',
    'direccion'     =>  'direccion',
    'correo'        =>  'correo',
    'telefono'      =>  'telefono',
    'fec_reg'       =>  '2020-01-01',
    'user_reg'      =>  '1',
    'id_tercero'    =>  '2'
];
$tercero = new Tercero($datos);
$res = $tercero->Modificar();
print_r($res);
