#!/bin/bash

# Start Apache in the foreground
#apache2ctl -D FOREGROUND &

# Execute your PHP script
php ch4tsite/index.php chatsite_server > output.log 2>&1