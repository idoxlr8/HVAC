<?php

class tables_payments {
/*	function getChildren($record){
    return df_get_records('invoice', 
        array(
            'partstotal'=>'='.$record->val('partstotal')
       )
    );
}*/
   function __sql__(){
		$query = $_GET["dups"];
		    if ( $query == '1') {
				return "SELECT * FROM payments GROUP BY invoiceid HAVING count(invoiceid) > 1";
				}

	}

function after_action_new($params=array()){
    $record =& $params['record'];
	$a = $record->val('invoiceid');
	$b = $record->val('id');
	$c = $record->val('amount');
	header('Location:includes/update.php?invid='.$a.'&amount='.$c.'&id='.$b);
    
	exit;
}
	
	function date__renderCell( &$record ){
		$originalDate = $record->strval('date');
		$newDate = date("m-d-Y", strtotime($originalDate));
		return $newDate;
	}
	function invoicedate__renderCell( &$record ){
		$originalDate = $record->strval('invoicedate');
		$newDate = date("m-d-Y", strtotime($originalDate));
		return $newDate;
	}
	function amount__renderCell( &$record ){
	return money_format('$%i', $record->val('amount')).'<a target="_blank" href="includes/print_receipt.php?id='.$record->strval('invoiceid').'">(<font color="#347C2C">Receipt</font>)</a>';
	}

/*function amount__display($record){
    return money_format('$%i', $record->val('amount'));
}*/
function tax__display($record){
    return money_format('$%i', $record->val('tax'));
}
function labortotal__display($record){
    return money_format('$%i', $record->val('labortotal'));
}
function partstotal__display($record){
    return money_format('$%i', $record->val('partstotal'));
}
function total__display($record){
    return money_format('$%i', $record->val('total'));
}
	function month__default(){
		return date("M");
}
	function year__default(){
		return date("Y");
}


	function block__before_left_column(){
    
        echo "<div id=\"invoice-sidebar\">
            <h4>Tasks</h4><br />";
		include('includes/pay_dropdown.php');

		echo '<p><a href="index.php?-table=payments&tax=>0">Taxable Invoices</a></p>';
		echo '<p><a href="index.php?-table=payments&tax==0">Untaxable Invoices</a></p>';
		echo '<p><a href="index.php?-table=reports">Tax Report</a></p>';
		echo '<p><a href="index.php?-table=partial">Partial Balance</a></p>';
		echo '<p><a href="index.php?-table=payments&dups=1">Check For Duplicates</a> - This includes multiple payments on the same invoice.</p>';
        echo "</div>";
        
    }


}