<?php
	require 'conn.php';
	$stm = "SELECT name FROM authors WHERE id=?;";
	$pdo_stm = $pdo->prepare($stm);
	$pdo_stm->execute(
		array( $_GET['auth_id'] )
	);
	$title = "Книги автора " . $pdo_stm->fetch()['name'];
?>

<!DOCTYPE html>
<html lang="ru">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php echo $title; ?></title>
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php
		include 'main-page-link.php';
		main_page_link();
	?>
	<h1>
		<?php echo $title;	?>
	</h1>

	<table border="1">
		<thead>
			<th>Название</th>
			<th>Год выпуска</th>
			<th>Количество</th>
			<th>ISBN</th>
			<th>Приложение</th>
		</thead>
		<tbody>
			<?php
				$stm = "
SELECT l.name, DATE_FORMAT(l.publication_date, '%Y'), l.quantity, l.ISBN, r.title
	FROM book_authors ba
	INNER JOIN literature l ON l.id_book=ba.fid_book
    LEFT JOIN resourse r ON r.id=l.fid_resourse
    WHERE ba.fid_authors=? AND l.type LIKE 'Book';";

    			$pdo_stm = $pdo->prepare($stm);
    			$pdo_stm->setFetchMode(PDO::FETCH_NUM);
    			$pdo_stm->execute(
    				array($_GET['auth_id'])
    			);
    			foreach ($pdo_stm as $row) {
    				echo "<tr>";
    				foreach ($row as $value) {
    					echo "<td>"
    						. $value
    						. "</td>";
    				}
    				echo "</tr>";
    			}
    		?>
		</tbody>
	</table>
</body>