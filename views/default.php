<!DOCTYPE html>
<html>
	<head>
		<title>Hangman Game</title>
		<link rel="stylesheet" type="text/css" href="views/css/style.css" media="screen">
	</head>
	<body>
		<form method="post">
			<?php if (!empty($_SESSION['gameOver'])) { ?>
				<div>
					<h1><?php echo $_SESSION['gameOver']; ?></h1>
					<input type="submit" name="new_game" value="START NEW GAME" />
				</div>
			<?php } else { ?>

				<div>
					<h1><?php echo implode(" ", str_split($_SESSION['hiddenWord'])); ?></h1>
				</div>
				<div>
					Misses: { <?php echo implode(", ", str_split($_SESSION['missesLetters'])); ?> } | Guesses left: { <?php echo $_SESSION['guessCount']; ?> }
				</div>
				<div>
					<input type="text" placeholder="Letter" name="guess" required="required" pattern="[A-Za-z]{1}" />
					<input type="submit" value="GUESS" />
				</div>

			<?php } ?>
		</form>
	</body>
</html>