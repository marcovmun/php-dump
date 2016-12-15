# php-dump
=============
This is a application that simple dump dumps in a separate web page

[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%205.6-8892BF.svg?style=flat-square)](https://php.net/)
## Installation
 1. Clone this project
 2. Run composer install in project map
 ```bash
 $ composer install
 ```
  3. Check if the index.html is accessible throw your browser.

## Enable
### In one project
start of project: (index or bootstrap file)
```php
require 'path/to/project/php-dump/project/vendor/autoload.php';
```
### Global on server
```bash
$  echo 'auto_prepend_file = "/location/of/this/project/vendor/autoload.php"' >> /path/to/php/include/ini/files/php-debug.ini
```

**Functions:**
- (start) Start pulling for new dumps 
- (stop) Stop pulling for new dumps
- (clear) Clear current page from all dumps

**Example debug pages:**
![Example page](media/image/debug_page.PNG)

![Example small page](media/image/small_debug_page.PNG)