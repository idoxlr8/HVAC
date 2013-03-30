<?php
class actions_partial {
    function handle(&$params){
        $bibs = df_get_records_array('docs', array());
        df_display(array('docs'=>$bibs), 'partial.html');
    }
}
?>