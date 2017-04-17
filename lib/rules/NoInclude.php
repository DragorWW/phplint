<?php
namespace PhpLint\Rules;

use PhpLint\Rule;
use PhpParser\Node;

class NoInclude extends Rule
{
    public function enterNode(Node $node)
    {
        if($node instanceof Node\Expr\Include_) {
            if ($node->type === Node\Expr\Include_::TYPE_INCLUDE) {
                $this->reporter->report($node, 'side effect: loads a file', get_class($this));

            }
        }
    }
}