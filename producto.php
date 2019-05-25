<?php
require_once 'producto.entidad.php';
require_once 'producto.model.php';
require_once 'funciones.php';

// Logica
//error_reporting(E_ALL ^ E_NOTICE);

$pro = new producto();
$modelo = new ProductoModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$pro->__SET('id',              $_REQUEST['id']);
			$pro->__SET('Descripcion',        $_REQUEST['Descripcion']);
			$pro->__SET('Precio',          $_REQUEST['Precio']);
			$pro->__SET('Stock',            $_REQUEST['Stock']);
			$pro->__SET('Imagen',            $_REQUEST['n_img']);

			$modelo->Actualizar($pro);
			header('Location: producto.php');
			break;

		case 'registrar':
			$pro->__SET('Descripcion',        $_REQUEST['Descripcion']);
			$pro->__SET('Precio',          $_REQUEST['Precio']);
			$pro->__SET('Stock',            $_REQUEST['Stock']);
			$pro->__SET('Imagen',            $_REQUEST['n_img']);
            $modelo->Registrar($pro);
            subir_fichero('dir','campofotografia');
			header('Location: producto.php');
			break;

		case 'eliminar':
			$modelo->Eliminar($_REQUEST['id']);
			header('Location: producto.php');
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
                            <th style="text-align:left;">Descripcion</th>
                            <td><input type="text" name="Descripcion" value="<?php echo $pro->__GET('Descripcion'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Precio</th>
                            <td><input type="text" name="Precio" value="<?php echo $pro->__GET('Precio'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Stock</th>
                            <td><input type="text" name="Stock" value="<?php echo $pro->__GET('Stock'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                                <th style="text-align:left;">Imagen</th>
                               <td><input id="campofotografia" name="campofotografia" type="file" /></td>
                                   
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
                            <th style="text-align:left;">Descripcion</th>
                            <th style="text-align:left;">Precio</th>
                            <th style="text-align:left;">Stock</th>
							<th style="text-align:left;">Imagen</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($modelo->Listar() as $r): ?>
                        <tr>
							<td><?php echo $r->__GET('Descripcion'); ?></td>
                            <td><?php echo $r->__GET('Precio'); ?></td>
                            <td><?php echo $r->__GET('Stock'); ?></td>
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