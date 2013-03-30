<?php


class tables_customers {

    function email__renderCell( &$record ){
		$related_records =& $record->strval('email');
		
		if ($related_records == "")
			return $record->strval('email');
		else
			return '<a target="_blank" href="mailto:'.$record->strval('email').'">'.$record->strval('email').'</a>';
    }
	
	function webpage__renderCell( &$record ){
		$related_records =& $record->strval('webpage');
		
		if ($related_records == "")
			return $record->strval('webpage');
		else
			return '<a target="_blank" href="http://'.$record->strval('webpage').'">'.$record->strval('webpage').'</a>';
    }

	    function company__renderCell( &$record ){
       return $record->strval('company').' (<a href="index.php?-action=new&-table=invoice&customer='.$record->strval('company').'"> New</a>)';
    }	
	
    function block__before_left_column(){
    
        echo "<div id=\"invoice-sidebar\">
            <h4>Tasks</h4><br />";
		include('includes/cust_dropdown.php');
        //echo '<p><a href="index.php?-table=invoice">All Invoices</a></p>';
		//echo '<p><a href="index.php?-table=invoice&payment1==0">Unpaid Invoices</a></p>';
		//echo '<p><a href="index.php?-table=invoice&payment1=>0">Paid Invoices</a></p>';
        echo "</div>";
        
    }	
	
	
}


