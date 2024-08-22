<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "DOCTORAL";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get GRA students that passed no milestones
$sql = "SELECT DISTINCT G.StudentId, S.FName, S.LName FROM (GRA G JOIN PHDSTUDENT S ON G.StudentId=S.StudentId) LEFT JOIN MILESTONESPASSED M ON G.StudentId=M.StudentId WHERE M.StudentId IS NULL ";
$result = $conn->query($sql);

// Insert Instructor
if (isset($_POST['insert'])) {
    // INSTRUCTOR attributes to insert
    $InstructorId = $_POST['InstructorId'];
    $FName = $_POST['FName'];
    $LName = $_POST['LName'];
    $StartDate = $_POST['StartDate'];
    $Degree = $_POST['Degree'];
    $Rank = $_POST['Rank'];
    $Type = $_POST['Type'];

    // Query to insert INSTRUCTOR 
    $stmt = $conn->prepare("INSERT INTO INSTRUCTOR (InstructorId, FName, LName, StartDate, Degree, Rank, Type) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $InstructorId, $FName, $LName, $StartDate, $Degree, $Rank, $Type);

    // Message Output
    if ($stmt->execute()) {
        echo "New instructor added successfully<br>";
    } else {
        echo "Error: " . $stmt->error;
    }
}

// Update Instructor
if (isset($_POST['update'])) {
    // INSTRUCTOR attributes to update
    $InstructorId = $_POST['InstructorId'];
    $FName = $_POST['FName'];
    $LName = $_POST['LName'];

    // Query to update an INSTRUCTOR name
    $stmt = $conn->prepare("UPDATE INSTRUCTOR SET FName=?, LName=? WHERE InstructorId=?");
    $stmt->bind_param("sss", $FName, $LName, $InstructorId);

    // Output message
    if ($stmt->execute()) {
	echo "Instructor updated successfully<br>";
    } else {
	echo "Error: " . $stmt->error;
    }
}

// Delete GRA Student
if (isset($_POST['delete'])) {

    // Get GRA Student ID
    $StudentId = $_POST['StudentId'];

    // Student deleted from GRA table first
    $stmt = $conn->prepare("DELETE FROM GRA WHERE StudentId=?");
    $stmt->bind_param("s", $StudentId);
    $stmt->execute();

    // Student deleted from PHDSTUDENT table second
    $stmt = $conn->prepare("DELETE FROM PHDSTUDENT WHERE StudentId=?");
    $stmt->bind_param("s", $StudentId);

    // Output message
    if ($stmt->execute()) {
          echo "GRA student deleted successfully<br>";
      } else {
          echo "Error: " . $stmt->error;
      }
}


$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Phase 3 Project</title>
</head>
<body>
    <h2>Insert Instructor</h2>
    <form method="post">
        Instructor ID: <input type="text" name="InstructorId" required><br>
        First Name: <input type="text" name="FName" required><br>
        Last Name: <input type="text" name="LName" required><br>
        Start Date: <input type="date" name="StartDate"><br>
        Degree: <input type="text" name="Degree"><br>
        Rank: <input type="text" name="Rank"><br>
        Type: <input type="text" name="Type"><br>
        <input type="submit" name="insert" value="Insert">
    </form>

    <h2>Update Instructor</h2>
    <form method="post">
        Instructor ID: <input type="text" name="InstructorId" required><br>
        New First Name: <input type="text" name="FName"><br>
        New Last Name: <input type="text" name="LName"><br>
        <input type="submit" name="update" value="Update">
    </form>

    <h2>Delete GRA Student</h2>
    <form method="post">
	<label for="StudentId">Select GRA Student:</label>
        	<select name="StudentId" id="StudentId" required>
            	<option value="">Select a student</option>
            	<?php
            	if ($result->num_rows > 0) {
                	while($row = $result->fetch_assoc()) {
                    	echo "<option value='" . $row['StudentId'] . "'>" . $row['FName'] . " " . $row['LName'] . " (" . $row['StudentId'] . ")</option>";
                	}
            	} else {
                	echo "<option value=''>No students available</option>";
            	}
            	?>
        	</select><br>
        	<input type="submit" name="delete" value="Delete">
    </form>
</body>
</html>
