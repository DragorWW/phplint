<?php
namespace PhpLint;

use PhpParser\NodeVisitorAbstract;

class Rule extends NodeVisitorAbstract
{
    private $config = [];
    protected $reporter;

    function __construct(string $level = 'error', array $config = [])
    {
        $this->config = $config;
        $this->reporter = Reporter::getInstance();
    }
    public function getConfigRule()
    {
        return [];
    }
    public function setConfig($conig)
    {

    }
}