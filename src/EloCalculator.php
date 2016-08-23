<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 21.08.16
 * Time: 12:22.
 */
namespace StasPiv\EloCalculator;

use StasPiv\EloCalculator\Model\EloGame;

/**
 * Class EloCalculator.
 */
class EloCalculator
{
    /**
     * @var array
     */
    private $coefficientMap = [];

    private $defaultCoefficient;

    /**
     * EloCalculator constructor.
     *
     * @param array $coefficientMap
     * @param int   $defaultCoefficient
     */
    public function __construct(
        array $coefficientMap = [
            5 => 40,
            10 => 35,
        ],
        $defaultCoefficient = 30
    ) {
        $this->coefficientMap = $coefficientMap;
        $this->defaultCoefficient = $defaultCoefficient;
    }

    /**
     * Calculates new elo.
     *
     * @param EloGame $game
     */
    public function calculate(EloGame $game)
    {
        $game->setWhiteElo(
            $this->calculateMyNewElo(
                $game->getWhiteElo(),
                $game->getWhiteResult(),
                $this->calculateMyExpectedValue(
                    $game->getWhiteElo(),
                    $game->getBlackElo()
                ),
                $this->getCoefficientByGamesCount($game->getWhiteGames())
            )
        );

        $game->setBlackElo(
            $this->calculateMyNewElo(
                $game->getBlackElo(),
                $game->getBlackResult(),
                $this->calculateMyExpectedValue(
                    $game->getBlackElo(),
                    $game->getWhiteElo()
                ),
                $this->getCoefficientByGamesCount($game->getBlackGames())
            )
        );
    }

    /**
     * @param int $myRating
     * @param int $opponentRating
     *
     * @return float
     */
    private function calculateMyExpectedValue(int $myRating, int $opponentRating): float
    {
        return round(1 / (1 + pow(10, ($opponentRating - $myRating) / 400)), 2);
    }

    /**
     * @param int   $myRating
     * @param float $actualValue
     * @param float $expectedValue
     * @param int   $coefficient
     *
     * @return int
     */
    private function calculateMyNewElo(int $myRating, float $actualValue, float $expectedValue, int $coefficient): int
    {
        return round($myRating + $coefficient * ($actualValue - $expectedValue));
    }

    /**
     * @param int $gamesCount
     *
     * @return int
     */
    private function getCoefficientByGamesCount(int $gamesCount): int
    {
        foreach ($this->getCoefficientMap() as $coefficientCount => $coefficient) {
            if ($gamesCount <= $coefficientCount) {
                return $coefficient;
            }
        }

        return $this->getDefaultCoefficient();
    }

    /**
     * @return array
     */
    public function getCoefficientMap(): array
    {
        return $this->coefficientMap;
    }

    /**
     * @return int
     */
    public function getDefaultCoefficient(): int
    {
        return $this->defaultCoefficient;
    }
}
