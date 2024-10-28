#
# NOTICE OF LICENSE
#
# This source file is subject to a commercial license from SARL 202 ecommerce
# Use, copy, modification or distribution of this source file without written
# license agreement from the SARL 202 ecommerce is strictly forbidden.
# In order to obtain a license, please contact us: tech@202-ecommerce.com
# ...........................................................................
# INFORMATION SUR LA LICENCE D'UTILISATION
#
# L'utilisation de ce fichier source est soumise a une licence commerciale
# concedee par la societe 202 ecommerce
# Toute utilisation, reproduction, modification ou distribution du present
# fichier source sans contrat de licence ecrit de la part de la SARL 202 ecommerce est
# expressement interdite.
# Pour obtenir une licence, veuillez contacter 202-ecommerce <tech@202-ecommerce.com>
# ...........................................................................
#
# @author    202-ecommerce <tech@202-ecommerce.com>
# @copyright Copyright (c) 202-ecommerce
# @license   Commercial license
#

set -e
set -x

curl \
  -L https://raw.githubusercontent.com/nickjj/wait-until/v0.2.0/wait-until \
  -o /usr/local/bin/wait-until && chmod +x /usr/local/bin/wait-until

wait-until "mysql -h localhost -u root prestashop -e 'select 1'"
wait-until "/etc/init.d/apache2 status | grep -v grep | grep 'apache2 is running' | wc -l | grep 1"
curl -v --trace - localhost || true

sed -i "s/define('_PS_MODE_DEV_', true);/define('_PS_MODE_DEV_', false);/g" /var/www/html/config/defines.inc.php
sed -i "s/fallbacks: \[\"default\"]/fallbacks: \[\"default\"]\n        logging: false/g" /var/www/html/app/config/config.yml

echo "Init and install of module"
php -dmemory_limit=-1 -dmax_execution_time=-1 /var/www/html/bin/console prestashop:module install tottrackingextend -e prod -vvv || true

apt-get update && apt-get install git -y

cd /var/www/html/modules/tottrackingextend/views/_dev
chown www-data:www-data /var/www/html/var -Rf

