<?php
if ( framework_get_option('script_focusform_active') )
        if ( !is_admin() && !is_feed() )
            themef_enqueue_script('jquery-focusform', 'jquery.focusform.min.js');
?>