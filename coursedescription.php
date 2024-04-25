<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Information</title>
    <style>
        .course {
            margin-bottom: 20px;
        }
        .course h3 {
            margin-top: 0;
        }
        .course p {
            margin: 5px 0;
        }
        .button {
    background-color: #4CAF50;
    border: none;
    color: white;
    padding: 10px 20px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin-top: 20px;
    cursor: pointer;
    border-radius: 8px;
}

/* Hover effect for buttons */
.button:hover {
    background-color: #45a049;
}

/* Active effect for buttons */
.button:active {
    background-color: #3e8e41;
}
    </style>
</head>
<body>
    <h2>Course Information</h2>
    <?php
    // Database connection
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "your_database";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve course information
    $sql = "SELECT course_name, duration, fee, seats FROM courses";
    $result = $conn->query($sql);

    // Display course information
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='course'>";
            echo "<h3>{$row['course_name']}</h3>";
            // Hardcoded description
            switch ($row['course_name']) {
                case 'AI':
                    echo "<p><strong>Description : </strong>Explore the cutting-edge field of Artificial Intelligence (AI) and learn to develop 
                    intelligent systems capable of performing tasks that typically require human intelligence. Gain insights into machine learning 
                    algorithms, neural networks, natural language processing, and computer vision, empowering you to build AI-powered applications and solutions.</p>";
                    break;
                case 'Cloud':
                    echo "<p><strong>Description : </strong>Delve into the transformative world of Cloud Computing and acquire skills to design, 
                    deploy, and manage scalable cloud infrastructure. Learn about cloud architecture, services, and deployment models such as IaaS,
                     PaaS, and SaaS. Master popular cloud platforms like AWS, Azure, and Google Cloud, enabling you to harness the power of cloud
                      technologies to optimize business operations and drive innovation.</p>";
                    break;
                case 'Full Stack':
                    echo "<p>><strong>Description : </strong>Embark on a comprehensive journey into Full Stack Development, mastering both front-end and 
                    back-end technologies. Acquire proficiency in HTML, CSS, JavaScript for creating dynamic user interfaces, and dive into server-side programming 
                    with languages like Node.js, Python, or Ruby on Rails. Gain hands-on experience with databases, APIs, and deployment tools, empowering you to build 
                    end-to-end web applications from scratch.</p>";
                    break;
                case 'Web Designing':
                    echo "<p><strong>Description : </strong>Immerse yourself in the world of Web Designing and unleash your creativity to craft visually appealing and user-friendly 
                    websites. Learn the principles of design, typography, color theory, and layout techniques to create compelling web experiences.
                     Explore tools and frameworks such as Adobe Photoshop, Illustrator, and Bootstrap to prototype and build responsive websites optimized 
                     for various devices and screen sizes.</p>";
                    break;
                default:
                    echo "<p>No description available</p>";
            }
            echo "<p><strong>Duration:</strong> {$row['duration']}</p>";
            echo "<p><strong>Fee:</strong> {$row['fee']}</p>";
            echo "<p><strong>Seats:</strong> {$row['seats']}</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No courses found</p>";
    }

    // Close database connection
    $conn->close();
    ?>
     <button class="button" onclick="location.href='homepage.html'">Go to Homepage</button>
    </body>
</html>
