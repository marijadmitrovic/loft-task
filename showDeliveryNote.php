<?php

use DeliveryNoteService\DeliveryNoteService;
use Files\FileUploader;

require_once "vendor/autoload.php";

$uploader = new FileUploader();
$fileName = $uploader->moveFileToFolder();

$deliveryNoteService = new DeliveryNoteService($fileName);
$deliveryNoteService->getListAsJsonObject($fileName);
