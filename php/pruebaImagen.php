<?php

// VARIABLES
// These are used in multiple places in the request. Replace the
// values with ones appropriate to you.
$accessKeyId = 'AKIAJDYNJSPSOZO4T4SQ';
$secretKey = 'EI+6fFrrxBOv8Ua4jF+y5T9shKEC2lTg8DMv8FkC';
$bucket = 'ac-automotor';
$region = 'us-west-2'; // us-west-2, us-east-1, etc
$acl = 'public-read'; // private, public-read, etc
$params = explode(",",$argv[1]);
$imagen= $params[0];
$filePath = $imagen['lob_upload']['tmp_name'];
$fileName = $imagen['lob_upload']['name'];
$fileType = pathinfo($fileName, PATHINFO_EXTENSION);

// POST POLICY
// Amazon requires a base64-encoded POST policy written in JSON.
// This tells Amazon what is acceptable for this request. For
// simplicity, we set the expiration date to always be a day in
// the future. The two "starts-with" fields are used to restrict
// the content of "key" and "Content-Type", which are specified
// later in the POST fields. Again for simplicity, we use blank
// values ('') to not put any restrictions on those two fields.
$policy = base64_encode(json_encode(array(
    'expiration' => gmdate('Y-m-d\TH:i:s\Z', time() + 86400),
    'conditions' => array(
        array('acl' => $acl),
        array('bucket' => $bucket),
        array('starts-with', '$key', ''),
        array('starts-with', '$Content-Type', '')
    )
)));

// SIGNATURE
// A base64-encoded HMAC hashed signature with your secret key.
// This is used so Amazon can verify your request, and will be
// passed along in a POST field later.
$signature = hash_hmac('sha1', $policy, $secretKey, true);
$signature = base64_encode($signature);

// CURL
// Pass in the full URL to your Amazon bucket. Set
// RETURNTRANSFER and HEADER true to see the full response from
// Amazon, including body and head. Set POST fields for cURL.
// Execute the cURL request.
$url = 'https://' . $bucket . '.s3-' . $region . '.amazonaws.com';
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HEADER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, array(
    'key' => $fileName,
    'AWSAccessKeyId' =>  $accessKeyId,
    'acl' => $acl,
    'policy' =>  $policy,
    'Content-Type' =>  $fileType,
    'signature' => $signature,
    'file' => new CurlFile($_FILES['lob_upload']['tmp_name'], $fileType, $fileName)
));
$response = curl_exec($ch);

// RESPONSE
// If Amazon returns a response code of 204, the request was
// successful and the file should be sitting in your Amazon S3
// bucket. If a code other than 204 is returned, there will be an
// XML-formatted error code in the body. For simplicity, we use
// substr to extract the error code and output it.
if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 204) {
    echo 'Success!';
    $url="http://$bucket.s3.amazonaws.com/$fileName";
    $eUrl = hash('sha512', $url);
    echo $eUrl;
} else {
    $error = substr($response, strpos($response, '<Code>') + 6);
}
