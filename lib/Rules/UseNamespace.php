<?php
namespace PhpLint\Rules;


use PhpLint\Rule;
use PhpParser\Node;
use PhpParser\NodeFinder;

class UseNamespace extends Rule
{
    public function beforeTraverse(array $nodes)
    {
        $finder = new NodeFinder;
        $isNamespace = $finder->findFirstInstanceOf($nodes,Node\Stmt\Namespace_::class);
        if(!$isNamespace) {
            $this->report($nodes[0], 'Shuld use namespace');
        }
    }
}