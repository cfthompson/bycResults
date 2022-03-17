bycResults
==========

Race results program for the Berkeley Yacht Club Friday Night and Sunday Chowder series

Check out the bycresults_bootstrap.sh script for a quick and dirty guide to setting up the environment.

Also check out bycresults.yaml for a sample cloudformation template for deploying an ec2 instance that uses the bootstrap script.

Lots of assumptions about s3 bucket access and mysql usernames, database names, and passwords are assumed.  The bootstrap script does a halfway decent job of calling that out.

### TODO:

- upload minimal mysqldump to git repo with no sensitive info in it, but with all the necessary tables and data, like series, seriestype, etc.
- try to migrate to YII 2
- try to migrate to PHP 8
