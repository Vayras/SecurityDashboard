

<?php
   // Check if the form was submitted
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      // Check if a file was uploaded
      if(isset($_FILES["file"])) {
         
         // Set file name and path
         $target_dir = "uploads/";
         $target_file = $target_dir . basename($_FILES["file"]["name"]);
         
         // Check if file already exists
         if(file_exists($target_file)) {
            echo "Sorry, file already exists.";
            exit();
         }
         
         // Check file size
         if($_FILES["file"]["size"] > 500000000) {
            echo "Sorry, your file is too large.";
            exit();
         }
         
         // Allow certain file formats
         $allowed_types = array("jpg", "jpeg", "png", "gif", "mp4", "avi", "mov", "wmv");
         $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
         if(!in_array($file_type, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG, GIF, MP4, AVI, MOV, and WMV files are allowed.";
            exit();
         }
         
         // Upload file
         if(move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
            echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded.";
         } else {
            echo "Sorry, there was an error uploading your file.";
         }
         
       // Save file path to database
             // Save file path and type to database
$conn = new mysqli('localhost', 'shivam112', 'm0mandp4p4', 'mydatabasenew');
$stmt = $conn->prepare("INSERT INTO files (filepath, filename, filetype) VALUES (?, ?, ?)");

if(!$stmt) {
    echo "Error: " . mysqli_error($conn);
    exit();
}
$file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
$stmt->bind_param("sss", $target_dir, basename($_FILES["file"]["name"]), $file_type);


//$stmt->bind_param("ss", $target_file, $file_type);
$stmt->execute();
$stmt->close();
$conn->close();

   }
}     
      
      
   



  