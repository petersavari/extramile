<?php
/**
 * @package          Joomla
 * @subpackage       SchuWeb_Sitemap
 *
 * @author           Sven Schultschik <extensions@schultschik.com>
 * @copyright    (c) 2019 extensions.schultschik.com - All rights reserved
 * @license          GNU General Public License version 3 or later
 */

// No direct access to this file
defined('_JEXEC') or die('Restricted access');

/**
 *
 * @package     Joomla.Administrator
 * @subpackage  com_helloworld
 *
 * @copyright   Copyright (C) 2005 - 2018 Open Source Matters, Inc. All rights
 *              reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 *
 * @since       __DEPLOY_VERSION__
 */
class pkg_schuweb_sitemapInstallerScript
{

	/**
	 * Runs right after any installation action is performed on the component.
	 *
	 * @param   string     $type    - Type of PostFlight action. Possible values
	 *                              are:
	 *                              - * install
	 *                              - * update
	 *                              - * discover_install
	 * @param   \stdClass  $parent  - Parent object calling object.
	 *
	 * @return void
	 *
	 * @throws \Exception
	 * @since       __DEPLOY_VERSION__
	 */
	public function postflight($type, $parent)
	{
		if ($type != "install")
		{
			return;
		}

		// Which components are installed?
		require_once JPATH_ADMINISTRATOR
			. DIRECTORY_SEPARATOR . 'components'
			. DIRECTORY_SEPARATOR . 'com_schuweb_sitemap'
			. DIRECTORY_SEPARATOR . 'helpers'
			. DIRECTORY_SEPARATOR . 'schuweb_sitemap.php';

		$extensions = SchuWeb_SitemapHelper::getExtensionsList();

		$db = JFactory::getDbo();

		// Activate the fitting plugins
		foreach ($extensions as $extension)
		{
			$query = $db->getQuery(true);

			$fields = array(
				$db->quoteName('enabled') . '= 1',
			);

			$conditions = array(
				$db->quoteName('type') . '=' . $db->quote('plugin'),
				$db->quoteName('element') . '=' . $db->quote($extension->element),
			);

			$query->update($db->quoteName('#__extensions'))
				->set($fields)
				->where($conditions);


			$db->setQuery($query);

			if (!$db->execute())
			{
				JFactory::getApplication()->enqueueMessage(JText::_('SCHUWEB_SITEMAP_ACTIVATE_PLUGIN_FAILED'), 'error');
			}
		}

		// Get all menus
		$query = $db->getQuery(true);

		$query->select($db->quoteName('menutype'))
			->from($db->quoteName('#__menu_types'));

		$db->setQuery($query);
		$menus = $db->loadObjectList();

		// Create a default sitemap with all needed components and all menus
		$columns = array(
			'title',
			'alias',
			'attribs',
			'selections',
			'is_default',
			'state',
			'access',
		);

		// {"mainmenu":{"enabled":"1","priority":"0.5","changefreq":"weekly"}}
		$selections = array();

		foreach ($menus as $menu)
		{
			$selections[$menu->menutype] = array(
				"enabled"    => 1,
				"priority"   => 1,
				"changefreq" => "weekly",
			);
		}

		$attribs = '{"showintro":"1","show_menutitle":"1","classname":"",'
			. '"columns":"","exlinks":"img_blue.gif","compress_xml":"1",'
			. '"beautify_xml":"1","include_link":"1","xmlLastMod":"1",'
			. '"xmlInsertChangeFreq":"1","xmlInsertPriority":"1",'
			. '"cacheControl":"1","cacheControlUseChangeFrequency":"1",'
			. '"cacheControlMaxAge":"","cacheControlPublic":"1","news_publication_name":""}';

		$values = array(
			$db->quote('Sitemap'),
			$db->quote('sitemap'),
			$db->quote($attribs),
			$db->quote(json_encode($selections)),
			1,
			1,
			1,
		);

		$query = $db->getQuery(true);

		$query->insert($db->quoteName('#__schuweb_sitemap'))
			->columns($db->quoteName($columns))
			->values(implode(',', $values));

		// Set the query using our newly populated query object and execute it.
		$db->setQuery($query);
		$db->execute();
	}

}
