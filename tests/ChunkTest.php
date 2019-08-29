<?php

namespace Rap2hpoutre\FastExcel\Tests;

use Box\Spout\Writer\Style\Color;
use Box\Spout\Writer\Style\StyleBuilder;
use Rap2hpoutre\FastExcel\FastExcel;
use Rap2hpoutre\FastExcel\SheetCollection;

/**
 * Class FastExcelTest.
 */
class FastExcelTest extends TestCase
{
    public function collectionGenerator($n)
    {
        for ($i = 1; $i <= $n; $i++) {
            yield collect(["a" => "b", "c" => "d"]);
        }
    }

    public function arrayGenerator($n)
    {
        for ($i = 1; $i <= $n; $i++) {
            yield ["a" => "b", "c" => "d"];
        }
    }

    public function testWithGenerator()
    {
        $n = 10;
        (new FastExcel($this->collectionGenerator($n)))->export(__DIR__.'/test-generator.xlsx');
        $result = (new FastExcel())->import(__DIR__.'/test-generator.xlsx');
        $this->assertEquals(
            collect($this->arrayGenerator($n)),
            $result
        );
        unlink(__DIR__.'/test-generator.xlsx');
    }
}