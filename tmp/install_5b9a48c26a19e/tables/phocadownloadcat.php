<?php
/*
 * @package		Joomla.Framework
 * @copyright	Copyright (C) 2005 - 2010 Open Source Matters, Inc. All rights reserved.
 * @license		GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @component Phoca Component
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU General Public License version 2 or later;
 */
defined('_JEXEC') or die('Restricted access');
jimport('joomla.filter.input');

class TablePhocaDownloadCat extends JTable
{
	
	function __construct(& $db) {
		parent::__construct('#__phocadownload_categories', 'id', $db);
	}
	
	function check()
	{
		
		$app = JFactory::getApplication();
		// check for valid name
		if (trim( $this->title ) == '') {
			
			
			$app->enqueueMessage(JText::_( 'CATEGORY MUST HAVE A TITLE') , 'error');
			return false;
		}

		if(empty($this->alias)) {
			$this->alias = $this->title;
		}
		$this->alias = PhocaDownloadUtils::getAliasName($this->alias);

		return true;
	}
}
?>