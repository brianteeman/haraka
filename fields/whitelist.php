<?php
/**
 * @package    haraka
 * @author     Brian Teeman
 * @copyright  (C) 2016 - 2017 - Brian Teeman
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined('_JEXEC') or die;

JFormHelper::loadFieldClass('textarea');

/**
 * Provides a Whitelist
 *
 * @since  1.0.0
 */
class JFormFieldWhitelist extends JFormFieldTextarea
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 * @since  1.0.0
	 */
	protected $type = 'Whitelist';

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   1.0.0
	 */
	protected function getInput()
	{
		$remoteAddress = JFactory::getApplication()->input->server->get('REMOTE_ADDR');

		$button  = '<br>';
		$onclick = "jQuery('#jform_params_" . $this->element['name'] . "').val(jQuery('#jform_params_" . $this->element['name'] . "').val()+(jQuery('#jform_params_" . $this->element['name'] . "').val() ? '\\n' : '')+'" . $remoteAddress . "'); return false;";
		$button .= '<button class="btn" onclick="' . $onclick . '" href="#">' . JText::_('PLG_SYSTEM_HARAKA_CFG_WHITELIST_ADD_CURRENT') . '</button>';
		$onclick = "jQuery('#jform_params_" . $this->element['name']. "').val(''); return false;";
		$button .= ' <button class="btn" onclick="' . $onclick . '" href="#">' . JText::_('PLG_SYSTEM_HARAKA_CFG_WHITELIST_CLEAR') . '</button>';

		return parent::getInput() . $button;
	}
}
