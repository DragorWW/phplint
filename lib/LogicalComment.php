<?php
namespace PhpLint;

use PhpParser\Comment;
use PhpParser\Node;
use PhpParser\NodeFinder;
use PhpParser\NodeVisitorAbstract;

class LogicalComment extends NodeVisitorAbstract
{
    const DISABLE_LINE = 'phplint-disable-line';
    const DISABLE_NEXT_LINE = 'phplint-disable-next-line';
    const DISABLE = 'phplint-disable';
    const ENABLE = 'phplint-enable';
    const PHPLINT = 'phplint';

    public function beforeTraverse(array $nodes)
    {
        $finder = new NodeFinder;
        /**
         * @var Comment[] $commentList
         */
        $commentList = $finder->findInstanceOf($nodes, Comment::class);
        /**
         * @var Comment\Doc[] $commentDocList
         */
        $commentDocList = $finder->findInstanceOf($nodes, Comment\Doc::class);



        foreach ($commentList as $comment) {
            preg_match('/^(phplint(-\w+){0,3}?)(\s|$)/', $comment->getReformattedText(), $matches);
            switch ($matches[0]) {
                case self::DISABLE_LINE:
                    $this->disableReporting($comment->getLine());
                    $this->enableReporting($comment->getLine() + 1);
                    break;
                case self::DISABLE_NEXT_LINE:
                    $this->disableReporting($comment->getLine());
                    $this->enableReporting($comment->getLine() + 2);
                    break;
            }
        }
        foreach ($commentDocList as $comment) {
            preg_match('/^(phplint(-\w+){0,3}?)(\s|$)/', $comment->getReformattedText(), $matches);
            $value = substr($comment->getReformattedText(),count($matches[0]) + count($matches[1]));
            switch ($matches[0]) {
                case self::DISABLE:
                    $this->disableReporting($comment->getLine(), self::parseListConfig($value));
                    break;
                case self::ENABLE:
                    $this->enableReporting($comment->getLine(), self::parseListConfig($value));
                    break;
                case self::PHPLINT:
                    break;
            }
        }
    }

    public function disableReporting($start, $rulesToDisable = [])
    {

    }
    public function enableReporting($start, $rulesToEnable = [])
    {

    }

    /**
     * Parses a config of values separated by comma.
     *
     * @param $value string The string to parse.
     *
     * @return array Result map of values and true values
     */
    public static function parseListConfig($value)
    {
        $items = [];
        $value = preg_replace('/\s*,\s*/', ':', $value);
        $arr = explode(':', $value);
        foreach ($arr as $name) {
            $name = trim($name);
            if ($name) {
                $items[] = $name;
            }
        }
        return $items;
    }
}