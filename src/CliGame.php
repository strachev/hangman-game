<?php

namespace HangmanGame;

Class CliGame extends Engine {

	public function __construct() {
		parent::__construct();

		$this->word = $this->getWord();
		$this->hiddenWord = $this->hideWord($this->word);
		$this->guessCount = MAX_GUESS;
		$this->missesLetters = "";

		$this->logs("==================================\nStart CLI Game\n==================================\n\n" . $this->word . "\n\n");
		
		$this->run();
	}

	public function run($stdin = NULL) {

		while (true) {
			if ($stdin === NULL) {
				$stdin = STDIN;
			}
			echo PHP_EOL . implode(" ", str_split($this->hiddenWord)) . PHP_EOL . PHP_EOL;
			echo "Enter a letter: ";
			$guess = trim(stream_get_line($stdin, 1024, PHP_EOL));
			$this->hiddenWord = $this->checkGuess($guess, $this->word, $this->hiddenWord);
			$this->guessCount--;
			$this->missesLetters .= $this->missesLetters($guess, $this->word);
			echo 'Misses: { ' . implode(", ", str_split($this->missesLetters)) . ' } | Guesses left: ' . $this->guessCount . PHP_EOL;

			$this->gameOver();
		}
	}

	public function gameOver() {
		if ($this->guessCount <= 0) {
			echo PHP_EOL . "GAME OVER" . PHP_EOL;
			echo "The word is " . $this->word . PHP_EOL;
			$this->logs("\n==================================\nGAME OVER\n==================================\n\n");
			exit;
		}
		if ($this->word == $this->hiddenWord) {
			echo PHP_EOL . "Congratulations, You have won!" . PHP_EOL;
			$this->logs("\n==================================\nGAME OVER\n==================================\n\n");
			exit;
		}
	}
}	