<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 21.08.16
 * Time: 12:28.
 */
namespace StasPiv\EloCalculator\Tests;

use PHPUnit\Framework\TestCase;
use StasPiv\EloCalculator\EloCalculator;
use StasPiv\EloCalculator\Model\EloGame;

/**
 * Class EloCalculatorTest.
 */
class EloCalculatorTest extends TestCase
{
    /**
     * @var EloCalculator
     */
    private $calculator;

    protected function setUp()
    {
        parent::setUp();
        $this->calculator = new EloCalculator();
    }

    /**
     * test calculate.
     */
    public function testCalculatorForLessThan5Games()
    {
        $game = (new EloGame())->setWhiteElo(1300)->setBlackElo(1800)
                               ->setWhiteGames(200)->setBlackGames(3)
                               ->setWhiteResult(1)
                               ->setBlackResult(0);

        $this->calculator->calculate($game);

        self::assertEquals(1771, $game->getBlackElo());
    }

    /**
     * test expected value.
     */
    public function testCalculateExpectedValue()
    {
        $methodName = 'calculateMyExpectedValue';
        self::assertEquals(0.5, $this->invokePrivateMethod($methodName, [2200, 2200]));
        self::assertEquals(0.64, $this->invokePrivateMethod($methodName, [2300, 2200]));
        self::assertEquals(0.97, $this->invokePrivateMethod($methodName, [2800, 2200]));
        self::assertEquals(1, $this->invokePrivateMethod($methodName, [2800, 1300]));
    }

    /**
     * test my new elo.
     */
    public function testCalculateMyNewElo()
    {
        $methodName = 'calculateMyNewElo';
        self::assertEquals(2200, $this->invokePrivateMethod($methodName, [2200, 0.5, 0.5, 30]));
        self::assertEquals(2215, $this->invokePrivateMethod($methodName, [2200, 1, 0.5, 30]));
        self::assertEquals(2210, $this->invokePrivateMethod($methodName, [2200, 1, 0.5, 20]));
    }

    /**
     * test get games count.
     */
    public function testGetCoefficientByGamesCount()
    {
        $methodName = 'getCoefficientByGamesCount';

        self::assertEquals(30, $this->invokePrivateMethod($methodName, [5]));
        self::assertEquals(30, $this->invokePrivateMethod($methodName, [2]));
        self::assertEquals(25, $this->invokePrivateMethod($methodName, [10]));
        self::assertEquals(20, $this->invokePrivateMethod($methodName, [20]));
    }

    /**
     * @param string $name
     * @param array  $args
     *
     * @return mixed
     */
    private function invokePrivateMethod(string $name, array $args = [])
    {
        $method = new \ReflectionMethod(EloCalculator::class, $name);

        $method->setAccessible(true);

        $result = $method->invokeArgs($this->calculator, $args);

        return $result;
    }
}
