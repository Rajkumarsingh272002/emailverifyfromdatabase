<?php
session_start(); // if you want session then now first start session
require_once 'databaseconfig.php';  // file read only once
?>
<?php 
//this is used for (cros) access permission
header("Access-Control-Allow-Origin: *");
header("Access-control-Allow-Methods: POST,OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-type: application/json");
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
//Sanitize inputs
$username=htmlspecialchars($data['fullName']);
$email=filter_var($data['email']??'',FILTER_SANITIZE_EMAIL);
$phoneNumber=filter_var($data['phoneNumber']??'',FILTER_SANITIZE_NUMBER_INT);
$createPassword=htmlspecialchars($data['createPassword']??'',ENT_QUOTES,'UTF-8');
//htmlspecialchars() HTML tags and special characters getting neutral bana .
//ENT_QUOTES: Single and double quotes both encode .
//'UTF-8': define Encoding 
$repeatPassword=htmlspecialchars($data['repeatPassword']??'',ENT_QUOTES,'UTF-8');
?>

<?php
//store data into session
$_SESSION['name']=$username;
?>

<?php
//VALIDATION
if(empty($username) || empty($email) || empty($phoneNumber) || empty($createPassword) || empty($repeatPassword)){
    http_response_code(400);
    echo json_encode(['error'=>"All fields are required"]);
    exit;
}

if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    http_response_code(400);
    echo json_encode(['error'=>'invalid email']);
    exit;
}

if(!ctype_digit($phoneNumber)){
    http_response_code(400);
    echo json_encode(['error'=>'invalid phone  number']);
    exit;
}
// Common password validation regex
$passwordPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/";
if(!preg_match($passwordPattern,$createPassword)){
http_response_code(400);
echo json_encode(['error'=>'Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.']);
exit;
}

if(!preg_match($passwordPattern,$repeatPassword)){
    http_response_code(400);
    echo json_encode(['error'=>'Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.']);
    exit;
    }
    
if($createPassword !==$repeatPassword){//value and data type both check 
http_response_code(400);
echo json_encode(['error'=>" create-password and repeat-password did not match"]);
exit;
}else{    
//password decrypt
// Hash the password using bcrypt (default algorithm)
        $hashPassword=password_hash($createPassword,PASSWORD_DEFAULT);
        $hashRepeatPassword=password_hash($repeatPassword,PASSWORD_DEFAULT);
}
?>

<?php
//select data
if($databaseconfig->connect_error){
    die("connection failed.".$databaseconfig->connect_error);
}else{
    $email2 = $databaseconfig->real_escape_string($email); // basic sanitization// your wish , you can do commit of real_escape_string() bocz we used prepare() and in this prepare already sanitize available
    $sql = "SELECT * FROM registration WHERE email = ?";
    $stmt=$databaseconfig->prepare($sql);
    $stmt->bind_param('s',$email2);// 's' means string
    $stmt->execute();
    $result =$stmt->get_result();
}

if($result->num_rows > 0){//here in this check emmail exit or not into database
    echo json_encode(['error'=>"email already exists"]);
}else{
    $sql="INSERT INTO registration( username, email, mobile, password, cpassword) VALUES(?,?,?,?,?)";
    $stmt=$databaseconfig->prepare($sql);
    $stmt->bind_param('sssss',$username, $email, $phoneNumber, $hashPassword, $hashRepeatPassword);
    $stmt->execute();
    echo json_encode([
        'message'=>'successfull create account plz login',
        'fullName'=>$username,
        'email'=>$email,
        'phonenumber'=>$phoneNumber,
        
]);
}
?>
