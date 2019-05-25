<?php
require_once 'pintor.entidad.php';
require_once 'pintor.model.php';
require_once 'funciones.php';

// Logica
//error_reporting(E_ALL ^ E_NOTICE);

$pro = new pintor();
$modelo = new pintorModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$pro->__SET('id',              $_REQUEST['id']);
			$pro->__SET('nombre',        $_REQUEST['nombre']);
			$pro->__SET('ciudad',          $_REQUEST['ciudad']);
			$pro->__SET('pais',            $_REQUEST['pais']);
			$pro->__SET('nacimiento',            $_REQUEST['nacimiento']);
			$pro->__SET('muerte',            $_REQUEST['muerte']);
			$pro->__SET('Imagen',            $_REQUEST['n_img']);

			$modelo->Actualizar($pro);
			header('Location: pintor.php');
			break;

		case 'registrar':
			$pro->__SET('nombre',        $_REQUEST['nombre']);
			$pro->__SET('ciudad',          $_REQUEST['ciudad']);
			$pro->__SET('pais',            $_REQUEST['pais']);
			$pro->__SET('nacimiento',            $_REQUEST['nacimiento']);
			$pro->__SET('muerte',            $_REQUEST['muerte']);
			$pro->__SET('Imagen',            $_REQUEST['n_img']);
            $modelo->Registrar($pro);
            subir_fichero('dir','campofotografia');
			header('Location: pintor.php');
			break;

		case 'eliminar':
			$modelo->Eliminar($_REQUEST['id']);
			header('Location: pintor.php');
			break;

		case 'editar':
			$pro = $modelo->Obtener($_REQUEST['id']);
			break;
	}
}

?>

<!DOCTYPE html>
<html lang="es">
	<head>
		<title>Mantenimiento</title>
        <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0/pure-min.css">
	</head>
    <body style="padding:15px;">

        <div class="pure-g">
            <div class="pure-u-1-12">
		
                <form enctype="multipart/form-data" action="?action=<?php echo $pro->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="id" value="<?php echo $pro->__GET('id'); ?>" />
              					
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">nombre</th>
                            <td><input type="text" name="nombre" value="<?php echo $pro->__GET('nombre'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">ciudad</th>
                            <td><input type="text" name="ciudad" value="<?php echo $pro->__GET('ciudad'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">pais</th>
                            <td><input type="text" name="pais" value="<?php echo $pro->__GET('pais'); ?>" style="width:100%;" /></td>
                        </tr>
						 <tr>
                            <th style="text-align:left;">nacimiento</th>
                            <td><input type="text" name="pais" value="<?php echo $pro->__GET('pais'); ?>" style="width:100%;" /></td>
                        </tr>
						 <tr>
                            <th style="text-align:left;">muerte</th>
                            <td><input type="text" name="pais" value="<?php echo $pro->__GET('pais'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                                <th style="text-align:left;">Imagen</th>
                               <td><input id="campofotografia" name="campofotografia" type="image" /></td>
                                   
                        </tr>
						<tr>
                            <th style="text-align:left;"n_img</th>
                             <td><input type="text" name="n_img"/></td>
                        </tr>
                        <tr>
                            <td colspan="2">
								<button type="submit" class="pure-button pure-button-primary">Guardar</button>
                            </td>
                        </tr>
                    </table>
                </form>

                <table class="pure-table pure-table-horizontal">
                    <thead>
                        <tr>
                            <th style="text-align:left;">nombre</th>
                            <th style="text-align:left;">ciudad</th>
                            <th style="text-align:left;">pais</th>
							<th style="text-align:left;">nacimiento</th>
							<th style="text-align:left;">muerte</th>
							<th style="text-align:left;">Imagen</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($modelo->Listar() as $r): ?>
                        <tr>
							<td><?php echo $r->__GET('nombre'); ?></td>
                            <td><?php echo $r->__GET('ciudad'); ?></td>
                            <td><?php echo $r->__GET('pais'); ?></td>
							<td><?php echo $r->__GET('nacimiento'); ?></td>
							<td><?php echo $r->__GET('muerte'); ?></td>
							<td><img src="dir/<?php echo $r->__GET('Imagen'); ?>" alt="<?php echo $r->__GET('Imagen'); ?>"></td>
                            <td>
                                <a href="?action=editar&id=<?php echo $r->id; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&id=<?php echo $r->id; ?>">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>

    </body>
</html>