<?php
/**
 * @package haraka
 * @author Brian Teeman
 * @copyright (C) 2016 - Brian Teeman
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined( '_JEXEC' ) or die( 'Restricted access' );
class plgSystemHaraka extends JPlugin

{
	protected $autoloadLanguage = true;
	private $redirect = false;

	function plgSystemHarakaSoon($config)
	{
		parent::__construct($config);
		$this->redirect = false;
	}

	private function displayHaraka()
	{
		$app = JFactory::getApplication();
		$display_haraka = false;
		$secret = trim($this->params->get('secret', ''));
		$whitelist = trim($this->params->get('whitelist', ''));

		if (!$display_haraka && $secret) {
			$display_haraka = $app->getUserStateFromRequest( $this->_name.".secret", $secret, '' );
		}
		if (!$display_haraka && $whitelist) {
			$ip_whitelist = preg_split('/\s*\n\s*/', $whitelist);
			$display_haraka = array_search($_SERVER['REMOTE_ADDR'], $whitelist) !== false;
		}
		if (!$display_haraka) {
			$bgimage 				= $this->params->get('bgimage', 'comingsoon.jpg');
			$bgimage_url 		= JURI::base().'media/plg_haraka/images/'.$bgimage;
			$caption 				= $this->params->get('caption', '');
			$countdown 			= $this->params->get('countdown','1');
			$countdown_date = $this->params->get('countdown_date', '');
			$facebook 			= $this->params->get('facebook', '');
			$facebook_url 	= "https://facebook.com/".$facebook;
			$favicon 				= $this->params->get('favicon', '');
			$fonts 					= $this->params->get('fonts','Roboto+Slab|Roboto');
			$font 					= explode("|", $fonts);
			$instagram 			= $this->params->get('instagram', '');
			$instagram_url 	= "https://instagram.com/".$instagram;
			$logo 					= $this->params->get('logo', '');
			$title 					= $this->params->get('title', $app->getCfg('sitename'));
			$meta_desc 			= $this->params->get('meta_desc', $app->getCfg('MetaDesc'));
			$meta_keys 			= $this->params->get('meta_keys', $app->getCfg('MetaKeys'));
			$meta_title 		= $this->params->get('meta_title', $title);
			$robots 				= $this->params->get('robots', $app->getCfg('robots'));
			$text 					= $this->params->get('text', JText::_('PLG_SYSTEM_HARAKA_COMING_SOON'));
			$theme 					= $this->params->get('theme', 'light');
			$twitter 				= $this->params->get('twitter', '');
			$twitter_url 		= "https://twitter.com/".$twitter;
			$uri 						= JURI::getInstance();
			$youtube 				= $this->params->get('youtube', '');
			$youtube_url 		= "https://youtube.com/".$youtube;

			require(JPATH_BASE.'/media/plg_haraka/haraka.php');	
			$app->close();
		}
	}
	public function onAfterInitialise()
	{
		$app = JFactory::getApplication();
		if ($app->isSite()) {
			$this->displayHaraka();
		}
	}	
}