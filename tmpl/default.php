<?php
/**
 * @package    haraka
 * @author     Brian Teeman
 * @copyright  (C) 2016 - 2017 - Brian Teeman
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

defined('_JEXEC') or die;
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="generator" content="Joomla! - Open Source Content Management" />
		<meta name="robots" content="<?php echo $robots; ?>" />
		<meta name="keywords" content="<?php echo $metaKeys; ?>" />
		<meta name="description" content="<?php echo $metaDesc; ?>" />

		<style>
			body,div,dl,dt,dd,ul,ol,li,h1,h2,h3,h4,h5,h6,pre,code,form,fieldset,legend,input,textarea,p,blockquote,th,td{margin:0;padding:0;}table{border-collapse:collapse;border-spacing:0;}fieldset,img{border:0;}address,caption,dfn,th,var{font-style:normal;font-weight:normal;}li{list-style:none;}caption,th{text-align:left;}h1,h2,h3,h4,h5,h6{font-size:100%;font-weight:normal;}
			body,h1 span{display:block}.header,body{text-align:center}.content p,.countdown_section,h1{text-shadow:1px 1px 3px #000}body,html{height:100%;font-size:100%;width:100%}body{margin:0;padding:0;color:#fff;background:url('<?php echo $bgimageUrl; ?>') center top;background-size:cover;position:relative}.wrapper{background:rgba(0,0,0, 0.33);height:100%;}.header{width:100%;float:left}#counter,.content{width:60%;padding:0 20%}h1{margin:.8em 0;font-size:6.25em}h1 span{font-size:.2em;line-height:0;font-weight:300}.content p{font-size:1.875em;line-height:1.33em}#counter{margin-top:3.75em;float:left}.countdown_section{color:#fff;display:inline-block;text-align:center;width:15%;box-sizing:border-box;font-size:.938em;text-transform:lowercase;font-style:italic;padding:2.667em 0;border-top:2px solid rgba(255,255,255,.2);border-bottom:2px solid rgba(255,255,255,.2)}.countdown_section:first-child{border-left:0}.countdown_amount{color:#fff;display:block;font-size:3.33em;font-weight:700;font-style:normal;line-height:.75em}.social{width:40%;float:left;padding:0 30%;margin:3.125em 0 0}.social ul li{display:inline;margin:0 1.25em}.social ul li a{color:#fff}@media only screen and (max-width:1024px){body{font-size:90%}.content{width:80%;padding:0 10%}#counter,.social{width:60%;float:left;padding:0 20%}#counter{margin-top:3.75em}.social{margin:3.125em 0 0}}@media only screen and (max-width:768px){.content p,h1{text-shadow:1px 1px 3px #000}#counter,.content,.social{width:90%;padding:0 5%}body{font-size:80%}h1{margin:.3em 0 .6em;font-size:5.25em;line-height:.9em}.content p{font-size:1.475em;line-height:1.63em}#counter{margin-top:3.75em;float:left}.social{float:left;margin:2.125em 0 0}.social ul{width:100%;float:left}}
			body {font-family: '<?php echo $fontcss[0]; ?>';}.countdown_section, h1 span {font-family: '<?php echo $fontcss[1]; ?>';}.content p {font-family: '<?php echo $fontcss[1]; ?>';}.countdown_amount {font-family: '<?php echo $fontcss[0]; ?>';}
		</style>
		<link href="//fonts.googleapis.com/css?family=<?php echo $fonts; ?>" rel="stylesheet">
		<link href="//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"></script>
		<title><?php echo $title; ?></title>
	</head>
	<body>
		<div class=wrapper>
		<div class="header">
			<h1 id="logo"><?php echo $title; ?><span><?php echo $caption; ?></span></h1>
		</div>
		<div class="content">
			<?php echo $text; ?>
		</div>
		<div id="counter" class="hasCountdown">
			<!-- javascript inserts the countdown here -->
		</div>
		<div class="social">
			<ul>
				<?php if ($facebook) : ?>
					<li><a href="<?php echo $facebook_url; ?>" target="_blank"><i class="fa fa-facebook-square fa-5x" aria-hidden="true"></i></a></li>
				<?php endif; ?>
				<?php if ($twitter) : ?>
					<li><a href="<?php echo $twitter_url; ?>" target="_blank"><i class="fa fa-twitter-square fa-5x" aria-hidden="true"></i></a></li>
				<?php endif; ?>
				<?php if ($instagram) : ?>
					<li><a href="<?php echo $instagram_url; ?>" target="_blank"><i class="fa fa-instagram fa-5x" aria-hidden="true"></i></a></li>
				<?php endif; ?>
				<?php if ($youtube) : ?>
					<li><a href="<?php echo $youtube_url; ?>" target="_blank"><i class="fa fa-youtube-square fa-5x" aria-hidden="true"></i></a></li>
				<?php endif; ?>
			</ul>
		</div>
		</div>
		<!--script at the bottom for the countdown -->
		<?php if ($countdown == 1) : ?>
			<script>
				$('#counter').countdown('<?php echo $countdown_date; ?>')
				.on('update.countdown', function(event) {
				var $this = $(this).html(event.strftime(''
				+ '<span class="countdown_section"><span class="countdown_amount">%m</span><br> <?php echo JText::_('PLG_SYSTEM_HARAKA_COUNTDOWN_MTHS'); ?> </span> '
				+ '<span class="countdown_section"><span class="countdown_amount">%w</span><br> <?php echo JText::_('PLG_SYSTEM_HARAKA_COUNTDOWN_WEEKS'); ?> </span> '
				+ '<span class="countdown_section"><span class="countdown_amount">%d</span><br> <?php echo JText::_('PLG_SYSTEM_HARAKA_COUNTDOWN_DAYS'); ?> </span> '
				+ '<span class="countdown_section"><span class="countdown_amount">%H</span><br> <?php echo JText::_('PLG_SYSTEM_HARAKA_COUNTDOWN_HRS'); ?> </span> '
				+ '<span class="countdown_section"><span class="countdown_amount">%M</span><br> <?php echo JText::_('PLG_SYSTEM_HARAKA_COUNTDOWN_MINS'); ?> </span>'));
				});
			</script>
		<?php endif; ?>
	</body>
</html>
