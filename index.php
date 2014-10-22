<?php

include_once 'config/config.php';
include_once 'src/engine.php';

if (php_sapi_name() == "cli") {
	include_once 'src/cligame.php';
	new \HangmanGame\CliGame();
} else {
	include_once 'src/webgame.php';
	new \HangmanGame\WebGame();
}