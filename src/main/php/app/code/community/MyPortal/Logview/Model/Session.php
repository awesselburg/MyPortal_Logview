<?php
/**
 * MyPortal_Logview_Model_Session
 *
 * @category    community
 * @copyright   Copyright (c) myportal.de
 *              (http://www.myportal.de)
 *
 * @author      awesselburg
 * @version     1.0.0
 *
 */
class MyPortal_Logview_Model_Session
    extends Mage_Core_Model_Session_Abstract
{
    /**
     * @var $_logview
     */
    protected $_logview;

    /**
     * First position top
     */
    const TOP = 50;
    /**
     * First position left
     */
    const LEFT = 50;
    /**
     * First state
     */
    const ENABLED = false;
    /**
     * param for first exception log update
     */
    const EXCEPTION_LOG_UPDATE = 'true';
    /**
     * param for first system log update
     */
    const SYSTEM_LOG_UPDATE = 'true';
    /**
     * size of first exception log size
     */
    const EXCEPTION_LOG_FILE_SIZE = 0;
    /**
     * size of first system log size
     */
    const SYSTEM_LOG_FILE_SIZE = 0;

    /**
     * Internal constructor not depended on params. Can be used for object initialization
     */
    public function __construct()
    {
        $namespace = 'myportal_logview';
        $this->init($namespace);
    }

    /**
     * set the right logview
     * @param MyPortal_Logview_Model_Logview $logview
     */
    public function setLogview(MyPortal_Logview_Model_Logview $logview)
    {
        $this->_logview = $logview;
    }

    /**
     * returns the top position
     * @return string
     */
    public function getTop()
    {
        if (!$this->getData('top')) {
            $this->setData('top', self::TOP);
        }
        return $this->getData('top');
    }

    /**
     * returns the left position
     * @return string
     */
    public function getLeft()
    {
        if (!$this->getData('left')) {
            $this->setData('left', self::LEFT);
        }
        return $this->getData('left');
    }

    /**
     * gets the enabled status
     * @return string
     */
    public function getEnabled()
    {
        if (!$this->getData('enabled')) {
            $this->setData('enabled', self::ENABLED);
        }
        return $this->getData('enabled');
    }

    /**
     * sets the enabled status
     * @param bool $status
     */
    public function setEnabled($status = false)
    {
        $this->setData('enabled', $status);
    }

    /**
     * sets the exception log update
     * @param bool $value
     */
    public function setExceptionLogUpdate($value)
    {
        $this->setData('exception_log_update', $value);
    }

    /**
     * gets the exception log update
     * @return bool
     */
    public function getExceptionLogUpdate()
    {
        if (!$this->getData('exception_log_update')) {
            $this->setData('exception_log_update', self::EXCEPTION_LOG_UPDATE);
        }
        return $this->getData('exception_log_update');
    }

    /**
     * sets the system log update
     * @param bool $value
     */
    public function setSystemLogUpdate($value)
    {
        $this->setData('system_log_update', $value);
    }

    /**
     * gets the system log update
     * @return bool
     */
    public function getSystemLogUpdate()
    {
        if (!$this->getData('system_log_update')) {
            $this->setData('system_log_update', self::SYSTEM_LOG_UPDATE);
        }
        return $this->getData('system_log_update');
    }

    /**
     * sets the exception log size and update flag
     * @param int $size
     */
    public function setExceptionLogSize($size)
    {
        if ($size != $this->getExceptionFileSize()) {
            $this->setExceptionLogUpdate('true');
        } else {
            $this->setExceptionLogUpdate('false');
        }
        $this->setData('exception_log_file_size', $size);
    }

    /**
     * sets the system log size and update flag
     * @param int $size
     */
    public function setSystemLogSize($size)
    {
        if ($size != $this->getSystemFileSize()) {
            $this->setSystemLogUpdate('true');
        } else {
            $this->setSystemLogUpdate('false');
        }
        $this->setData('system_log_file_size', $size);
    }

    /**
     * returns the exception file size
     * @return int
     */
    public function getExceptionFileSize()
    {
        if (!$this->getData('exception_log_file_size')) {
            $this->setData('exception_log_file_size', self::EXCEPTION_LOG_FILE_SIZE);
        }
        return $this->getData('exception_log_file_size');
    }

    /**
     * returns the system file size
     * @return int
     */
    public function getSystemFileSize()
    {
        if (!$this->getData('system_log_file_size')) {
            $this->setData('system_log_file_size', self::SYSTEM_LOG_FILE_SIZE);
        }
        return $this->getData('system_log_file_size');
    }

}