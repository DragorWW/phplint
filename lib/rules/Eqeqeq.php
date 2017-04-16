<?php
namespace PhpLint\Rules;

use PhpLint\Rule;
use PhpParser\Node;

class Eqeqeq extends Rule
{
    public function enterNode(Node $node)
    {
        if (is_a($node, 'PhpParser\Node\Expr\BinaryOp\Equal', true)) {
            $this->reporter->report($node, 'Expected "===" and instead saw  "==".', 'eqeqeq');
        }
    }
}