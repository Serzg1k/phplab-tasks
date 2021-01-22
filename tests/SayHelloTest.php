<?php

use PHPUnit\Framework\TestCase;

class SayHelloTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */
    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, sayHello());
    }

    public function positiveDataProvider()
    {
        return [
            [[], 'Hello'],
            [stdClass::class, 'Hello'],
        ];
    }
}