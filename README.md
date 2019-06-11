# Loft-task

## About
**Loft-task** is PHP implementation that can accept any set of delivery notes. 
Using PHP without frameworks, the exception is the section 'Tests' where Codeception is used.

## Let's start
### How to execute?
This is a simple GUI app ,where in the input field put the JSON file and the PHP class `DeliveryNote` returns a complete ordered list (here I was confused do I need back in the order list format or in JSON format, so in `showDeliveryNote.php` I put both).


### Run the test
For testing I used Codeception.
* First, install via Composer:
```bash
composer require "codeception/codeception" --dev
```

* Second creates configuration file codeception.yml and tests directory:
```bash
./vendor/bin/codecept bootstrap
```

* In `acceptance.suite.yml` set up properly `PhpBrowser.url` field. 

* Tests are executed with 'run' command
```bash
codecept run --steps
```

For more information, visit the site
[Codeception](https://codeception.com/)

### JSON schema validation

To make sure that the correct JSON data will be forwarded to the script UploadFile class use [justinrainbow/json-schema](https://github.com/justinrainbow/json-schema) library.

#### ShowDeliveryNoteCest (testShowDeliveryNoteContent())

The test should be to show the data from the uploaded Json file, needs to be fixed.
I could not find the reason why the test doesn't show the Json data correctly.
