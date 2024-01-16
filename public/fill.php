<?php 
// This is a test file to fill the database with some data

// Define the base path
chdir('../');

// Include database configuration
require_once('app/core/database.php');

// Include models
require_once('app/models/BoardModel.php');
require_once('app/models/AttachmentModel.php');
require_once('app/models/PostModel.php');

// Initialize the database connection
$DB = new Database();

// Create a post (thread)
//$post = new Post($DB);
//$post->create(1, true, null, null, 'Test thread', 'This is a test thread');

// For loop to create 10 replies
for ($i = 0; $i < 3; $i++) {
    // Create a post (reply)
    $post = new Post($DB);
    $post->create(1, false, 3, null, 'Test reply', 'This is a test reply');
}

echo 'Done!';
echo '<pre>';
var_dump($post);
echo '</pre>';