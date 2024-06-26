<?php

require_once('CasaDeComidas.php');
require_once('Cliente.php');
require_once('Plato.php');
require_once('Pedido.php');
require_once('Conexion.php');
require_once('DetallePedido.php');
require_once('main.php');

echo "========= Bienvenido al Gestor Pedidos/Clientes/Platos ========= \n";
$nombre = readline("Nombre de la casa de comidas:\n");
$casaDeComidas = new CasaDeComidas($nombre);
$casaDeComidas->getNombre();

function menu($titulo, $opciones) {
    echo (PHP_EOL);
    echo ($titulo.PHP_EOL);

    foreach ($opciones as $opcion) {
        echo ($opcion[0] .'- '. $opcion[1]. PHP_EOL );
    } 
    echo ("==================================".PHP_EOL);
    $opcion = readline('Ingrese una opcion: ');

    if (!isset($opciones[$opcion])) {
        return false; 
    }
    
    $funcion = $opciones[$opcion][2];

    if (isset($opciones[$opcion][3])) {
        $parametros = $opciones[$opcion][3];
        call_user_func_array($funcion, $parametros);
    } else {
        call_user_func($funcion);
    }

}
function menuPrincipal($casaDeComidas){
    $opcionesPrincipales = [
        ['0', 'Salir', 'salir'],
        ['1', 'Gestionar Clientes', 'menuClientes', [$casaDeComidas]],
        ['2', 'Gestionar Pedidos', 'menuPedidos', [$casaDeComidas]],
        ['3', 'Gestionar Platos', 'menuPlatos', [$casaDeComidas]],
        ['4', 'Ver Facturacion Total Por Dia', 'registroFacturacionTotalPorDia', [$casaDeComidas]]
    ];

    $opcionValida = menu('============ Menu Principal ============', $opcionesPrincipales);
    if (!$opcionValida) {
        echo ("Error: Opcion no valida.\n").PHP_EOL;
        menuPrincipal($casaDeComidas);
    }else if ($opcionValida == 0){
        echo ("").PHP_EOL;
    }
}
function salir(){
    echo ("Cerrando Sesion...");
    exit;
}
menuPrincipal($casaDeComidas);
function menuClientes($casaDeComidas) {
    $opcionesClientes = [
        ['0', 'Volver', 'menuPrincipal', [$casaDeComidas]],
        ['1', 'Agregar Cliente', 'agregarCliente', [$casaDeComidas]],
        ['2', 'Borrar Cliente', 'borrarCliente', [$casaDeComidas]],
        ['3', 'Modificar Cliente', 'modificarCliente', [$casaDeComidas]],
        ['4', 'Listar Clientes', 'listarClientes', [$casaDeComidas]]
    ];
    menu('============ Clientes ============', $opcionesClientes);
}
function menuPedidos($casaDeComidas) {
    $opcionesClientes = [
        ['0', 'Volver', 'menuPrincipal', [$casaDeComidas]],
        ['1', 'Agregar Pedido', 'agregarPedido', [$casaDeComidas]],
        ['2', 'Borrar Pedido', 'borrarPedido', [$casaDeComidas]],
        ['3', 'Modificar Estado del Pedido', 'modificarEstadoPedido', [$casaDeComidas]],
        ['4', 'Modificar Datos del Pedido', 'modificarDatosPedido', [$casaDeComidas]],
        ['5', 'Modificar Contenido del Pedido', 'modificarContenidoPedido', [$casaDeComidas]],
        ['6', 'Listar Pedidos', 'listarPedidos', [$casaDeComidas]]
    ];
    menu('============ Pedidos ============', $opcionesClientes);
}
function estadoPedidos($casaDeComidas) {
    $opcionesClientes = [
        ['0', 'Volver', 'menuPrincipal', [$casaDeComidas]],
        ['1', 'Ver Pedidos En Preparacion', 'listarPedidoPorEstado', [$casaDeComidas, "En Preparacion"]],
        ['2', 'Ver Pedidos En Camino', 'listarPedidoPorEstado', [$casaDeComidas, "En Camino"]],
        ['3', 'Ver Pedidos Entregados', 'listarPedidoPorEstado', [$casaDeComidas, "Entregado"]]
    ];
    menu('============ Estado de los Pedidos ============', $opcionesClientes);
}
function menuPlatos($casaDeComidas) {
    $opcionesClientes = [
        ['0', 'Volver', 'menuPrincipal', [$casaDeComidas]],
        ['1', 'Agregar Plato', 'agregarPlato', [$casaDeComidas]],
        ['2', 'Borrar Plato', 'borrarPlato', [$casaDeComidas]],
        ['3', 'Modificar Plato', 'modificarPlato', [$casaDeComidas]],
        ['4', 'Listar Platos', 'listarPlatos', [$casaDeComidas]]
    ];
    menu('============ Platos ============', $opcionesClientes);
}