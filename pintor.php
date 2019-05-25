<?php
require_once 'pintor.entidad.php';
require_once 'pintor.model.php';

// Logica
$alm = new Pintor();
$model = new PintorModel();
$nombre = '';

if(isset($_REQUEST['action']))
{

    switch($_REQUEST['action'])
    {
        case 'actualizar':
            $alm->__SET('idPintor',              $_REQUEST['idPintor']);
            $alm->__SET('nombre',     $_REQUEST['nombre']);
            $alm->__SET('pais',        $_REQUEST['pais']);
            $alm->__SET('fechaNacimiento',          $_REQUEST['fechaNacimiento']);
            $alm->__SET('fechaFallecimiento',          $_REQUEST['fechaFallecimiento']);

            include('subir.php');

            $alm->__SET('foto',        $nombre_imagen);

            $model->Actualizar($alm);
            header('Location: pintor.php');
            break;

    case 'registrar':
            $alm->__SET('idPintor',              $_REQUEST['idPintor']);
            $alm->__SET('nombre',     $_REQUEST['nombre']);
            $alm->__SET('pais',        $_REQUEST['pais']);
            $alm->__SET('fechaNacimiento',          $_REQUEST['fechaNacimiento']);
            $alm->__SET('fechaFallecimiento',          $_REQUEST['fechaFallecimiento']);

            include('subir.php');

            $alm->__SET('foto',        $nombre_imagen);

            $model->Registrar($alm);
            header('Location: pintor.php');
            break;

        case 'eliminar':
            $model->Eliminar($_REQUEST['idPintor']);
            header('Location: pintor.php');
            break;

        case 'editar':
            $alm = $model->Obtener($_REQUEST['idPintor']);
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
                
                <form action="?action=<?php echo $alm->idPintor > 0 ? 'actualizar' : 'registrar'; ?>" method="post" enctype="multipart/form-data" class="pure-form pure-form-stacked" style="margin-bottom:30px;">
                    <input type="hidden" name="idPintor" value="<?php echo $alm->__GET('idPintor'); ?>" />
                    
                    <table style="width:500px;">
                        <tr>
                            <th style="text-align:left;">ID</th>
                            <td><input type="text" name="idPintor" value="<?php echo $alm->__GET('idPintor'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">nombre</th>
                            <td><input type="text" name="nombre" value="<?php echo $alm->__GET('nombre'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">pais</th>
                            <td><input type="text" name="pais" value="<?php echo $alm->__GET('pais'); ?>" style="width:100%;" /></td>
                        </tr>
                        <tr>
                            <th style="text-align:left;">fechaNacimiento</th>
                            <td><input type="text" name="fechaNacimiento" value="<?php echo $alm->__GET('fechaNacimiento'); ?>" style="width:100%;" /></td>
                        </tr>

                        <tr>
                            <th style="text-align:left;">fechaFallecimiento</th>
                            <td><input type="text" name="fechaFallecimiento" value="<?php echo $alm->__GET('fechaFallecimiento'); ?>" style="width:100%;" /></td>
                        </tr>

                       
                            <tr>
                                <td style="text-align:left;">Imagen</td>
                                <td><input type="file" name="foto" value="" style="width:100%;" /></td>
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
                            <th style="text-align:left;">ID</th>
                            <th style="text-align:left;">nombre</th>
                            <th style="text-align:left;">pais</th>
                            <th style="text-align:left;">fechaNacimiento</th>
                            <th style="text-align:left;">fechaFallecimiento</th>
                            <th style="text-align:left;">Imagen</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <?php foreach($model->Listar() as $r): ?>
                        <tr>
                            <td><?php echo $r->__GET('idPintor'); ?></td>
                            <td><?php echo $r->__GET('nombre'); ?></td>
                            <td><?php echo $r->__GET('pais'); ?></td>
                            <td><?php echo $r->__GET('fechaNacimiento'); ?></td>
                            <td><?php echo $r->__GET('fechaFallecimiento'); ?></td>

                            <td><img src="/imagen/<?php echo $r->__GET('imagen'); ?>" alt="Girl in a jacket" width="100" height="100">       </td>


                            <td>
                                <a href="?action=editar&id=<?php echo $r->idPintor; ?>">Editar</a>
                            </td>
                            <td>
                                <a href="?action=eliminar&id=<?php echo $r->idPintor; ?>">Eliminar</a>
                            </td>

                        </tr>
                    <?php endforeach; ?>
                </table>     
              
            </div>
        </div>

    </body>
</html>



