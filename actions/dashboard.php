<?php
class actions_dashboard {
    function handle(&$params){
        $bibs = df_get_records_array('docs', array());
        df_display(array('docs'=>$bibs), 'dashboard.html');
    }
}
?>