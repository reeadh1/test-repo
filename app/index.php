<!-- app/index.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Student Information</title>
</head>
<body>
    <h2>Add Student Information</h2>
    <form action="index.php" method="post">
        Name: <input type="text" name="name"><br><br>
        Age: <input type="number" name="age"><br><br>
        Class Grade: <input type="text" name="class_grade"><br><br>
        <input type="submit" value="Submit">
    </form>
    
    <?php
    // PHP code to handle form submission and display stored data
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = $_POST['name'];
        $age = $_POST['age'];
        $class_grade = $_POST['class_grade'];

        // Connect to MySQL database
        $conn = new mysqli('db', 'root', 'password', 'student_db');
        
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Insert data into the database
        $sql = "INSERT INTO students (name, age, class_grade) VALUES ('$name', $age, '$class_grade')";
        if ($conn->query($sql) === TRUE) {
            echo "<p>Student information added successfully.</p>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Display stored data
        $result = $conn->query("SELECT * FROM students");
        if ($result->num_rows > 0) {
            echo "<h2>Student Information</h2>";
            echo "<table border='1'><tr><th>Name</th><th>Age</th><th>Class Grade</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>".$row["name"]."</td><td>".$row["age"]."</td><td>".$row["class_grade"]."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close();
    }
    ?>
</body>
</html>

