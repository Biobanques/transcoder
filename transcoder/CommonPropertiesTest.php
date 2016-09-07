<?php

/*
  Common properties for circle ci
 */

class CommonProperties
{
    static $CONNECTIONSTRING = "mysql:host=127.0.0.1;dbname=circle_test";
    static $CONNECTIONUSER = "ubuntu";
    static $CONNECTIONPASSWORD = null;
    static $LAUNCHSELENIUM = false;
    static $SERVERTESTURL = 'http://transcoder.local:8080';
    /**
     * Browser used for functional testing. chrome and firefox implmented
     * @var String
     * Available values : chrome firefox
     */
    static $TESTBROWSER = 'firefox';
}