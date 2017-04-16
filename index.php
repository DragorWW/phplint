<?php
use PhpLint\Rules\Eqeqeq;

require './vendor/autoload.php';

ini_set('xdebug.max_nesting_level', 3000);

$code = '<?php if ($a == $b) {}';

$phpLint = new PhpLint\PhpLint();

$phpLint->setRules([
    new Eqeqeq('error'),
]);

$phpLint->validate($code);