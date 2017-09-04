<html>
<link rel="stylesheet" href="/style.css">
<body>
<b>AWS SDK for php v3</b><br>

<li>upload files to cdn (20 MB limits)
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select file to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>
<br>
</li>

<li><a href='list_bucket.php'>list my bucket content</a></li>
<li><a href='dynamodb.php'>list my dynamodb content</a></li>
<li><a href='ec2_snapshot.php'>ec2 - create snapshot (Note: there is upper limit)</a></li>
<li><a href='eb.php'>elasticbeans</a></li>
</ol>
</body>
</html>