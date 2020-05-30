<?php
namespace Tests;

use Tests\TestCase;
use Jslmariano\Aiodin\Models\Solutions;

class AiodinFunctionTest extends TestCase
{
    public $solution = null;

    /**
     * Set up objects per test
     * Please do not remove void type hint as it will fail
     * https://github.com/realodix/urlhub/pull/233
     */
    protected  function setUp(): void
    {
        parent::setUp();
        $this->solution = new Solutions();
    }

    /**
     * Test for solution 1
     * @return void
     */
    public function testSolution1()
    {
        // valid inputs
        $binary_gap = $this->solution->countBinaryGap(9);
        $this->assertEquals(2, $binary_gap);
        $binary_gap = $this->solution->countBinaryGap(529);
        $this->assertEquals(4, $binary_gap);
        $binary_gap = $this->solution->countBinaryGap(20);
        $this->assertEquals(1, $binary_gap);
        $binary_gap = $this->solution->countBinaryGap(15);
        $this->assertEquals(0, $binary_gap);
        $binary_gap = $this->solution->countBinaryGap(1041);
        $this->assertEquals(5, $binary_gap);
        $binary_gap = $this->solution->countBinaryGap(52);
        $this->assertEquals(1, $binary_gap);
        // String inputs
        $binary_gap = $this->solution->countBinaryGap('15');
        $this->assertEquals(0, $binary_gap);
        $binary_gap = $this->solution->countBinaryGap('529');
        $this->assertEquals(4, $binary_gap);
        // Invalid inputs
        $binary_gap = $this->solution->countBinaryGap('15xxxx');
        $this->assertEquals(0, $binary_gap);
        $binary_gap = $this->solution->countBinaryGap('xxx');
        $this->assertEquals(0, $binary_gap);
    }


    /**
     * Test for solution 2
     * @return void
     */
    public function testSolution2()
    {
        // valid inputs
        $result = $this->solution->findMissingLink(array());
        $this->assertEquals(array(), $result);
        $result = $this->solution->findMissingLink(array(2,3,1,5));
        $this->assertEquals(4, $result);
        $result = $this->solution->findMissingLink(array(2,3));
        $this->assertEquals(1, $result);

        // Many numbers and random pick single number to remove
        // This is kind slow because of large array
        $many = range(1, 100000);
        shuffle($many);
        $missing_number = array_pop($many);
        print_r("\nRandomly missing number : $missing_number");
        $result = $this->solution->findMissingLink($many);
        $this->assertEquals($missing_number, $result);

        // supports multiple missing
        $result = $this->solution->findMissingLink(array(3));
        $this->assertEquals(array(1,2), $result);

        // test not integer mixed in array
        $this->expectException(\InvalidArgumentException::class);
        $result = $this->solution->findMissingLink(array(2,3,'oops',5));
    }

}
