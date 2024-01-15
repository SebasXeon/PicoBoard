<?php 
// This is a test file to fill the database with some data

// Define the base path
chdir('../');

// Include database configuration
require_once('app/core/database.php');

// Include models
require_once('app/models/BoardModel.php');
require_once('app/models/AttachmentModel.php');
require_once('app/models/ThreadModel.php');
require_once('app/models/PostModel.php');

// Initialize the database connection
$DB = new Database();

// Create a new thread
$thread = new Thread($DB);
$thread->create(1, 'Test thread');
// Create a new post
$post = new Post($DB);
$post->create($thread->id, null, 'Test post');
// Create another post
$post = new Post($DB);
$post->create($thread->id, null, 'Another test post');
// Edit the post body
$post->body = 'Edited post body';
$post->update();

echo 'Done!';
echo '<pre>';
var_dump($thread);
var_dump($post);
echo '</pre>';