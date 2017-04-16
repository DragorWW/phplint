<?php
namespace PhpLint;

use PhpParser\Node;

class Reporter {
    private $reportList = [];
    private $_filePath = '';
    private static $_instance = null;
    private function __construct() {
    }
    protected function __clone() {
    }
    static public function getInstance() {
        if(is_null(self::$_instance))
        {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function setFilePath(string $filePath)
    {
        $this->_filePath = $filePath;
    }
    public function report(Node $node, string $message, $rule)
    {
        $this->reportList[] = [
            'node' => $node,
            'message' => $message,
            'rule' => $rule,
            'file' => $this->_filePath,
        ];
    }
    public function getReport()
    {
        return $this->reportList;
    }
}