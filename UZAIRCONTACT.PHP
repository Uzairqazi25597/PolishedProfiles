<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['resume'])) {
    $file = $_FILES['resume'];
    $allowedExtensions = ['pdf', 'doc', 'docx'];
    $fileExtension = pathinfo($file['name'], PATHINFO_EXTENSION);

    if (in_array($fileExtension, $allowedExtensions) && $file['error'] == 0) {
        $uploadDirectory = 'uploads/';
        $uploadPath = $uploadDirectory . basename($file['name']);

        if (!is_dir($uploadDirectory)) {
            mkdir($uploadDirectory, 0777, true);
        }

        if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
            echo 'Resume uploaded successfully!';
        } else {
            echo 'Error uploading the resume. Please try again.';
        }
    } else {
        echo 'Invalid file type or upload error.';
    }
} else {
    echo 'No file uploaded or invalid request.';
}
?>
