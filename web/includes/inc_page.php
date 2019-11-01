<?php
include_once(FS_ROOT.'includes/inc_head.php');
include_once(FS_ROOT."includes/inc_header.php");

// If the chosen layout file exists, use it. Otherwise use page.php (standard)
if ( file_exists(FS_ROOT.'layouts/'.$post_layout.'.php') ) {
    include_once(FS_ROOT.'layouts/'.$post_layout.'.php');
} else {
    include_once(FS_ROOT.'layouts/page.php');
}

include_once(FS_ROOT."includes/inc_footer.php");
include_once(FS_ROOT."includes/inc_js.php");
?>