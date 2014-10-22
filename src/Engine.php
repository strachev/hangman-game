<?php

namespace HangmanGame;

Class Engine {

	protected $word;
	protected $hiddenWord;
	protected $guessCount;
	protected $missesLetters;

	public function __construct() {
		
	}

	public function startSession() {
		return session_start();
	}

	public function getWord() {
		$file = fopen(FILE_WORD, 'r');
		if ($file) {
			$count = 0;
			while (!feof($file)) {
				$count++;
				$words[] = trim(fgets($file));
			}
			fclose($file);

			$randLine = rand(0, $count - 1);
			return $words[$randLine];
		}
		return null;
	}

	public function checkGuess($guessLetter, $word, $guessWord) {
		$hiddenWord = "";
		$wordArr = str_split($word);
		$guessWordArr = str_split($guessWord);
		for ($i = 0; $i < count($wordArr); $i++) {
			if ($guessLetter == $wordArr[$i]) {
				$hiddenWord .= $guessLetter;
			} elseif ($guessWordArr[$i] != "_") {
				$hiddenWord .= $guessWordArr[$i];
			} else {
				$hiddenWord .= "_";
			}
		}
		$this->logs($hiddenWord. "\n");
		return $hiddenWord;
	}

	public function missesLetters($guessLetter, $word) {
		$wrongGuess = false;
		$wordArr = str_split($word);
		foreach ($wordArr as $letter) {
			if ($guessLetter == $letter) {
				$wrongGuess = true;
			}
		}

		if (!$wrongGuess) {
			return $guessLetter;
		}
	}

	public function hideWord($word) {
		return preg_replace('/([A-Za-z])/', '_', $word);
	}

	public function logs($data) {
		$open = fopen(FILE_LOGS, "a+");
		fwrite($open, $data);
		fclose($open);
	}

}
