<?php
namespace PhpLint;

use PhpParser\ParserFactory;
use PhpParser\NodeVisitor\NameResolver;
use PhpParser\NodeTraverser;
use PhpLint\Parser\Lexer;


class PhpLint
{
    private $parser;
    private $traverser;
    private $lexer;
    /**
     * @var Rule[]
     */
    private $rules;
    public function __construct()
    {
        $this->lexer = new Lexer(array(
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
        $this->rules[] = $rule;
        $this->traverser->addVisitor($rule);
    }

    public function validate($file) {
        Reporter::getInstance()->setFilePath($file->getRealPath());
        $stmts = $this->parser->parse($file->getContents());
        foreach ($this->rules as $rule) {
            $rule->setTokens($this->lexer->getTokens());
        }

        $this->traverser->traverse($stmts);
    }

    public function getAst($code)
    {
        return $this->parser->parse($code);
    }
    public function getTokens($code)
    {
        $this->parser->parse($code);
        return $this->lexer->getTokens();
    }
}