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

    protected function _generateOddNumbers($max = 1000000, $skip_numbers = array())
    {
        $odd_numbers = array();
        for ($i = 0; $i <= $max ; $i++) {
            if (in_array($i, $skip_numbers)) {
                continue;
            }
            if((int)$i % 2 != 0) {
                $odd_numbers[] = $i;
            }
        }
        return $odd_numbers;
    }


    /**
     * Test for solution 3
     * @return void
     */
    public function testSolution3()
    {
        // valid inputs
        $result = $this->solution->findLoners(array(9,3,9,3,9,7,9));
        $this->assertEquals(7, $result);

        // test with some zeros
        $result = $this->solution->findLoners(array(9,3,9,3,9,7,9,0,0,9));
        $this->assertEquals(7, $result);

        // test multiple single numbers w/o pair
        $result = $this->solution->findLoners(array(9,3,9,3,9,7,9,1,9));
        $this->assertEquals(array(7,1), $result);

        /**
         * promgrammatically create set of arrays with duplicate with one
         * un-paired element, in this test it is number 3
         */
        $setA    = $this->_generateOddNumbers(10000, array(3)); // 10000 numbers w/o 3
        $setB    = $this->_generateOddNumbers(10000); // 10000 numbers w/ 3
        $numbers = array_merge($setA, $setB);
        $result = $this->solution->findLoners($numbers);
        $this->assertEquals(3, $result);

        /**
         * promgrammatically create set of arrays with duplicate with one
         * un-paired element, in this test it is number 100, a little slow
         * beause of looping and large arrays
         */
        $setA    = $this->_generateOddNumbers(100000000, array(100)); // 10000 numbers w/o 100
        $setB    = $this->_generateOddNumbers(100000000, array(100)); // 10000 numbers w/o 100
        $setC    = $this->_generateOddNumbers(100000000); // 10000 numbers w/ 3
        $numbers = array_merge($setA, $setB, $setC);
        $result = $this->solution->findLoners($numbers);
        $this->assertEquals(100, $result);

        // test not odd mixed in array
        $this->expectException(\InvalidArgumentException::class);
        $result = $this->solution->findLoners(array(9,10));

        // test not integer mixed in array
        $this->expectException(\InvalidArgumentException::class);
        $result = $this->solution->findLoners(array(2,3,'oops',5));
    }

}
