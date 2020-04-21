<?php

declare(strict_types=1);

class Card
{
    public const START_NUMBER = 2;
    public const SUITS = ['♦', '♣', '♥', '♠'];
    public const NUMBER_MAP = [
        2 => '2', 3 => '3', 4 => '4', 5 => '5', 6 => '6', 7 => '7',
        8 => '8', 9 => '9', 10 => '10', 11 => 'J', 12 => 'Q', 13 => 'K', 14 => 'A'
    ];

    private $number;
    private $suit;


    public function __construct(int $number, string $suit)
    {
        $this->number = $number;
        $this->suit = $suit;
    }

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function toString(): string
    {
        $number = Card::NUMBER_MAP[$this->number];
        return $this->suit . "" . $number;
    }
}
