<?php

use PHPUnit\Framework\TestCase;


final class TestTest extends TestCase
{
    public function testCanBeUsedAsString()
    {
        $this->assertEquals(
            'user@example.com',
            'user@example.com'
        );
    }
}