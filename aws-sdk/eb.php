<html>
<link rel="stylesheet" href="/style.css">
<body>
-- START --<BR>
<?php

// Require the Composer autoloader.
require 'aws-autoloader.php';

use Aws\ElasticBeanstalk\ElasticBeanstalkClient;

// Instantiate an Amazon S3 client.
$eb = new ElasticBeanstalkClient([
    'version' => 'latest',
    'region'  => 'ap-southeast-1'
]);

echo "<b># Initialized ElasticBeanstalkClient object.</b><br>";

echo "<b># describe the application</b><br>";

$result = $eb->describeApplicationVersions([
    'ApplicationNames' => 'elasticbeans-env'
]);

echo "<pre>";
print_r($result);
echo "</pre>";
?>
<br>
-- END --
</body>
</html>
