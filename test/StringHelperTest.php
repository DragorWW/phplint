<?php

use PHPUnit\Framework\TestCase;
use PhpLint\StringHelper;

final class StringHelperTest extends TestCase
{
    public function testIsCamelCaps()
    {
        $this->assertEquals(
            StringHelper::isCamelCaps('setToken', false, true, true),
            true
        );
        $this->assertEquals(
            StringHelper::isCamelCaps('_setToken', false, false, true),
            true
        );
    }
}