<?php
/**
 * @version       $Id$
 * @copyright     Copyright (C) 2007 - 2009 Joomla! Vargas. All rights reserved.
 * @license       GNU General Public License version 2 or later; see LICENSE.txt
 * @author        Guillermo Vargas (guille@vargas.co.cr)
 */

// no direct access
defined('_JEXEC') or die;

JTable::addIncludePath( JPATH_COMPONENT.'/tables' );

jimport('joomla.form.form');
JForm::addFieldPath( JPATH_COMPONENT.'/models/fields' );

// Register helper class
JLoader::register('SchuWeb_SitemapHelper', dirname(__FILE__) . '/helpers/schuweb_sitemap.php');

// Include dependancies
jimport('joomla.application.component.controller');

$controller = JControllerLegacy::getInstance('SchuWeb_Sitemap');
$controller->execute(JFactory::getApplication()->input->get('task'));
$controller->redirect();