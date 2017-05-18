<?
echo "<pre>";
//system("ps awx");
//system("cat /proc/loadavg");
//system("killall /usr/bin/php-cgi");
system("pkill -9 -u shop");
system("pkill -9 -u www-data");
echo "</pre>";
?>