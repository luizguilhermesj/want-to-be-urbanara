<?php
include 'GroupByInterval.php';

class GroupByIntervalTest extends PHPUnit_Framework_TestCase
{
    public function testShouldReturnEmptyWhenNull()
    {
        $cashMachine = new GroupByInterval();
        $expected = [];
        $actual = $cashMachine->group(null, []);

        $this->assertEquals($expected, $actual);
    }

    public function testShouldReturnTwoGroupsOfOneNumber()
    {
        $cashMachine = new GroupByInterval();
        $expected = [[10],[20]];
        $actual = $cashMachine->group(10, [20, 10]);

        $this->assertEquals($expected, $actual);
    }

    public function testShouldReturnThreeGroupsOfOneNumber()
    {
        $cashMachine = new GroupByInterval();
        $expected = [[10],[20],[50]];
        $actual = $cashMachine->group(10, [20, 10, 50]);

        $this->assertEquals($expected, $actual);
    }

    public function testShouldReturnTwoGroupsOfOneNumberAndOneGroupOfTwo()
    {
        $cashMachine = new GroupByInterval();
        $expected = [[5,10],[20],[50]];
        $actual = $cashMachine->group(10, [20, 10, 50, 5]);

        $this->assertEquals($expected, $actual);
    }

    public function testShouldReturnTwoGroupsOfTwoNumbersAndOneGroupOfOne()
    {
        $cashMachine = new GroupByInterval();
        $expected = [[5,10],[11, 20],[50]];
        $actual = $cashMachine->group(10, [20, 10, 50, 5, 11]);

        $this->assertEquals($expected, $actual);
    }

    public function testShouldReturnThreeGroupsOfTwoNumbers()
    {
        $cashMachine = new GroupByInterval();
        $expected = [[5,10],[11, 20],[45, 50]];
        $actual = $cashMachine->group(10, [45, 20, 10, 50, 5, 11]);

        $this->assertEquals($expected, $actual);
    }

    public function testShouldWorkWithDifferentRanges()
    {
        $cashMachine = new GroupByInterval();
        $expected = [[5,10, 11], [20], [45], [50]];
        $actual = $cashMachine->group(15, [45, 20, 10, 50, 5, 11]);

        $this->assertEquals($expected, $actual);
    }

    public function testShouldWorkWithNegativeNumbers()
    {
        $cashMachine = new GroupByInterval();
        $expected = [[-60, -55], [5,10, 11], [20], [45], [50]];
        $actual = $cashMachine->group(15, [-60, -55, 45, 20, 10, 50, 5, 11]);

        $this->assertEquals($expected, $actual);
    }

    public function testShouldProcessBiggerList()
    {
        $cashMachine = new GroupByInterval();
        $expected = [[-20], [1, 10], [14, 19, 20], [22], [93, 99], [117, 120], [131, 136]];
        $actual = $cashMachine->group(10, [10, 1, -20,  14, 99, 136, 19, 20, 117, 22, 93,  120, 131]);

        $this->assertEquals($expected, $actual);
    }

    public function testShouldProcessBiggerListWithDifferentRange()
    {
        $cashMachine = new GroupByInterval();
        $expected = [[-20], [1, 10, 14], [19, 20, 22], [93, 99], [117, 120], [131], [136]];
        $actual = $cashMachine->group(15, [10, 1, -20,  14, 99, 136, 19, 20, 117, 22, 93,  120, 131]);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testShouldThrowExceptionOnInvalidInput()
    {
        $cashMachine = new GroupByInterval();
        $expected = [[-20], [1, 10, 14], [19, 20, 22], [93, 99], [117, 120], [131], [136]];
        $actual = $cashMachine->group(15, [10, 1, 'A',  14, 99, 133, 19, 20, 117, 22, 93,  120, 131]);

        $this->assertEquals($expected, $actual);
    }



}
