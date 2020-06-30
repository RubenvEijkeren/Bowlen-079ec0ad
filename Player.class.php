<?php
require_once 'ScoreBoard.class.php';
require_once 'BowlingGame.class.php';

class Player {
    public $name;
    public $pinsThrown;

    public function __construct($name)
    {
        $this->name = $name;
        $this->pinsThrown = 0;
    }

    public function getName()
    {
        return $this->name;
    }

    public function throwPins($throw1, $throw2 = 0)
    {
        echo $this->name . " threw " . $throw1 . " in the first hit and " . $throw2 . " in the second hit." . PHP_EOL;
        $this->pinsThrown += $throw1 + $throw2;
    }
}