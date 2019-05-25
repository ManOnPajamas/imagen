<?php
require_once 'funciones.php';

if(!empty($_POST)){
      if (subir_fichero('dir','campofotografia'))
         echo 'Archivo recibido correctamente';
}
?>