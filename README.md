# Job Post Task
This is a simple example of hypothetical job board project

##User Story 1
As a HR manager I would like to go to job submission page, fill out a form and publish a job offer.
###COS:
● new job form should contain title, description and email field.
● when i hit submit button, if this is my first job posting i should receive email saying that
my submission is in moderation, otherwise it should be public/published.
##User Story 2
As a job board moderator i would like to receive email every time someone posts a job for a first
time.
###COS:
● every time someone posts a job for a first time (based on email address) i should receive
email about it
● email notification should contain title and description of submission, as well as links to
approve (publish) or mark it as a spam.

###Installations

    cd [to-repo-directory];  composer install

Change config `config/database.php` & `config/mail.php` with yours & then run `php install.php`

###Running project

    cd [to-repo-directory]; php -S 0.0.0.0:8080 -t public public/index.php
###Running tests

    cd [to-repo-directory];  vendor/bin/phpunit

###Packages & libraries used

 1. https://github.com/mikecao/sparrow
 2. https://github.com/nikic/FastRoute
 3. https://github.com/eoghanobrien/php-simple-mail
 4. https://github.com/arifmahmudrana/context
 5. https://gist.github.com/BaylorRae/1504836