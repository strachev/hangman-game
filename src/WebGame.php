<?php

namespace HangmanGame;

Class WebGame extends Engine {

	public function __construct() {
		parent::__construct();
		$this->run();
	}

	function run() {
		$this->startSession();

		if (isset($_POST['new_game'])) {
			unset($_SESSION['word']);
			unset($_SESSION['gameOver']);
		}

		$this->session();

		if (!empty($_POST["guess"])) {
			$guess = strtolower($_POST["guess"]);
			$_SESSION['hiddenWord'] = $this->checkGuess($guess, $_SESSION['word'], $_SESSION['hiddenWord']);
			$_SESSION['guessCount'] = $_SESSION['guessCount'] - 1;
			$_SESSION['missesLetters'] .= $this->missesLetters($guess, $_SESSION['word']);
			if ($_SESSION['guessCount'] <= 0) {
				$_SESSION['gameOver'] = "GAME OVER <br /> The word is <font color='red'> " . $_SESSION['word'] . "</font>";
				$this->logs("\n==================================\nGAME OVER\n==================================\n\n");
			}
			if($_SESSION['word'] == $_SESSION['hiddenWord']){
				$_SESSION['gameOver'] = "Congratulations, You have won!";
				$this->logs("\n==================================\nGAME OVER\n==================================\n\n");
			}
		}
		include_once 'views/default.php';
	}

	public function session() {
		if (empty($_SESSION['word'])) {
			$word = $this->getWord();
			$this->logs("==================================\nStart WEB Game\n==================================\n" . $word . "\n\n");
			$_SESSION['word'] = $word;
			$_SESSION['hiddenWord'] = $this->hideWord($word);
			$_SESSION['guessCount'] = MAX_GUESS;
			$_SESSION['missesLetters'] = "";
		}
	}

}
