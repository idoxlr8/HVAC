<?php
class actions_reports {
    function handle(&$params){
        $bibs = df_get_records_array('docs', array());
        df_display(array('docs'=>$bibs), 'reports.html');
    }
}
?>