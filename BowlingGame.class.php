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
        foreach ($this->players as $key => $name) {
            $this->players[$key] = new Player($name);
        }
        $this->scoreBoard = new ScoreBoard($this->players);
        var_dump($this->players);
        $this->round = 1;
        $this->playAllRounds();
    }

    private function addPlayer($playerName)
    {
        array_push($this->players, $playerName);
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
            for ($i = 0;$i < count($this->players);$i++) {
            $throw1 = readline("Round " . $this->round . ": " . $this->players[$i]->getName() . " it's your turn, how many pins did you hit with your first throw?");
            if ($throw1 < 10) {
                $throw2 = readline($this->players[$i]->getName() . " it's still your turn, how many pins did you hit with your second throw?");
                $this->scoreBoard->calculatePlayerScore($this->players[$i]->getName(), $this->round, $throw1, $throw2);
            } else {
                $this->scoreBoard->calculatePlayerScore($this->players[$i]->getName(), $this->round, $throw1);
            }
        }
    }

    private function playLastRound()
    {
        // TODO
    }

    private function playAllRounds()
    {
        while ($this->round <= 10) {
            $this->playRound();
            $this->round++;
        }
//        var_dump($this->players);
        $this->scoreBoard->displayScores();
    }
}