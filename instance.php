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

// URL to send the request to
$url = "http://192.168.0.5:5000/createINSTANCE";

$service_id = $_GET['id'];
// Do something with the ID, such as storing it in a database or performing other operations

// Initialize curl
$curl = curl_init();
//Data to include in the request body
$data = array(
    'flavor_id' => $service_id
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
$instance_id = $response;

if (!isset($error)){
    mysqli_query($conn, "INSERT INTO users_services (user_id, service_id, instance_id) VALUES ($user_id, $service_id, $instance_id)") or die("Error Occured");

}
else{
    echo("Error $error"); 
}
$conn->close();
