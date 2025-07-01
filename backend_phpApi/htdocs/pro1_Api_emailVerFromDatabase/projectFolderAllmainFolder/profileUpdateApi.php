<?php
session_start(); // // first you want session then you write first

//this is used for (cros) access permission
header("Access-Control-Allow-Origin: *");
header("Access-control-Allow-Methods: POST,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-type: application/json");

require_once 'databaseconfig.php';  // // File include only once 
?>

<?php
//here we used prflied option we  used 
if($_SERVER['REQUEST_METHOD']==='OPTIONS'){
    http_response_code(200);
    exit;
}
?>


<?php
// only POST requests allow 
if($_SERVER['REQUEST_METHOD'] !=='POST'){
    if($_SERVER['REQUEST_METHOD'] ==='GET'){
        echo "this endpoint is for post request ";
        echo "<h3>This API only accepts POST requests. Please use a REST client or frontend form.</h3>";
        exit;
    }
    http_response_code(405);
    echo json_encode(['error'=>'Method is not Allowed']);//convert to json_object
    exit;
}
?>

<?php
// read JSON data 
$jsonData=file_get_contents('php://input');
$data=json_decode($jsonData,true);
if($data==null){
    http_response_code(400);
    echo json_encode(['error'=>"invalid json"]);
    exit;
}else{
    http_response_code(200);//...//send response 200 that 200 means everything is ok(Success)
}
?>






<?php
$response=[];
//Sanitize inputs
$id = filter_var($data['id'] ?? '', FILTER_SANITIZE_NUMBER_INT);
$response['id']=$id;
$finalid=$id;
    $username = htmlspecialchars(
    trim(preg_replace('/[^a-zA-Z]/', '', $data['username'] ?? '')),
    ENT_QUOTES,
    'UTF-8'
);
$response['username']=$username;
$finalusername=$username;
    
// for taking Email input 
$email = trim($data['email'] ?? '');
//first  Sanitize email
$sanitizedEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
$errors = [];

if(empty($sanitizedEmail)) {
    $errors[]="Email cannot be blank";
}else if (filter_var($sanitizedEmail, FILTER_VALIDATE_EMAIL)) {// Then validate
    // ✅ Email is valid
    $response['valid_email']=$sanitizedEmail;
    $finalEmail = $sanitizedEmail; //this is for bind_param
}else {
    // ❌ Invalid email
    $errors[]="invalid email format";
    
}




$mobile = trim($data['mobile'] ?? '');
// Remove all non-digit characters (optional)
$sanitizedMobile = filter_var($mobile, FILTER_SANITIZE_NUMBER_INT);
 if (empty($sanitizedMobile)) {
    // "mobile cannot be blank";
    $errors[]="mobile cannot be blank";
}else if (preg_match('/^[6-9][0-9]{9}$/', $sanitizedMobile)) {// Check if mobile is exactly 10 digits (Indian format example)
    //echo "Valid mobile number: " . $sanitizedMobile;
    $response['valid_mobile_number']=$sanitizedMobile;
    $finalmobile=$sanitizedMobile;
}else{
    //echo "Invalid mobile number.";
   $errors[]="invalid_mobile_number";
}






// Only proceed if email and mobile valid
if (isset($response['valid_email'])){
    if(isset($response['valid_mobile_number'])){
// from here we see will update
if($databaseconfig->connect_error){
    die("connection fail error.".$databaseconfig->connect_error);
}else{
$sql="UPDATE `registration` SET `username`=?,
`email`=?,`mobile`=? WHERE id=?";
 // Prepare the statement
$stmt=$databaseconfig->prepare($sql);
    // Bind the parameters
$stmt->bind_param("sssi", $finalusername, $finalEmail, $finalmobile, $finalid);
    // "sssi" means: string, string, string, integer

if($stmt->execute()){
       // "Profile updated successfully!";
       $response['message']="Profile updated successfully!";
       
}
else{
    // "Update failed: ";
        $errors[]='failed update';
}
   // Close
    $stmt->close();
    $databaseconfig->close();
}}else{
$errors[] = " mobile validation failed. Update aborted.";
}}else{
     $errors[] = "Email validation failed. Update aborted.";
}
if(count($errors)>0){
  $response['errors'] = $errors;
    echo json_encode($response);
    exit;
}else{
echo json_encode($response);
}
?>