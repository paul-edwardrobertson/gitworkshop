<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]--><head>
	<meta charset="utf-8" />
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="author" content="Edward Robertson - www.edwardrobertson.co.uk" />
    <meta name="description" content="<? if ( isset($meta_description) ) { echo $meta_description; } ?>" />
    <meta name="msapplication-TileImage" content="/images/apple-touch-icon-precomposed.png" />
    <meta name="msapplication-TileColor" content="#fff" />

    <title><? if ( isset($meta_title) ) { echo $meta_title; } ?></title>

    <link rel="stylesheet" href="/css/<?=$css_js_filename?>.min.css?v=<?=filemtime(FS_ROOT.'css/'.$css_js_filename.'.min.css');?>" media="all" />
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">  
    <link rel="shortcut icon" href="/images/favicon.ico" />
    <link rel="apple-touch-icon-precomposed" href="/images/apple-touch-icon-precomposed.png">
   
    <!--[if lte IE 7]><script src="/js/lte-ie7.js"></script><![endif]-->
    <!--[if lt IE 9]>
        <script src="/js/respond.min.js"></script>
        <script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <script src="/js/modernizr-2.5.3.min.js"></script>
    <![endif]-->
	<? if (($ga_code!='' && !is_null($ga_code)) ) { ?>
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
            ga('create', '<?=$ga_code?>', 'auto');
            ga('send', 'pageview');
        </script>
    <? } ?>
  <? include_once(FS_ROOT."includes/inc_open_graph.php"); ?>
</head>
<body>
    <div id="skip-to-main"><a href="#main">skip to main content</a></div>
    <div id="page-wrap">