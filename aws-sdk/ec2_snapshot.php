<html>
<link rel="stylesheet" href="/style.css">
<body>
-- START --<BR>
<?php

// Require the Composer autoloader.
require 'aws-autoloader.php';

use Aws\Ec2\Ec2Client;

// Instantiate an Amazon S3 client.
$ec2 = new Ec2Client([
    'version' => 'latest',
    'region'  => 'ap-southeast-1'
]);

echo "# Initialized ec2 object.<br>";

echo "<b># create a snapshot for my ec2</b><br>";

$result = $ec2->createSnapshot([         // the flag dry run return error but real run ok.
    'Description' => 'create snapshot from php',
    'DryRun' => false,
    'VolumeId' => 'vol-fce56926', // REQUIRED
]);
echo "<pre>";
print_r($result);
echo "</pre>";
?>
<br>
-- END --
</body>
</html>
