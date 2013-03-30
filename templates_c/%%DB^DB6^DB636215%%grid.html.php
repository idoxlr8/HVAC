<?php /* Smarty version 2.6.18, created on 2013-02-11 10:50:48
         compiled from DataGrid/grid.html */ ?>


<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['ENV']['DATAFACE_URL']; ?>
/modules/DataGrid/css/ext-all.css" />
<link rel="stylesheet" type="text/css" href="<?php echo $this->_tpl_vars['ENV']['DATAFACE_URL']; ?>
/modules/DataGrid/css/DataGrid.css" />
<!-- GC -->
<!-- LIBS -->
<script type="text/javascript" src="<?php echo $this->_tpl_vars['ENV']['DATAFACE_URL']; ?>
/modules/DataGrid/js/Ext-min.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['ENV']['DATAFACE_URL']; ?>
/modules/DataGrid/js/ext-base.js"></script>
<!-- ENDLIBS -->

<script type="text/javascript" src="<?php echo $this->_tpl_vars['ENV']['DATAFACE_URL']; ?>
/modules/DataGrid/js/ext-all.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['ENV']['DATAFACE_URL']; ?>
/modules/DataGrid/js/ext-plugins/Select.js"></script>
<script type="text/javascript" src="<?php echo $this->_tpl_vars['ENV']['DATAFACE_URL']; ?>
/modules/DataGrid/js/DataGrid.js"></script>



<div id="editor-grid"></div>

<script language="javascript"><!--
<?php echo '


if ( typeof(Dataface) == \'undefined\' ) Dataface = {};
if ( typeof(Dataface.Valuelists) == \'undefined\' ) Dataface.Valuelists = {};

'; ?>

<?php $_from = $this->_tpl_vars['grid']->getValuelists(); if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['name'] => $this->_tpl_vars['valuelist']):
?>
	Dataface.Valuelists['<?php echo $this->_tpl_vars['name']; ?>
'] = <?php echo $this->_tpl_vars['json']->encode($this->_tpl_vars['valuelist']); ?>
;
	Dataface.renderers['<?php echo $this->_tpl_vars['name']; ?>
'] = function(value)<?php echo '{'; ?>

		return Dataface.Valuelists['<?php echo $this->_tpl_vars['name']; ?>
'][value];
	<?php echo '}'; ?>
;
<?php endforeach; endif; unset($_from); ?>

var fieldDefs = <?php echo $this->_tpl_vars['fieldDefs']; ?>
;

<?php echo '
for ( var i in fieldDefs){
	var discard = false;
	switch ( fieldDefs[i].widget.type ){
		case \'text\':
		case \'textarea\':
		case \'select\':
		case \'checkbox\':
		case \'hidden\':
		case \'autocomplete\':
		case \'yui_autocomplete\':
		case \'calendar\':
		case \'date\':
		case \'time\':
			break;
		default:
			discard = true;
			break;
	}
	if ( discard || fieldDefs[i].repeat || fieldDefs[i].widget.type==\'file\' ) delete fieldDefs[i];
}
	Ext.onReady(function(){
   Dataface.modules.DataGrid.init();
   var grid = Dataface.modules.DataGrid.create({
   		fielddefs: fieldDefs,
   		id: '; ?>
'<?php echo $this->_tpl_vars['grid']->id; ?>
'<?php echo '
   	});
   
   setInterval(\'Dataface.modules.DataGrid.save()\', 5000);
   grid.render();
});

'; ?>


//--></script>

