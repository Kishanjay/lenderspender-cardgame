<?php

declare(strict_types=1);

require_once('deck.php');
require_once('player.php');

class round {

}

class LenderSpenderGame
{
  public const POINTS_TO_LOSE = 50;

  private $players;
  private $deck;

  public function __construct($playerNames)
  {
    $this->initDeck();
    $this->initPlayers($playerNames);
  }

  private function dealCardsToPlayers()
  {
    $cardsPerPlayer = $this->deck->size() / count($this->players);
    foreach ($this->players as $player) {
      $playerDeck = $this->deck->draw($cardsPerPlayer);
      $player->setDeck($playerDeck);

      echo $player->getName() . " has been dealt: " . $player->getDeck()->toString() . "\r\n";
    }
  }

  private function initPlayers($playerNames)
  {
    $this->players = [];

    foreach ($playerNames as $playerName) {
      array_push($this->players, new Player($playerName));
    }
  }

  private function initDeck()
  {
    $deck = new Deck(false);

    foreach (Card::SUITS as $suit) {
      for ($cardNumber = 7; $cardNumber < Deck::CARDS_PER_SUIT + Card::START_NUMBER; $cardNumber += 1) {
        $card = new Card($cardNumber, $suit);
        $deck->addCard($card);
      }
    }

    $this->deck = $deck;
  }

  private function getCardPoints($card) {
    if ($card->getSuit() == '♠' && $card->getNumber() == 12){
      return 5;
    }
    if ($card->getSuit() == '♣' && $card->getNumber() == 11){
      return 2;
    }
    if ($card->getSuit() == '♥'){
      return 1;
    }
    return 0;
  }

  private function getRoundPoints(Array $playedCards) {
    $totalPoints = 0;
    foreach($playedCards as $playedCard) {
      $totalPoints += $this->getCardPoints($playedCard['card']);
    }
    return $totalPoints;
  }

  // returns true is card1 > card2
  private function isWinningOver(string $roundSuit, Card $card1, Card $card2): bool {
    if ($card1->getSuit() != $roundSuit){
      return false;
    }
    if ($card2->getSuit() != $roundSuit){
      return true;
    }
    return $card1->getNumber() > $card2->getNumber();
  }

  private function getRoundWinner(string $roundSuit, Array $playedCards): Array {
    $winningCard = null;
    $winningPlayer = null;

    foreach ($playedCards as $playedCard){
      if (!$winningCard) {
        $winningCard = $playedCard['card'];
        $winningPlayer = $playedCard['player'];
      }

      if ($this->isWinningOver($roundSuit, $playedCard['card'], $winningCard)){
        $winningCard = $playedCard['card'];
        $winningPlayer = $playedCard['player'];
      }
    }

    return [$winningPlayer, $winningCard];
  }

  private function playRound(int $roundCounter, Player $startPlayer): Player
  {
    echo "\r\nRound " . $roundCounter . ": " . $startPlayer->getName() . " starts the game\r\n";

    $playedCards = [];
    $startCard = $startPlayer->playCard();
    echo $startPlayer->getName() . " plays: " . $startCard->toString() . "\r\n";
    array_push($playedCards, ['player' => $startPlayer, 'card' => $startCard]);

    foreach ($this->players as $player) {
      if ($player === $startPlayer) {
        continue;
      }

      $card = $player->playCard($startCard->getSuit());
      echo $player->getName() . " plays: " . $card->toString() . "\r\n";
      array_push($playedCards, ['player' => $player, 'card' => $card]);
    }

    [$player, $card] = $this->getRoundWinner($startCard->getSuit(), $playedCards);
    $roundPoints = $this->getRoundPoints($playedCards);
    $player->addPoints($roundPoints);

    echo "\r\n" . $player->getName() . " played " . $card->toString() . ", the highest matching card of this match and got " . $roundPoints . " added to his total score. ";
    echo "\r\n" . $player->getName() . " total score is " . $player->getPoints() . " points.\r\n\r\n";
    return $player;
  }

  public function start()
  {
    $names = array_map("playerNameMap", $this->players);
    echo "Starting a game with " . implode(', ', $names) . "\r\n";

    $this->dealCardsToPlayers();

    $roundCounter = 1;
    $currentStartPlayer = $this->players[rand(0, count($this->players) - 1)];
    while (true) {
      if ($currentStartPlayer->getDeck()->size() === 0){ 
        echo "\r\nPlayers ran out of cards. Reshuffle.\r\n";
        $this->initDeck();
        $this->dealCardsToPlayers();
      }

      $currentStartPlayer = $this->playRound($roundCounter, $currentStartPlayer);

      $roundCounter += 1;

      foreach($this->players as $player) {
        if ($player->getPoints() > LenderSpenderGame::POINTS_TO_LOSE){
          echo "\r\n" . $player->getName() . " lost the game!\r\n";
          break 2;
        }
      }
    }

    echo "Points: \r\n";
    foreach($this->players as $player) {
      echo $player->getName() . ": " . $player->getPoints() . "\r\n";
    }
  }
}

function playerNameMap($player)
{
  return $player->getName();
}
