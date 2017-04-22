<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/**
 * @var ClassLoader $loader
 */

$loader = require __DIR__.'/../vendor/autoload.php';

//$loader->add('System', realpath(__DIR__.'/../vendor/system/system/src'));

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

return $loader;
