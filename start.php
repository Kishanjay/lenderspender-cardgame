<?php

require_once('ls_game.php');

$PLAYERS = ['Lucas', 'Huub', 'Kishan', 'Nando'];

(new LenderSpenderGame($PLAYERS))->start();