# Install git an zip/unzip (required by composer)
apt update && apt install -y git zip unzip

# Download and install Composer
# I _could_ mount a volume and install it there. But it only takes
# a few seconds so do it everytime the container is run.
curl -o /home/composer-setup.php https://getcomposer.org/installer
EXPECTED_SIGNATURE="$(curl https://composer.github.io/installer.sig)"
ACTUAL_SIGNATURE="$(php -r "echo hash_file('sha384', '/home/composer-setup.php');")"
if [ "$EXPECTED_SIGNATURE" != "$ACTUAL_SIGNATURE" ]
then
    >&2 echo 'ERROR: Invalid installer signature'
    rm composer-setup.php
    exit 1
fi
cd /home
php /home/composer-setup.php --filename=composer
php -r "rename('/home/composer', '/usr/local/bin/composer');"
php -r "unlink('/home/composer-setup.php');"

cd /srv/php-lib
ls -alh
# Output a PHP version details + other info
echo "\n"
php -v
echo "\n"

# Start a bash shell
bash
