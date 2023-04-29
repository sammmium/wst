<?php

define('CONFIG_DIRECTORY_PATTERN', '../config/*.php');
define('DEPENDENCIES_DIRECTORY_PATTERN', '../config/dependencies/*.php');

$files = array_merge(
    glob(DEPENDENCIES_DIRECTORY_PATTERN ?: []),
    glob(CONFIG_DIRECTORY_PATTERN ?: []),
);

$config = array_map(function($file) {
    return require_once $file;
}, $files);

return array_merge_recursive(...$config);
