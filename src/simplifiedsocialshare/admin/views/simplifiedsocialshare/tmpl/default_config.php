<?php
/**
 * @package     SimplifiedSocialShare.Component
 * @subpackage  com_simplifiedsocialshare
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

$enableVerticalArticalType = $disableVerticalArticalType = $enableHorizontalArticalType = $disableHorizontalArticalType = "";

if ($this->settings['horizontalarticaltype'] == '0')
    $disableHorizontalArticalType = "checked='checked'";
else
    $enableHorizontalArticalType = "checked='checked'";

if ($this->settings['verticalarticaltype'] == '0')
    $disableVerticalArticalType = "checked='checked'";
else
    $enableVerticalArticalType = "checked='checked'";

?>

<!-- Display Table-->
<table class="form-table social_table">
    <tr>
        <th class="head" colspan="2"><?php echo JText::_('COM_SOCIAL_SHARE_SOCIAL_SHARE'); ?></th>
    </tr>
    <tr class="social_row_white">
        <td colspan="2">
            <span class="social_subhead"><?php echo JText::_('COM_SOCIAL_SHARE_THEME'); ?></span><br/><br/>
            <a id="mymodal1" href="javascript:void(0);" onclick="makeAdvanceVisible();" style="color: #00CCFF;"><b><?php echo JText::_('COM_SOCIAL_SHARE_ADVANCE'); ?></b></a> &nbsp;|&nbsp;
            <a id="mymodal2" href="javascript:void(0);" onclick="makeHorizontalVisible();" style="color: #000000;"><b><?php echo JText::_('COM_SOCIAL_SHARE_HORI'); ?></b></a> &nbsp;|&nbsp;
            <a id="mymodal3" href="javascript:void(0);" onclick="makeVerticalVisible();" style="color: #000000;"><b><?php echo JText::_('COM_SOCIAL_SHARE_VERTICAL'); ?></b></a>
            <div style="border:#dddddd 1px solid; margin:10px 0 0 0;">
                <span id="arrow" class="advance"></span>
                <div id="shareadvance" style="display:block;">
                <iframe src="https://social9.com/configurations?view=cms" scrolling="no" frameborder="0" style="border:none;overflow:hidden;width:100%;height: 500px;" allowtransparency="true"></iframe>
<input name="settings[sharing_script]" id="opensocialshare_share_settings_interface_script" type="hidden" value="<?php echo isset($this->settings['sharing_script'])?$this->settings['sharing_script']:'';?>"/>
                </div>
                <div id="sharehorizontal" style="display:none;">

                    <!--socialshare position select-->
                    <div style="overflow:auto; background:#FFFFFF; padding:10px;">
                        <span class="social_subhead"><?php echo JText::_('COM_SOCIAL_SHARE_POSITION'); ?></span><br/><br/>
                        <input name="settings[shareontoppos]" type="checkbox"  <?php echo $this->settings['shareontoppos']; ?> value="1"/> <?php echo JText::_('COM_SOCIAL_SHARE_POSITION_TOP'); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name="settings[shareonbottompos]" type="checkbox"  <?php echo $this->settings['shareonbottompos']; ?> value="1"/> <?php echo JText::_('COM_SOCIAL_SHARE_POSITION_BOTTOM'); ?>
                    </div>
                    <!--select page for socialshare-->
                    <div style="overflow:auto; background:#FFFFFF; padding:10px;" id="horizontalPageSelect">
                        <span class="social_subhead"><?php echo JText::_('COM_SOCIAL_SHARE_ARTICLES'); ?></span><br/>
                        <label><input name="settings[horizontalarticaltype]" type="radio"  <?php echo $enableHorizontalArticalType; ?> value="1"/> <?php echo JText::_('COM_SOCIAL_SHARE_ARTICLE_ALL'); ?> </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label><input name="settings[horizontalarticaltype]" type="radio" <?php echo $disableHorizontalArticalType; ?> value="0"/> <?php echo JText::_('COM_SOCIAL_SHARE_ARTICLE_LIST'); ?></label> </div>
                    
                        <select id="horizontalArticles" name="horizontalArticles[]" multiple="multiple" style="width:400px;<?php if(empty($disableHorizontalArticalType)){echo 'display:none;';}?>">
                            <?php foreach ($this->rows as $row) {
                                ?>
                                <option <?php
                            if (!empty($this->settings['horizontalArticles'])) {
                                foreach ($this->settings['horizontalArticles'] as $key => $value) {
                                    if ($row->id == $value) {
                                        echo " selected=\"selected\"";
                                    }
                                }
                            }
                                ?>value="<?php echo $row->id; ?>">
                                <?php echo $row->title; ?>
                                </option>
                            <?php } ?>
                        </select></div>
                <div id="sharevertical" style="display:none;">
                                      <!-- select page for vertical share interface-->
                    <div style="overflow:auto; background:#FFFFFF; padding:10px;" id="verticalPageSelect">
                        <span class="social_subhead"><?php echo JText::_('COM_SOCIAL_SHARE_ARTICLES'); ?></span><br/>
                        <label><input name="settings[verticalarticaltype]" type="radio"  <?php echo $enableVerticalArticalType; ?> value="1"/> <?php echo JText::_('COM_SOCIAL_SHARE_ARTICLE_ALL'); ?> </label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <label><input name="settings[verticalarticaltype]" type="radio" <?php echo $disableVerticalArticalType; ?> value="0"/> <?php echo JText::_('COM_SOCIAL_SHARE_ARTICLE_LIST'); ?> </label></div>
                    
                        <select id="verticalArticles" name="verticalArticles[]" multiple="multiple" style="width:400px;<?php if(empty($disableVerticalArticalType)){echo 'display:none;';}?>">
                            <?php foreach ($this->rows as $row) {
                                ?>
                                <option <?php
                                if (!empty($this->settings['verticalArticles'])) {
                                    foreach ($this->settings['verticalArticles'] as $key => $value) {
                                        if ($row->id == $value) {
                                            echo " selected=\"selected\"";
                                        }
                                    }
                                }
                                ?>value="<?php echo $row->id; ?>">
                                    <?php echo $row->title; ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                
            </div>
        </td>
    </tr>
</table>

