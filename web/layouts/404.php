<section class="section section--post-header">     
	<div class="inner">
        <? if ( isset($post_title) && $post_title != '' ) { ?><h1 class="post-title"><?=$post_title?></h1><? } ?>        
        <? if ( isset($post_tagline) && $post_tagline != '' ) { ?><div class="post-tagline"><?=$post_tagline;?></div><? } ?>
	</div>
</section>
<main id="main" class="post-not-found">
	<div class="inner">
        
	<? if ( isset($post_content) && strlen(trim($post_content)) > 0 ) { ?><div class="post-content"><?=$page_content;?></div><? } ?>
    <? if ( isset($post_content2) && strlen(trim($post_content2)) > 0 ) { ?><div class="post-content2"><?=$page_content2;?></div><? } ?>
    <? if ( isset($post_content3) && strlen(trim($post_content3)) > 0 ) { ?><div class="post-content3"><?=$page_content3;?></div><? } ?>        
         	
  </div>
</main>