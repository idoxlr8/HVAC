<?php
class actions_payments_report {
    function handle(&$params){
        $app =& Dataface_Application::getInstance();
        $query =& $app->getQuery();
        //$query['-skip'] = 0;
        //$query['-limit'] = 1000;
        
        if ( $query['-table'] != 'payments' ){
            return PEAR::raiseError('This action can only be called on the payments table.');
        }
        
        $payments = df_get_records_array('payments', $query);
        
 ?>       
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Language" content="en-us" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Payment Report</title>
<link href="css/print.css" rel="stylesheet" type="text/css" media="print, screen" />
</head>

<body onload="javascript:window.print()">

<table style="width: 100%" cellpadding="3" class="centered">
	<tr class="cell_header">
		<td class="cell_header">ID</td>
		<td class="cell_header">Invoice ID</td>
		<td class="cell_header">Invoice Date</td>
		<td class="cell_header">Customer</td>
		<td class="cell_header">Labor Total</td>
		<td class="cell_header">Parts Total</td>
		<td class="cell_header">Tax</td>
		<td class="cell_header">Total</td>
		<td class="cell_header">Payment Date</td>
		<td class="cell_header">Payment</td>
	</tr>
	



<?php
        foreach ($payments as $p){
    
		echo '<tr class="cell">';
		echo '<td class="cell">'.$p->htmlValue('id').'</td>';
		echo '<td class="cell">'.$p->htmlValue('invoiceid').'</td>';
		echo '<td class="cell">'.$p->htmlValue('invoicedate').'</td>';
		echo '<td class="cell">'.$p->htmlValue('customer').'</td>';		
		echo '<td class="cell">'.$p->htmlValue('labortotal').'</td>';
		echo '<td class="cell">'.$p->htmlValue('partstotal').'</td>';
		echo '<td class="cell">'.$p->htmlValue('tax').'</td>';
		echo '<td class="cell">'.$p->htmlValue('total').'</td>';
		echo '<td class="cell">'.$p->htmlValue('date').'</td>';
		echo '<td class="cell_right_end">'.$p->htmlValue('amount').'</td>';

		echo '</tr>';
 
        }
        
        echo '</table></body></html>';
        
    }
}