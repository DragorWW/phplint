<?php
namespace PhpLint\Rules;

use PhpLint\Rule;
use PhpParser\Node;

class NoIniSet extends Rule
{
    public function enterNode(Node $node)
    {
        if($node instanceof Node\Expr\FuncCall) {
            if ($node->name->toString() === 'ini_set') {
                $this->report($node, 'side effect: change ini settings');
            }
        }
    }
}