<?php
session_start(); // first you want session then you write first
require_once 'databaseconfig.php';  // File include only once 
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
$email=filter_var($data['email']??'',FILTER_SANITIZE_EMAIL);
$createPassword=htmlspecialchars($data['createPassword']??'',ENT_QUOTES,'UTF-8');
?>

<?php
//store data into session
?>

<?php
//VALIDATION
if( empty($email) || empty($createPassword)){
    http_response_code(400);
    echo json_encode(['error'=>"All fields are required"]);
    exit;
}

if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    http_response_code(400);
    echo json_encode(['error'=>'invalid email']);
    exit;
}

// Common password validation regex
$passwordPattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/";
if(!preg_match($passwordPattern,$createPassword)){
http_response_code(400);
echo json_encode(['error'=>'Password must be at least 8 characters long and include uppercase, lowercase, number, and special character.']);
exit;
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

if ($result->num_rows > 0) {//here in this check emmail exit or not into database
    $row = $result->fetch_assoc(); // ✅ This is important
    $enteredPassword = $row['password'];
    $enterEmail = $row['email'];

    // Email checking
    if ($enterEmail === $email) {
        if (password_verify($createPassword, $enteredPassword)) {
            $_SESSION['id']=$row['id'];//Session store
            $_SESSION['username'] = $row['username']; // Session store
            $_SESSION['email']=$row['email'];//Session Store
            $_SESSION['mobile']=$row['mobile'];
            echo json_encode([
                'message' => "success",
                'id'=>  $_SESSION['id'],
                'username' => $_SESSION['username'],
                'email'=>$_SESSION['email'],
                'mobile'=>$_SESSION['mobile']
            ]);
        } else {
            echo json_encode(['error' => "invalid password, no match in database"]);
        }
    } else {
        echo json_encode(['error' => 'no email match']);
    }
} else {
    echo json_encode(['error' => 'email  did not match in database, please try again']);
}

?>
