<!DOCTYPE html>
<html>
<head>
	<title>Content Display</title>
</head>
<body>
	<h1>Content Display</h1>
	<?php 
		// connect to the database
		$servername = "localhost";
		$username = "shivam112";
		$password = "m0mandp4p4";
		$dbname = "mydatabasenew";

		$conn = new mysqli($servername, $username, $password, $dbname);

		// check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		// select all files from the database
		$sql = "SELECT * FROM files";
		$result = $conn->query($sql);

		// display the files
		if ($result->num_rows > 0) {
			while ($row = $result->fetch_assoc()) {
				// check the file type
				if ($row["filetype"] == "jpg" || $row["filetype"] == "jpeg" || $row["filetype"] == "png" || $row["filetype"] == "gif") {
					// display image
					echo '<img src="' . $row["filepath"] . '/' . $row["filename"] . '" alt="' . $row["filename"] . '" width="200">';
				} elseif ($row["filetype"] == "mp4" || $row["filetype"] == "avi" || $row["filetype"] == "mov" || $row["filetype"] == "wmv") {
					// display video
					echo '<video width="320" height="240" controls>
						<source src="' . $row["filepath"] . '/' . $row["filename"] . '" type="video/' . $row["filetype"] . '">
						Your browser does not support the video tag.
					</video>';
				} else {
					// unsupported file type
					echo '<p>Unsupported file type: ' . $row["filename"] . '</p>';
				}
			}
		} else {
			echo '<p>No files found.</p>';
		}

		// close the database connection
		$conn->close();
	?>
</body>
</html>
