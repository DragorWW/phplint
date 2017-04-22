<?php
use PhpLint\Rules\Eqeqeq;

require './vendor/autoload.php';

ini_set('xdebug.max_nesting_level', 3000);
ini_set('short_open_tag', true);

$code = '<?php';

$phpLint = new PhpLint\PhpLint();

const VERSION = '1.0';
$phpLint->setRules([
    new Eqeqeq('error'),
]);


$asd = $phpLint->getAst('<?php
// 
');
print_r($asd);
/*echo json_encode($phpLint->getAst('<?php ini_set(\'error_reporting\', E_ALL); ?>'), JSON_PRETTY_PRINT), "\n";
*/

//print_r($ast);