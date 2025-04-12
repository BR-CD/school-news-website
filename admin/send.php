<?php   
// Your database credentials   
$servername = "localhost";  
$username = "root";  
$password = "";  
$dbname = "news";  

// Create connection  
$conn = new mysqli($servername, $username, $password, $dbname);  

// Check connection  
if ($conn->connect_error) {  
    die("Connection failed: " . $conn->connect_error);  
}  

// Check whether the data from the form is submitted   
if ($_SERVER["REQUEST_METHOD"] == "POST") {  
    $title = $conn->real_escape_string($_POST['title']);  
    $content = $conn->real_escape_string($_POST['content']);  
    $files = $conn->real_escape_string($_POST['files']);  
    $updated_by = $conn->real_escape_string($_POST['updated_by']);  
    $created_at = $conn->real_escape_string($_POST['created_at']);   
   
    // Prepare and bind  
    $stmt = $conn->prepare("INSERT INTO annoncment (title, content, files, updated_by, created_at) VALUES (?, ?, ?, ?, ?)");  
     
    $stmt->bind_param("ssssi", $title, $content, $files, $updated_by, $created_by);  

    if ($stmt->execute()) {  
        header("Location: admin.html");  
    } else {  
        echo "Error: " . $stmt->error;  
    }  

    // Close the statement   
    $stmt->close();  
}  

// Close connection  
$conn->close();  
?>  