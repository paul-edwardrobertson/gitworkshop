<?
$breadcrumb = array();

if ($bypass_default_meta != true) {

	$rsPages = mysqli_query($db_con,"SELECT * FROM c_page WHERE page_id = " . $page_id . " AND show_on_site='Yes'" );

	if (mysqli_num_rows($rsPages)==0) {
		// this should never happen
		exit();
	} else {

		while ($rsPage = mysqli_fetch_array($rsPages)) {

      //LOAD VARS
			$page_parent_id	= $rsPage['page_parent_id'];
			$page_title		= $rsPage['page_title'];
			$page_short_title = $rsPage['page_short_title'];
			$page_intro		= $rsPage['page_intro'];
			$page_tagline = $rsPage['page_tagline'];
			$page_content	= $rsPage['page_content'];
			$page_content2	= $rsPage['page_content2'];
			$page_content3	= $rsPage['page_content3'];
			$page_layout	= $rsPage['page_layout'];
			$page_slug		= $rsPage['page_slug'];
			$meta_noindex	= $rsPage['meta_noindex'];

			// check if the page layout file exists.
			if (!is_file(FS_ROOT . "layouts/". $page_layout . ".php")) {
				$page_layout = "standard";
			}

			//META
			$PageMETATitle = buildMetaTitle($rsPage['meta_title'],$rsPage['page_title']);
			$PageMETADescription = buildMetaDescription($rsPage['meta_description'],$rsPage['page_intro'],$rsPage['page_content']);

			// build breadcrumb, work out correct url
			// reccursively work back through the pages until root

			$correct_url = $rsPage['page_slug']."/";
			function pageLoop($page_parent_id) {
				global $db_con;
				global $correct_url;
				global $breadcrumb;
				$rsTemps = mysqli_query($db_con,"SELECT * FROM c_page WHERE page_id = " . $page_parent_id . " AND show_on_site='Yes'" );
				if (mysqli_num_rows($rsTemps)==0) {
					// parent doesn't exist - that shouldn't be possible
				}else{
					$rsTemp = mysqli_fetch_assoc($rsTemps);
					$correct_url = $rsTemp["page_slug"] . "/" . $correct_url;
					if ($rsTemp["page_parent_id"]>0) {
						array_unshift($breadcrumb,array($rsTemp['page_slug']."/",$rsTemp['page_title']));
						pageLoop($rsTemp["page_parent_id"]);
					}
				}
			}
			
			// page images (if any)
			$page_images = array();
			$rsPhotosQ = "SELECT * FROM c_gallery_photo WHERE page_id = '".$page_id."' AND show_on_site = 'Yes' ORDER BY order_in_set ASC";
			if ( mysqli_num_rows( $rsPhotos = mysqli_query($db_con,$rsPhotosQ) ) >= 1 ) {
    			while ( $rsPhoto = mysqli_fetch_assoc($rsPhotos) ) {
        			$page_images[] = $rsPhoto;
    			}
			}

			if ($page_parent_id>0) {
				//array_unshift($breadcrumb,array($rsPage['page_slug']."/",$rsPage['page_title']));
				pageLoop($page_parent_id);
			}

			$correct_url = preg_replace('/index\//', "", $correct_url, 1);

			// handle "thanks" querystring
			if (isset($_GET['qstr'])) {
				if (XSSTrapper($_GET['qstr']) == "thanks") {
					$correct_url = $correct_url . "thanks";
				}
			}


		}
	}

}

if ($page_layout=="404") { header('HTTP/1.0 404 Not Found'); }

array_unshift($breadcrumb,array($NormPath,'Home'));
if ($force_layout!='' && !is_null($force_layout)) { $page_layout = $force_layout; }
?>
