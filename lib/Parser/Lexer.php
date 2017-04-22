<?php
namespace PhpLint\Parser;

use PhpParser\Lexer as PhpParserLexer;

class Lexer extends PhpParserLexer {
    public function __construct(array $options = array()) {
        $this->getNextToken();
        parent::__construct($options);
        $this->dropTokens = array_fill_keys(
            array(T_WHITESPACE, T_OPEN_TAG, T_COMMENT, T_DOC_COMMENT), 0
        );
    }
}