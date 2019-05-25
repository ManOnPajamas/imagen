<?php
require_once 'curso.entidad.php';
require_once 'curso.model.php';

// Logica
$cur = new Curso();
$modelo = new CursoModel();

if(isset($_REQUEST['action']))
{
	switch($_REQUEST['action'])
	{
		case 'actualizar':
			$cur->__SET('id',              $_REQUEST['id']);
			$cur->__SET('Codigo',        $_REQUEST['Codigo']);
			$cur->__SET('Nombre',          $_REQUEST['Nombre']);
			$cur->__SET('Creditos',            $_REQUEST['Creditos']);

			$modelo->Actualizar($cur);
			header('Location: curso.php');
			break;

		case 'registrar':
			$cur->__SET('Codigo',        $_REQUEST['Codigo']);
			$cur->__SET('Nombre',          $_REQUEST['Nombre']);
			$cur->__SET('Creditos',            $_REQUEST['Creditos']);

			$modelo->Registrar($cur);
			header('Location: curso.php');
			break;

		case 'eliminar':
			$modelo->Eliminar($_REQUEST['id']);
			header('Location: curso.php');
			break;

		case 'editar':
			$cur = $modelo->Obtener($_REQUEST['id']);
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
                
                <form action="?action=<?php echo $cur->id > 0 ? 'actualizar' : 'registrar'; ?>" method="post" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="id" value="<?php echo $cur->__GET('id'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">Codigo</th>
                            <td><input type="text" name="Codigo" value="<?php echo $cur->__GET('Codigo'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Nombre</th>
                            <td><input type="text" name="Nombre" value="<?php echo $cur->__GET('Nombre'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">Creditos</th>
                            <td><input type="text" name="Creditos" value="<?php echo $cur->__GET('Creditos'); ?>" style="width:100%;" /></td>
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
                            <th style="text-align:left;">Codigo</th>
                            <th style="text-align:left;">Nombre</th>
                            <th style="text-align:left;">Creditos</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($modelo->Listar() as $r): ?>
                        <tr>
							<td><?php echo $r->__GET('Codigo'); ?></td>
                            <td><?php echo $r->__GET('Nombre'); ?></td>
                            <td><?php echo $r->__GET('Creditos'); ?></td>
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