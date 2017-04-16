<?php

namespace PhpLint;


class ConfigLoader
{
    public $NAME = '.phpLint';
    /**
     * @var Rule[]
     */
    private $ruleList = [];
    public function addRule(string $name, string $level = 'error', array $config = [])
    {
        $this->ruleList[] = new $name($level, $config);
    }
    /**
     * @return Rule[]
     */
    public function getRuleList(): array
    {
        return $this->ruleList;
    }
}