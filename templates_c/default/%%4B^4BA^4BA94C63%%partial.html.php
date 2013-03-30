<?php /* Smarty version 2.6.18, created on 2013-02-11 10:06:41
         compiled from partial.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'use_macro', 'partial.html', 1, false),array('block', 'fill_slot', 'partial.html', 2, false),array('function', 'block', 'partial.html', 13, false),)), $this); ?>
<?php $this->_tag_stack[] = array('use_macro', array('file' => "Dataface_Main_Template.html")); $_block_repeat=true;$this->_plugins['block']['use_macro'][0][0]->use_macro($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('fill_slot', array('name' => 'main_column')); $_block_repeat=true;$this->_plugins['block']['fill_slot'][0][0]->fill_slot($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
        <!--<h1>Welcome to the Air Force Management System (AFMS)</h1>
        
        <p>This system allows you to manage your Customer Invoicing.  

            <ul>
                <li><img src="<?php echo $this->_tpl_vars['ENV']['DATAFACE_URL']; ?>
/images/file.gif"/> 
				<a href="index.php?-action=login&-cursor=0&-skip=0&-limit=30&-mode=list">Login</a>
                </li>
            </ul> -->
			
		<?php echo $this->_plugins['function']['block'][0][0]->block(array('name' => 'my_special_block'), $this);?>

    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['fill_slot'][0][0]->fill_slot($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['use_macro'][0][0]->use_macro($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>