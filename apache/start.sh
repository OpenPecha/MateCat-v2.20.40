#!/bin/bash

for file in Error_Mail_List.ini config.ini oauth_config.ini task_manager_config.ini
do
    cp /app/matecat/inc/$file /app/matecat/inc/$file.tmp
    envsubst < /app/matecat/inc/$file.tmp > /app/matecat/inc/$file
    rm /app/matecat/inc/$file.tmp
done

sudo -H -u www-data bash -c 'bash /app/matecat/daemons/restartAnalysis.sh'

apache2-foreground

