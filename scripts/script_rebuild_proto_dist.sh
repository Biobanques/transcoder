#!/bin/bash
MUSER="root"
MURL="mydomain"
MPATH="/var/www/vhosts/mydomain/transcoderapp"

echo "mise a jour d u numero revision"
echo -n "" > ./transcoder/revision_number.php
svnversion -n . >> ./transcoder/revision_number.php
echo "supppression des fichiers en cache local/pas de besoin de synchro"
rm -Rf ./transcoder/assets/*
echo "syncro des sources"
rsync --delete -avz -e 'ssh'  --exclude '.svn' ./transcoder/ $MUSER@$MURL:$MPATH
rsync --delete -avz -e 'ssh'  --exclude '.svn' ./docs $MUSER@$MURL:$MPATH/docs/

