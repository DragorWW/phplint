<?php
namespace PhpLint;

use PhpParser\Node;

class SourceCode {

    /**
     * @var int[]
     */
    private $tokens;
    /**
     * @var Node[]
     */
    private $nodes;

    public function __construct(array $nodes, array $tokens)
    {
        $this->nodes = $nodes;
        $this->tokens = $tokens;
    }

    /**
     * returns the source code for the given node. Omit node to get the whole source.
     *
     * @param Node $node
     */
    public function getText(Node $node) {

    }

    /**
     * returns an array of all comments in the source.
     *
     *
     */
    public function getAllComments() {

    }

    /**
     * returns the leading and trailing comments arrays for the given node.
     *
     * @param Node $node
     */
    public function getComments(Node $node) {

    }

    /**
     * returns the JSDoc comment for a given node or null if there is none.
     * @param Node $node
     */
    public function getJSDocComment(Node $node) {

    }

    /**
     * returns true if there is a whitespace character between the two tokens.
     *
     * @param first
     * @param second
     */
    public function isSpaceBetweenTokens($first, $second) {

    }

    /**
     * returns the first token representing the given node.
     *
     * @param Node $node
     * @param node
     */
    public function getFirstToken(Node $node, $skipOptions) {

    }

    /**
     * returns the first count tokens representing the given node.
     *
     * @param Node $node
     * @param node
     */
    public function getFirstTokens(Node $node, $countOptions) {

    }

    /**
     * returns the last token representing the given node.
     *
     * @param Node $node
     * @param node
     */
    public function getLastToken(Node $node, $skipOptions) {

    }

    /**
     * returns the last count tokens representing the given node.
     *
     * @param node
     * @param countOptions
     */
    public function getLastTokens(Node $node, $countOptions) {

    }

    /**
     * returns the first token after the given node or token.
     *
     * @param nodeOrToken
     * @param skipOptions
     */
    public function getTokenAfter(Node $nodeOrToken, $skipOptions) {

    }

    /**
     * returns count tokens after the given node or token.
     *
     * @param nodeOrToken
     * @param countOptions
     */
    public function getTokensAfter(Node $nodeOrToken, $countOptions) {

    }

    /**
     * returns the first token before the given node or token.
     *
     * @param nodeOrToken
     * @param skipOptions
     */
    public function getTokenBefore(Node $nodeOrToken, $skipOptions) {

    }

    /**
     * returns count tokens before the given node or token.
     *
     * @param nodeOrToken
     * @param countOptions
     */
    public function getTokensBefore(Node $nodeOrToken, $countOptions) {

    }

    /**
     * returns the first token between two nodes or tokens.
     *
     * @param nodeOrToken1
     * @param nodeOrToken2
     * @param skipOptions
     */
    public function getFirstTokenBetween(Node $nodeOrToken1, Node $nodeOrToken2, $skipOptions) {

    }

    /**
     * returns the first count tokens between two nodes or tokens.
     *
     * @param nodeOrToken1
     * @param nodeOrToken2
     * @param countOptions
     */
    public function getFirstTokensBetween(Node $nodeOrToken1, Node $nodeOrToken2, $countOptions) {

    }

    /**
     * returns the last token between two nodes or tokens.
     *
     * @param Node $nodeOrToken1
     * @param Node $nodeOrToken2
     * @param nodeOrToken1
     */
    public function getLastTokenBetween(Node $nodeOrToken1, Node $nodeOrToken2, $skipOptions) {

    }

    /**
     * returns the last count tokens between two nodes or tokens.
     *
     * @param Node $nodeOrToken1
     * @param Node $nodeOrToken2
     * @param nodeOrToken1
     */
    public function getLastTokensBetween(Node $nodeOrToken1, Node $nodeOrToken2, $countOptions) {

    }

    /**
     * returns all tokens for the given node.
     *
     * @param Node $node
     * @return int[]
     */
    public function getTokens(Node $node) {
        $start = $node->getAttribute('startTokenPos');
        $end = $node->getAttribute('endTokenPos');
        return array_slice($this->tokens, $start, $start + $end);
    }

    /**
     * returns all tokens between two nodes.
     * @param Node $nodeOrToken1
     * @param Node $nodeOrToken2
     * @return int[]
     */
    public function getTokensBetween(Node $nodeOrToken1, Node $nodeOrToken2) {
        $start = $nodeOrToken1->getAttribute('startTokenPos');
        $end = $nodeOrToken2->getAttribute('endTokenPos');
        return array_slice($this->tokens, $start, $start + $end);
    }

    /**
     * Gets the token starting at the specified index.
     *
     * @param int $index - Index of the start of the token's range.
     * @param $rangeOptions - The option object.
     */
    public function getTokenByRangeStart(int $index, $rangeOptions) {

    }

    /**
     * returns the deepest node in the AST containing the given source index.
     *
     * @param index
     */
    public function getNodeByRangeIndex($index) {

    }
}