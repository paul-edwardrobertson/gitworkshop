<footer id="footer">
    <div class="inner">
        
            <div class="footer-address">
                <h5 class="footer-address__title">Get in touch</h5>
                
                <? if(isset($site_address) && $site_address != '') { ?><p><?=$site_name?>,<br /><?=str_replace(',', ',<br />', $site_address);?><? if($site_postcode) { ?>,<br /><?=$site_postcode?><? } ?></p><? } ?>
                
                <? if(isset($site_maplink) && $site_maplink != '') { ?><p class="footer-address__detail"><i class="footer-address__icon fa fa-map-marker"></i> <a class="footer-link" target="_blank" href="<?=$site_maplink?>">Our Location</a></p><? } ?>

<? if(isset($site_telephone) && $site_telephone != '') { ?><p><i class="footer-address__icon fa fa-phone"></i> <a class="footer-link" href="tel:<?=str_replace(' ', '', $site_telephone);?>"><?=$site_telephone?></a></p><? } ?>
                
            </div>
      
        
    </div>
    <div class="wrap copyright">
            <div class="inner">
                <p>&copy; Copyright <?=$site_name?> trading as <?=$site_name?>  <? if (isset($reg_number)) { ?>Registered in the United Kingdom - No. <?=$reg_number?><? } ?><br />
                See our <a class="copyright-link" href="/privacy-policy/">privacy policy</a> and <a class="copyright-link" href="/terms-and-conditions/">terms and conditions</a>. Website by <a class="copyright-link" target="_blank" href="https://www.edwardrobertson.co.uk">Edward Robertson</a></p>

                <? if((isset($twitter_handle)) || (isset($facebook_handle)) || (isset($instagram_handle)) || (isset($linkedin_handle)) || (isset($pinterest_handle)) || (isset($googleplus_handle)) || (isset($flickr_handle)) || (isset($youtube_handle)) || (isset($skype_handle))) { ?>
                <div class="external-socials">
                    <? if(isset($twitter_handle) && $twitter_handle != '') { ?><a class="external-social--twitter" target="_blank" href="https://www.twitter.com/<?=$twitter_handle?>"><i class="fa fa-twitter"></i></a><? } ?>
                    <? if(isset($facebook_handle) && $facebook_handle != '') { ?><a class="external-social--facebook" target="_blank" href="<?=$facebook_handle?>"><i class="fa fa-facebook"></i></a><? } ?>
                    <? if(isset($instagram_handle) && $instagram_handle != '') { ?><a class="external-social--instagram" target="_blank" href="https://www.instagram.com/<?=$instagram_handle?>"><i class="fa fa-instagram"></i></a><? } ?>
                    <? if(isset($linkedin_handle) && $linkedin_handle != '') { ?><a class="external-social--linkedin" target="_blank" href="<?=$linkedin_handle?>"><i class="fa fa-linkedin"></i></a><? } ?>
                    <? if(isset($pinterest_handle) && $pinterest_handle != '') { ?><a class="external-social--pinterest" target="_blank" href="<?=$pinterest_handle?>"><i class="fa fa-pinterest"></i></a><? } ?>
                    <? if(isset($googleplus_handle) && $googleplus_handle != '') { ?><a class="external-social--googleplus" target="_blank" href="<?=$googleplus_handle?>"><i class="fa fa-google-plus"></i></a><? } ?>
                    <? if(isset($flickr_handle) && $flickr_handle != '') { ?><a class="external-social--flickr" target="_blank" href="<?=$flickr_handle?>"><i class="fa fa-flickr"></i></a><? } ?>
                    <? if(isset($youtube_handle) && $youtube_handle != '') { ?><a class="external-social--youtube" target="_blank" href="<?=$youtube_handle?>"><i class="fa fa-youtube"></i></a><? } ?>
                    <? if(isset($skype_handle) && $skype_handle != '') { ?><a class="external-social--skype" target="_blank" href="<?=$skype_handle?>"><i class="fa fa-skype"></i></a><? } ?>
                </div>
                <? } ?>
            </div>
        </div>
</footer>