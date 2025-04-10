<?php
require 'vendor/autoload.php'; // Make sure you have Composer and MongoDB PHP library installed

// Replace with your actual password
$uri = "mongodb+srv://allianzateamone:<future@2050!@>@schooldb.tghlgl9.mongodb.net/?retryWrites=true&w=majority&appName=schoolDB";

try {
    // Connect to MongoDB
    $client = new MongoDB\Client($uri);

    // Select database and collection
    $db = $client->selectDatabase("schoolDB");
    $collection = $db->selectCollection("news");

    // Insert a sample news article
    $insertOneResult = $collection->insertOne([
        'title' => 'Test Article',
        'author' => 'Allianza Team',
        'content' => 'This is a test to see if MongoDB is connected.',
        'created_at' => new MongoDB\BSON\UTCDateTime()
    ]);

    echo "✅ Inserted document ID: " . $insertOneResult->getInsertedId() . "<br>";

    // Fetch and display all articles
    echo "<h3>📚 All News Articles:</h3>";
    $cursor = $collection->find();

    foreach ($cursor as $doc) {
        echo "<strong>Title:</strong> " . $doc['title'] . "<br>";
        echo "<strong>Author:</strong> " . $doc['author'] . "<br>";
        echo "<strong>Content:</strong> " . $doc['content'] . "<br><br>";
    }

} catch (Exception $e) {
    echo "❌ Error: " . $e->getMessage();
}
?>
