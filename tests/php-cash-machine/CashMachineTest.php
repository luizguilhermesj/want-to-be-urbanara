<?php
include 'CashMachine.php';
include 'NoteUnavailableException.php';

class CashMachineTest extends PHPUnit_Framework_TestCase
{
    public function testShouldReturnEmptyWhenNull()
    {
        $cashMachine = new CashMachine();
        $expected = [];
        $actual = $cashMachine->withdraw(null);

        $this->assertEquals($expected, $actual);
    }

    public function testShouldWithdrawOneNoteOfTen()
    {
        $cashMachine = new CashMachine();
        $expected = [10];
        $actual = $cashMachine->withdraw(10);

        $this->assertEquals($expected, $actual);
    }

    public function testShouldWithdrawOneNoteOfTwenty()
    {
        $cashMachine = new CashMachine();
        $expected = [20];
        $actual = $cashMachine->withdraw(20);

        $this->assertEquals($expected, $actual);
    }

    public function testShouldWithdrawOneNoteOfTwentyAndOneOfTen()
    {
        $cashMachine = new CashMachine();
        $expected = [20,10];
        $actual = $cashMachine->withdraw(30);

        $this->assertEquals($expected, $actual);
    }

    public function testShouldWithdrawTwoNotesOfTwenty()
    {
        $cashMachine = new CashMachine();
        $expected = [20, 20];
        $actual = $cashMachine->withdraw(40);

        $this->assertEquals($expected, $actual);
    }

    public function testShouldWithdrawOneNoteOfFifty()
    {
        $cashMachine = new CashMachine();
        $expected = [50];
        $actual = $cashMachine->withdraw(50);

        $this->assertEquals($expected, $actual);
    }

    public function testShouldWithdrawOneNoteOfFiftyAndOneOfTen()
    {
        $cashMachine = new CashMachine();
        $expected = [50, 10];
        $actual = $cashMachine->withdraw(60);

        $this->assertEquals($expected, $actual);
    }

    public function testShouldWithdrawOneNoteOfFiftyAndOneOfTwenty()
    {
        $cashMachine = new CashMachine();
        $expected = [50, 20];
        $actual = $cashMachine->withdraw(70);

        $this->assertEquals($expected, $actual);
    }

    public function testShouldWithdrawOneNoteOfFiftyOneOfTwentyAndOneOfTen()
    {
        $cashMachine = new CashMachine();
        $expected = [50, 20, 10];
        $actual = $cashMachine->withdraw(80);

        $this->assertEquals($expected, $actual);
    }

    public function testShouldWithdrawTwoNotesOfOneHundredOneOfFiftyOneOfTwentyAndOneOfTen()
    {
        $cashMachine = new CashMachine();
        $expected = [100, 100, 50, 20, 10];
        $actual = $cashMachine->withdraw(280);

        $this->assertEquals($expected, $actual);
    }

    /**
     * @expectedException     InvalidArgumentException
     * @dataProvider invalidArgumentsProvider
     */
    public function testShouldThrowExceptionOnInvalidWithdraw($value)
    {
        $cashMachine = new CashMachine();
        $cashMachine->withdraw($value);
    }

    public function invalidArgumentsProvider()
    {
        return [
            [-1],
            [-10],
            [-15],
            [-20],
            [-30],
            [-50],
            [-75],
            [-999],
            [-100000],
        ];
    }

    /**
     * @expectedException     NoteUnavailableException
     * @dataProvider unavailableNotesProvider
     */
    public function testShouldThrowExceptionOnWithdrawOfUnavailableNote($value)
    {
        $cashMachine = new CashMachine();
        $cashMachine->withdraw($value);
    }

    public function unavailableNotesProvider()
    {
        return [
            [1],
            [2],
            [3],
            [4],
            [5],
            [6],
            [7],
            [8],
            [9],
            [15],
            [25],
            [42],
            [99],
            [127],
            [1508],
        ];
    }
}
