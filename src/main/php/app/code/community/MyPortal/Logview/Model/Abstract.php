<?php
/**
 * MyPortal_Logview_Model_Abstract
 *
 * @category    community
 * @copyright   Copyright (c) myportal.de
 *              (http://www.myportal.de)
 *
 * @author      awesselburg
 * @version     1.0.0
 *
 */
class MyPortal_Logview_Model_Abstract
    extends Varien_Object
{
    /**
     * config log file path
     * @var bool
     */
    public $CONFIG_LOG_FILE_PATH = false;

    /**
     * returns the path for the currend log file
     * @return string
     */
    protected function _getLogFile()
    {
        $file = Mage::getStoreConfig($this->CONFIG_LOG_FILE_PATH);
        return Mage::getBaseDir('var') . DS . 'log' . DS . $file;
    }

    /**
     * Internal constructor not depended on params. Can be used for object initialization
     */
    public function _construct()
    {
        $this->setData('logs', $this->_getHelper()->tail($this->_getLogFile()));
    }

    /**
     * @return MyPortal_Logview_Helper_Data
     */
    protected function _getHelper()
    {
        return Mage::helper('myportal_logview');
    }

    /**
     * returns the current file size
     * @param string $file
     * @return int
     */
    protected function _getFileSize($file)
    {
        if (is_file($file)) {
            return filesize($file);
        } else {
            return 0;
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