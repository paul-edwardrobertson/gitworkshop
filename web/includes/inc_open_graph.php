<?
	switch ( $post_type ) {
    	case 'page':
    	    $og_set_image = 'header_image';
    	    break;
        case 'product':
    	    $og_set_image = 'product_thumbnail';
    	    break;
        default:
    	    $og_set_image = $post_type . '_image';
	}
	
	if ( isset($og_set_image) ) {
    	$getOgImage = $pdo->prepare("SELECT meta_value FROM er_postmeta WHERE post_id = ? AND meta_name = ?");
    	$getOgImage->execute([$post_id,$og_set_image]);
    	
    	if ( $has_og_image = $getOgImage->fetch() ) {
        	$og_image_json = json_decode($has_og_image['meta_value'],true);
        	$og_image = rtrim(SITE_URL,"/").$og_image_json['post_slug'];
    	}
	}
	
	$og_title = (isset($meta_title)) ? $meta_title : $post_title . ' ' . $append_meta_title;
	$og_desc = (isset($meta_description)) ? $meta_description : $post_title . ' ' . $append_meta_description;
	$og_url = rtrim(SITE_URL,"/").(($post_id == 1)?'':buildPath($post_id));
	$og_type = $post_type;
?>
        
    <meta property="og:title" content="<?=$og_title;?>"> 
    <meta property="og:description" content="<?=$og_desc;?>"> 
    <meta property="og:type" content="<?=$og_type;?>">
    <meta property="og:url" content="<?=$og_url;?>">
    <? if ( isset($og_image) ) { ?><meta property="og:image" content="<?=$og_image?>">
    <? } ?><meta property="og:site_name" content="<?=$site_name?>">
    
    <meta name="twitter:card" content="summary">
    <meta name="twitter:url" content="<?=$og_url?>">
    <meta name="twitter:title" content="<?=$og_title?>">
    <meta name="twitter:description" content="<?=$og_desc;?>">
    <? if ( isset($og_image) ) { ?><meta name="twitter:image" content="<?=$og_image?>">
    <? } ?><? if( isset($twitter_handle) &&  $twitter_handle != "") { ?><meta name="twitter:creator" content="<?=$twitter_handle;?>">
    <? } ?><? if ( isset($og_image) ) { ?><link rel="image_src" href="<?=$og_image?>"/>
    
    <? } ?>