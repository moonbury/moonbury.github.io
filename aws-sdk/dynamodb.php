<html>
<link rel="stylesheet" href="/style.css">
<body>
-- START --<BR>
<?php

// Require the Composer autoloader.
require 'aws-autoloader.php';

use Aws\DynamoDb\DynamoDbClient;

/*
$dydb = new DynamoDbClient([
    'region'  => 'ap-southeast-1'
]);
*/

$sdk = new Aws\Sdk([
    'region'   => 'ap-southeast-1',
    'version'  => 'latest'
]);
$dynamodb = $sdk->createDynamoDb();

$tableName = 'ProductCatalog';

echo "Initialized dynamodb object.<br>";
//$table = 'music';

// make sure the table is created and with proper key (Id)
$id = rand(1,1000);
echo "# Adding book data (id: $id) to table $tableName...<br>";
$id_str = (string)$id;				// please note the id is in string

$response = $dynamodb->putItem([
    'TableName' => $tableName,
    'Item' => [
        'Id' => ['N' => $id_str],
        'Title' => ['S' => 'Book Title'],
        'ISBN' => ['S' => '1111111111-111'],
        'Authors' => ['SS' => ['Author12', 'Author22']],
        'Price' => ['N' => $id_str],
        'Category' => ['S' => 'Book'],
        'Dimensions' => ['S' => '8.5x11.0x.75'],
        'InPublication' => ['BOOL' => false],
    ],
    'ReturnConsumedCapacity' => 'TOTAL'
]);

echo "Consumed capacity: " . $response ["ConsumedCapacity"] ["CapacityUnits"] . "<br>";

// ###################################################################
// Getting an item from the table

echo "\n\n";
echo "# Getting the added item from table $tableName...<br>";

$response = $dynamodb->getItem ([
    'TableName' => $tableName,
    'ConsistentRead' => true,
    'Key' => [
        'Id' => ['N' => $id_str] 
    ],
    'ProjectionExpression' => 'Id, ISBN, Title, Authors' 
] );
print_r ( $response ['Item'] );

?>
<br>
-- END --
</body>
</html>
