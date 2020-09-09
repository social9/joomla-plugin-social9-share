<?php

/**
 * @package     SimplifiedSocialShare.Plugin
 * @subpackage  com_simplifiedsocialshare
 *
 * @copyright   Copyright (C) 2005 - 2012 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die('Restricted access');

jimport('joomla.plugin.plugin');
jimport('joomla.html.parameter');

/**
 * Class plgContentSimplifiedSocialShare
 */
class plgContentSimplifiedSocialShare extends JPlugin
{

    /**
     * @param object $subject
     */
    public function __construct(&$subject)
    {
        parent::__construct($subject);

        // Loading plugin parameters
        $settings = $this->getSettings();
        $this->horizontalarticaltype = (isset($settings['horizontalarticaltype']) && $settings['horizontalarticaltype'] != '1') ? $settings['horizontalarticaltype'] : "1";
        $this->verticalarticaltype = (isset($settings['verticalarticaltype']) && $settings['verticalarticaltype'] != '1') ? $settings['verticalarticaltype'] : "1";
        $this->horizontalArticles = (!empty($settings['horizontalArticles']) ? @unserialize($settings['horizontalArticles']) : []);
        $this->verticalArticles = (!empty($settings['verticalArticles']) ? @unserialize($settings['verticalArticles']) : []);
        $this->shareontoppos = (!empty($settings['shareontoppos']) ? $settings['shareontoppos'] : "");
        $this->shareonbottompos = (!empty($settings['shareonbottompos']) ? $settings['shareonbottompos'] : "");
        $this->sharingScript = isset($settings['sharing_script']) ? urldecode($settings['sharing_script']) : '';
        $this->enableScript = true;
        $this->loadLanguage('plg_content_simplifiedsocialshare');
    }


    /**
     * 
     * @param type $form
     * @param type $data
     * @return boolean
     */
    public function onContentPrepareForm($form, $data)
    {
        $app = JFactory::getApplication();
        $option = $app->input->get('option');
        switch ($option) {
            case 'com_content':
                if ($app->isAdmin()) {
                    $form->load('<form>
                        <fields name="attribs">
                            <fieldset name="simplifiedsocialshare" label="PLG_CONTENT_SOCIAL_SHARE_FIELDSET_LABEL">
                            <field name="share_enable" type="list" description="PLG_CONTENT_SOCIAL_SHARE_FIELD_ENABLE_DESC" translate_description="true" label="PLG_CONTENT_SOCIAL_SHARE_FIELD_ENABLE_LABEL" translate_label="true" size="7" filter="cmd">
                                <option value="">JGLOBAL_USE_GLOBAL</option>
                                <option value="0">JHIDE</option>
                            </field>
                            </fieldset>
                        </fields>
                    </form>');
                }
        }
        return true;
    }
    /**
     * social9 get saved setting from db
     * 
     * @return array
     */
    private function getSettings()
    {
        $db = JFactory::getDBO();

        $sql = "SELECT * FROM #__oss_share_settings";
        $db->setQuery($sql);
        $rows = $db->LoadAssocList();
        $settings = array();

        if (is_array($rows)) {
            foreach ($rows as $key => $data) {
                $settings[$data['setting']] = $data['value'];
            }
        }

        return $settings;
    }

    /**
     * Before display content method
     *
     * @param $context
     * @param $article
     * @param $params
     * @param int $limitstart
     * @return string
     */
    public function onContentBeforeDisplay($context, &$article, &$params, $limitstart = 0)
    {

        $beforediv = '';
        if ($this->shareontoppos == '1') {
            if ($this->horizontalarticaltype == '1') {
                $beforediv .= '<div class="s9-widget-wrapper"></div>';
            } else if (is_array($this->horizontalArticles)) {
                if (isset($article->id) && in_array($article->id, $this->horizontalArticles)) {
                    $beforediv .= '<div class="s9-widget-wrapper"></div>';
                }
            }
        }

        if ($this->enableScript == true) {
            if ($this->verticalarticaltype != '1') {
                if (!isset($article->id) || !in_array($article->id, $this->verticalArticles)) {
                    $this->sharingScript = str_replace(array("id="), array("data-hide-float='true' id="), $this->sharingScript);
                }
            }
            JFactory::getDocument()->addScriptDeclaration('</script>' . $this->sharingScript . '<script>');
            $this->enableScript = false;
        }
        return $beforediv;
    }

    /**
     * After display content method
     *
     * @param $context
     * @param $article
     * @param $params
     * @param int $limitstart
     * @return string
     */
    public function onContentAfterDisplay($context, &$article, &$params, $limitstart = 0)
    {
        $afterdiv = '';
        if ($this->shareonbottompos == '1') {
            if ($this->horizontalarticaltype == '1') {
                $afterdiv .= '<div class="s9-widget-wrapper"></div>';
            } else if (is_array($this->horizontalArticles)) {
                if (isset($article->id) && in_array($article->id, $this->horizontalArticles)) {
                    $afterdiv .= '<div class="s9-widget-wrapper"></div>';
                }
            }
        }
        return $afterdiv;
    }
}
