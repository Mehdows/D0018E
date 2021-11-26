<!DOCTYPE html>
<html>
	<body>
		<h1>My first PHP page</h1>

		<?php
		require __DIR__ . '/functions.php';
		$conn = startConnection();
		echo "Hello World! <br>";
		$result = getAllItems($conn);

		//display rows
		/*if ($result->num_rows > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
			echo "id: " . $row["item_ID"]. " - Name: " . $row["name"]. " - Price: " . $row["price"]. " - Image: " . $row["image"]. "<br>";
			}
		} else {
			echo "0 results";
		}*/


		//display rows as table
		/*echo('<table border="1">'."\n");
		while ( $row = $result->fetch_assoc() ) {
			echo "<tr><td>";
			echo(htmlentities($row['item_ID']));
			echo("</td><td>");
			echo(htmlentities($row['name']));
			echo("</td><td>");
			echo(htmlentities($row['price']));
			echo("</td><td>");
			echo(htmlentities($row['image']));
			echo("</td></tr>\n");
		}
		echo('</table>');*/

		//display as homepage
		while ($row = mysqli_fetch_assoc($result)) {
		echo('<div class="imgContainer">');
			echo('<div>');
                echo('<div>');
					echo(htmlentities($row['name']). " - " . htmlentities($row['price']). " kr/st");
					echo('<a href="inspect.html" ><img src='.htmlentities($row['image']).' style="width:300px;height:300px;"></a>');
				echo('</div>');
                echo('<div class="imgButton">');
					echo('<button value="test">buy</button>');
				echo('</div>');
			echo('</div>');
		echo('</div>');
		}


		closeConnection($conn);
		?>
	</body>
</html>
