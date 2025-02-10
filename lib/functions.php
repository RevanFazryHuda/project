<?php
require_once __DIR__ . "/../vendor/autoload.php"; 

function getJSON($jsonResponse){
    $data = json_decode($jsonResponse);

    // Check if the JSON decoding was successful
    if ($data !== null) {
        // Access the values
        $success = $data->success; // true
        $message = $data->message; // "Update successful"

        // Now you can use $success and $message in your PHP code
        if ($success) {
            $val = true;
        } else {
            $val = false;
        }
    } else {
        // JSON parsing failed
        $val = "error";
    }
    return $val;
}

function base_url(){
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
    $dotenv->load();
    $base = $_ENV["BASE_URL"];
    return $base;
}

function controller_url(){
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
    $dotenv->load();
    $base = $_ENV["CONTROLLER_URL"];
    return $base;
}

function MenuList(){
    // Ensure the directory path is correct
    $directory = controller_url(); 
    $mod_array = array('Login', 'Transaksidetail'); 
    
    // Validate directory path
    if (!is_dir($directory)) {
        // Log or handle the error
        error_log("Invalid directory path: " . $directory);
        return []; // Return empty array if directory is invalid
    }

    // Get all .php files in the directory
    $files = glob($directory . '*.php');
    
    // Check if glob found any files
    if ($files === false) {
        error_log("Error reading directory: " . $directory);
        return [];
    }

    // Remove directory path and .php extension
    $filenames = array_map(function($file) {
        return basename($file, '.php');
    }, $files);
    
    $filenames = array_filter($filenames, function($mod) use ($mod_array) {
        return !in_array($mod, $mod_array);
    });
    
    return array_values($filenames); // Re-index array after filtering

}

function ShowCheckBoxValue($val){
    if($val===0){
        $result = "Tidak";
    } else {
        $result = "Ya";
    }
    return $result;
}

function setTheme(){
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/..");
    $dotenv->load();
    $theme = $_ENV["THEME"];
    return $theme;
}

function getHeader($theme_name){
    include("../themes/".$theme_name."/header.php"); 
    include("../themes/".$theme_name."/leftmenu.php"); 
    include("../themes/".$theme_name."/topnav.php");
    include("../themes/".$theme_name."/upper_block.php");
}

function getFooter($theme_name, $extra){
    include("../themes/".$theme_name."/lower_block.php"); 
    echo $extra;
    include("../themes/".$theme_name."/footer.php"); 
    
    echo '</body>
    </html>';
}
function getHeaderLogin($theme_name){
    include("themes/".$theme_name."/headerlogin.php"); 
    include("themes/".$theme_name."/leftmenulogin.php"); 
    include("themes/".$theme_name."/topnavlogin.php");
    include("themes/".$theme_name."/upper_block.php");
}

function getFooterLogin($theme_name, $extra){
    include("themes/".$theme_name."/lower_block.php"); 
    echo $extra;
    include("themes/".$theme_name."/footerlogin.php"); 
    
    echo '</body>
    </html>';
}
function getFilename(){
    $host = $_SERVER["HTTP_HOST"];
    $uri = $_SERVER["REQUEST_URI"];
    $url = "http://".$host.$uri;
    $parsed_url = parse_url($url);

    // Get the path from the parsed URL
    $path = $parsed_url["path"];

    // Use pathinfo to extract the filename
    $file_info = pathinfo($path);

    // Get the filename
    $filename = $file_info["basename"];

    return $filename;
}


function handleFileUpload($file, $id)
{
    // Define the upload directory
    $uploadDir = "images/";

    // Ensure the directory exists
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Get the original filename and its extension
    $originalFilename = $file['name'];
    $fileExtension = strtolower(pathinfo($originalFilename, PATHINFO_EXTENSION));

    // Generate a unique filename to avoid overwriting
    $uniqueFilename = uniqid() . '.' . $fileExtension;

    // Target file path
    $targetFilePath = $uploadDir . $uniqueFilename;

    // Move the uploaded file to the target directory
    if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        // Return success response in JSON format
        return json_encode([
            "status" => "success",
            "message" => "File uploaded successfully.",
            "id" => $id,
            "filename" => $uniqueFilename,
        ]);
    } else {
        // Return error response in JSON format
        return json_encode([
            "status" => "error",
            "message" => "Failed to upload the file.",
        ]);
    }
}

function createThumbnail($sourcePath, $targetPath, $maxWidth = 100, $maxHeight = 100)
{
    // Get image info
    list($width, $height, $type) = getimagesize($sourcePath);

    // Calculate new dimensions
    $ratio = min($maxWidth / $width, $maxHeight / $height);
    $new_width = round($width * $ratio);
    $new_height = round($height * $ratio);

    // Create new image
    $thumb = imagecreatetruecolor($new_width, $new_height);

    // Load source image based on file type
    switch ($type) {
        case IMAGETYPE_JPEG:
            $source = imagecreatefromjpeg($sourcePath);
            break;
        case IMAGETYPE_PNG:
            $source = imagecreatefrompng($sourcePath);
            // Preserve transparency
            imagealphablending($thumb, false);
            imagesavealpha($thumb, true);
            break;
        case IMAGETYPE_GIF:
            $source = imagecreatefromgif($sourcePath);
            break;
        default:
            return false;
    }

    // Resize image
    imagecopyresampled($thumb, $source, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    // Save thumbnail based on original file type
    switch ($type) {
        case IMAGETYPE_JPEG:
            imagejpeg($thumb, $targetPath, 90);
            break;
        case IMAGETYPE_PNG:
            imagepng($thumb, $targetPath, 9);
            break;
        case IMAGETYPE_GIF:
            imagegif($thumb, $targetPath);
            break;
    }

    // Free up memory
    imagedestroy($thumb);
    imagedestroy($source);

    return true;
}
?>
