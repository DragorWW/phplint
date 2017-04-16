<?php

use PHPUnit\Framework\TestCase;


final class TestTest extends TestCase
{
    public function testCanBeUsedAsString(): void
    {
        $this->assertEquals(
            'user@example.com',
            'dfsdf'
        );
    }
}