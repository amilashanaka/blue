#!/bin/sh
echo 'Touching files for logging / debug'
touch /srv/www/htdocs/agent2019/vicidial_debug.txt
chmod 777 /srv/www/htdocs/agent2019/vicidial_debug.txt
touch /srv/www/htdocs/agent2019/vicidial_mysqli_errors.txt
chmod 777 /srv/www/htdocs/agent2019/vicidial_mysqli_errors.txt
touch /srv/www/htdocs/agent2019/vicidial_debug.txt
chmod 777 /srv/www/htdocs/agent2019/vicidial_debug.txt
touch /srv/www/htdocs/agent2019/project_auth_entries.txt
chmod 777 /srv/www/htdocs/agent2019/project_auth_entries.txt
touch /srv/www/htdocs/agent2019/vicidial_auth_entries.txt
chmod 777 /srv/www/htdocs/agent2019/vicidial_auth_entries.txt
touch /srv/www/htdocs/agent2019/astguiclient_auth_entries.txt
chmod 777 /srv/www/htdocs/agent2019/astguiclient_auth_entries.txt
chmod -R +x /srv/www/htdocs/agent2019/bluetelecoms/
chmod -R +x /srv/www/htdocs/agent2019/bluetelecoms/settings
chmod -R +x /srv/www/htdocs/uploader
echo 'Done....'
