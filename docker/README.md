#github notes:

The code assumes it can fetch a mysqldump of the database from a github repo using a fine-grained access token.  The full name and email adress of the github user with access to this github repo should be defined in the src/git-config file, but more importantly, the username and fined grained access token should be defined in the src/gitcreds file using the following format:

https://username:<token>@github.com

For example:

https://cfthompson:github_pat_123456789ABCDFHG@github.com

where "cfthompson" is the username and "github_pat_123456789ABCDFHG" is the token.

A few notes on github tokens:
- tokens (more specifically "Personal Access Tokens" are created by the github user on the github website.  Go to your profile in the upper right and choose Settings, then scroll all the way down to "Developer Settings" on the left and click on it to be taken to the tokens page.
- you should only use fine-grained tokens.  Classic tokens are way too overly permissive.
- when creating the fine grained token, only give it access to the backup repo, with "Read access to metadata" and "Read and Write access to code and commit statuses".  You do not need to give it any Org permissions.i Give it an expiration of a year (that's the longest possible) and mark the byc calendar so we know we need to regenerate it. Ideally we'd do this at the beginning of each beercan season.`
- once you punch the generate button, the token string will be there for you to copy.  This is your only chance to do so. If you lose it, you'll need to generate a new token. Copy the token string and punch it into gitcreds file noted above, then rebuild and re-push the container image.  The Dockerfile will run commands that put the git-config and gitcreds files in the right location in the filesystem with the right permissions.
