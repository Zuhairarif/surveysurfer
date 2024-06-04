<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection settings
$servername = "localhost";
$username = "root";
$password = "zuhairarif1"; // Change this to your MySQL root password
$dbname = "sony_survey"; // The database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to sanitize input
function sanitizeInput($data) {
    return htmlspecialchars(strip_tags(trim($data)));
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input
    $sonyHeadphone = isset($_POST['Sony']) ? sanitizeInput($_POST['Sony']) : null;

    if ($sonyHeadphone) {
        // Prepare and bind SQL statement
        $stmt = $conn->prepare("INSERT INTO SurveyResponses (SonyHeadphone) VALUES (?)");
        if ($stmt) {
            $stmt->bind_param("s", $sonyHeadphone);

            // Execute the statement
            if ($stmt->execute()) {
                $message = "Thank you for participating in our survey! Your favorite Sony headphone is: <strong>$sonyHeadphone</strong>";
            } else {
                $message = "Error executing statement: " . $stmt->error;
            }

            // Close statement
            $stmt->close();
        } else {
            $message = "Error preparing statement: " . $conn->error;
        }
    } else {
        $message = "No headphone selected. Please go back and select your favorite Sony headphone.";
    }
} else {
    $message = "Invalid request method.";
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sony Headphones | Survey</title>
  <link rel="stylesheet" href="https://unpkg.com/@picocss/pico">
</head>
<body>
  <main class="container">
    <h1>Sony Headphones Survey</h1>
    <article>
      <header><strong>Q1: Which one is your favourite headphone of Sony?</strong></header>
      <p><?php echo $message; ?></p>
    </article>
  </main>
</body>
</html>
