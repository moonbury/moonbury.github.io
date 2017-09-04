<html>
<link rel="stylesheet" href="/style.css">
<body>
-- START --<BR>
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
$bucket = 'elasticbeanstalk-ap-southeast-1-045451481687';

echo "<b>Listing out s3 buckets: $bucket</b><br>";

$iterator = $s3->getIterator('ListObjects', array('Bucket' => $bucket));
foreach ($iterator as $obj) {
	echo $obj['Key'] . "<br>";
}

echo "<br><b>Bucket Policy</b><BR>";
$result = $s3->getBucketPolicy(['Bucket' => $bucket]);
echo $result['Policy'];

?>
<br>
-- END --
</body>
</html>
