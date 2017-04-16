<?php
namespace PhpLint;

use PhpParser\ParserFactory;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\NodeTraverser;
use PhpParser\Lexer;

class MyLexer extends Lexer {
    public function __construct(array $options = array()) {
        $this->getNextToken();
        parent::__construct($options);
        $this->dropTokens = array_fill_keys(
            array(T_WHITESPACE, T_OPEN_TAG, T_COMMENT, T_DOC_COMMENT), 0
        );
    }
}

class PhpLint
{
    private $parser;
    private $traverser;
    private $lexer;
    public function __construct()
    {
        $this->lexer = new MyLexer(array(
            'usedAttributes' => array(
                'comments',
                'startLine',
                'endLine',
                'startTokenPos',
                'endTokenPos',
                'startFilePos',
                'endFilePos',
            )
        ));
        $this->parser = (new ParserFactory)->create(ParserFactory::PREFER_PHP7, $this->lexer);
        $this->traverser = new NodeTraverser;

        $this->traverser->addVisitor(new NameResolver);
    }

    /**
     * @param Rule[] $rules
     */
    public function setRules(array $rules) {
        foreach ($rules as $rule) {
            $this->setRule($rule);
        }
    }
    public function setRule($rule)
    {
        $this->traverser->addVisitor($rule);
    }

    public function validate($file) {
        Reporter::getInstance()->setFilePath($file->getRealPath());
        $stmts = $this->parser->parse($file->getContents());
        $this->traverser->traverse($stmts);
    }
}