<?php
/**
 * @package    haraka
 * @author     Brian Teeman
 * @copyright  (C) 2016 - Brian Teeman
 * @license    GNU/GPLv3 http://www.gnu.org/licenses/gpl-3.0.html
**/

defined('_JEXEC') or die('Restricted access');

JFormHelper::loadFieldClass('textarea');

class JFormFieldWhitelist extends JFormFieldTextarea
{
	protected $type = 'Whitelist';

	protected function getInput()
	{
		$remoteAddress = JFactory::getApplication()->input->server->get('REMOTE_ADDR');
		$button = '<br>';
		$onclick = "jQuery('#jform_params_".$this->element['name']."').val(jQuery('#jform_params_".$this->element['name']."').val()+(jQuery('#jform_params_".$this->element['name']."').val() ? '\\n' : '')+'".$remoteAddress."'); return false;";
		$button.= '<button class="btn" onclick="'.$onclick.'" href="#">'.JText::_('PLG_SYSTEM_HARAKA_CFG_WHITELIST_ADD_CURRENT').'</button>';
		$onclick = "jQuery('#jform_params_".$this->element['name']."').val(''); return false;";
		$button.= ' <button class="btn" onclick="'.$onclick.'" href="#">'.JText::_('PLG_SYSTEM_HARAKA_CFG_WHITELIST_CLEAR').'</button>';
		return parent::getInput().$button;
	}
}
