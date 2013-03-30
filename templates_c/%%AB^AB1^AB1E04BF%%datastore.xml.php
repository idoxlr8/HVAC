<?php /* Smarty version 2.6.18, created on 2013-02-11 10:50:49
         compiled from DataGrid/datastore.xml */ ?>
<?php echo '<?xml'; ?>
 version="1.0"<?php echo '?>'; ?>

<datastore>
<?php $_from = $this->_tpl_vars['rows']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['row']):
?>
	<row id="<?php echo $this->_tpl_vars['row']['__recordID__']; ?>
">
	<?php $_from = $this->_tpl_vars['row']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['value']):
?>
		<?php if ($this->_tpl_vars['key'] != '__recordID__'): ?>
		<<?php echo $this->_tpl_vars['key']; ?>
><?php echo $this->_tpl_vars['value']; ?>
</<?php echo $this->_tpl_vars['key']; ?>
>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</row>
<?php endforeach; endif; unset($_from); ?>
</datastore>
