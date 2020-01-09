<style>
	table,
	th,
	td {
		border-collapse: collapse;
		border: 1px solid black;
	}

	th,
	td {
		padding: 15px;
	}
</style>
<div style="width:50%;text-align:center;border:2px solid grey;margin:auto;">
	<form name="text_form" method="POST" action="">
		<p>Text : <input type="text" name="text_value"><button type="submit" name="submit">Submit</button></p>
	</form>

	<?php

	if (isset($_POST['submit'])) {
		$name = $_POST['text_value'];
		if ($name !== "") {
			echo "<p style='text-align:center;'>Value submitted : <b> $name </b></p>";
			echo "<p style='text-align:center;'>Uppercase: <b> " . strtoupper($name) . "</b></p>";
			echo "<p style='text-align:center;'>Alternating Uppercase & Lowercase: <b> " . alternatingString($name) . "</b></p>";
			echo "<p style='text-align:center;color:green;'><b>" . generateCSV($name) . "</b></p>";
		} else {
			echo "<p style='text-align:center;color:red;'><b> text not found! </b></p>";
		}
	}

	function alternatingString($string)
	{
		if ($string !== "") {
			$result = '';
			$vals = explode(' ', $string); // cater for multiple strings
			foreach ($vals as $val) {
				$val = str_split($val); // convert every string to its own set of arrays
				$newVal = '';
				foreach ($val as $key => $_val) {
					$key % 2 == 0 ? $newVal .= strtoupper($_val) : $newVal .= strtolower($_val); // alternating uppercase / lowercase characters
				}

				$result .= $newVal . " ";
			}
			return $result;
		} else {
			return null;
		}
	}

	function generateCSV($string)
	{
		if ($string !== "") {
			$_string = str_split($string); // convert all strings and spaces into set of array values
			if (count($_string) > 0) {
				$fp = fopen('downloads/output_' . date('YmdHis') . '.csv', 'w');
				fputcsv($fp, $_string);
				fclose($fp);

				return 'CSV Created!';
			} else {
				return null;
			}
		} else {
			return null;
		}
	}
	?>
</div>
<br /><br /><br />
<div style="width:50%;top: 50px;text-align:center;margin:auto;">
	<br>
	<table>
		<?php
		$path = 'downloads';
		$files = array_diff(scandir($path), array('.', '..'));

		if (count($files) > 0) {
			echo '<tr><th>File</th><th>Action</th></tr>';
			foreach ($files as $file) {
				echo '<tr><td>' . $file . ' </td><td> <a href="' . $path . '/' . $file . '"> Download </a> </td></tr>';
			}
		}
		?>

	</table>
	<br>
</div>