<?php

declare(strict_types=1);

require_once('card.php');

class Deck
{
  public const CARDS_PER_SUIT = 13;

  private $cards;

  public function __construct($autoInitialize = true)
  {
    if (!$autoInitialize) {
      $this->cards = [];
      return;
    }

    $this->init();
  }

  function init()
  {
    foreach (Card::SUITS as $suit) {
      for ($i = 0; $i < Deck::CARDS_PER_SUIT; $i += 1) {
        $cardNumber = $i + Card::START_NUMBER;
        $card = new Card($cardNumber, $suit);
        $this->addCard($card);
      }
    }
  }

  function addCard(Card $card)
  {
    array_push($this->cards, $card);
  }
  function removeCard(): Card {
    $randomCardIndex = rand(0, count($this->cards) - 1);
    $removedCards = array_splice($this->cards, $randomCardIndex, 1);
    return $removedCards[0];
  }
  function removeLowestCard(string $suit): Card {
    $lowestCardIndex = -1;
    $lowestCardValue = -1;
    for ($i = 0; $i < count($this->cards); $i += 1){
      $card = $this->cards[$i];
      if ($suit != $card->getSuit()){
        continue;
      }

      if ($lowestCardValue == -1 || $lowestCardValue > $card->getNumber()){
        $lowestCardValue = $card->getNumber();
      }
    }
    $removedCards = array_splice($this->cards, $lowestCardIndex, 1);
    return $removedCards[0];
  }
  function draw(int $number = 1): Deck
  {
    $deck = new Deck(false);
    for ($i = 0; $i < $number; $i += 1) {
      $card = $this->removeCard();
      $deck->addCard($card);
    }

    return $deck;
  }
  public function size(): int {
    return count($this->cards);
  }

  public function hasSuit(string $suit) {
    foreach($this->cards as $card) {
      if ($card->getSuit() == $suit){
        return true;
      }
    }
    return false;
  }

  public function toString(): string {
    $cardStrings = array_map("cardStringMap", $this->cards);
    return implode(" ", $cardStrings);
  }
}

function cardStringMap(Card $card) {
  return $card->toString();
}