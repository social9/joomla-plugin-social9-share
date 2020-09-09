<?php

/**
 * @package     SimplifiedSocialShare.Component
 * @subpackage  com_simplifiedsocialshare
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die ('Direct Access to this location is not allowed.');
JHtml::_('behavior.tooltip');
jimport('joomla.plugin.helper');
jimport('joomla.html.html.tabs');
?>
<form action="<?php echo JRoute::_('index.php?option=com_simplifiedsocialshare&view=simplifiedsocialshare&layout=default'); ?>" method="post" name="adminForm" id="adminForm">
    <div>
            <!-- Start simplified social share -->
            <?php
                echo $this->loadTemplate('config');
            ?>
            <!-- End simplified social share -->
    </div>
    <input type="hidden" name="task" value="apply"/>
</form>