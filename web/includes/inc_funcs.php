<?php
// isAdmin
function isAdmin() {
    global $pdo;

    if ( isset($_SESSION['eruid']) && (int)$_SESSION['eruid'] > 0 ) {
        $id = $_SESSION['eruid'];

        $adminCheck = $pdo->prepare("SELECT level FROM er_users WHERE _id = ? LIMIT 1");
        $adminCheck->execute([$id]);
        $is_admin = $adminCheck->fetch();

        if ( $is_admin['level'] == 'superuser' || $is_admin['level'] == 'admin' ) {
            return true;
        }
    }

    return false;
}

// XSSTrapper
function XSSTrapper($TheString) {
	if (is_null($TheString) || trim($TheString) == "") {
		$XSSTrapper = $TheString;
	} else {
		$XSSTrapper = trim($TheString);
		$XSSTrapper = str_replace(
			array("<",">","(",")","'","\""),
			array("&lt;","&gt;","&#x28;","&#x29;","&apos;","&#x22;"),
			$XSSTrapper
		);
	}
	return $XSSTrapper;
}

// Check XSSTrapper output
function trapCheck($input) {    
    if ( $input != '' && !is_null($input) ) {
        return true;
    }
    return false;
}

// buildPath
function buildPath($post_id, $count = 0) {
    global $pdo;
    global $path;

    if ( $count == 0 ) {
        $path = [];
    }

    $getPost = $pdo->prepare("SELECT post_slug, parent_id FROM er_posts WHERE _id = ? LIMIT 1");
    $getPost->execute([$post_id]);

    if ( $post = $getPost->fetch() ) {
        // Add page slug to path array
        $path[] = $post['post_slug'];

        // Loop this function until parent_id reaches 1, then build the path
        if ( $post['parent_id'] > 1 ) {
            $count++;
            buildPath($post['parent_id'], $count);
        } else {
            $path = "/" . implode("/",array_reverse($path)) . "/";
        }
    }
    return $path;
}

// buildBreadcrumb
function buildBreadcrumb($thearray) {
	global $NormPath;
	echo '<ul id="breadcrumb" class="reset--list">';
	$combined_url="";
	foreach ($thearray as $value) {
		$combined_url .= $value[0];
		echo '<li class="breadcrumb__item" itemscope itemtype="https://data-vocabulary.org/Breadcrumb"><a class="breadcrumb__link" href="'.$combined_url.'" itemprop="url"><span itemprop="title">'.ucwords($value[1]).'</span></a></li>';
	}
	echo '</ul>';
}

// EMAILER
function emailer($fromname,$fromemail,$replyto,$toemail,$ccemail,$bccemail,$subject,$mailbody,$htmlmailbody,$attachments) {
	$mail = new htmlMimeMail5();

    // BASIC SETUP
    $mail -> setTextCharset('UTF-8');
    $mail -> setHTMLCharset('UTF-8');
    $mail -> setFrom("$fromname <$fromemail>");
    $mail -> setHeader('Reply-To', $replyto);
	$mail -> setReturnPath("$fromemail");
	$mail -> setSubject($subject);

	// RECIPIENTS
	if (!empty($ccemail)) {
		$mail -> setCc($ccemail);
	}

	if (!empty($bccemail)) {
		$mail -> setBcc($bccemail);
	}

	// SET MAIL BODY
	if ($mailbody!='' && !is_null($mailbody)) {
		$mail -> setText($mailbody);
	}
	if ($htmlmailbody!='' && !is_null($htmlmailbody)) {
		$mail -> setHTML($htmlmailbody);
	}

	if (!empty($attachments)) {
		foreach ($attachments as $attachment){
			$mail->addAttachment(new fileAttachment($attachment));
		}
	}

	// SEND
	$mail -> send(array($toemail));
}

function showName($post_id) {
    global $pdo;

    $getPost = $pdo->prepare("SELECT post_title FROM er_posts WHERE _id = ? LIMIT 1");
    $getPost->execute([$post_id]);
    
    $post = $getPost->fetch();
    return $post['post_title'];
}

function showLink($post_id, $class_name, $title_type) {
    global $pdo;
	// Example use - showLink(1,"button","post_title") - id of post and class name

    $getPost = $pdo->prepare("SELECT _id, post_title FROM er_posts WHERE _id = ? LIMIT 1");
    $getPost->execute([$post_id]);
    
    $post = $getPost->fetch();
    return '<a class="'.$class_name.'" href="'.buildPath($post['_id']).'">'.$post[$title_type].'</a>';
}

function pullMeta($post,$prefs = []) {
	global $pdo;
	// Example use - pullMeta($row,["image_thumbnail","header_image"]) - id of post and array of items needed
	// Example use - pullMeta($row) - this will grab all meta_value

    if ( !empty($prefs) ) {
        $in = str_repeat('?,',count($prefs) - 1) . '?';
        $pullMeta = $pdo->prepare("SELECT * FROM er_postmeta WHERE post_id = ? AND meta_name IN ($in)");
        $pullMeta->execute(array_merge([$post['_id']],$prefs));
    } else {
        $pullMeta = $pdo->prepare("SELECT * FROM er_postmeta WHERE post_id = ?");
        $pullMeta->execute([$post['_id']]);
    }

    if ( $pullMeta->rowCount() > 0 ) {
        $meta = $pullMeta->fetchAll();

        foreach ( $meta as $m ) {
            if ( substr($m['meta_value'],0,1) == '{' || substr($m['meta_value'],0,2) == '[{' ) {
                $post[$m['meta_name']] = json_decode($m['meta_value'],true);
            } else {
                $post[$m['meta_name']] = $m['meta_value'];
            }
        }
    }

    return $post;
}
?>