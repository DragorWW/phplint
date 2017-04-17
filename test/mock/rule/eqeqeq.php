<?php

// eqeqeq
if ($a == $b) {
}

// side effect: change ini settings
ini_set('error_reporting', E_ALL);

// side effect: loads a file
include "file.php";

// one class per file
class Foo
{
}

// one class per file
class Bar
{
}