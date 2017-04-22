<?php
namespace PhpLint;

use PhpParser\Node;
use PhpParser\NodeVisitorAbstract;

class Rule extends NodeVisitorAbstract
{
    private $config = [];
    protected $reporter;

    private $tokens;

    function __construct(string $level = 'error', array $config = [])
    {
        $this->config = $config;
        $this->reporter = Reporter::getInstance();
    }


    public function setTokens(array $tokens) {
        $this->tokens = $tokens;
    }
    protected function report(Node $node, string $message, array $data = [])
    {
        $this->reporter->report($node, $message, $data, get_class($this));
    }
    public function getConfigRule()
    {
        return [];
    }
    public function setConfig($conig)
    {
        // TODO set rule config
    }

    protected function getFilename(): string {
        return ''; // TODO return file name
    }
}