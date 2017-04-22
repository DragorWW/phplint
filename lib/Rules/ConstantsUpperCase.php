<?php
namespace PhpLint\Rules;


use PhpLint\Rule;
use PhpParser\Node;
use PhpParser\NodeFinder;

class ConstantsUpperCase extends Rule
{
    public function beforeTraverse(array $nodes)
    {
        $finder = new NodeFinder;
        $constList = $finder->findInstanceOf($nodes,Node\Const_::class);
        if($constList) {
            foreach ($constList as $node) {
                /**
                 * @var Node\Const_ $node
                 */
                if ($node->name !== strtoupper($node->name)) {
                    $this->report($node, 'constants MUST be declared in all upper case with underscore separators.');
                }

            }
        }
    }
}