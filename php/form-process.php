<?php
$errorMSG = "";

// Check if form fields are set
if (isset($_POST["name"], $_POST["email"], $_POST["person"], $_POST["date"], $_POST["time"], $_POST["phone"])) {
    // Get form input values
    $name = $_POST["name"];
    $email = $_POST["email"];
    $person = $_POST["person"];
    $date = $_POST["date"];
    $time = $_POST["time"];
    $phone = $_POST["phone"];

    // Validate form input
    if (empty($name)) {
        $errorMSG .= "Name is required. ";
    }
    if (empty($email)) {
        $errorMSG .= "Email is required. ";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMSG .= "Invalid email format. ";
    }
    if (empty($person)) {
        $errorMSG .= "Number of persons is required. ";
    }
    if (empty($date)) {
        $errorMSG .= "Date is required. ";
    }
    if (empty($time)) {
        $errorMSG .= "Time is required. ";
    }
    if (empty($phone)) {
        $errorMSG .= "Phone number is required. ";
    } elseif (!preg_match("/^[0-9]{11}$/", $phone)) {
        $errorMSG .= "Invalid phone number format. ";
    }

    // If there are no errors
    if ($errorMSG == "") {
        // Database connection configuration
        $servername = 'localhost';
        $username = 'root';
        $password = '';
        $dbname = 'rmsdb';

        // Create a new mysqli connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare the SQL statement
        $sql = "INSERT INTO table_reservations(name, email, person, date, time, phone) VALUES ($name, $email, $person, $date, $time, $phone)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssisss", $name, $email, $person, $date, $time, $phone);

        // Execute the statement
        if ($stmt->execute()) {
            echo "success";
        } else {
            echo "Something went wrong :(";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo $errorMSG;
    } 
} 
else {
    echo "Invalid request";
}
?>
