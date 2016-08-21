<?php
/**
 * Created by PhpStorm.
 * User: stas
 * Date: 21.08.16
 * Time: 12:24.
 */
namespace StasPiv\EloCalculator\Model;

/**
 * Class EloGame.
 */
class EloGame
{
    /**
     * @var int
     */
    private $whiteElo;

    /**
     * @var int
     */
    private $blackElo;

    /**
     * @var int
     */
    private $whiteGames;

    /**
     * @var int
     */
    private $blackGames;

    /**
     * @var float
     */
    private $whiteResult;

    /**
     * @var float
     */
    private $blackResult;

    /**
     * @return int
     */
    public function getWhiteElo(): int
    {
        return $this->whiteElo;
    }

    /**
     * @param int $whiteElo
     *
     * @return EloGame
     */
    public function setWhiteElo(int $whiteElo): self
    {
        $this->whiteElo = $whiteElo;

        return $this;
    }

    /**
     * @return int
     */
    public function getBlackElo(): int
    {
        return $this->blackElo;
    }

    /**
     * @param int $blackElo
     *
     * @return EloGame
     */
    public function setBlackElo(int $blackElo): self
    {
        $this->blackElo = $blackElo;

        return $this;
    }

    /**
     * @return int
     */
    public function getWhiteGames(): int
    {
        return $this->whiteGames;
    }

    /**
     * @param int $whiteGames
     *
     * @return EloGame
     */
    public function setWhiteGames(int $whiteGames): self
    {
        $this->whiteGames = $whiteGames;

        return $this;
    }

    /**
     * @return int
     */
    public function getBlackGames(): int
    {
        return $this->blackGames;
    }

    /**
     * @param int $blackGames
     *
     * @return EloGame
     */
    public function setBlackGames(int $blackGames): self
    {
        $this->blackGames = $blackGames;

        return $this;
    }

    /**
     * @return float
     */
    public function getWhiteResult(): float
    {
        return $this->whiteResult;
    }

    /**
     * @param float $whiteResult
     *
     * @return EloGame
     */
    public function setWhiteResult(float $whiteResult): self
    {
        $this->whiteResult = $whiteResult;

        return $this;
    }

    /**
     * @return float
     */
    public function getBlackResult(): float
    {
        return $this->blackResult;
    }

    /**
     * @param float $blackResult
     *
     * @return EloGame
     */
    public function setBlackResult(float $blackResult): self
    {
        $this->blackResult = $blackResult;

        return $this;
    }
}
