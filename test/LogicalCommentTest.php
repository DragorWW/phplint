<?php

use PhpLint\LogicalComment;
use PHPUnit\Framework\TestCase;

class LogicalCommentTest extends TestCase
{
    public function testParseListConfig()
    {

        $this->assertEquals(LogicalComment::parseListConfig(' a,c, b,  d'), ['a', 'c', 'b', 'd']);
    }
}