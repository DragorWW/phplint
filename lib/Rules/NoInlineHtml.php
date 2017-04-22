<?php

namespace PhpLint\Rules;

use PhpLint\Rule;
use PhpParser\Node;
use PhpParser\NodeFinder;

class NoInlineHtml extends Rule
{
    public function beforeTraverse(array $nodes)
    {
        $finder = new NodeFinder;

        /**
         * @var Node\Stmt\InlineHTML[] $classMethodList
         */
        $classMethodList = $finder->findInstanceOf($nodes, Node\Stmt\InlineHTML::class);
        if ($classMethodList) {
            foreach ($classMethodList as $node) {
                $this->report(
                    $node,
                    'No use inline HTML in php file'
                );
            }
        }
    }
}