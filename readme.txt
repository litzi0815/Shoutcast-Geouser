This script grabs all connected ip addresses from one or more shoutcast servers an tries to gather the location of the users.

The file read_ips.php has to be run every few minutes by a cron job. This is the part that reads the ips.

The file get_locations.php hat to be run once a day (i guess at night). This script will try to gather the locations of the ips recorded over the day.