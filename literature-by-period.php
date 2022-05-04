<?php
	require 'conn.php';
	$title = "Вся литература за период с " 
			. $_GET['from']
			. " по " . $_GET['to'];
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
			<th>Дата выпуска</th>
			<th>Издательство</th>
			<th>Количество</th>
			<th>ISBN</th>
			<th>Вид ресурса</th>
		</thead>
		<tbody>
			<?php
				$stm = "
SELECT name, publication_date, publisher, quantity, ISBN, type 
	FROM literature 
	WHERE publication_date BETWEEN ? AND ?";

				$pdo_stm = $pdo->prepare($stm);
				$pdo_stm->setFetchMode(PDO::FETCH_NUM);
				$pdo_stm->execute(
					array($_GET['from'], $_GET['to'])
				);
				foreach ($pdo_stm as $row) {
					echo "<tr>";
					foreach ($row as $value) {
						echo "<td>" . $value . "</td>";
					}
					echo "</tr>";
				}
			?>
		</tbody>
	</table>
</body>
