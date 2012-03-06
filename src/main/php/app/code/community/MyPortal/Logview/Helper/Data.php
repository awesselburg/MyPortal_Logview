<?php
/**
 * MyPortal_Logview_Helper_Data
 *
 * @category    community
 * @copyright   Copyright (c) myportal.de
 *              (http://www.myportal.de)
 *
 * @author      awesselburg
 * @version     1.0.0
 *
 */
class MyPortal_Logview_Helper_Data
    extends Mage_Core_Helper_Abstract
{
    /**
     * returns the definded lines from log file
     * @param $file
     * @return string
     */
    public function tail($file)
    {

        $data = '';
        $tailLines = Mage::getStoreConfig('dev/logview/lines');

        if (is_file($file)) {

            $fp = fopen($file, "r");
            $block = 4096;
            $max = filesize($file);

            for ($len = 0; $len < $max; $len += $block) {

                $seekSize = ($max - $len > $block) ? $block : $max - $len;
                fseek($fp, ($len + $seekSize) * -1, SEEK_END);
                $data = fread($fp, $seekSize) . $data;

                if (substr_count($data, "\n") >= $tailLines + 1) {
                    if (substr($data, strlen($data) - 1, 1) !== "\n") {
                        $data .= "\n";
                    }
                    preg_match("!(.*?\n){" . $tailLines . "}$!", $data, $match);
                    fclose($fp);
                    return $match[0];
                }
            }

            fclose($fp);

        }

        return $data;
    }

    /**
     * split the items and add the css classes
     * @param $data
     * @return string
     */
    public function decorateItems($data)
    {
        $items = array();
        foreach (explode("\n", $data) as $item) {

            $dateTime = substr($item, 0, 25);
            $dateTimeItems = explode(':', $dateTime);

            if (count($dateTimeItems) == '4') {

                $fullLengh = strlen($item);
                $infoString = substr($item, 25, $fullLengh);

                array_push($items,

                    sprintf('<pre class="item"><code><span class="datetime">%s:%s:%s:%s</span>%s</code></pre>',
                        $dateTimeItems[0],
                        $dateTimeItems[1],
                        $dateTimeItems[2],
                        $dateTimeItems[3],
                        $this->_decorateLogInfo($infoString)
                    )
                );
            } else {
                array_push($items, '<pre class="item"><code>' . $item . '</pre></code>');
            }
        }
        return implode('', $items);
    }

    /**
     * decorate datetime info
     * @param $info
     * @return string
     */
    public function _decorateLogInfo($info)
    {

        $logTypeItems = explode(' ', $info);
        return sprintf('<span class="%s"> %s</span> %s',
            $this->_getLogInfoClass($logTypeItems[1]),
            $logTypeItems[1],
            substr(
                $info,
                strlen($logTypeItems[1]) + 2,
                strlen($info)
            )
        );
    }

    /**
     * gets the right class for debug level
     * @param $item
     * @return string
     */
    public function _getLogInfoClass($item)
    {
        switch ($item) {
            case 'ERR' :
                return 'err';
                break;
            case 'CRIT' :
                return 'crit';
                break;
            case 'DEBUG' :
                return 'debug';
                break;
            default :
                return 'debug';
                break;
        }
    }

    /**
     * returns the auto reload setting from config
     * @return bool
     */
    public function getAutoReload()
    {
        return Mage::getStoreConfig('dev/logview/auto_reload');
    }

    /**
     * sets the reload status to config
     * @param bool $status
     */
    public function setAutoReload($status)
    {
        Mage::getModel('core/config')->saveConfig('dev/logview/auto_reload', $status);
    }
}