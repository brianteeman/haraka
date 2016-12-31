<?php
/**
 * @package    haraka
 * @author     Brian Teeman
 * @copyright  (C) 2016 - Brian Teeman
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined('_JEXEC') or die;

/**
 * Haraka Plugin by Brian Teeman
 *
 * @since  1.0.0
 */
class plgSystemHaraka extends JPlugin
{
	/**
	 * Application object.
	 *
	 * @var    JApplicationCms
	 * @since  1.0.0
	 */
	protected $app;

	/**
	 * Load plugin language files automatically
	 *
	 * @var    boolean
	 * @since  1.0.0
	 */
	protected $autoloadLanguage = true;

	/**
	 * Redirect variable
	 *
	 * @var    boolean
	 * @since  1.0.0
	 */
	private $redirect = false;

	/**
	 * Display the Haraka
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	private function displayHaraka()
	{
		$display_haraka = false;
		$secret         = trim($this->params->get('secret', ''));
		$whitelist      = trim($this->params->get('whitelist', ''));

		if ($secret)
		{
			$storedSecret = $this->app->getUserState($this->_name . '.secret', 0);

			if ($storedSecret === $secret)
			{
				$display_haraka = true;
			}
			else
			{
				$this->app->setUserState($this->_name . '.secret', 0);
				$secretRequest = $this->app->getUserStateFromRequest($this->_name . '.secret', $secret, 0);

				if ($secretRequest == 1)
				{
					$this->app->setUserState($this->_name . '.secret', $secret);
				}
			}
		}

		if (!$display_haraka && $whitelist)
		{
			$ip_whitelist   = preg_split('/\s*\n\s*/', $whitelist);
			$display_haraka = array_search($this->app->input->server->get('REMOTE_ADDR'), $whitelist) !== false;
		}

		if (!$display_haraka)
		{
			$bgimage_url    = JUri::base() . 'media/plg_haraka/images/' . $this->params->get('bgimage', 'comingsoon.jpg');
			$caption        = $this->params->get('caption', '');
			$countdown      = $this->params->get('countdown', 1);
			$countdown_date = $this->params->get('countdown_date', '');
			$fonts          = $this->params->get('fonts', 'Roboto+Slab|Roboto');
			$font           = explode("|", $fonts);
			$text           = $this->params->get('text', JText::_('PLG_SYSTEM_HARAKA_COMING_SOON'));
			$theme          = $this->params->get('theme', 'light');
			$uri            = JUri::getInstance();

			// Meta
			$meta_desc  = $this->params->get('meta_desc', $this->app->get('MetaDesc'));
			$meta_keys  = $this->params->get('meta_keys', $this->app->get('MetaKeys'));
			$title      = $this->params->get('title', $this->app->get('sitename'));
			$robots     = $this->params->get('robots', $this->app->get('robots'));

			// Social Media
			$facebook      = $this->params->get('facebook', '');
			$facebook_url  = 'https://facebook.com/' . $facebook;
			$instagram     = $this->params->get('instagram', '');
			$instagram_url = 'https://instagram.com/' . $instagram;
			$twitter       = $this->params->get('twitter', '');
			$twitter_url   = 'https://twitter.com/' . $twitter;
			$youtube       = $this->params->get('youtube', '');
			$youtube_url   = 'https://youtube.com/' . $youtube;

			$path = JPluginHelper::getLayoutPath('system', 'haraka');
			include $path;

			$this->app->close();
		}
	}

	/**
	 * Listener for the `onAfterInitialise` event
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function onAfterInitialise()
	{
		if ($this->app->isSite())
		{
			$this->displayHaraka();
		}
	}	
}
