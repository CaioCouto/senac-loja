<?php
spl_autoload_register(function($className) {
    require_once(realpath(dirname(__DIR__) . "/classes/{$className}.php"));
});