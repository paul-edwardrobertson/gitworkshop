<?
	if ( !defined('FS_ROOT') ) {
		// 404
		require_once($_SERVER['DOCUMENT_ROOT']."/includes/inc_funcs.php");
		do404();
		exit();
	}
?> 
<main id="main">
<section id="masthead" class="section">     
	<div class="inner">
		<?
        array_pop($breadcrumb);
		if( $parent_id > 1 ) { buildBreadcrumb($breadcrumb); } ?>
		
		<ul id="breadcrumb" class="reset--list">
			<li class="breadcrumb__item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="breadcrumb__link" href="/" itemprop="url"><span itemprop="title">Home</span></a></li>
			<li class="breadcrumb__item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="breadcrumb__link" href="asdsad" itemprop="url"><span itemprop="title">Page Name</span></a></li>
			<li class="breadcrumb__item" itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a class="breadcrumb__link" href="asdas" itemprop="url"><span itemprop="title">Subpage Name</span></a></span></li>
		</ul>                    
        <? if ( isset($post_title) && $post_title != '' ) { ?><h1 class="post-title"><?=$post_title?></h1><? } ?>        
        <? if ( isset($post_tagline) && $post_tagline != '' ) { ?><div class="post-tagline"><?=$post_tagline;?></div><? } ?>
	</div>
</section>
<section class="section homepage">     
	<div class="inner">
	
	<h3>Admin Login</h3>
	<p>Please <a href="/admin/">login to your admin</a></p>
	<p><a class="button button--outlined" href="/admin/">Admin Log in</a></p>

	<hr />

	<h3>Example of pulling link</h3>

	<?=showLink(3,"button","post_title")?>

	<hr />
	
	<? if ( isset($post_content) && strlen(trim($post_content)) > 0 ) { ?><div class="post-content"><?=$post_content;?></div><? } ?>
    <? if ( isset($post_content2) && strlen(trim($post_content2)) > 0 ) { ?><div class="post-content2"><?=$post_content2;?></div><? } ?>
    <? if ( isset($post_content3) && strlen(trim($post_content3)) > 0 ) { ?><div class="post-content3"><?=$post_content3;?></div><? } ?>         
         	
  </div>
</main>