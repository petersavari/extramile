<?php
/**
* @version	 $Id$
* @package   TC Latest News
* @author    ThemeChoice.com http://www.themechoice.com
* @copyright Copyright (C) 2015 ThemeChoice.com. All rights reserved.
* @license   http://www.gnu.org/licenses/gpl.html GNU/GPL
*/


defined('_JEXEC') or die;

// Include the syndicate functions only once
require_once __DIR__ . '/helper.php';

$document = JFactory::getDocument();
$document->addStyleSheet('https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');
$document->addStyleSheet(JUri::root().'modules/mod_tc_latest_news/assets/css/global.css');
$document->addStyleSheet(JUri::root().'modules/mod_tc_latest_news/assets/css/owl.carousel.css');
$document->addStyleSheet(JUri::root().'modules/mod_tc_latest_news/assets/css/owl.theme.css');
$document->addStyleSheet(JUri::root().'modules/mod_tc_latest_news/assets/css/owl.transitions.css');
$document->addScript(JUri::root().'modules/mod_tc_latest_news/assets/js/owl.carousel.min.js');

$list            		= ModTCLatestNewsHelper::getList($params);

$char_limit 			= $params->get('char_limit');
$per_row			= $params->get('per_row');
$show_title			= $params->get('show_title');
$show_desc			= $params->get('show_desc');
$show_date			= $params->get('show_date');
$show_category		= $params->get('show_category');
$show_image			= $params->get('show_image');

$list_layout			= $params->get('list_layout', 'grid');
$list_layout			= $params->get('list_layout', 'list2');
$list_layout		= $params->get('list_layout', 'list3');
$moduleclass_sfx 		= htmlspecialchars($params->get('moduleclass_sfx'));

require JModuleHelper::getLayoutPath('mod_tc_latest_news', $list_layout);
//require JModuleHelper::getLayoutPath('mod_tc_latest_news', $list_layout_seven);
