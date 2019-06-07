<?php

use UploadFiles\UploadFile;

require_once "vendor/autoload.php";

$result = new UploadFile();
$result->formatOrderedList();
$result->formatJsonObject();