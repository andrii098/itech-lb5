<?php
	require 'conn.php';
	$title = "Книги издателя " . $_GET['publ'];
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
			<th>Автор</th>
			<th>Приложение</th>
		</thead>
		<tbody>
			<?php
				$stm = "
SELECT l.id_book, l.name, DATE_FORMAT(l.publication_date, '%Y'), l.quantity, l.ISBN, r.title
	FROM literature l 
    LEFT JOIN resourse r ON r.id=l.fid_resourse
	WHERE l.publisher LIKE ?;";

				$stm2 = "
SELECT * FROM book_authors ba 
	INNER JOIN authors a ON a.id=ba.fid_authors
    WHERE ba.fid_book=?;";

				$pdo_stm = $pdo->prepare($stm);
				$pdo_stm->execute(
                	array($_GET['publ'])
            	);

				$pdo_stm2 = $pdo->prepare($stm2);

            	$pdo_stm->setFetchMode(PDO::FETCH_NUM);
            	foreach ($pdo_stm as $row) {
            		$book_id = $row[0];
                	echo '<tr>';
                	for ($i = 1; $i <= 4; ++$i) {
                    	echo '<td>' . $row[$i] . '</td>';
                	}

                	echo "<td>";
					$pdo_stm2->execute(
    	            	array($book_id)
        	    	);
        	    	foreach ($pdo_stm2 as $row2) { 
        	    		echo $row2['name'] . ' ';
        	    	}
                	echo "</td>";

                	echo "<td>" . $row[5] . "</td>";

                	echo '</tr>';
            	}
			?>
		</tbody>
	</table>
</body>
