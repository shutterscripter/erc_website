<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "erc";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get input values
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $branch = $_POST['branch'];
    $year = $_POST['year'];
    $domain = $_POST['domain'];
    $reason = $_POST['reason'];
    $technicalSkills = $_POST['technicalSkills'];
    $softSkills = $_POST['softSkills'];
    $achievements = $_POST['achievements'];
    $whyJoin = $_POST['whyJoin'];
    $note = $_POST['note'];
    $recordDate = date('Y-m-d H:i:s');

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO erc_join_raw (record_date, std_name, std_email, std_phone, std_branch, std_year, std_domain, std_domain_reason, std_tech_skills, std_soft_skills, std_achievements, std_why_join_erc, std_note) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    echo $conn->error;
    $stmt->bind_param("sssssssssssss", $recordDate, $name, $email, $phone, $branch, $year, $domain, $reason, $technicalSkills, $softSkills, $achievements, $whyJoin, $note);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
