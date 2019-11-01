<?php
require_once("includes/inc_config.php");

$main_query = XSSTrapper($_GET['qstring']);
$main_query = str_replace('.php','',$main_query);
$main_query = rtrim($main_query,'/');

$qs_array = explode('/',$main_query);

$post_id = null;
$parent_ids = [0,1];

$correct_path = [];

$breadcrumb[] = ['/', 'home'];
$breadcrumbString = '';

if ( isAdmin() ) {
    $post_status = "(post_status = 'live' OR post_status = 'private')";
} else {
    $post_status = "post_status = 'live'";
}


// Loop through url to find page
foreach ( $qs_array as $level => $slug ) {

    // in_parents is the number of required ?'s to add to the query's IN section
    $in_parents = str_repeat('?, ', count($parent_ids) - 1) . '?';

    $getPost = $pdo->prepare("SELECT * FROM er_posts WHERE post_slug = ? AND $post_status AND parent_id IN ($in_parents) LIMIT 1");

    // merge the slug and status values with the parent ids array
    $arr = array_merge([$slug], $parent_ids);

    $getPost->execute($arr);

    if ( $getPost->rowCount() > 0 ) {

        $post = $getPost->fetch();

        if ( $post['_id'] != 2 ) {
            
            unset($meta_title);
            unset($meta_description);
            unset($page_tagline);
            unset($page_content);
            unset($page_content2);
            unset($page_content3);

            $post_id = $post['_id'];
            $parent_id = $post['parent_id'];
            $post_title = $post['post_title'];
            $post_slug = $post['post_slug'];
            $post_alt_title = $post['post_alt_title'];
            $post_type = $post['post_type'];
            $menu_order = $post['menu_order'];

            if ( $post_id == 1 ) {
                $post_layout = 'homepage';
            } else {
                $post_layout = $post['post_type'];
            }

            $parent_ids = [$post_id];

            if ( $post_slug != 'index' ) {
                $correct_path[] = $post_slug;
            }

            $getPostMeta = $pdo->prepare("SELECT * FROM er_postmeta WHERE post_id = :id");
            $getPostMeta->execute(['id'=>$post_id]);
            $postMeta = $getPostMeta->fetchAll();

            foreach ( $postMeta as $field ) {
                $meta_name = $field['meta_name'];
                $$meta_name = $field['meta_value'];
            }
            
            $breadcrumb[] = [$post_slug.'/', $post_title];
            $breadcrumbString = $post_title . (($breadcrumbString != '')? ' - ' : '') . $breadcrumbString;
            
            
            // If the meta title is not already set, create one to use on the post
            switch($post_type) {

                default: 
                $meta_title = (isset($meta_title)) ? $meta_title . (($post_slug != 'index') ? ' '.$append_meta_title : '') : $breadcrumbString . ' : ' . $site_name .' '. $append_meta_title;
            } 
            
            
            switch ($post_type) {
                
                default : 
                    $meta_description = (isset($meta_description)) ? $meta_description  : $breadcrumbString . ' : ' . $site_name .' '. $append_meta_description;
            }
        }

    } else {
        
                
        switch ( $post_layout ) {

            default:
                $post = $post_id = $parent_id = $post_title = $post_layout = $post_slug = $post_alt_title = $post_type = null;
        }
        
    }

}

// If there's no trailing slash on the URL, add it
if ( !empty($correct_path) ) {
    $correct_path = implode("/",$correct_path) . "/";

    if ( strtok($_SERVER["REQUEST_URI"],'?') != "/".$correct_path ) {
        $realqs = strtok('?');
        header("HTTP/1.1 301 Moved Permanently");
		header("Location: ".SITE_URL.$correct_path.( ($realqs!='')?'?'.$realqs:''));
		exit();
    }
}


// Generate variables for the post, if it exists
if ( $post_id ) {
    require_once('includes/inc_page.php');
    exit();
}

// check for non-db pages
switch (end($qs_array)) {

    // Handle non-database posts (if any) or do 404

    default:
        // If you end up here, it's a 404. Set header and show 404 page
        $post = $pdo->query("SELECT * FROM er_posts WHERE _id = '2' LIMIT 1")->fetch();
        $post_id = $post['_id'];
        $post_title = $post['post_title'];
        $post_layout = '404';

        $postMeta = $pdo->query("SELECT * FROM er_postmeta WHERE post_id = '2'");
        foreach ( $postMeta as $field ) {
            $meta_name = $field['meta_name'];
            $$meta_name = $field['meta_value'];
        }

        header('HTTP/1.0 404 Not Found');
        require_once('includes/inc_page.php');
        break;

}
exit();