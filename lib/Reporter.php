<?php
namespace PhpLint;

use PhpParser\Node;
use StringTemplate;

class Reporter {
    private $reportList = [];
    private $_filePath = '';
    private static $_instance = null;
    private $engine;

    private function __construct() {
        $this->engine = new StringTemplate\Engine;

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
    public function report(Node $node, string $message, array $data = [], $name)
    {
        $this->reportList[] = [
            'node' => $node,
            'message' => $this->engine->render($message, $data),
            'rule' => $name,
            'file' => $this->_filePath,
        ];
    }
    public function getReport()
    {
        return $this->reportList;
    }
}