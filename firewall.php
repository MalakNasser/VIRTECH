<?php
session_start();
$servername = "localhost";
$username   = "root";
$password   = "";
$dbname     = "graduation_project";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$user_id =  $_SESSION['id'];

$sql = "SELECT COUNT(id) AS count_id
FROM users_firewall;";
$result   = $conn->query($sql);
$row      = $result->fetch_assoc();
$count_id = $row['count_id'];

// URL to send the request to
$url = "http://192.168.0.5:5000/createFIREWALL";

$service_id = $_GET['id'];
// Do something with the ID, such as storing it in a database or performing other operations

// Initialize curl
$curl = curl_init();

//Data to include in the request body
$data = array(
    'count_id' => $count_id
);

// Set the request options
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'
));

// Execute the request
$response = curl_exec($curl);

// Check for errors
if ($response === false) {
    $error = curl_error($curl);
    // Handle the error
    // ...
}

// Close the curl session
curl_close($curl);

// Output the response
$ip = $response;

if (!isset($error)) {
    mysqli_query($conn, "INSERT INTO users_firewall (user_id, ip) VALUES ($user_id, $ip)") or die("Error Occured");
} else {
    echo ("Error $error");
}

$conn->close();
?>
