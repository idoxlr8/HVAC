<?php /* Smarty version 2.6.18, created on 2013-03-16 21:41:57
         compiled from invoice_edit.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('block', 'use_macro', 'invoice_edit.html', 1, false),array('block', 'fill_slot', 'invoice_edit.html', 2, false),)), $this); ?>
<?php $this->_tag_stack[] = array('use_macro', array('file' => "Dataface_Main_Template.html")); $_block_repeat=true;$this->_plugins['block']['use_macro'][0][0]->use_macro($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
    <?php $this->_tag_stack[] = array('fill_slot', array('name' => 'html_body')); $_block_repeat=true;$this->_plugins['block']['fill_slot'][0][0]->fill_slot($this->_tag_stack[count($this->_tag_stack)-1][1], null, $this, $_block_repeat);while ($_block_repeat) { ob_start(); ?>
	<table cellpadding="2" cellspacing="3">
		<tr>
			<td>
			<table cellpadding="2" cellspacing="3">
				<tr><td colspan="4"><p></p></td></tr>
		    	<tr>
		<td class="currentLabel">Date:</td>
		<td><?php echo $this->_tpl_vars['elements']['date']['html']; ?>
</td>

		</tr>
		<tr>
		<td class="currentLabel">Customer:</td>
		<td colspan="2"><?php echo $this->_tpl_vars['elements']['customer']['html']; ?>
<a href="#" onclick="return openNewWindow('includes/help.php?id=1', '', '400', '200')"><img src="<?php echo $this->_tpl_vars['elements']['customer']['field']['icon']; ?>
" /></a></td>
		</tr>
		<tr>
		<td class="currentLabel">Address</td>
		<td colspan="2"><?php echo $this->_tpl_vars['elements']['address']['html']; ?>
</td>
		</tr>
		<tr>
		<td class="currentLabel">Property</td>
		<td colspan="2"><?php echo $this->_tpl_vars['elements']['property']['html']; ?>
</td>
		</tr>
		<tr>
		<td class="currentLabel">City/State/Zip</td>
		<td colspan="2"><?php echo $this->_tpl_vars['elements']['city']['html']; ?>
&nbsp;<?php echo $this->_tpl_vars['elements']['state']['html']; ?>
&nbsp;<?php echo $this->_tpl_vars['elements']['zip']['html']; ?>
</td>
		</tr>
		</table>
   		</td>
		</tr>
		<tr>
		<td>
		<table cellpadding="2" cellspacing="3">
		<tr>
		<td class="currentLabel">Parts</td>
		<td class="currentLabel">Parts Taxable?</td>
		<td class="currentLabel">
			<!--<select name="partstaxable" id="partstaxable">
				<option selected="selected">Choose</option>
				<option value="yes">yes</option>
				<option value="no">no</option>
			</select>-->
			<?php echo $this->_tpl_vars['elements']['partstaxable']['html']; ?>

		</td>
		</tr>
		<tr>
		<td class="currentLabel" style="width: 43px">Qty</td>
		<td class="currentLabel" style="width: 682px">Description</td>
		<td class="currentLabel">Amount</td>
		</tr>
		<tr>
		<td style="width: 43px"><?php echo $this->_tpl_vars['elements']['item1qty']['html']; ?>
</td>
		<td style="width: 682px"><?php echo $this->_tpl_vars['elements']['item1description']['html']; ?>
</td>
		<td><?php echo $this->_tpl_vars['elements']['item1cost']['html']; ?>
</td>
		</tr>
		<tr>
		<td style="width: 43px"><?php echo $this->_tpl_vars['elements']['item2qty']['html']; ?>
</td>
		<td style="width: 682px"><?php echo $this->_tpl_vars['elements']['item2description']['html']; ?>
</td>
		<td><?php echo $this->_tpl_vars['elements']['item2cost']['html']; ?>
</td>
		</tr>
		<tr>
		<td style="width: 43px"><?php echo $this->_tpl_vars['elements']['item3qty']['html']; ?>
</td>
		<td style="width: 682px"><?php echo $this->_tpl_vars['elements']['item3description']['html']; ?>
</td>
		<td><?php echo $this->_tpl_vars['elements']['item3cost']['html']; ?>
</td>
		</tr>
		<tr>
		<td style="width: 43px"><?php echo $this->_tpl_vars['elements']['item4qty']['html']; ?>
</td>
		<td style="width: 682px"><?php echo $this->_tpl_vars['elements']['item4description']['html']; ?>
</td>
		<td><?php echo $this->_tpl_vars['elements']['item4cost']['html']; ?>
</td>
		</tr>
		<tr>
		<td style="width: 43px"><?php echo $this->_tpl_vars['elements']['item5qty']['html']; ?>
</td>
		<td style="width: 682px"><?php echo $this->_tpl_vars['elements']['item5description']['html']; ?>
</td>
		<td><?php echo $this->_tpl_vars['elements']['item5cost']['html']; ?>
</td>
		</tr>
		<tr>
		<td style="width: 43px"><?php echo $this->_tpl_vars['elements']['item6qty']['html']; ?>
</td>
		<td style="width: 682px"><?php echo $this->_tpl_vars['elements']['item6description']['html']; ?>
</td>
		<td><?php echo $this->_tpl_vars['elements']['item6cost']['html']; ?>
</td>
		</tr>
		
		<tr>
		<td style="width: 43px"><?php echo $this->_tpl_vars['elements']['item7qty']['html']; ?>
</td>
		<td style="width: 682px"><?php echo $this->_tpl_vars['elements']['item7description']['html']; ?>
</td>
		<td><?php echo $this->_tpl_vars['elements']['item7cost']['html']; ?>
</td>
		</tr>
		
		<tr>
		<td style="width: 43px"><?php echo $this->_tpl_vars['elements']['item8qty']['html']; ?>
</td>
		<td style="width: 682px"><?php echo $this->_tpl_vars['elements']['item8description']['html']; ?>
</td>
		<td><?php echo $this->_tpl_vars['elements']['item8cost']['html']; ?>
</td>
		</tr>
		
		<tr>
		<td style="width: 43px"><?php echo $this->_tpl_vars['elements']['item9qty']['html']; ?>
</td>
		<td style="width: 682px"><?php echo $this->_tpl_vars['elements']['item9description']['html']; ?>
</td>
		<td><?php echo $this->_tpl_vars['elements']['item9cost']['html']; ?>
</td>
		</tr>		
		<tr>
		<td colspan="3"></td>
		</tr>
		<tr>
		<td colspan="3"></td>
		</tr>
		<tr>
		<td class="currentLabel">Service</td>
		<td class="currentLabel">Labor Taxable?</td>
		<td class="currentLabel">
			<!--<select name="labortaxable" id="labortaxable">
				<option selected="selected">Choose</option>
				<option value="yes">yes</option>
				<option value="no">no</option>
			</select>-->
		<?php echo $this->_tpl_vars['elements']['labortaxable']['html']; ?>
			
		</td>
		</tr>
		<tr>
		<td class="currentLabel">Hrs</td>
		<td class="currentLabel">Description</td>
		<td class="currentLabel">Amount</td>
		</tr>
		<tr>
		<td style="width: 43px"><?php echo $this->_tpl_vars['elements']['labor1qty']['html']; ?>
</td>
		<td style="width: 682px"><?php echo $this->_tpl_vars['elements']['labor1description']['html']; ?>
</td>
		<td><?php echo $this->_tpl_vars['elements']['labor1cost']['html']; ?>
</td>
		</tr>
		<tr>
		<td style="width: 43px"><?php echo $this->_tpl_vars['elements']['labor2qty']['html']; ?>
</td>
		<td style="width: 682px"><?php echo $this->_tpl_vars['elements']['labor2description']['html']; ?>
</td>
		<td><?php echo $this->_tpl_vars['elements']['labor2cost']['html']; ?>
</td>
		</tr>
		<tr>
		<td style="width: 43px"><?php echo $this->_tpl_vars['elements']['labor3qty']['html']; ?>
</td>
		<td style="width: 682px"><?php echo $this->_tpl_vars['elements']['labor3description']['html']; ?>
</td>
		<td><?php echo $this->_tpl_vars['elements']['labor3cost']['html']; ?>
</td>
		</tr>
		</table>
		</td>
		</tr>
		<tr>
		<td>
		
		<table cellpadding="2" cellspacing="3" style="width: 100%">
		<tr><td style="width: 70%" class="infolabel"><a href="#" onclick="return openNewWindow('includes/help.php?id=1', '', '400', '200')"><img src="<?php echo $this->_tpl_vars['elements']['payment1']['field']['icon']; ?>
" /></a></td>
		<td style="width: 15%" class="currentLabel">
		All Payments:&nbsp; </td><td style="width: 15%">
		<?php echo $this->_tpl_vars['elements']['payment1']['html']; ?>
</td></tr>
		<tr><td style="width: 70%" class="infolabel">Related <em>"Payments"</em> Record Must Be Changed If You Change This!</td>
		<td style="width: 15%" class="currentLabel">
		Payment Date:&nbsp; </td><td style="width: 15%">
		<?php echo $this->_tpl_vars['elements']['paymentdate1']['html']; ?>
</td></tr>
		<tr><td style="width: 70%" class="infolabel">
		&nbsp;</td><td style="width: 15%" class="currentLabel">
		Parts Total:&nbsp; </td><td style="width: 15%">
		<?php echo $this->_tpl_vars['elements']['partstotal']['html']; ?>
</td></tr>
		<tr><td style="width: 70%" class="infolabel">
		&nbsp;</td><td style="width: 15%" class="currentLabel">
		Labor Total:&nbsp; </td><td style="width: 15%">
		<?php echo $this->_tpl_vars['elements']['labortotal']['html']; ?>
</td></tr>
		<tr><td style="width: 70%" class="infolabel">
		&nbsp;</td><td style="width: 15%" class="currentLabel">
		Sub Total:&nbsp; </td><td style="width: 15%">
		<?php echo $this->_tpl_vars['elements']['subtotal']['html']; ?>
</td></tr>
		<tr><td style="width: 70%" class="infolabel">
		&nbsp;</td><td style="width: 15%" class="currentLabel">
		Parts Tax:&nbsp; </td><td style="width: 15%">
		<input name="tax1" id="tax1" type="text" size="30" style="width: 232px"></td></tr>
		<tr><td style="width: 70%" class="infolabel">
		&nbsp;</td><td style="width: 15%" class="currentLabel">
		Labor Tax:&nbsp; </td><td style="width: 15%">
		<input name="tax2" id="tax2" type="text" size="30" style="width: 232px"></td></tr>
		<tr><td style="width: 70%" class="infolabel">
		&nbsp;</td><td style="width: 15%" class="currentLabel">
		Total Tax:&nbsp; </td><td style="width: 15%">
		<?php echo $this->_tpl_vars['elements']['tax']['html']; ?>
</td></tr>
		<tr><td style="width: 70%" class="infolabel">
		&nbsp;</td><td style="width: 15%" class="currentLabel">
		Total:&nbsp; </td><td style="width: 15%">
				<?php echo $this->_tpl_vars['elements']['total']['html']; ?>
</td></tr>
		<tr><td style="width: 70%" class="infolabel">
		&nbsp;</td><td style="width: 15%" class="currentLabel">
		Update:&nbsp; </td><td class="infolabel" style="width: 15%">
		<strong><a href="#" onclick="updatetotal()">Update Totals</a></strong></td></tr>
		<tr>
		<td colspan="3">
		&nbsp;</td>
		</tr>
		<tr>
		<td class="currentLabel" colspan="3">Comments For Customer</td>
		</tr>
		<tr>
		<td colspan="3">
		<?php echo $this->_tpl_vars['elements']['custcomments']['html']; ?>
</td>
		</tr>
		<tr>
		<td class="currentLabel" colspan="3">Personal Comments</td>
		</tr>
		<tr>
		<td colspan="3"><?php echo $this->_tpl_vars['elements']['notes']['html']; ?>
</td>
		</tr>
		<tr>
		<td colspan="3"><center><b>Be Sure To  <a href="#" onclick="updatetotal()"> Update Totals</a></b></center></td>
		</tr>
				<tr>
					<td colspan="3"></td>
				</tr>
			</table>
			</td>
		</tr>
	</table>




   <?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['fill_slot'][0][0]->fill_slot($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>
<?php $_block_content = ob_get_contents(); ob_end_clean(); $_block_repeat=false;echo $this->_plugins['block']['use_macro'][0][0]->use_macro($this->_tag_stack[count($this->_tag_stack)-1][1], $_block_content, $this, $_block_repeat); }  array_pop($this->_tag_stack); ?>