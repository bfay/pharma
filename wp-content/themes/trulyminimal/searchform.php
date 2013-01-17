<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div>
        <input type="text" value="<?php _e( 'enter search term', 'trulyminimal' ); ?>" name="s" id="s" />
        <input type="submit" id="searchsubmit" value="<?php _e( 'Search', 'trulyminimal' ); ?>" />
    </div>
</form>