<?php

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    exit('POST request method required');
}

if (empty($_FILES)) {
    exit('$_FILES is empty - is file_uploads set to "On" in php.ini?');
}

if ($_FILES["pdf"]["error"] !== UPLOAD_ERR_OK) {
    switch ($_FILES["pdf"]["error"]) {
        // ... (same as before)
    }
}

// Reject uploaded file larger than 1MB
if ($_FILES["pdf"]["size"] > 1048576) {
    exit('File too large (max 1MB)');
}

// Use fileinfo to get the mime type
$finfo = new finfo(FILEINFO_MIME_TYPE);
$mime_type = $finfo->file($_FILES["pdf"]["tmp_name"]);

if ($mime_type !== "application/pdf") {
    exit("Invalid file type. Please upload a PDF file.");
}

// Create a unique file name based on user ID, timestamp, and the original filename
$user_id = $_SESSION['user_id'];
$timestamp = time(); // current timestamp
$date = date("Y-m-d"); // current date in "YYYY-MM-DD" format

// Replace any characters not \w- in the original filename
$pathinfo = pathinfo($_FILES["pdf"]["name"]);
$base = $pathinfo["filename"];
$base = preg_replace("/[^\w-]/", "_", $base);
$filename = "{$user_id}_{$timestamp}_{$date}_{$base}.{$pathinfo["extension"]}";

$destination = __DIR__ . "/uploads/" . $filename;

// Move the uploaded file to the target directory
if (!move_uploaded_file($_FILES["pdf"]["tmp_name"], $destination)) {
    exit("Can't move uploaded file");
}

echo "File uploaded successfully.";
