<?
$myyear = $_GET["year"];
class tables_invoice {

function valuelist__yesno(){
    return array(
        'yes'=>'yes',
        'no'=>'no',
    );
}

	function getChildren($record){
    return df_get_records('payments', 
        array(
            'date'=='='.$record->val('paymentdate1')
       )
    );
}
 
	function labortotal__display($record){
    return money_format('$%i', $record->val('labortotal'));
}
	function partstotal__display($record){
    return money_format('$%i', $record->val('partstotal'));
}
	function subtotal__display($record){
    return money_format('$%i', $record->val('subtotal'));
}
	function tax__display($record){
    return money_format('$%i', $record->val('tax'));
}
	function total__display($record){
    return money_format('$%i', $record->val('total'));
}

	function difference__renderCell( &$record ){
	$related_records =& $record->strval('payment1');
	
	if ($record->strval('total') > $related_records)
		return '<font color="red">-' . money_format('$%i', $record->val('total')-$record->val('payment1')) . '</font>';
	else
		return money_format('$%i', $record->val('total')-$record->val('payment1'));
	}

///Render Cell to display the way we want//	
	function payment1__renderCell( &$record ){
	$app =& Dataface_Application::getInstance();
    $query =& $app->getQuery();
	$related_records =& $record->strval('payment1');
	$mydate = date("Y-m-d");
	$diff = $record->val('total')-$record->val('payment1');
///////Need to figure out if partial payment applies and id so... send a link without tax information//
//Maybe an elseif statement... elseif payment1 > than 0...
	if ($query['partial'] == 'true')
		return money_format('$%i', $record->val('payment1')).'<a href="index.php?-action=new&-table=payments&invoiceid='.$record->strval('id').'&customer='.$record->strval('customer').'&date='.$mydate.'&amount='.$diff.'&total='.$record->strval('total').'&invoicedate='.$record->strval('date').'"><font color="red">(Pay)</font></a>';
	
	if ($record->strval('total') > $related_records)
		return money_format('$%i', $record->val('payment1')).'<a href="index.php?-action=new&-table=payments&invoiceid='.$record->strval('id').'&customer='.$record->strval('customer').'&date='.$mydate.'&tax='.$record->strval('tax').'&amount='.$diff.'&total='.$record->strval('total').'&partstotal='.$record->strval('partstotal').'&labortotal='.$record->strval('labortotal').'&invoicedate='.$record->strval('date').'"><font color="red">(Pay)</font></a>';

	else
		return '<b>'.money_format('$%i', $record->val('payment1')).'</b><a target="_blank" href="includes/print_receipt.php?id='.$record->strval('id').'">(<font color="#347C2C">Receipt</font>)</a>';
	}
	
	function total__renderCell( &$record ){
	return money_format('$%i', $record->val('total')).'<a target="_blank" href="includes/print_invoice.php?id='.$record->strval('id').'">(<font color="#347C2C">Invoice</font>)</a>';
	}
	function date__renderCell( &$record ){
		$originalDate = $record->strval('date');
		$newDate = date("m-d-Y", strtotime($originalDate));
		return $newDate;
	}
//	function paymentdate1__renderCell( &$record ){
//		$originalDate = $record->strval('paymentdate1');
//		$newDate = date("m-d-Y");
//		return $newDate;
//	}
	
	function printdate__renderCell( &$record ){
		$originalDate = $record->strval('printdate');
		$newDate = date("m-d-Y", strtotime($originalDate));
		return $originalDate;
	}	
///End Of Render Cells///
	
///Give fields a default when in EDIT MODE///
	function date__default(){
		return date("Y-m-d");
}
	function month__default(){
		return date("M");
}
	function year__default(){
		return date("Y");
}
	function state__default(){
		return "Texas";
}	
///End Of Default Fields///

	
	function block__before_left_column(){
    
        echo "<div id=\"invoice-sidebar\">
            <h4>Tasks</h4><br />";
		include('includes/inv_dropdown.php');
        echo '<p><a href="index.php?-table=invoice">All Invoices</a></p>';
		//echo '<br />';
		echo '<p><a href="index.php?-table=invoice&payment1==0&year=' . $myyear . '">Unpaid Invoices</a></p>';
		//echo '<br />';
		echo '<p><a href="index.php?-table=invoice&payment1=>0&year=' . $myyear . '">Paid Invoices</a></p>';
		
		//echo '<p><a href="index.php?-table=invoice&action=partial">Partial Balance</a></p>';
		
        echo "</div>";
        
    }
}


