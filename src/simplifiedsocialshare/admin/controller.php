<?php

/**
 * @package     SimplifiedSocialShare.Component
 * @subpackage  com_simplifiedsocialshare
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
jimport('joomla.application.component.controller');

/**
 * Controller of SocialLogin component.
 */
class simplifiedSocialShareController extends JControllerLegacy
{


    /**
     * @param bool $cachable
     * @param bool $urlparams
     * @return JControllerLegacy|void
     */
    public function display($cachable = false, $urlparams = false)
    {
        JRequest::setVar('view', JRequest::getCmd('view', 'SimplifiedSocialShare'));
        parent::display($cachable);
    }

    /**
     * Save settings
     */
    public function apply()
    {
        $mainframe = JFactory::getApplication();
        $model = $this->getModel();
        $result = $model->saveSettings();
        $mainframe->enqueueMessage($result['message'], $result['status']);
        $this->setRedirect(JRoute::_('index.php?option=com_simplifiedsocialshare&view=simplifiedsocialshare&layout=default', false));
    }

    /**
     * Save and close settings
     */
    public function save()
    {
        $mainframe = JFactory::getApplication();
        $model = & $this->getModel();
        $result = $model->saveSettings();
        $mainframe->enqueueMessage($result['message'], $result['status']);
        $this->setRedirect(JRoute::_('index.php', false));
    }

    /**
     * cancel settings
     */
    public function cancel()
    {
        $this->setRedirect(JRoute::_('index.php', false));
    }

}
