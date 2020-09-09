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
 * Get an instance of the controller
 * */
$controller = JControllerLegacy::getInstance('SimplifiedSocialShare');
/**
 * Perform the requested task
 * */
$controller->execute(JRequest::getCmd('task', 'display'));
/**
 * Redirect if set by the controller
 * */
$controller->redirect();
