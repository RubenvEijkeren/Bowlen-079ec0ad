<?php
require_once 'ScoreBoard.class.php';
require_once 'Player.class.php';

class BowlingGame
{
    private $scoreBoard;
    public $players = array();
    private $round;

    public function __construct()
    {
        echo "Welcome to greuBowling!" . PHP_EOL;
        $this->askPlayerNames();
    }

    public function start()
    {
        $this->scoreBoard = new ScoreBoard($this->players);
        var_dump($this->players);
        $this->round = 1;
        $this->playAllRounds();
    }

    private function addPlayer($playerName)
    {
        array_push($this->players, new Player($playerName));
    }

    private function askPlayerNames()
    {
        $this->addPlayer(readline('What is your name?' . PHP_EOL));
        if (readline('Add another player? Y/N' . PHP_EOL) == 'Y') {
            $this->askPlayerNames();
        } else {
            $this->start();
        }
    }

    private function playRound()
    {
        for ($i = 0; $i < count($this->players); $i++) {
            $throw1 = readline("Round " . $this->round . ": " . $this->players[$i]->name . " it's your turn, how many pins did you hit with your first throw?");
            if ($throw1 < 10) {
                $throw2 = readline($this->players[$i]->name . " it's still your turn, how many pins did you hit with your second throw?");
                $this->scoreBoard->calculatePlayerScore($this->players[$i]->name, $this->round, $throw1, $throw2);
            } else {
                $this->scoreBoard->calculatePlayerScore($this->players[$i]->name, $this->round, $throw1);
            }
        }
    }

    private function playLastRound($player, $throws)
    {
        if ($throws == 2) {
            echo "Final round! you threw a strike on round 10 so you get to throw two more balls!" . PHP_EOL ;
            $throw1 = readline($player . " how many pins did you hit with your first throw?");
            $throw2 = readline($player . " how many pins did you hit with your second throw?");
                $this->scoreBoard->scores[$player][10][2] += $throw1 + $throw2;
                if ($this->scoreBoard->scores[$player][9][0] == 10) {
                    $this->scoreBoard->scores[$player][9][2] += $throw1;
                    $this->scoreBoard->scores[$player][10][2] += $throw2;
                }
        }
        if ($throws == 1) {
            echo "Final round! you threw a spare on round 10 so you get to throw one more ball!" . PHP_EOL;
            $throw1 = readline($player . " how many pins did you hit with your throw?");
            $this->scoreBoard->scores[$player][10][2] += $throw1;
        }
    }

    private function playAllRounds()
    {
        while ($this->round <= 10) {
            $this->playRound();
            $this->round++;
        }
        for ($i = 0; $i < count($this->players); $i++) {
            if ($this->scoreBoard->scores[$this->players[$i]->name][10][0] == 10) {
                $this->playLastRound($this->players[$i]->name, 2);
            } elseif ($this->scoreBoard->scores[$this->players[$i]->name][10][0] + $this->scoreBoard->scores[$this->players[$i]->name][10][1] == 10) {
                $this->playLastRound($this->players[$i]->name, 1);
            }
        }
        $this->scoreBoard->displayScores();
        $this->scoreBoard->displayWinner();
    }
}