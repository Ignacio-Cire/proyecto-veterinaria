<?php 
include_once '../estructura/nav-seguro.php';
include_once '../../../configuracion.php';
include_once '../../controller/session.php';

// Crear la instancia de la clase Session
$objSession = new Session();

// Verificar si el usuario está autenticado
if (!$objSession->validar()) {
    header('Location: login.php');
    exit;
}

// Obtener el rol del usuario desde la sesión
$rolUsuario = $objSession->getRol(); // Esto te dará el rol del usuario
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../assests/css/style.css">
</head>
<body>

<div class="container mt-5">
    <h1>Bienvenido a tu Dashboard, <?php echo htmlspecialchars($objSession->getUsuario()); ?>!</h1>
<br>
    <!-- Ejemplo de contenido del dashboard -->
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Información de tu cuenta
                </div>
                <div class="card-body">
                    <p><strong>Nombre:</strong> <?php echo htmlspecialchars($objSession->getUsuario()); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($objSession->getEmail()); ?></p>
                    <!-- Botón para cerrar sesión -->
                <form action="../Login/logout.php" method="POST">
                    <button type="submit" class="btn btn-danger mt-3">Cerrar Sesión</button>
                </form>

    <br>
                </div>
            </div>
        </div>

        <!-- Mostrar opciones solo para administradores -->
        <?php if ($rolUsuario == 1): ?>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Gestión Administrativa
                </div>
                <div class="card-body">
            <div id="toolbar">
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-add" plain="true" onclick="newMenu()">Nuevo Menu </a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-edit" plain="true" onclick="editMenu()">Editar Menu</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-remove" plain="true" onclick="destroyMenu()">Baja Menu</a>
            </div>
            
            <div id="dlg" class="easyui-dialog" style="width:600px" data-options="closed:true,modal:true,border:'thin',buttons:'#dlg-buttons'">
            <form id="fm" method="post" novalidate style="margin:0;padding:20px 50px">
            <h3>Menu Informacion</h3>
            <div style="margin-bottom:10px">
            
                      
            <input name="menombre" id="menombre"  class="easyui-textbox" required="true" label="Nombre:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
            <input  name="medescripcion" id="medescripcion"  class="easyui-textbox" required="true" label="Descripcion:" style="width:100%">
            </div>
            <div style="margin-bottom:10px">
             
            </div>
              <div style="margin-bottom:10px">
            <input class="easyui-checkbox" name="medeshabilitado" value="medeshabilitado" label="Des-Habilitar:">
        </div>
            </form>
            </div>
            <div id="dlg-buttons">
            <a href="javascript:void(0)" class="easyui-linkbutton c6" iconCls="icon-ok" onclick="saveMenu()" style="width:90px">Aceptar</a>
            <a href="javascript:void(0)" class="easyui-linkbutton" iconCls="icon-cancel" onclick="javascript:$('#dlg').dialog('close')" style="width:90px">Cancelar</a>
            </div>
            <script type="text/javascript">
            var url;
            function newMenu(){
                $('#dlg').dialog('open').dialog('center').dialog('setTitle','Nuevo Menu');
                $('#fm').form('clear');
                url = 'accion/alta_menu.php';
            }
            function editMenu(){
                var row = $('#dg').datagrid('getSelected');
                if (row){
                    $('#dlg').dialog('open').dialog('center').dialog('setTitle','Editar Menu');
                    $('#fm').form('load',row);
                    url = 'accion/edit_menu.php?accion=mod&idmenu='+row.idmenu;
                }
            }
            function saveMenu(){
            	//alert(" Accion");
                $('#fm').form('submit',{
                    url: url,
                    onSubmit: function(){
                        return $(this).form('validate');
                    },
                    success: function(result){
                        var result = eval('('+result+')');

                        alert("Volvio Serviodr");   
                        if (!result.respuesta){
                            $.messager.show({
                                title: 'Error',
                                msg: result.errorMsg
                            });
                        } else {
                           
                            $('#dlg').dialog('close');        // close the dialog
                            $('#dg').datagrid('reload');    // reload 
                        }
                    }
                });
            }
            function destroyMenu(){
                var row = $('#dg').datagrid('getSelected');
                if (row){
                    $.messager.confirm('Confirm','Seguro que desea eliminar el menu?', function(r){
                        if (r){
                            $.post('accion/eliminar_menu.php?idmenu='+row.idmenu,{idmenu:row.id},
                               function(result){
                               	 alert("Volvio Serviodr");   
                                 if (result.respuesta){
                                   	 
                                    $('#dg').datagrid('reload');    // reload the  data
                                } else {
                                    $.messager.show({    // show error message
                                        title: 'Error',
                                        msg: result.errorMsg
                                  });
                                }
                            },'json');
                        }
                    });
                }
            }
            </script>
                </div>
            </div>
        </div>
        <?php endif; ?>

    </div>
    <br>

</div>
<?php 
    include_once '../estructura/footer.php'; 
    ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
