<?php

class ScoreBoard
{
    public $scores = array();

    public function __construct($players)
    {
    }

    public function calculatePlayerScore($player, $round, $throw1, $throw2 = 0)
    {
        $this->scores[$player][$round][0] = intval($throw1);
        $this->scores[$player][$round][1] = intval($throw2);
        if ($round > 1 && $this->scores[$player][$round - 1][0] == 10) {
            $this->scores[$player][$round - 1][2] += $throw1 + $throw2;
            if ($round > 2 && $this->scores[$player][$round - 2][0] == 10) {
                $this->scores[$player][$round - 2][2] += $throw1; // voegt 10 toe aan twee worpen terug
                $this->scores[$player][$round - 1][2] += $throw1; // en aan de vorige worp
            }
        } elseif ($round > 1 && ($this->scores[$player][$round - 1][0] + $this->scores[$player][$round - 1][1]) == 10) {
            $this->scores[$player][$round - 1][2] += $throw1;
        }
        $this->scores[$player][$round][2] = intval($throw1) + intval($throw2) + $this->scores[$player][$round - 1][2];
        $this->displayScores();
    }

    public function displayScores()
    {
        var_dump($this->scores);
    }

    public function displayWinner()
    {
        $highest = array();
        foreach ($this->scores as $key => $value) {
            $highest[$key] = $value[10][2];
        }
        var_dump($highest);
        arsort($highest);
        foreach ($highest as $key => $value) {
            echo "The winner is: " . $key . " with an amount of points of: " . $value . ". Congratulations!" . PHP_EOL;
            die;
        }
    }
}