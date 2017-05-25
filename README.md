# Php-Git-Status-Check
Check git status and alert you with email when something is changed.

## Warning
Please be careful, don't use this code if you do not fully understand what it do.

`gitcheck.php` is only a snippet and is not secure for a production server.
For use on a production server you muse secure it.

## Usage

* Edit `gitcheck.php` with your needs ( email, folder, password etc...)
* Configure you cron to launch php script every x time (es every 1 hour)
```sh
15 * * * * /usr/bin/php -f /var/www/vhosts/yourdomain.com/httpdocs/gitcheck.php >/dev/null 2>&1
```

##### Optionally
You can open www.yourdomain.com/gitcheck.php via browser for:
* Check current Git status
* Add/Commit difference
* View last 10 commit `git log --stat --pretty=short -10`
