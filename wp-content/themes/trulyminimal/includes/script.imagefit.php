<?php
if ( framework_get_option('script_imagefit_active') )
        if ( !is_admin() && !is_feed() )
            themef_enqueue_script('jquery-imagefit', 'jquery.imagefit.min.js');
?>