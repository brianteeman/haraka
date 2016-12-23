<?php
/**
 * @package haraka
 * @author Brian Teeman
 * @copyright (C) 2016 - Brian Teeman
 * @license GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
 */

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
	 * Constructor.
	 *
	 * @param   object  &$subject  The object to observe.
	 * @param   array   $config    An optional associative array of configuration settings.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function __construct(&$subject, $config)
	{
		parent::__construct($config);

		// Set redirect to false per default
		$this->redirect = false;
	}

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
			$display_haraka = $this->app->getUserStateFromRequest($this->_name . ".secret", $secret, '');
		}

		if (!$display_haraka && $whitelist)
		{
			$ip_whitelist   = preg_split('/\s*\n\s*/', $whitelist);
			$display_haraka = array_search($_SERVER['REMOTE_ADDR'], $whitelist) !== false;
		}

		if (!$display_haraka)
		{
			$bgimage        = $this->params->get('bgimage', 'comingsoon.jpg');
			$bgimage_url    = JUri::base().'media/plg_haraka/images/' . $bgimage;
			$caption        = $this->params->get('caption', '');
			$countdown      = $this->params->get('countdown','1');
			$countdown_date = $this->params->get('countdown_date', '');
			$favicon        = $this->params->get('favicon', '');
			$fonts          = $this->params->get('fonts','Roboto+Slab|Roboto');
			$font           = explode("|", $fonts);
			$logo           = $this->params->get('logo', '');
			$text           = $this->params->get('text', JText::_('PLG_SYSTEM_HARAKA_COMING_SOON'));
			$theme          = $this->params->get('theme', 'light');
			$uri            = JUri::getInstance();

			// Meta
			$meta_desc  = $this->params->get('meta_desc', $this->app->get('MetaDesc'));
			$meta_keys  = $this->params->get('meta_keys', $this->app->get('MetaKeys'));
			$title      = $this->params->get('title', $this->app->get('sitename'));
			$meta_title = $this->params->get('meta_title', $title);
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

			require(JPATH_BASE . '/media/plg_haraka/haraka.php');

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