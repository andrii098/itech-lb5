<?php
	require 'conn.php';
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Библиотека</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<h1>Библиотека</h1>
	<form action="books-by-publisher.php">
		<label for="publisher">
			Книги издательства:
		</label>
		<select name="publ" id="publisher">
			<?php
				$stm = "SELECT DISTINCT publisher FROM `literature`;";
                foreach ($pdo->query($stm) as $row) {
                    $publ = $row['publisher'];
                    echo "<option>"
                        . $publ 
                    	. "</option>";
                }
			?>
		</select>
		<input type="submit" value="Показать">
	</form>

	<form action="literature-by-period.php">
		Вся литература за период с 
		<input type="date" name="from">
		<label for="to">по</label>
		<input type="date" name="to" id="to">
		<input type="submit" value="Показать">
	</form>

	<form action="books-by-author.php">
		Книги автора 
		<select name="auth_id">
			<?php
				$stm = "SELECT id, name FROM authors;";
				foreach ($pdo->query($stm) as $row) {
					echo "<option value='"
						. $row['id'] . "'>"
						. $row['name'] 
						. "</option>";
				}
			?>
		</select>
		<input type="submit" value="Показать">
	</form>
</body>
</html>