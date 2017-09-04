<html>
<link rel="stylesheet" href="/style.css">
<body>
-- START --<BR>
<?php

$target_dir = "video/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;

// Check file size
if ($_FILES["fileToUpload"]["size"] > 100000000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
Upload file complete."<br>

<?php

// Require the Composer autoloader.
require 'aws-autoloader.php';

use Aws\S3\S3Client;

// Instantiate an Amazon S3 client.
$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'ap-southeast-1'
]);

echo "Initialized s3 object.<br>";

// $filename = "kitagawa".rand(1,100).".jpg";
$filename = $target_file;

// Upload a publicly accessible file. The file size and type are determined by the SDK.
try {
    $s3->putObject([
        'Bucket' => 'elasticbeanstalk-ap-southeast-1-045451481687',
        'Key'    => $filename,
        'Body'   => fopen($filename, 'r'),
        'ACL'    => 'public-read',
    ]);
} catch (Aws\Exception\S3Exception $e) {
    echo "There was an error uploading the file.\n";
}


$url = "http://cdn.moonbury.de/".basename( $_FILES["fileToUpload"]["name"]);
echo "uploading image(" . $_FILES["fileToUpload"]["name"] . ") to s3 buckets. url: <a href='$url'>$url</a><br>";

echo "Listing out s3 buckets.<br>";
$result = $s3->listBuckets();
foreach ($result['Buckets'] as $bucket) {
    echo $bucket['Name'] . "\n";
}

?>
<br>
-- END --
</body>
</html>
