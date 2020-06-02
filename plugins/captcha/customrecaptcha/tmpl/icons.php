<?php
/**
 * @copyright	Copyright (C) 2011 Simplify Your Web, Inc. All rights reserved.
 * @license		GNU General Public License version 3 or later; see LICENSE.txt
 */
 
// no direct access
defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');

jimport('syw.fonts', JPATH_LIBRARIES);
SYWFonts::loadIconFont();
?>
<div id="<?php echo $id; ?>" style="display: none" class="g-recaptcha<?php echo $classes; ?>">
	<input type="text" id="recaptcha_response_field" name="recaptcha_response_field"><br />
	<span class="recaptcha_only_if_image"><?php echo JText::_('PLG_CAPTCHA_CUSTOMRECAPTCHA_INSTRUCTIONS_VISUAL'); ?></span>
	<span class="recaptcha_only_if_audio"><?php echo JText::_('PLG_CAPTCHA_CUSTOMRECAPTCHA_INSTRUCTIONS_AUDIO'); ?></span>
	<div id="recaptcha_image"></div>			
	<div class="recaptcha_only_if_incorrect_sol"><?php echo JText::_('PLG_CAPTCHA_CUSTOMRECAPTCHA_INCORRECT_TRY_AGAIN'); ?></div>
	<ul>
		<li class="recaptcha_reload hasTooltip"><a href="javascript:Recaptcha.reload()" title="<?php echo JText::_('PLG_CAPTCHA_CUSTOMRECAPTCHA_REFRESH_BTN'); ?>"><i class="SYWicon-refresh"></i></a></li>
		<li class="recaptcha_only_if_image hasTooltip"><a href="javascript:Recaptcha.switch_type('audio')" title="<?php echo JText::_('PLG_CAPTCHA_CUSTOMRECAPTCHA_AUDIO_CHALLENGE'); ?>"><i class="SYWicon-volume-up"></i></a></li>
		<li class="recaptcha_only_if_audio hasTooltip"><a href="javascript:Recaptcha.switch_type('image')" title="<?php echo JText::_('PLG_CAPTCHA_CUSTOMRECAPTCHA_VISUAL_CHALLENGE'); ?>"><i class="SYWicon-insert-photo"></i></a></li>
		<li class="recaptcha_help hasTooltip"><a href="javascript:Recaptcha.showhelp()" title="<?php echo JText::_('PLG_CAPTCHA_CUSTOMRECAPTCHA_HELP_BTN'); ?>"><i class="SYWicon-question"></i></a></li>
	</ul>	
	<div class="recaptcha_only_if_privacy" id="recaptcha_privacy"><a href="http://www.google.com/intl/<?php echo $language_tag; ?>/policies/" target="_blank"><?php echo JText::_('PLG_CAPTCHA_CUSTOMRECAPTCHA_PRIVACY_AND_TERMS'); ?></a></div>
</div>