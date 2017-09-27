<?php echo $header; ?>
<style type="text/css">
  .table_header {
    padding: 5px;
    background: #E7EFEF;
}
</style>
<?php echo $column_left; ?>
<div id="content">
  <div class="page-header">
    <div class="container-fluid">
      <div class="pull-right">
        <button type="submit" form="form-ups" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary">
          <i class="fa fa-save"></i>
        </button>
        <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default">   <i class="fa fa-reply"></i>
        </a>
      </div>
      <h1><?php echo $heading_title; ?></h1>
      <ul class="breadcrumb">
        <?php foreach ($breadcrumbs as $breadcrumb) { ?>
        <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <div class="container-fluid">
    <?php if ($error_warning) { ?>
    <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
      <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
    <?php } ?>

    <ul class="nav nav-tabs">
      <!--
      <a href="#tab-general"><?php echo $tab_general; ?></a>
    <a href="#tab-list-envios"><?php echo $tab_list_envios; ?></a> -->
      <li class="active"><a href="#tab-general" data-toggle="tab"><?php echo $tab_general; ?></a></li>
      <li><a href="#tab-list-envios" data-toggle="tab"><?php echo $tab_list_envios; ?></a></li>
      <!--
      <li><a href="#tab-links" data-toggle="tab"><?php echo $tab_links; ?></a></li>
      <li><a href="#tab-attribute" data-toggle="tab"><?php echo $tab_attribute; ?></a></li>
      <li><a href="#tab-option" data-toggle="tab"><?php echo $tab_option; ?></a></li>
      <li><a href="#tab-recurring" data-toggle="tab"><?php echo $tab_recurring; ?></a></li>
      <li><a href="#tab-discount" data-toggle="tab"><?php echo $tab_discount; ?></a></li>
      <li><a href="#tab-special" data-toggle="tab"><?php echo $tab_special; ?></a></li>
      <li><a href="#tab-image" data-toggle="tab"><?php echo $tab_image; ?></a></li>
      <li><a href="#tab-reward" data-toggle="tab"><?php echo $tab_reward; ?></a></li>
      <li><a href="#tab-design" data-toggle="tab"><?php echo $tab_design; ?></a></li>
    -->
    </ul>

    <div class="tab-content">
      <div class="tab-pane active" id="tab-general">      
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-ups" class="form-horizontal">  
          

          <div class="panel panel-default" id="">      
            <div class="panel-heading">        
              <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_edit; ?></h3>      
            </div>      
            <div class="panel-body">
              
              <div class="form-group required">
                <label class="col-sm-3 control-label" for="input-key">
                  <span data-toggle="tooltip" title="<?php echo $help_status; ?>"><?php echo $entry_status; ?></span>
                </label>
                <div class="col-sm-9">
                  <select name="oca_status" class="form-control">
                    <?php if ($oca_status) { ?>
                    <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                    <option value="0"><?php echo $text_disabled; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_enabled; ?></option>
                    <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                    <?php } ?>
                  </select>
                  <?php /*if ($error_key) { ?>
                  <div class="text-danger"><?php echo $error_key; ?></div>
                  <?php } */ ?>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-3 control-label" for="input-username">
                  <?php echo $entry_sort_order; ?>
                </label>
                <div class="col-sm-9">
                  <input type="text" name="oca_sort_order" id="oca_sort_order" value="<?php echo $oca_sort_order; ?>" size="1"  class="form-control"/>
                  <?php /* if ($error_username) { ?>
                  <div class="text-danger"><?php echo $error_username; ?></div>
                  <?php } */?>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-3 control-label" for="input-username">
                  
                    <?php echo $entry_cuit; ?>
                  
                </label>
                <div class="col-sm-9">
                  <input type="text" name="oca_cuit" value="<?php echo $oca_cuit; ?>" id="cuil"   class="form-control"/>
                  <?php if ($error_cuit) { ?>
                  <span class="error"><?php echo $error_cuit; ?></span>
                  <?php } ?>
                 
                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-3 control-label" for="oca_user">              
                    <?php echo $entry_user; ?>              
                </label>
                <div class="col-sm-9">
                  <input type="text" name="oca_user"  id="oca_user" value="<?php echo $oca_user; ?>" id="cuil"   class="form-control"/>
                  <?php if ($error_user) { ?>
                  <span class="error"><?php echo $error_user; ?></span>
                  <?php } ?>
                 
                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-3 control-label" for="oca_password">              
                    <?php echo $entry_password; ?>             
                </label>
                <div class="col-sm-9">
                  <input type="text" name="oca_password"  id="oca_password" value="<?php echo $oca_password; ?>" id="cuil"   class="form-control"/>
                  <?php if ($error_password) { ?>
                  <span class="error"><?php echo $error_password; ?></span>
                  <?php } ?>             
                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-3 control-label" for="oca_password">              
                    <?php echo $entry_cp_origen; ?>             
                </label>
                <div class="col-sm-9">
                  <input type="text" name="oca_cp_origen"  id="oca_cp_origen" value="<?php echo $oca_cp_origen; ?>" class="form-control"/>
                  <?php if ($error_cp_origen) { ?>
                  <span class="error"><?php echo $error_cp_origen; ?></span>
                  <?php } ?>             
                </div>
              </div>


              <div class="form-group required">
                <label class="col-sm-3 control-label" for="oca_password">              
                    <?php echo $entry_operativa; ?>             
                </label>
                <div class="col-sm-9">
                  <table id="operativas" class="table table-bordered">
                    <thead>
                      <tr>
                        <td class="left"><?php echo $text_idoperativa; ?> <img src="view/image/information.png" height="13" width="13" class="tooltip" alt="" title="<?php echo $help_idoperativa; ?>" /></td>
                        <td class="left"><?php echo $text_descripcion; ?> <img src="view/image/information.png" height="13" width="13" class="tooltip" alt="" title="<?php echo $help_descripcion; ?>" /></td>
                        <td class="left"><?php echo $text_sucursal; ?> <img src="view/image/information.png" height="13" width="13" class="tooltip" alt="" title="<?php echo $help_sucursal; ?>" /></td>
                        <td class="left"><?php echo $text_seguro; ?> <img src="view/image/information.png" height="13" width="13" class="tooltip" alt="" title="<?php echo $help_seguro; ?>" /></td>
                        <td class="left"><?php echo $text_prioritario; ?> <img src="view/image/information.png" height="13" width="13" class="tooltip" alt="" title="<?php echo $help_prioritario; ?>" /></td>
                        <td class="left"><?php echo $text_destino; ?> <img src="view/image/information.png" height="13" width="13" class="tooltip" alt="" title="<?php echo $help_destino; ?>" /></td>
                        <td></td>
                      </tr>
                    </thead>
                    <?php $operativas_row = 0; ?>
                    <?php if ($oca_operativas) { ?>
                    <?php foreach ($oca_operativas as $oca_operativa) { ?>
                    <tbody id="operativas-row<?php echo $operativas_row; ?>">
                      <tr>
                        <td class="left">
                          <input type="text" name="oca_operativa[<?php echo $operativas_row; ?>][operativa_id]" value="<?php echo $oca_operativa['operativa_id']; ?>" />
                          <?php if ( isset($error_operativa_id[$operativas_row]) ) { ?>
                          <span class="error"><?php echo $error_operativa_id[$operativas_row]; ?></span>
                          <?php } ?>
                        </td>
                        <td class="left">
                          <input type="text" name="oca_operativa[<?php echo $operativas_row; ?>][nombre]" value="<?php echo $oca_operativa['nombre']; ?>" size="80" />
                          <?php if ( isset($error_nombre[$operativas_row]) ) { ?>
                          <span class="error"><?php echo $error_nombre[$operativas_row]; ?></span>
                          <?php } ?>
                        </td>
                        <td class="left">
                          <input type="checkbox" name="oca_operativa[<?php echo $operativas_row; ?>][sucursal]" <?php echo (array_key_exists('sucursal', $oca_operativa) ? 'checked' : ''); ?> />
                        </td>
                        <td class="left">
                          <input type="checkbox" name="oca_operativa[<?php echo $operativas_row; ?>][seguro]" <?php echo (array_key_exists('seguro', $oca_operativa) ? 'checked' : ''); ?> />
                        </td>
                        <td class="left">
                          <input type="checkbox" name="oca_operativa[<?php echo $operativas_row; ?>][prioritario]" <?php echo (array_key_exists('prioritario', $oca_operativa) ? 'checked' : ''); ?> />
                        </td>
                        <td class="left">
                          <input type="checkbox" name="oca_operativa[<?php echo $operativas_row; ?>][destino]" <?php echo (array_key_exists('destino', $oca_operativa) ? 'checked' : ''); ?> />
                        </td>
                        <td class="left"><a onclick="$('#operativas-row<?php echo $operativas_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
                      </tr>
                    </tbody>
                    <?php $operativas_row++; ?>
                    <?php } ?>
                    <?php } else { ?>
                    <tbody id="operativas-row<?php echo $operativas_row; ?>">
                      <tr>
                        <td class="center" colspan="6">No hay Operativas cargadas, ingrese aquí sus operativas.</td>
                      </tr>
                    </tbody>
                    <?php } ?>
                    <tfoot>
                      <tr>
                        <td colspan="6"></td>
                        <td class="left"><a onclick="addOperativa();" class="button"><?php echo $button_add_operativa; ?></a></td>
                      </tr>
                    </tfoot>
                  </table>

                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-3 control-label" for="oca_round">
                  <?php echo $entry_round; ?>
                </label>
                <div class="col-sm-9">
                  <select name="oca_round" id="oca_round" class="form-control">
                    <?php if ($oca_round) { ?>
                    <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                    <option value="0"><?php echo $text_no; ?></option>
                    <?php } else { ?>
                    <option value="1"><?php echo $text_yes; ?></option>
                    <option value="0" selected="selected"><?php echo $text_no; ?></option>
                    <?php } ?>
                  </select>              
                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-3 control-label" for="oca_weight_class_id">
                  <?php echo $entry_medicion; ?></label>
                <div class="col-sm-9">
                  <select name="oca_weight_class_id" name="oca_weight_class_id" class="form-control" > 
                    <?php foreach ($weight_classes as $weight_class) { ?>
                    <?php if ($weight_class['weight_class_id'] == $oca_weight_class_id) { ?>
                    <option value="<?php echo $weight_class['weight_class_id']; ?>" selected="selected"><?php echo $weight_class['title']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $weight_class['weight_class_id']; ?>"><?php echo $weight_class['title']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                 
                  <?php /*if ($error_username) { ?>
                    <div class="text-danger"><?php echo $error_username; ?></div>
                  <?php  */ ?>
                </div>
              </div>

               <div class="form-group required">
                <label class="col-sm-3 control-label" for="oca_length_class_id">
                  <?php echo $entry_length; ?></label>
                <div class="col-sm-9">
                  <select name="oca_length_class_id" name="oca_length_class_id" class="form-control" >
                    <?php foreach ($length_classes as $length_class) { ?>
                    <?php if ($length_class['length_class_id'] == $oca_length_class_id) { ?>
                    <option value="<?php echo $length_class['length_class_id']; ?>" selected="selected"><?php echo $length_class['title']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $length_class['length_class_id']; ?>"><?php echo $length_class['title']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                 
                  <?php /*if ($error_username) { ?>
                    <div class="text-danger"><?php echo $error_username; ?></div>
                  <?php  */ ?>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-3 control-label" for="oca_length">
                  <?php echo $entry_dimension; ?></label>
                <div class="col-sm-9">
                  <input type="text" name="oca_length" id="oca_length" value="<?php echo $oca_length; ?>" size="4" placeholder="profundidad"  class="form-control" />
                  <input type="text" name="oca_width" id="oca_width" value="<?php echo $oca_width; ?>" size="4" placeholder="ancho"  class="form-control" />
                  <input type="text" name="oca_height" id="oca_height" value="<?php echo $oca_height; ?>" size="4" placeholder="alto"  class="form-control" />
                  <?php /* if ($error_dimension) { ?>
                  <span class="error"><?php echo $error_dimension; ?></span>
                  <?php } */?>
                              
                </div>
              </div>


              <div class="form-group required">
                <label class="col-sm-3 control-label" for="oca_length_class_id">
                  <?php echo $entry_length; ?></label>
                <div class="col-sm-9">
                  <select name="oca_length_class_id" name="oca_length_class_id" class="form-control" >
                    <?php foreach ($length_classes as $length_class) { ?>
                    <?php if ($length_class['length_class_id'] == $oca_length_class_id) { ?>
                    <option value="<?php echo $length_class['length_class_id']; ?>" selected="selected"><?php echo $length_class['title']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $length_class['length_class_id']; ?>"><?php echo $length_class['title']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select>
                 
                  <?php /*if ($error_username) { ?>
                    <div class="text-danger"><?php echo $error_username; ?></div>
                  <?php  */ ?>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-3 control-label" for="oca_tax_class_id">
                  <?php echo $entry_tax; ?>
                </label>
                <div class="col-sm-9">
                  <select name="oca_tax_class_id" id="oca_tax_class_id" class="form-control">
                    <option value="0"><?php echo $text_none; ?></option>
                    <?php foreach ($tax_classes as $tax_class) { ?>
                    <?php if ($tax_class['tax_class_id'] == $oca_tax_class_id) { ?>
                    <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                    <?php } else { ?>
                    <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                    <?php } ?>
                    <?php } ?>
                  </select> 
                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-3 control-label" for="oca_destino">
                  <?php echo $entry_destino; ?>
                </label>
                <div class="col-sm-9"> 
                  <input type="text" name="oca_destino"  id="oca_destino" value="<?php echo $oca_destino; ?>" size="5" class="form-control" />
                  <?php if ($error_destino) { ?>
                  <span class="error"><?php echo $error_destino; ?></span>
                  <?php } ?>
                </div>
              </div>

              <div class="form-group required">
                <label class="col-sm-3 control-label" for="oca_seguro">
                  <?php echo $entry_seguro; ?>
                </label>
                <div class="col-sm-9"> 
                  <input type="text" name="oca_seguro" id="oca_seguro" value="<?php echo $oca_seguro; ?>" size="5" class="form-control"/>
                  <?php if ($error_destino) { ?>
                  <span class="error"><?php echo $error_seguro; ?></span>
                  <?php } ?>
                </div>
              </div>



            
            </div>
          </div>
          <div class="panel panel-default">      
            <div class="panel-heading">        
              <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $heading_restrinction; ?></h3>      
            </div>      
            <div class="panel-body">

              <div class="form-group required">
                <label class="col-sm-3 control-label" for="oca_total_max">
                  <?php echo $entry_total; ?>
                </label>
                <div class="col-sm-9">
                  <table>
                    <tr>
                      <td><?php echo $text_total_max; ?></td>
                      <td><input type="text" name="oca_total_max"  id="oca_total_max" class="form-control" value="<?php echo $oca_total_max; ?>" size="5" /></td>
                    </tr>
                    <tr>
                      <td><?php echo $text_total_min; ?></td>
                      <td><input type="text" name="oca_total_min" id="oca_total_min" class="form-control"value="<?php echo $oca_total_min; ?>" size="5" /></td>
                    </tr>
                  </table>
                  <?php if ($error_total) { ?>
                  <span class="error"><?php echo $error_total; ?></span>
                  <?php } ?> 
                </div>
              </div>

              

              <div class="form-group required">
                <label class="col-sm-3 control-label" for="oca_length_class_id">
                  <?php echo $entry_geo_zone; ?>
                </label>
                <div class="col-sm-9">
                  <div class="scrollbox">
                    <?php $class = 'odd'; ?>
                    <div class="<?php echo $class; ?>">
                      <?php if (in_array(0, $oca_geo_zone_id)) { ?>
                      <input type="checkbox" name="oca_geo_zone_id[]" value="0" checked="checked" />
                      <?php echo $text_all_zone; ?>
                      <?php } else { ?>
                      <input type="checkbox" name="oca_geo_zone_id[]" value="0" />
                      <?php echo $text_all_zone; ?>
                      <?php } ?>
                    </div>
                    <?php foreach ($geo_zones as $geo_zone) { ?>
                    <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                    <div class="<?php echo $class; ?>">
                      <?php if (in_array($geo_zone['geo_zone_id'], $oca_geo_zone_id)) { ?>
                      <input type="checkbox" name="oca_geo_zone_id[]" value="<?php echo $geo_zone['geo_zone_id']; ?>" checked="checked" />
                      <?php echo $geo_zone['name']; ?>
                      <?php } else { ?>
                      <input type="checkbox" name="oca_geo_zone_id[]" value="<?php echo $geo_zone['geo_zone_id']; ?>" />
                      <?php echo $geo_zone['name']; ?>
                      <?php } ?>
                    </div>
                    <?php } ?>
                  </div>
                  <?php if (defined('VERSION') && strpos(VERSION, '1.4.9') !== 0) { ?>
                    <a onclick="$(this).parent().find(':checkbox').attr('checked', true)"><?php echo $text_select_all; ?></a>
                    /
                    <a onclick="$(this).parent().find(':checkbox').attr('checked', false)"><?php echo $text_unselect_all; ?></a>
                  <?php } ?> 
                </div>
              </div>
              <div class="form-group required">
                <label class="col-sm-3 control-label" for="oca_length_class_id">
                  <?php echo $entry_store; ?>
                </label>
                <div class="col-sm-9">
                  <div class="scrollbox">
                    <?php $class = 'odd'; ?>
                    <div class="<?php echo $class; ?>">
                      <?php if (in_array(0, $oca_store_id)) { ?>
                      <input type="checkbox" name="oca_store_id[]" value="0" checked="checked" />
                      <?php echo $text_default; ?>
                      <?php } else { ?>
                      <input type="checkbox" name="oca_store_id[]" value="0" />
                      <?php echo $text_default; ?>
                      <?php } ?>
                    </div>
                    <?php foreach ($stores as $store) { ?>
                    <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                    <div class="<?php echo $class; ?>">
                      <?php if (in_array($store['store_id'], $oca_store_id)) { ?>
                      <input type="checkbox" name="oca_store_id[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                      <?php echo $store['name']; ?>
                      <?php } else { ?>
                      <input type="checkbox" name="oca_store_id[]" value="<?php echo $store['store_id']; ?>" />
                      <?php echo $store['name']; ?>
                      <?php } ?>
                    </div>
                    <?php } ?>
                  </div>
                  <?php if (defined('VERSION') && strpos(VERSION, '1.4.9') !== 0) { ?>
                    <a onclick="$(this).parent().find(':checkbox').attr('checked', true)"><?php echo $text_select_all; ?></a>
                    /
                    <a onclick="$(this).parent().find(':checkbox').attr('checked', false)"><?php echo $text_unselect_all; ?></a>
                  <?php } ?> 
                </div>
              </div>

              


              <div class="form-group required">
                <label class="col-sm-3 control-label" for="oca_customer_group_id">
                  <?php echo $entry_customer_group; ?>
                </label>
                <div class="col-sm-9"> 
                  <div class="scrollbox">
                    <?php $class = 'odd'; ?>
                    <div class="<?php echo $class; ?>">
                      <?php if (in_array(0, $oca_customer_group_id)) { ?>
                      <input type="checkbox" name="oca_customer_group_id[]" value="0" checked="checked" />
                      <?php echo $text_guest_user; ?>
                      <?php } else { ?>
                      <input type="checkbox" name="oca_customer_group_id[]" value="0" />
                      <?php echo $text_guest_user; ?>
                      <?php } ?>
                    </div>
                    <?php foreach ($customer_groups as $customer_group) { ?>
                    <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                    <div class="<?php echo $class; ?>">
                      <?php if (in_array($customer_group['customer_group_id'], $oca_customer_group_id)) { ?>
                      <input type="checkbox" name="oca_customer_group_id[]" id="oca_customer_group_id" value="<?php echo $customer_group['customer_group_id']; ?>" checked="checked" />
                      <?php echo $customer_group['name']; ?>
                      <?php } else { ?>
                      <input type="checkbox" name="oca_customer_group_id[]" value="<?php echo $customer_group['customer_group_id']; ?>" />
                      <?php echo $customer_group['name']; ?>
                      <?php } ?>
                    </div>
                    <?php } ?>
                  </div>
                  <?php if (defined('VERSION') && strpos(VERSION, '1.4.9') !== 0) { ?>
                    <a onclick="$(this).parent().find(':checkbox').attr('checked', true)"><?php echo $text_select_all; ?></a>
                    /
                    <a onclick="$(this).parent().find(':checkbox').attr('checked', false)"><?php echo $text_unselect_all; ?></a>
                  <?php } ?>
                </div>
              </div>

              

            </div>
          </div>          
        </form>
      </div>
      <div class="tab-pane" id="tab-list-envios">
        <div id="listado_envios">


        </div>
      </div>
  </div>

  </div>

</div>


<style type="text/css">
.pestana {margin-bottom: 10px;}
#tooltip{color:#222;font-size:11px;text-shadow:1px 1px 0 #fff;border:1px solid #666;-moz-border-radius:5px;-webkit-border-radius:5px;border-radius:5px;background-color:#EFEFEF;-moz-box-shadow:0 0 4px #bbb;-webkit-box-shadow:0 0 4px #bbb;box-shadow:0 0 4px #bbb;line-height:1.2em;padding:5px;position:absolute;z-index:100000;display:none}
</style>

<?php if (!$v14x) { ?>
<div id="content" class="hidden">
  <div class="breadcrumb">
    <?php foreach ($breadcrumbs as $breadcrumb) { ?>
      <?php echo $breadcrumb['separator']; ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a>
    <?php } ?>
  </div>
<?php } ?>

  <?php if ($error_warning) { ?>
  <div class="warning">
    <?php echo $error_warning; ?>
  </div>
  <?php } ?>


  <div id="htabs" class="htabs">
    <a href="#tab-general"><?php echo $tab_general; ?></a>
    <a href="#tab-list-envios"><?php echo $tab_list_envios; ?></a>
  </div>

<div id="tab-general">
  <div class="box">
    <?php if ($v14x) { ?>
     <div class="left"></div>
    <div class="right"></div>
    <?php } ?>

    <div class="heading">
      <h1><img src="view/image/shipping.png" alt="" /> <?php echo $heading_general; ?></h1>
      <div class="buttons">
        <a onclick="$('#form').submit();" class="button"><?php echo $button_save; ?></a>
        <a onclick="location = '<?php echo $cancel; ?>';" class="button"><?php echo $button_cancel; ?></a>
      </div>
    </div>
    <div class="content">
      <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form">
        <table class="form">
          <tr>
            <td><?php echo $entry_status; ?></td>
            <td><select name="oca_status">
                <?php if ($oca_status) { ?>
                <option value="1" selected="selected"><?php echo $text_enabled; ?></option>
                <option value="0"><?php echo $text_disabled; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_enabled; ?></option>
                <option value="0" selected="selected"><?php echo $text_disabled; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_sort_order; ?></td>
            <td><input type="text" name="oca_sort_order" value="<?php echo $oca_sort_order; ?>" size="1" /></td>
          </tr>
          <tr>
            <td><span class="required">*</span> <?php echo $entry_cuit; ?></td>
            <td><input type="text" name="oca_cuit" value="<?php echo $oca_cuit; ?>" id="cuil" />
              <?php if ($error_cuit) { ?>
              <span class="error"><?php echo $error_cuit; ?></span>
              <?php } ?></td>
          </tr>
          <tr>
            <td>
              <span class="required">*</span> <?php echo $entry_user; ?>
            </td>
            <td>
              <input type="text" name="oca_user" value="<?php echo $oca_user; ?>" size="40" />
              <?php if ($error_user) { ?>
              <span class="error"><?php echo $error_user; ?></span>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <td><span class="required">*</span> <?php echo $entry_password; ?></td>
            <td><input type="text" name="oca_password" value="<?php echo $oca_password; ?>" />
              <?php if ($error_password) { ?>
              <span class="error"><?php echo $error_password; ?></span>
              <?php } ?></td>
          </tr>
          <tr>
            <td><span class="required">*</span> <?php echo $entry_cp_origen; ?></td>
            <td><input type="text" name="oca_cp_origen" value="<?php echo $oca_cp_origen; ?>" />
              <?php if ($error_cp_origen) { ?>
              <span class="error"><?php echo $error_cp_origen; ?></span>
              <?php } ?></td>
          </tr>
          <tr>
            <td valign="top"><span class="required">*</span> <?php echo $entry_operativa; ?></td>
            <td>
              <table id="operativas" class="list">
                <thead>
                  <tr>
                    <td class="left"><?php echo $text_idoperativa; ?> <img src="view/image/information.png" height="13" width="13" class="tooltip" alt="" title="<?php echo $help_idoperativa; ?>" /></td>
                    <td class="left"><?php echo $text_descripcion; ?> <img src="view/image/information.png" height="13" width="13" class="tooltip" alt="" title="<?php echo $help_descripcion; ?>" /></td>
                    <td class="left"><?php echo $text_sucursal; ?> <img src="view/image/information.png" height="13" width="13" class="tooltip" alt="" title="<?php echo $help_sucursal; ?>" /></td>
                    <td class="left"><?php echo $text_seguro; ?> <img src="view/image/information.png" height="13" width="13" class="tooltip" alt="" title="<?php echo $help_seguro; ?>" /></td>
                    <td class="left"><?php echo $text_prioritario; ?> <img src="view/image/information.png" height="13" width="13" class="tooltip" alt="" title="<?php echo $help_prioritario; ?>" /></td>
                    <td class="left"><?php echo $text_destino; ?> <img src="view/image/information.png" height="13" width="13" class="tooltip" alt="" title="<?php echo $help_destino; ?>" /></td>
                    <td></td>
                  </tr>
                </thead>
                <?php $operativas_row = 0; ?>
                <?php if ($oca_operativas) { ?>
                <?php foreach ($oca_operativas as $oca_operativa) { ?>
                <tbody id="operativas-row<?php echo $operativas_row; ?>">
                  <tr>
                    <td class="left">
                      <input type="text" name="oca_operativa[<?php echo $operativas_row; ?>][operativa_id]" value="<?php echo $oca_operativa['operativa_id']; ?>" />
                      <?php if ( isset($error_operativa_id[$operativas_row]) ) { ?>
                      <span class="error"><?php echo $error_operativa_id[$operativas_row]; ?></span>
                      <?php } ?>
                    </td>
                    <td class="left">
                      <input type="text" name="oca_operativa[<?php echo $operativas_row; ?>][nombre]" value="<?php echo $oca_operativa['nombre']; ?>" size="80" />
                      <?php if ( isset($error_nombre[$operativas_row]) ) { ?>
                      <span class="error"><?php echo $error_nombre[$operativas_row]; ?></span>
                      <?php } ?>
                    </td>
                    <td class="left">
                      <input type="checkbox" name="oca_operativa[<?php echo $operativas_row; ?>][sucursal]" <?php echo (array_key_exists('sucursal', $oca_operativa) ? 'checked' : ''); ?> />
                    </td>
                    <td class="left">
                      <input type="checkbox" name="oca_operativa[<?php echo $operativas_row; ?>][seguro]" <?php echo (array_key_exists('seguro', $oca_operativa) ? 'checked' : ''); ?> />
                    </td>
                    <td class="left">
                      <input type="checkbox" name="oca_operativa[<?php echo $operativas_row; ?>][prioritario]" <?php echo (array_key_exists('prioritario', $oca_operativa) ? 'checked' : ''); ?> />
                    </td>
                    <td class="left">
                      <input type="checkbox" name="oca_operativa[<?php echo $operativas_row; ?>][destino]" <?php echo (array_key_exists('destino', $oca_operativa) ? 'checked' : ''); ?> />
                    </td>
                    <td class="left"><a onclick="$('#operativas-row<?php echo $operativas_row; ?>').remove();" class="button"><?php echo $button_remove; ?></a></td>
                  </tr>
                </tbody>
                <?php $operativas_row++; ?>
                <?php } ?>
                <?php } else { ?>
                <tbody id="operativas-row<?php echo $operativas_row; ?>">
                  <tr>
                    <td class="center" colspan="6">No hay Operativas cargadas, ingrese aquí sus operativas.</td>
                  </tr>
                </tbody>
                <?php } ?>
                <tfoot>
                  <tr>
                    <td colspan="6"></td>
                    <td class="left"><a onclick="addOperativa();" class="button"><?php echo $button_add_operativa; ?></a></td>
                  </tr>
                </tfoot>
              </table>
            </td>
          </tr>
          <tr>
            <td><?php echo $entry_round; ?></td>
            <td><select name="oca_round">
                <?php if ($oca_round) { ?>
                <option value="1" selected="selected"><?php echo $text_yes; ?></option>
                <option value="0"><?php echo $text_no; ?></option>
                <?php } else { ?>
                <option value="1"><?php echo $text_yes; ?></option>
                <option value="0" selected="selected"><?php echo $text_no; ?></option>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><span class="required">*</span> <?php echo $entry_medicion; ?></td>
            <td><select name="oca_weight_class_id">
                <?php foreach ($weight_classes as $weight_class) { ?>
                <?php if ($weight_class['weight_class_id'] == $oca_weight_class_id) { ?>
                <option value="<?php echo $weight_class['weight_class_id']; ?>" selected="selected"><?php echo $weight_class['title']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $weight_class['weight_class_id']; ?>"><?php echo $weight_class['title']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><span class="required">*</span> <?php echo $entry_length; ?></td>
            <td><select name="oca_length_class_id">
                <?php foreach ($length_classes as $length_class) { ?>
                <?php if ($length_class['length_class_id'] == $oca_length_class_id) { ?>
                <option value="<?php echo $length_class['length_class_id']; ?>" selected="selected"><?php echo $length_class['title']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $length_class['length_class_id']; ?>"><?php echo $length_class['title']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><span class="required">*</span> <?php echo $entry_dimension; ?></td>
            <td><input type="text" name="oca_length" value="<?php echo $oca_length; ?>" size="4" placeholder="profundidad" />
              <input type="text" name="oca_width" value="<?php echo $oca_width; ?>" size="4" placeholder="ancho" />
              <input type="text" name="oca_height" value="<?php echo $oca_height; ?>" size="4" placeholder="alto" />
              <?php if ($error_dimension) { ?>
              <span class="error"><?php echo $error_dimension; ?></span>
              <?php } ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_tax; ?></td>
            <td><select name="oca_tax_class_id">
                <option value="0"><?php echo $text_none; ?></option>
                <?php foreach ($tax_classes as $tax_class) { ?>
                <?php if ($tax_class['tax_class_id'] == $oca_tax_class_id) { ?>
                <option value="<?php echo $tax_class['tax_class_id']; ?>" selected="selected"><?php echo $tax_class['title']; ?></option>
                <?php } else { ?>
                <option value="<?php echo $tax_class['tax_class_id']; ?>"><?php echo $tax_class['title']; ?></option>
                <?php } ?>
                <?php } ?>
              </select></td>
          </tr>
          <tr>
            <td><?php echo $entry_destino; ?></td>
            <td><input type="text" name="oca_destino" value="<?php echo $oca_destino; ?>" size="5" />
              <?php if ($error_destino) { ?>
              <span class="error"><?php echo $error_destino; ?></span>
              <?php } ?></td>
          </tr>
          <tr>
            <td><?php echo $entry_seguro; ?></td>
            <td><input type="text" name="oca_seguro" value="<?php echo $oca_seguro; ?>" size="5" />
              <?php if ($error_destino) { ?>
              <span class="error"><?php echo $error_seguro; ?></span>
              <?php } ?></td>
          </tr>
        </table>
      </div>
    </div>

    <div class="box">
      <div class="heading">
        <h1><img src="view/image/lock.png" alt="" /> <?php echo $heading_restrinction; ?></h1>
      </div>
      <div class="content">
        <table class="form">
          <tr>
            <td><?php echo $entry_total; ?></td>
            <td>
              <table>
                <tr>
                  <td><?php echo $text_total_max; ?></td>
                  <td><input type="text" name="oca_total_max" value="<?php echo $oca_total_max; ?>" size="5" /></td>
                </tr>
                <tr>
                  <td><?php echo $text_total_min; ?></td>
                  <td><input type="text" name="oca_total_min" value="<?php echo $oca_total_min; ?>" size="5" /></td>
                </tr>
              </table>
              <?php if ($error_total) { ?>
              <span class="error"><?php echo $error_total; ?></span>
              <?php } ?>
            <td>
          </tr>
          <tr>
            <td class="top"><?php echo $entry_geo_zone; ?></td>
            <td>
              <div class="scrollbox">
                <?php $class = 'odd'; ?>
                <div class="<?php echo $class; ?>">
                  <?php if (in_array(0, $oca_geo_zone_id)) { ?>
                  <input type="checkbox" name="oca_geo_zone_id[]" value="0" checked="checked" />
                  <?php echo $text_all_zone; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="oca_geo_zone_id[]" value="0" />
                  <?php echo $text_all_zone; ?>
                  <?php } ?>
                </div>
                <?php foreach ($geo_zones as $geo_zone) { ?>
                <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                <div class="<?php echo $class; ?>">
                  <?php if (in_array($geo_zone['geo_zone_id'], $oca_geo_zone_id)) { ?>
                  <input type="checkbox" name="oca_geo_zone_id[]" value="<?php echo $geo_zone['geo_zone_id']; ?>" checked="checked" />
                  <?php echo $geo_zone['name']; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="oca_geo_zone_id[]" value="<?php echo $geo_zone['geo_zone_id']; ?>" />
                  <?php echo $geo_zone['name']; ?>
                  <?php } ?>
                </div>
                <?php } ?>
              </div>
              <?php if (defined('VERSION') && strpos(VERSION, '1.4.9') !== 0) { ?>
                <a onclick="$(this).parent().find(':checkbox').attr('checked', true)"><?php echo $text_select_all; ?></a>
                /
                <a onclick="$(this).parent().find(':checkbox').attr('checked', false)"><?php echo $text_unselect_all; ?></a>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <td valign="top"><?php echo $entry_store; ?></td>
            <td><div class="scrollbox">
                <?php $class = 'odd'; ?>
                <div class="<?php echo $class; ?>">
                  <?php if (in_array(0, $oca_store_id)) { ?>
                  <input type="checkbox" name="oca_store_id[]" value="0" checked="checked" />
                  <?php echo $text_default; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="oca_store_id[]" value="0" />
                  <?php echo $text_default; ?>
                  <?php } ?>
                </div>
                <?php foreach ($stores as $store) { ?>
                <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                <div class="<?php echo $class; ?>">
                  <?php if (in_array($store['store_id'], $oca_store_id)) { ?>
                  <input type="checkbox" name="oca_store_id[]" value="<?php echo $store['store_id']; ?>" checked="checked" />
                  <?php echo $store['name']; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="oca_store_id[]" value="<?php echo $store['store_id']; ?>" />
                  <?php echo $store['name']; ?>
                  <?php } ?>
                </div>
                <?php } ?>
              </div>
              <?php if (defined('VERSION') && strpos(VERSION, '1.4.9') !== 0) { ?>
                <a onclick="$(this).parent().find(':checkbox').attr('checked', true)"><?php echo $text_select_all; ?></a>
                /
                <a onclick="$(this).parent().find(':checkbox').attr('checked', false)"><?php echo $text_unselect_all; ?></a>
              <?php } ?>
            </td>
          </tr>
          <tr>
            <td valign="top"><?php echo $entry_customer_group; ?></td>
            <td><div class="scrollbox">
                <?php $class = 'odd'; ?>
                <div class="<?php echo $class; ?>">
                  <?php if (in_array(0, $oca_customer_group_id)) { ?>
                  <input type="checkbox" name="oca_customer_group_id[]" value="0" checked="checked" />
                  <?php echo $text_guest_user; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="oca_customer_group_id[]" value="0" />
                  <?php echo $text_guest_user; ?>
                  <?php } ?>
                </div>
                <?php foreach ($customer_groups as $customer_group) { ?>
                <?php $class = ($class == 'even' ? 'odd' : 'even'); ?>
                <div class="<?php echo $class; ?>">
                  <?php if (in_array($customer_group['customer_group_id'], $oca_customer_group_id)) { ?>
                  <input type="checkbox" name="oca_customer_group_id[]" value="<?php echo $customer_group['customer_group_id']; ?>" checked="checked" />
                  <?php echo $customer_group['name']; ?>
                  <?php } else { ?>
                  <input type="checkbox" name="oca_customer_group_id[]" value="<?php echo $customer_group['customer_group_id']; ?>" />
                  <?php echo $customer_group['name']; ?>
                  <?php } ?>
                </div>
                <?php } ?>
              </div>
              <?php if (defined('VERSION') && strpos(VERSION, '1.4.9') !== 0) { ?>
                <a onclick="$(this).parent().find(':checkbox').attr('checked', true)"><?php echo $text_select_all; ?></a>
                /
                <a onclick="$(this).parent().find(':checkbox').attr('checked', false)"><?php echo $text_unselect_all; ?></a>
              <?php } ?>
            </td>
          </tr>
        </table>
      </form>
    </div>
  </div>
</div>

<!-- Lista de envios y eventos de tracking -->
<div id="tab-list-envios">
  <div id="listado_envios"></div>
</div>

<?php if (!$v14x) { ?>
</div>
<?php } ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" />
<script type="text/javascript"><!--
$('.box > .content').css('min-height', '50px');
$('.pestana a').tabs();
//--></script>

<script type="text/javascript"><!--
var operativas_row = <?php echo $operativas_row; ?>;

function addOperativa() {
  html  = '<tbody id="operativas-row' + operativas_row + '">';
  html += '<tr>';
  html += '<td class="left"><input type="text" name="oca_operativa[' + operativas_row + '][operativa_id]" /></td>';
  html += '<td class="left"><input type="text" name="oca_operativa[' + operativas_row + '][nombre]" size="80"/></td>';
  html += '<td class="left"><input type="checkbox" name="oca_operativa[' + operativas_row + '][sucursal]" /></td>';
  html += '<td class="left"><input type="checkbox" name="oca_operativa[' + operativas_row + '][seguro]" /></td>';
  html += '<td class="left"><input type="checkbox" name="oca_operativa[' + operativas_row + '][prioritario]" /></td>';
  html += '<td class="left"><input type="checkbox" name="oca_operativa[' + operativas_row + '][destino]" /></td>';
  html += '<td class="left"><a onclick="$(\'#operativas-row' + operativas_row + '\').remove();" class="button"><?php echo $button_remove; ?></a></td>';
  html += '</tr>';
  html += '</tbody>';
  
  $('#operativas > tfoot').before(html);
    
  operativas_row++;
}

function CPcuitValido(cuit) {
  if (typeof (cuit) == 'undefined')
    return true;
  cuit = cuit.toString().replace(/[-_]/g, '');
  if (cuit == '')
    return true; 
  if (cuit.length != 11)
    return false;
  else {
    var mult = [5, 4, 3, 2, 7, 6, 5, 4, 3, 2];
    var total = 0;
  for (var i = 0; i < mult.length; i++) {
    total += parseInt(cuit.charAt(i)) * mult[i];
  }
    var mod = total % 11;
    var digito = mod == 0 ? 0 : mod == 1 ? 9 : 11 - mod;
  }
  return digito == parseInt(cuit.charAt(10));
}
$('#cuil').bind('blur', function() {
  var c = $('#cuil').val();
  if ( CPcuitValido(c) == false ){
    alert("cuit no valido");
    $('#cuil').focus();
  }
});

//--></script> 

<script type="text/javascript"><!--
$('#listado_envios .pagination a').on('click', function() {
  $('#listado_envios').load(this.href);
  
  return false;
});

$('#listado_envios').load('index.php?route=shipping/oca/listado_envios&token=<?php echo $token; ?>');

function filterListadoEnvios() {
  $.ajax({
    type: 'POST',
    url: 'index.php?route=shipping/oca/listado_envios&token=<?php echo $token; ?>',
    dataType: 'html',
    data: 'FechaDesde=' + encodeURIComponent($('#listado_envios input[name=\'FechaDesde\']').val()) + '&FechaHasta=' + encodeURIComponent($('#listado_envios input[name=\'FechaHasta\']').val()),
    beforeSend: function() {
      $('.success, .warning').remove();
      $('#button-listado-envios').attr('disabled', true);
      $('#listado_envios').before('<div class="attention"><img src="view/image/loading.gif" alt="" /> <?php echo $text_wait; ?></div>');
    },
    complete: function() {
      $('#button-listado-envios').attr('disabled', false);
      $('.attention').remove();
    },
    success: function(html) {
      $('#listado_envios').html(html);
    }
  });
}
//--></script> 

<script type="text/javascript"><!--
;(function(a){var j='',d=false;a.fn.extend({tooltip:function(){d=a('<p id="tooltip"></p>').appendTo(document.body);return this.on('mouseenter',function(f){j=a(this).attr('title');a(this).attr('title','');d.html(j).show();k(f);a(document.body).bind('mousemove',k);a(this).mouseleave(function(){d.hide().empty().css({top:0,left:0});a(this).attr('title',j);a(document.body).unbind('mousemove',k);d.unbind()})})}});function k(f){var b={},c=10,e=d,g=(f.pageX+c),h=(f.pageY+c),i={l:a(window).scrollLeft(),t:a(window).scrollTop(),w:a(window).width(),h:a(window).height()};e.css({top:h+'px',left:g+'px'});b={w:e.width(),h:e.height()};if(i.l+i.w<b.w+g+(c*2)&&g>b.w)e.css({left:(g-b.w-(c*3))+'px'});if(i.t+i.h<b.h+h+(c*3)&&h>b.h)e.css({top:(h-b.h-(c*2))+'px'})}})(jQuery);$(function(){$('.tooltip').tooltip()});
//--></script>

<script type="text/javascript"><!--
//$('.htabs a').tabs();
//--></script> 
<?php echo $footer; ?>