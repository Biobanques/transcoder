#!/bin/bash

TESTSPATH='/var/www/transcoder/transcoder/protected/tests/'

cd $TESTSPATH
echo '-------------------Lancements des tests unitaires------------------------'
phpunit unit/ --coverage-html ./report 

