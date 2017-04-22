<?php

namespace PhpLint\Rules;

use PhpLint\Rule;
use PhpLint\StringHelper;
use PhpParser\Node;
use PhpParser\NodeFinder;

class ClassMethodCamelCase extends Rule
{
    public function beforeTraverse(array $nodes)
    {
        $finder = new NodeFinder;

        /**
         * @var Node\Stmt\ClassMethod[] $classMethodList
         */
        $classMethodList = $finder->findInstanceOf($nodes, Node\Stmt\ClassMethod::class);
        if ($classMethodList) {
            foreach ($classMethodList as $node) {
                // TODO add config isPrivate _privateMethod
                if (!StringHelper::isMagicMethod($node->name) && !StringHelper::isCamelCaps($node->name, false, true, false)) {
                    $this->report(
                        $node,
                        'Method name "{name}" is not in camel caps format',
                        [
                            'name' => $node->name,
                        ]
                    );
                }

            }
        }
    }
}