<?php

require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

// Replace these values with your actual AWS credentials and S3 bucket details
$awsAccessKeyId = 'your-access-key-id';
$awsSecretAccessKey = 'your-secret-access-key';
$bucketName = 'compliance-s.s3.ap-south-1.amazonaws.com';
$objectKey = 'banner/banner_image1.png';

// Create an S3 client
$s3 = new S3Client([
    'version' => 'latest',
    'region' => 'ap-south-1', // Update with your region
    'credentials' => [
        'key' => $awsAccessKeyId,
        'secret' => $awsSecretAccessKey,
    ],
]);

try {
    // Get the object URL
    $objectUrl = $s3->getObjectUrl($bucketName, $objectKey);

    // Output the HTML to display the image
    echo '<html>';
    echo '<head>';
    echo '<title>SSN</title>';
    echo '</head>';
    echo '<body>';
    echo '<h1>SSN Images</h1>';
    echo '<img src="' . $objectUrl . '" alt="Banner Image">';
    echo '</body>';
    echo '</html>';
} catch (AwsException $e) {
    echo 'Error: ' . $e->getAwsErrorMessage();
}

?>
