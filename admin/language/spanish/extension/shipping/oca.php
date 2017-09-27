<?php
//==============================================================================
// OCA 1.1
// 
// Desarrollado por: Cofran
// E-mail: franco.iglesias@gmail.com
// Sitio Web: http://www.wachipato.com
// Soporte: http://www.wachipato.com/support
//==============================================================================

// Heading
$_['heading_title']			= 'OCA';
$_['heading_general']		= 'Configuración general';
$_['heading_config']		= 'Configuración de OCA';
$_['heading_restrinction']	= 'Restricciones';

// Buttons
$_['button_add_operativa']	= 'Agregar Operativa';
$_['button_filter']			= 'Filtrar fecha';
$_['button_tracking_envio']	= 'seguimiento';

// Tabs
$_['tab_list_envios']		= 'Listado de envios';

// Text
$_['text_shippng']			= 'Envios';
$_['text_success']			= 'Éxito: Has actualizado el modulo de OCA!';
$_['text_success_le']		= 'Éxito: Has filtrado los resultados desde <b>%s</b> hasta <b>%s</b>';
$_['text_total_min']		= 'mínimo';
$_['text_total_max']		= 'máximo';
$_['text_default']			= 'Por defecto';
$_['text_all_zone']			= 'Todas las demás Zonas';
$_['text_guest_user']		= 'Usuarios no registrados';
$_['text_idoperativa']		= 'ID de operativa';
$_['text_descripcion']		= 'Nombre / Descripción';
$_['text_sucursal']			= 'Sucursal';
$_['text_seguro']			= 'Seguro';
$_['text_prioritario']		= 'Prioritario';
$_['text_destino']			= 'Pago en destino';
$_['text_wait']				= 'Aguarde unos instantes hasta que se obtengan los resultados del filtro por favor...';
$_['text_dialog_le']		= 'Detalle de movimientos sobre la orden <b>Nº%s</b>';

// Entry
$_['entry_cuit']			= 'CUIT:<br /><span class="help">Ingrese su número del cuil con los guiones medios incluidos, por ejemplo: 30-1111111-8.</span>';
$_['entry_user']			= 'Usuario:<br /><span class="help">Ingrese el nombre de usuario e-pak.</span>';
$_['entry_password']		= 'Contraseña:<br /><span class="help">Ingrese la contraseña e-pak.</span>';
$_['entry_operativa']		= 'Operativa:<br /><span class="help">Seleccione la/las operativas que ha acordado con OCA y desea habilitar en los envios.</span>';
$_['entry_medicion']		= 'Unidad Medición Peso:<br /><span class="help">Seleccione la unidad de medición en Kilogramos, esto es muy importante!.</span>';
$_['entry_tax']				= 'Tipo de impuesto:<br /><span class="help">Seleccione el tipo de impuesto aplicado al coste de OCA.</span>';
$_['entry_cp_origen']		= 'Código Postal de Origen:<br /><span class="help">Seleccione el CP desde donde se calculara el envio. Recuerde ingresar solamente números, ej: 5000 para Córdoba.</span>';
$_['entry_destino']			= 'Comisión Contra Reembolso:<br /><span class="help">Ingrese un porcentaje a cobrar sobre el total del pedido si el envio es Contra Reembolso. Ingrese solo números con punto decimales para separar los miles, <b>ej 2.50</b><br />Si no quiere cobrar un porcetaje sobre los envios Contra Reembolso, deje esten campo en blanco.</span>';
$_['entry_seguro']			= 'Comisión del seguro:<br /><span class="help">Ingrese un porcentaje a cobrar sobre el total de los productos si el envio es con seguro. Ingrese solo números con punto decimales para separar los miles, <b>ej 2.75</b><br />Si no quiere cobrar un porcetaje sobre el seguro, deje esten campo en blanco. Recuerde que OCA hace incapié que es usted quien debe abonar el seguro y no su cliente!</span>';
$_['entry_geo_zone']		= 'Geo Zona:<br /><span class="help">Seleccione las Geo Zonas donde desea habilitar el envio por OCA. Si desea habilitar <b>todas</b> las Geo Zonas, tilde todas.</span>';
$_['entry_status']			= 'Estado:';
$_['entry_customer_group']	= 'Grupo de Clientes:<br /><span class="help">Seleccione el/los grupos de clientes a quienes desea habilitar el envio por OCA. Si desea habilitarlo para <b>todos</b> los grupos de clientes, tilde todos.</span>';
$_['entry_store']			= 'Tienda:<br /><span class="help">Seleccione las tiendas donde desea habilitar el envio por OCA. Si desea habilitar <b>todas</b> las Tiendas, tilde todas.</span>';
$_['entry_sort_order']		= 'Orden:';
$_['entry_total']			= 'Total:<br /><span class="help">Ingresa el mínimo y máximo que debe tener el carrito de compras para que el modulo este activo (mínimo) o inactivo (máximo).</span>';
$_['entry_length']			= 'Unidad Medición Metrica:<br /><span class="help">Seleccione la unidad de medición en Centímetros, esto es muy importante!.</span>';
$_['entry_dimension']		= 'Tamaño Caja:<br /><span class="help">Ingresa los tamaños máximo de su caja <u>más grande</u> para el envio. Por ejemplo <b>70 x 70 x 70</b>. Consulte con su ejecutivo de cuenta en OCA los tamaños máximos permitidos por paquete. Ingrese solo números!</span>';
$_['entry_round']			= 'Redondear costo:<br /><span class="help">Redondea el costo devuelto por el webserivece de OCA. Por ejemplo 64.54 lo redondea a 64.00 o 64.55 a 65.00</span>';

