<?php

/**
 * General properties file
 *
 */
class CommonProperties
{
    static $CONNECTIONSTRING = "mysql:host=127.0.0.1;dbname=transcoder";
    static $CONNECTIONUSER = "tcUser";
    static $CONNECTIONPASSWORD = "tc@mypass";
    static $LAUNCHSELENIUM = true;
    static $SERVERTESTURL = 'http://transcoder.local';
    /**
     * Browser used for functional testing. chrome and firefox implmented
     * @var String
     * Available values : chrome firefox
     */
    static $TESTBROWSER = 'firefox';
}