<?php

/**
 * @package     SimplifiedSocialShare.Component
 * @subpackage  com_simplifiedsocialshare
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die ('Restricted access');
jimport('joomla.application.component.view');

/**
 * Class SimplifiedSocialShareViewSimplifiedSocialShare
 */
class SimplifiedSocialShareViewSimplifiedSocialShare extends JViewLegacy
{
    public $settings;

    /**
     * SocialLogin - Display administration area
     */
    public function display($tpl = null)
    {
        $version = '3';
        if (JVERSION < 3) {
            $version = '2';
        }
        $document = JFactory::getDocument();
        $document->addStyleSheet('components/com_simplifiedsocialshare/assets/css/simplifiedsocialshare' . $version . '.css');
        $document->addScript('//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js');
        $document->addScript('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.0/jquery-ui.min.js');
        $model = $this->getModel();
        $this->settings = $this->initialSetting($model);
        $document->addScript('components/com_simplifiedsocialshare/assets/js/simplifiedsocialshare.js');
        
        $this->rows = $this->selectArticles();
        $this->form = $this->get('Form');
        $this->addToolbar();
        parent::display($tpl);
    }

    /**
     * @return mixed
     */
    private function selectArticles()
    {
        $db = JFactory::getDBO();
        $query = "SELECT id, title FROM #__content WHERE state = '1' ORDER BY ordering";
        $db->setQuery($query);
        $rows = $db->loadObjectList();
        return $rows;
    }

    /**
     * @param $model
     * @return mixed
     */
    private function initialSetting($model)
    {
        $settings = $model->getSettings();
        $settings['shareontoppos'] = isset($settings['shareontoppos']) && $settings['shareontoppos'] == '1' ? 'checked="checked"' : "";
        $settings['shareonbottompos'] = isset($settings['shareonbottompos']) && $settings['shareonbottompos'] == '1' ? 'checked="checked"' : "";
        $settings['horizontalarticaltype'] = (isset($settings['horizontalarticaltype']) && $settings['horizontalarticaltype'] != '1') ? $settings['horizontalarticaltype'] : "1";
        $settings['horizontalArticles'] = (isset($settings['horizontalArticles']) ? @unserialize($settings['horizontalArticles']) : "");
        $settings['verticalarticaltype'] = (isset($settings['verticalarticaltype']) && $settings['verticalarticaltype'] != '1') ? $settings['verticalarticaltype'] : "1";
        $settings['verticalArticles'] = (isset($settings['verticalArticles']) ? @unserialize($settings['verticalArticles']) : "");
        
        return $settings;
    }

    /**
     * SocialLogin - Add admin option on toolbar
     */
    protected function addToolbar()
    {
        JRequest::setVar('hidemainmenu', false);
        JToolBarHelper::title(JText::_('COM_SIMPLIFIEDSOCIALSHARE').' '.JText::_('Component'), 'configuration.gif');
        JToolBarHelper::apply('apply');
        JToolBarHelper::save('save', 'JTOOLBAR_SAVE');
        JToolBarHelper::cancel('cancel');
    }
}