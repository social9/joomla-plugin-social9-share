<?php

/**
 * @package     SimplifiedSocialShare.Component
 * @subpackage  com_simplifiedsocialshare
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
jimport('joomla.application.component.modellist');

/**
 * Class SimplifiedSocialShareModelSimplifiedSocialShare
 */
class SimplifiedSocialShareModelSimplifiedSocialShare extends JModelList {

    /**
     * save extension setting on db
     * 
     * @return string
     */
    public function saveSettings() {
        //Get database handle
        $db = $this->getDbo();

        //Read Settings
        $settings = JRequest::getVar('settings');
        $settings['horizontalArticles'] = (sizeof(JRequest::getVar('horizontalArticles')) > 0 ? serialize(JRequest::getVar('horizontalArticles')) : "");
        $settings['verticalArticles'] = (sizeof(JRequest::getVar('verticalArticles')) > 0 ? serialize(JRequest::getVar('verticalArticles')) : "");
  
        $sql = "DELETE FROM #__oss_share_settings";
        $db->setQuery($sql);
        $db->query();

        //Insert new settings
        foreach ($settings as $k => $v) {
            $sql = "INSERT INTO #__oss_share_settings ( setting, value )" . " VALUES ( " . $db->Quote($k) . ", " . $db->Quote($v) . " );";
            $db->setQuery($sql);
            $db->query();
        }
        $result['status'] = "message";
        $result['message'] = JText::_('COM_SOCIAL_SHARE_SETTING_SAVED');
        return $result;
    }

    /**
     * get extension setting from db
     * 
     * @return array
     */
    public function getSettings() {
        $settings = array();

        $db = $this->getDbo();

        $db->setQuery("CREATE TABLE IF NOT EXISTS #__oss_share_settings (
						`id` int(10) unsigned NOT NULL AUTO_INCREMENT,
						`setting` varchar(255) NOT NULL,
						`value` text NOT NULL,
						PRIMARY KEY (`id`),
						UNIQUE KEY `setting` (`setting`)
						) ENGINE=MyISAM  DEFAULT CHARSET=utf8;");
        $db->setQuery("SELECT * FROM #__oss_share_settings");
        $rows = $db->LoadAssocList();

        if (is_array($rows)) {
            foreach ($rows AS $key => $data) {
                $settings [$data['setting']] = $data ['value'];
            }
        }

        return $settings;
    }



}
