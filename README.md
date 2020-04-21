# About
Coding assignment

`php start.php`

# Opdracht
Schrijf een programma wat vier spelers tegen elkaar een vereenvoudigde versie van hartenjagen laat spelen.
- Schud de piketkaarten(32 speelkaarten met waarde vanaf 7) en verdeel de kaarten onder de spelers.
- 1 random speler begint het spel, deze speler legt willekeurig een kaart op.
- De overige spelers leggen om de beurt een zo laag mogelijke matching kaart op. Heeft
de speler geen matching kaart meer, dan legt de speler willekeurig een kaart op.
- Als alle 4 de spelers zijn geweest verliest de speler die de hoogste matching kaart heeft
opgelegd en krijgt het totaal aantal punten van alle 4 de opgelegde kaarten
bijgeschreven. Hierna mag de volgende speler het spel beginnen.
- Als alle spelers geen kaarten meer hebben wordt het deck opnieuw geschud en
verdeeld onder de spelers. En gaat het spel verder bij de speler die aan de beurt is.
- Als een speler 50 punten of meer heeft is het spel afgelopen en heeft deze speler
verloren.
- Het moet geen interactief spel worden, je programmeert een programma wat de
bovenstaande regels volgt.
- Het spel moet zonder framework gemaakt worden. Composer en helper packages
mogen gebruikt worden.
- Bonus: probeer minstens 1 PHPunit test toe te voegen.

## Punten telling:
- Hartenkaart: 1 punt
- Klaver boer: 2 punten 
- Schoppen vrouw: 5 punten 
- Overige kaarten: 0 punten

## Voorbeeld programma:
Het programma laat de voortgang van het spel zien via de console of via een simpele HTML pagina. Dat ziet er bijvoorbeeld als volgt uit:
```
Starting a game with John, Jane, Jan, Otto
 John has been dealt: ♦9 ♦10 ♥9 ♠K ♥A ♠A ♦J ♠7 
 Jane has been dealt: ♠8 ♥7 ♥10 ♣8 ♦Q ♦7 ♠9 ♦8 
 Jan has been dealt: ♣A ♥J ♥K ♥8 ♣7 ♥Q ♦A ♣10 
 Otto has been dealt: ♠10 ♣9 ♣K ♦K ♣Q ♠Q ♠J ♣J

Round 1: Jan starts the game Jan plays: ♣7
Otto plays: ♣9
John plays: ♥K
Jane plays: ♣8
Otto played ♣9, the highest matching card of this match and got 1 point added to his total
score. Otto’s total score is 1 point. Round 2: Otto start the game 

...etc

Players ran out of cards. Reshuffle.
John has been dealt: ♠8 ♥7 ♥10 ♣8 ♦Q ♦7 ♠9 ♦8 
Jane has been dealt: ♠10 ♣9 ♣K ♦K ♣Q ♠Q ♠J ♦J 
Jan has been dealt: ♦9 ♦10 ♣J ♥9 ♠K ♥A ♠A ♣10 
Otto has been dealt: ♣A ♥J ♥K ♠7 ♥8 ♣7 ♥Q ♦A

...etc

Jan loses the game! Points:
Jan: 50
Jane: 32
John: 13 Otto: 40
```