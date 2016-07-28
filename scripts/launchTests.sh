#!/bin/bash

SERVERPATH='/home/matthieu/Documents/test/selenium-server-standalone-2.41.0.jar'
TESTSPATH='/home/matthieu/NetBeansProjects/transcoder/transcoder/protected/tests/'
#java -jar $SERVERPATH &
sleep 3
cd $TESTSPATH
echo '-------------------Lancements des tests unitaires------------------------'
phpunit unit/ --coverage ./report
echo '-------------------Lancements des tests fonctionnels------------------------'
phpunit functional/ 
