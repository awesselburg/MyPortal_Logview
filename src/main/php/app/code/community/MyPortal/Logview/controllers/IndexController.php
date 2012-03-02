<?php
/**
 * MyPortal_Logview_IndexController
 *
 * @category    community
 * @copyright   Copyright (c) myportal.de
 *              (http://www.myportal.de)
 *
 * @author      awesselburg
 * @version     1.0.0
 *
 */
class MyPortal_Logview_IndexController
    extends Mage_Adminhtml_Controller_Action
{
    /**
     * returns the json data
     */
    public function logAction()
    {

        $result = new Varien_Object();

        $result->setUpdateExceptions(
            $this->_getSession()->getExceptionLogUpdate()
        );

        $result->setUpdateSystems(
            $this->_getSession()->getSystemLogUpdate()
        );

        $result->setExceptions(
            $this->_getHelper()->decorateItems(
                Mage::getSingleton('myportal_logview/exception')->getLogs()
            )
        );

        $result->setExceptionsFileSize(
            $this->_getSession()->getExceptionFileSize()
        );

        $result->setSystems(
            $this->_getHelper()->decorateItems(
                Mage::getSingleton('myportal_logview/system')->getLogs()
            )
        );

        $result->setSystemsFileSize(
            $this->_getSession()->getSystemFileSize()
        );

        $result->setAutoReload(
            $this->_getHelper()->getAutoReload()
        );

        $this->getResponse()->setHeader('Content-Type', 'application/json', true)->setBody(json_encode($result->getData()));
    }

    /**
     * update the data in session from move, close etc.
     */
    public function updateAction()
    {
        $_req = $this->_getRequest();
        $_logviewSession = $this->_getSession();

        $_logviewSession->setTop(intval($_req['positiontop'], 10));
        $_logviewSession->setLeft(intval($_req['positionleft'], 10));
        $_logviewSession->setEnabled($_req['logenabled'] == 'true' ? true : false);
        $this->_getHelper()->setAutoReload($_req['autoreload'] == 'true' ? true : false);
    }

    /**
     * enable the view
     */
    public function enableAction()
    {
        $_logviewSession = $this->_getSession();
        $_logviewSession->setEnabled(Mage::app()->getRequest()->getParam('type') == 'true' ? true : false);
        $this->getResponse()->setRedirect($this->_getRefererUrl());
    }

    /**
     * returns the request data
     * @return object
     */
    protected function _getRequest()
    {
        return Mage::app()->getRequest()->getParams();
    }

    /**
     * @return MyPortal_Logview_Model_Session
     */
    protected function _getSession()
    {
        return Mage::getSingleton('myportal_logview/session');
    }

    /**
     * @return MyPortal_Logview_Helper_Data
     */
    public function _getHelper()
    {
        return Mage::helper('myportal_logview');
    }
}