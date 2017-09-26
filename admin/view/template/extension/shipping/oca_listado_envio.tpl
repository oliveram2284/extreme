<?php
//==============================================================================
// OCA 1.2
// 
// Desarrollado por: Cofran
// E-mail: franco.iglesias@gmail.com
// Sitio Web: http://www.wachipato.com
// Soporte: http://www.wachipato.com/support
//==============================================================================
?>

<?php if ($error_warning) { ?>
<div class="warning"><?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($success) { ?>
<div class="success"><?php echo $success; ?></div>
<?php } ?>
<style type="text/css">
  .filter {
    padding: 5px;
    background: #E7EFEF;
}
</style>
<table class="table table-bordered">
  <thead>
    <tr class="filter">
      <td colspan="3" class="right">
        <div class="pull-right">
          <input type="text" name="FechaDesde" value="" size="12" class="date" />
        <input type="text" name="FechaHasta" value="" size="12" class="date" />
        <a id="button-listado-envios" onclick="filterListadoEnvios();" class="button"><?php echo $button_filter; ?></a>
          
        </div>
      </td>
    </tr>
    <tr>
      <td class="left"><?php echo $column_num_producto; ?></td>
      <td class="left"><?php echo $column_num_envio; ?></td>
      <td class="right">Tracking</td>
    </tr>
  </thead>
  <tbody>
    <?php if ($listados_envios) { ?>
    <?php foreach ($listados_envios as $listado_envio) { ?>
    <tr>
      <td class="left"><?php echo $listado_envio['numero_producto']; ?></td>
      <td class="left"><?php echo $listado_envio['numero_envio']; ?></td>
      <td class="right" id="tracking-<?php echo $listado_envio['numero_envio']; ?>"><a id="button-tracking-envio" onclick="trackingEnvio('<?php echo $listado_envio['numero_envio']; ?>');"><?php echo $button_tracking_envio; ?></a></td>
    </tr>
    <?php } ?>
    <?php } else { ?>
    <tr>
      <td class="center" colspan="3"><?php echo $text_no_results; ?></td>
    </tr>
    <?php } ?>
  </tbody>
</table>
<div class="pagination"><?php echo $pagination; ?></div>

<script type="text/javascript"><!--
function trackingEnvio(pieza) {
  $.ajax({
    type: 'POST',
    url: 'index.php?route=shipping/oca/tracking_envio&token=<?php echo $token; ?>',
    dataType: 'json',
    data: 'Pieza=' + pieza,
    beforeSend: function() {
      $('#dialog').remove();
      $('.result_tracking').remove();
      //$('#button-tracking-envio').hide();
      $('#tracking-'+pieza).append(' <img src="view/image/loading.gif" class="loading" />');
    },
    complete: function() {
      //$('#button-tracking-envio').show();
      $('.loading').remove();
    },
    success: function(json) {
      if (json['resultados'])
      {
        html = '<table class="list result_tracking"><thead><tr><th class="left">Fecha</th><th class="left">Sucursal</th><th class="left">Estado</th></tr></thead>';

        $.each(json['resultados'], function(i, item) {
            html += '<tr><td>' + item.fecha + '</td><td>' + item.SUC +'</td><td>' + item.Desdcripcion_Estado + '</td></tr>';
        });

        html += '</table>';

        $('#content').prepend('<div id="dialog" style="padding: 3px 0px 0px 0px;">' + html + '</div>');
        
        $('#dialog').dialog({
          title: json['title'],
          bgiframe: false,
          width: 800,
          height: 400,
          resizable: false,
          modal: true
        });
      }
    }
  });
}

$(document).ready(function() {
  $('.date').datepicker({dateFormat: 'dd/mm/yy'});
});
//--></script>