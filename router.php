<?php

$pagina = $_GET['pagina'] ?? false;

$include = filter_var("{$pagina}.php",FILTER_SANITIZE_STRING);

if(!file_exists($include)) {

    echo 'seu raquer!!';
    die;


}

require($include);