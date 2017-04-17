<?php
namespace PhpLint\Rules;

use PhpLint\Rule;
use PhpParser\Node;

class NoIniSet extends Rule
{
    public function enterNode(Node $node)
    {
        if($node instanceof Node\Expr\FuncCall) {
            $this->reporter->report($node, 'side effect: change ini settings', 'NoIniSet');
        }
    }
}