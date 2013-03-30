<?php /* Smarty version 2.6.18, created on 2013-02-14 14:21:09
         compiled from dashboard.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'use_macro', 'dashboard.html', 1, false),array('block', 'fill_slot', 'dashboard.html', 2, false),array('block', 'define_slot', 'dashboard.html', 17, false),array('block', 'translate', 'dashboard.html', 17, false),array('function', 'block', 'dashboard.html', 16, false),)), $this); ?>
<?php $this->_tag_stack[] = array('use_macro', array('file' => "Dataface_Main_Template.html")); $_block_repeat=true;$this->_plugins['block']['use_macro'][0][0]->use_macro($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('fill_slot', array('name' => 'main_column')); $_block_repeat=true;$this->_plugins['block']['fill_slot'][0][0]->fill_slot($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<table style="width: 100%" cellspacing="1" class="style1">
	<tr>
		<td valign="top">
       <h1>Welcome to the Air Force Management System (AFMS)</h1>
        
        <p>This system allows you to manage your Customer Invoicing.  

            <ul>
                <!-- <li><img src="<?php echo $this->_tpl_vars['ENV']['DATAFACE_URL']; ?>
/images/file.gif"/> <a href="index.php?-action=login&-cursor=0&-skip=0&-limit=30&-mode=list">Login</a></li> -->
				
		<?php if (! $this->_tpl_vars['ENV']['prefs']['hide_user_status']): ?>
		<li><img src="<?php echo $this->_tpl_vars['ENV']['DATAFACE_URL']; ?>
/images/file.gif"/>
		<?php if ($this->_tpl_vars['ENV']['username']): ?>
			<?php echo $this->_plugins['function']['block'][0][0]->block(array('name' => 'before_user_status_logged_in'), $this);?>

			<?php $this->_tag_stack[] = array('define_slot', array('name' => 'user_status_logged_in')); $_block_repeat=true;$this->_plugins['block']['define_slot'][0][0]->define_slot($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><?php $this->assign('username', $this->_tpl_vars['ENV']['username']); ?><?php $this->_tag_stack[] = array('translate', array('id' => 'Logged in as user','username' => $this->_tpl_vars['username'])); $_block_repeat=true;$this->_plugins['block']['translate'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Logged in as <?php echo $this->_tpl_vars['username']; ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['translate'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?> (<a href="<?php echo $this->_tpl_vars['APP']->url('-action=logout'); ?>
" title="<?php $this->_tag_stack[] = array('translate', array('id' => "scripts.GLOBAL.LABEL_LOGOUT")); $_block_repeat=true;$this->_plugins['block']['translate'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Logout<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['translate'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>"><?php $this->_tag_stack[] = array('translate', array('id' => "scripts.GLOBAL.LABEL_LOGOUT")); $_block_repeat=true;$this->_plugins['block']['translate'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Logout<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['translate'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a>)<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['define_slot'][0][0]->define_slot($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php echo $this->_plugins['function']['block'][0][0]->block(array('name' => 'after_user_status_logged_in'), $this);?>

		<?php elseif ($this->_tpl_vars['APP']->getAuthenticationTool()): ?>
			<?php echo $this->_plugins['function']['block'][0][0]->block(array('name' => 'before_user_status_not_logged_in'), $this);?>

			<?php $this->_tag_stack[] = array('define_slot', array('name' => 'user_status_not_logged_in')); $_block_repeat=true;$this->_plugins['block']['define_slot'][0][0]->define_slot($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?><a href="<?php echo $this->_tpl_vars['APP']->url('-action=login'); ?>
" title="Login"><?php $this->_tag_stack[] = array('translate', array('id' => "scripts.GLOBAL.LABEL_LOGIN")); $_block_repeat=true;$this->_plugins['block']['translate'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>Login<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['translate'][0][0]->translate($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?></a><?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['define_slot'][0][0]->define_slot($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
			<?php echo $this->_plugins['function']['block'][0][0]->block(array('name' => 'after_user_status_not_logged_in'), $this);?>

		<?php endif; ?>
		</li>
		<?php endif; ?>
				<!-- <li><img src="<?php echo $this->_tpl_vars['ENV']['DATAFACE_URL']; ?>
/images/file.gif"/> <a href="hvac.idoxlr8.com/v1.php">Old Site V1</a></li> -->
				<li><img src="images/bomb.png"/> <a target="_blank" href="includes/sync.php">Synchronize - Check for updates</a></li>
				<li><img src="images/bomb.png"/> <a target="_blank" href="backup/backup.php">Backup Database</a></li>
            </ul>
				<?php echo $this->_plugins['function']['block'][0][0]->block(array('name' => 'my_special_block'), $this);?>

		</td>
		<td valign="top">
		<h1>Weather Forecast For <?php echo $this->_tpl_vars['ENV']['APPLICATION']['weathercity']; ?>
</h1>
		<iframe name="I1" id="I1" src="weather/index.php" marginwidth="1" marginheight="1" scrolling="no" border="0" frameborder="0" style="height: 600px; width: 350px; float: center">Your browser does not support inline frames or is currently configured not to display inline frames.
			</iframe>		
		</td>
	</tr>
</table>

	
 
			


    <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['fill_slot'][0][0]->fill_slot($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['use_macro'][0][0]->use_macro($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>