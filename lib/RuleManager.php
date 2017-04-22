<?php

namespace PhpLint;


class RuleManager
{
    public const LEVEL_ERROR = 'error';
    public const LEVEL_WARNING = 'warning';
    public const LEVEL_OFF = 'off';


    private $ruleList = [];
    public function addRule(Rule $rule, string $level = RuleManager::LEVEL_ERROR)
    {
        $this->ruleList[] = $rule;
    }
    /**
     * @return Rule[]
     */
    public function getRuleList(): array
    {
        return $this->ruleList;
    }
}