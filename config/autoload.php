<?php
function autoCargador($clase)
{
    $archivo = '../../Clases/' . $clase . '.php';
    include $archivo;
}

spl_autoload_register('autoCargador');
