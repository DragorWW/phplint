<?php
namespace PhpLint\Rules;

use PhpLint\Rule;
use PhpParser\Node;

/**
 * Class NoEcho
 * TODO checking is using ob_start, and other.
 *
 * @package PhpLint\Rules
 */
class NoEcho extends Rule
{
    protected static $sideEffectFunctions = [
        'var_dump' => true,
        'print_r' => true,
        'debug_zval_dump' => true,
        'var_export' => true,
    ];

    public function enterNode(Node $node)
    {
        if($node instanceof Node\Stmt\Echo_) {
            $this->report($node, 'side effect: generates output. don\'t use "echo".');
        }
        if($node instanceof Node\Expr\FuncCall) {
            if (isset(static::$sideEffectFunctions[strtolower($node->name->toString())])) {
                $this->report(
                    $node,
                    'side effect: generates output. don\'t use "{{name}}".',
                    [
                        'name' => static::$sideEffectFunctions[strtolower($node->name->toString())],
                    ]
                    );
            }
        }
    }
}