// Column
$_['column_num_producto']	= 'Nº de Producto';
$_['column_num_envio']		= 'Nº de Envío';

//Help
$_['help_idoperativa']		= 'Ingrese el identificador de la operativa previamente acordada con OCA. Por ejmplo: 74756';
$_['help_descripcion']		= 'Ingrese un nombre descriptivo para esta operativa, el texto aquí ingresado, será el que visualizaran los usuarios (clientes) cuando seleccionen el método de envio.';
$_['help_sucursal']			= 'Tilde esta casilla, si su operativa es con destino a sucursal, el sistema automáticamente listará las posibles sucursales OCA según el código postal del usuario (cliente).';
$_['help_prioritario']		= 'Tilde esta casilla, si su operativa es prioritaria. Recuerde que no se envia a Tierra del Fuego. El calculo del costo de envio es tomado en base al peso aforado de la compra.';
$_['help_seguro']			= 'Tilde esta casilla, si su operativa es con seguro. Recuerde que el límite mínimo del mismo es de $100 y el máximo es de $6000. También puede configurar el modulo para aplicar una comisión extra sobre el seguro si lo desea.';
$_['help_destino']			= 'Tilde esta casilla, si su operativa es con pago en destino. Recuerde que el pago en destino, es el usuario (cliente) quien abona el costo del envio en el destino. El sistema en este caso solamente informa el costo del mismo pero no lo suma al total de la orden.';

// Error
$_['error_permission']		= 'Atención: Usted no tiene permisos para modificar el modulo de OCA!';
$_['error_cuit']			= 'Debe ingresar CUIT asociaso a su cuenta de OCA.';
$_['error_user']			= 'Debe ingresar el nombre de usuario e-pak.';
$_['error_password']		= 'Debe ingresar la contraseña e-pak.';
$_['error_cuit_format']		= 'El CUIT es inválido, compruebelo e ingrese con guiones medios, de la forma xx-xxxxxxxx-x';
$_['error_cp_origen']		= 'Debe ingresar el Código Postal de Origen.';
$_['error_cp_format']		= 'El CP es inválido, compruebelo e ingrese el mismo sin guiones o letras, ej: 5001';
$_['error_total']			= 'Solo se permiten números enteros o decimales separados por punto, por ejemplo: 100.50';
$_['error_dimension']		= 'Debe ingresar el tamaño máximo de su caja para envio, alto, ancho y profundidad. Recuerde consultar con OCA los tamaños máximos permitidos por paquetes.';
$_['error_nombre']			= 'Ingrese un nombre para esta operativa.';
$_['error_operativa_id']	= 'Ingrese un número de operativa.<br />Ingrese solo números.';
?>