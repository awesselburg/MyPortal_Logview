<?php
/**
 * MyPortal_Logview_Block_Page_Log
 *
 * @category    community
 * @copyright   Copyright (c) myportal.de
 *              (http://www.myportal.de)
 *
 * @author      awesselburg
 * @version     1.0.0
 *
 */
class MyPortal_Logview_Block_Page_Log
    extends Mage_Adminhtml_Block_Template
{
    /**
     * returns the update url
     * @return string
     */
    public function getUpdateUrl()
    {
        return Mage::helper('adminhtml')->getUrl('logview/index/update');
    }

    /**
     * returns the update url
     * @return string
     */
    public function getLogUrl()
    {
        return Mage::helper('adminhtml')->getUrl('logview/index/log');
    }

    /**
     * returns the reload time
     * @return int
     */
    public function getReloadTime()
    {
        return Mage::getStoreConfig('dev/logview/reload');
    }

    /**
     * returns the auto reload status
     * @return bool
     */
    public function getAutoReloadEnabled()
    {
        return Mage::getStoreConfig('dev/logview/auto_reload');
    }

    /**
     * returns the active status
     * @return bool
     */
    public function isActive()
    {
        if (Mage::getStoreConfig('dev/logview/active')
            && $this->_getSession()->getEnabled()
        ) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return MyPortal_Logview_Model_Session
     */
    protected function _getSession()
    {
        return Mage::getSingleton('myportal_logview/session');
    }
}