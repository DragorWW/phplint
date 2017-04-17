<?php
namespace PhpLint\Rules;


use PhpLint\Rule;
use PhpParser\Node;
use PhpParser\NodeFinder;

class OneClass extends Rule
{
    public function beforeTraverse(array $nodes)
    {
        $finder = new NodeFinder;
        $classList = $finder->findInstanceOf($nodes,Node\Stmt\Class_::class);
        if($classList && count($classList) > 1) {
            foreach ($classList as $class) {
                $this->reporter->report($class, 'One class per file', get_class($this));
            }

        }
    }
}