Corgioverflow
=========

Usage
=====

Composer
--------
Corgioverflow git should come with the vendor map that contains all needed 
composer packages. If doing manually, add
```
    "require": {
        "php": ">=5.4",
        "phpmvc/comment": "dev-master",
        "mos/cform": "2.*@dev",
        "mos/cdatabase": "dev-master"
    }
```
to your `composer.json` file, use Packagist/Composer and update, and then manually 
edit `vendor/mos/cform/src/HTMLForm/CForm.php` with:
```PHP
    /**
     * Get values of a form elements checked boxes.
     *
     * @param string $element the name of the formelement.
     *
     * @return mixed the value of the element.
     */
    public function values($element)
    {
        return $this[$element]['checked'];
    }
```
preferably at row 167 for easy finding. This edit will allow you to get marked values 
from a multiple checkbox form. This is only required when manually using composer packages.

SQL
---
Import SQL tables from `sql/sqlimport.sql` to your SQL host using the import feature.
This will create tables used by Corgioverflow and a set of tags used when creating 
questions. Adding/removing in table `corgi_commentcategory` will allow you to make new tags.

Edit `app/config/config_mysqlonline.php` and change:
```PHP
define('DB_PASSWORD', 'YOUR PASSWORD');
'dsn'     => "mysql:host=HOSTNAME;dbname=DATABASENAME;"
'username'        => "YOUR USERNAME"
```
to your specific details. 

For local use edit `app/config/config_mysql.php` and change:
```PHP
'dsn'     => "mysql:host=localhost;dbname=DATABASENAME;"
```
to your preferred database.

Setting up your webpage
-----------------------
Edit `webroot/.htaccess` and remove commented RewriteEngine for online use if needed.

---
To change between online/offline use edit `webroot/index.php` and change:
```PHP
    $db->setOptions(require ANAX_APP_PATH . 'config/config_mysqlonline.php');
```
to `$db->setOptions(require ANAX_APP_PATH . 'config/config_mysql.php');`

---
Change permissions for folder `webroot/css/anax-grid` to 777 which allows less files 
to be created. If CSS is not loaded when viewing page delete `webroot/css/anax-grid/style.css`
and `webroot/css/anax-grid/style.less.cache` so new ones will be created.

CorgiOverflow usage
-------------
* Create new user.
* Edit your own profile.
* Ask questions, answer questions and comment questions/answers.
* Upvote/downvote questions/answers/comments.
* As the author of a question mark other users answers as accepted so other users can see.
* Add tags to your questions so they are easily categorized and accessed via the tags page.
* Gather points as a user for asking/answering/commenting questions based on their upvoted/downvoted status.

License
------------------

This software is free software and carries a MIT license.



Use of external libraries
-----------------------------------

The following external modules are included and subject to its own license.



### Modernizr
* Website: http://modernizr.com/
* Version: 2.6.2
* License: MIT license
* Path: included in `webroot/js/modernizr.js`



### PHP Markdown
* Website: http://michelf.ca/projects/php-markdown/
* Version: 1.4.0, November 29, 2013
* License: PHP Markdown Lib Copyright © 2004-2013 Michel Fortin http://michelf.ca/
* Path: included in `3pp/php-markdown`



### Lessphp
* Website: http://leafo.net/lessphp
* Version: 0.4.0
* License: Copyright (c) 2013 Leaf Corcoran, http://leafo.net/lessphp
* Path: included in `webroot/css/anax-grid/lessphp/lessc.inc.php`



### Semantic grid
* Website: http://tylertate.github.io/semantic.gs/
* Version: 1.2, January 11, 2012
* License: Licensed under Apache 2.0. See [LICENSE](https://github.com/twigkit/semantic.gs/blob/master/LICENSE.txt)
* Path: included in `webroot/css/anax-grid/semantic.gs`
