<?php

namespace Tests\App\Calculator\Operations;

use App\Calculator\Operations\Addition;
use PHPUnit\Framework\TestCase;

class AdditionTest extends TestCase 
{
    private $sut;
    
    public function setUp()
    {
        $this->sut = new Addition();
    }

    /**
     * @dataProvider addingDp
     */
    public function testCalculate($a, $b, $result)
    {
        $this->assertSame($result, $this->sut->calculate([$a, $b]));
    }

    public function addingDp()
    {
        return [
            [1, 1, 2],
            [-1, -1, -2],
            [2, 0, 2],
            [1.5, 0.5, 2.0],
        ];
    }
}
