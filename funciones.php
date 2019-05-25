<?php

function subir_fichero($dir, $imagen)
{
    $tmp_name = $_FILES[$imagen]['tmp_name'];
    //si hemos enviado un directorio que existe realmente y hemos subido el archivo    
    if (is_dir($dir) && is_uploaded_file($tmp_name))
    {
        $img_file = $_FILES[$imagen]['name'];
        $img_type = $_FILES[$imagen]['type'];
        echo 1;
        // Si se trata de una imagen   
        if (((strpos($img_type, "gif") || strpos($img_type, "jpeg") ||
 strpos($img_type, "jpg")) || strpos($img_type, "png")))
        {
            //¿Tenemos permisos para subir la imágen?
            echo 2;
            if (move_uploaded_file($tmp_name, $dir . '/' . $img_file))
            {
                return true;
            }
        }
    }
    //Si llegamos hasta aquí es que algo ha fallado
    return false;
}
?>