<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <style>
        table {
            border-collapse: collapse;
            width: 50%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
        }
    </style>
</head>
<body>
    <h2>Profile</h2>

    <?php
    session_start();

    // Database credentials
    $servername = "localhost";
    $db_username = "root";
    $db_password = "";
    $dbname = "your_database";

    // Create connection
    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];

        // Fetch user information from users table
        $user_sql = "SELECT name, department, year, email, college, username FROM users1 WHERE username='$username'";
        $user_result = $conn->query($user_sql);

        if ($user_result->num_rows > 0) {
            $user_row = $user_result->fetch_assoc();
            echo "<table>";
            echo "<tr><th>Attribute</th><th>Value</th></tr>";
            echo "<tr><td>Name</td><td>" . $user_row['name'] . "</td></tr>";
            echo "<tr><td>Department</td><td>" . $user_row['department'] . "</td></tr>";
            echo "<tr><td>Year</td><td>" . $user_row['year'] . "</td></tr>";
            echo "<tr><td>email</td><td>" . $user_row['email'] . "</td></tr>";
            echo "<tr><td>College</td><td>" . $user_row['college'] . "</td></tr>";
            echo "<tr><td>Username</td><td>" . $user_row['username'] . "</td></tr>";
            echo "</table>";

            // Fetch registered courses from register table
            $register_sql = "SELECT course_name FROM registration WHERE Student_name='" . $user_row['name'] . "'";
            $register_result = $conn->query($register_sql);

            if ($register_result->num_rows > 0) {
                echo "<h3>Registered Courses:</h3>";
                echo "<ul>";
                while ($register_row = $register_result->fetch_assoc()) {
                    echo "<li>" . $register_row['course_name'] . "</li>";
                }
                echo "</ul>";
            } else {
                echo "<p>No courses registered.</p>";
            }
        }
    } else {  
        echo "No user logged in.";
    }

    // Close connection
    $conn->close();
    ?>
    
    <button onclick="window.location.href='homepage.html'">OK</button>
</body>
</html>
