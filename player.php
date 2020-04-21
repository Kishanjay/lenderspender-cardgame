<?php

require_once('deck.php');

class Player
{
    private $name;
    private $deck;
    private $points;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->points = 0;
    }

    public function setDeck(Deck $deck)
    {
        $this->deck = $deck;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDeck(): Deck
    {
        return $this->deck;
    }
    public function playCard(string $suit = null)
    {
        if ($suit && $this->deck->hasSuit($suit)) {
            return $this->deck->removeLowestCard($suit);
        }
        return $this->deck->removeCard();
    }
    public function addPoints(int $points)
    {
        $this->points += $points;
    }
    public function getPoints()
    {
        return $this->points;
    }
}
