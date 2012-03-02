<?php
/**
 * MyPortal_Logview_Model_Exception
 *
 * @category    community
 * @copyright   Copyright (c) myportal.de
 *              (http://www.myportal.de)
 *
 * @author      awesselburg
 * @version     1.0.0
 *
 */
class MyPortal_Logview_Model_Exception
    extends MyPortal_Logview_Model_Abstract
{
    /**
     * defined the config log path
     * @var string
     */
    public $CONFIG_LOG_FILE_PATH = 'dev/log/exception_file';

    /**
     * Internal constructor not depended on params. Can be used for object initialization
     */
    public function _construct()
    {
        parent::_construct();

        $this->_getSession()->setExceptionLogSize(
            $this->_getFileSize(
                $this->_getLogFile()
            )
        );
    }

}