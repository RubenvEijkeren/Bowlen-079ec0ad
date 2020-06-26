<?php
require_once 'BowlingGame.class.php';
require_once 'Player.class.php';
require_once 'bowlen.php';

class ScoreBoard {
    private $scores = array();

    public function __construct($players)
    {
/*        for ($i = 0;$i < count($players);$i++) {
            echo $players[$i]->getName() . PHP_EOL;
        }*/
    }

    public function calculatePlayerScore($player, $round, $throw1, $throw2 = 0)
    {
        $this->scores[$player][$round][0] = intval($throw1);
        $this->scores[$player][$round][1] = intval($throw2);
        $this->scores[$player][$round][2] = intval($throw1) + intval($throw2) + $this->scores[$player][$round-1][2];
        $this->displayScores();
    }

    public function calculateAllScores()
    {
        // TODO
    }

    public function displayScores()
    {
        var_dump($this->scores);
    }

    public function displayWinner()
    {
        // TODO
    }
}