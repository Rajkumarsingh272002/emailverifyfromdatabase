<?php
session_start(); // if you want session then you first write this
require_once 'databaseconfig.php';  // once time include file 
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
// only allow POST requests 
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
    http_response_code(200);//send response 200 that 200 means everything is ok(Success)
}

?>

<?php
 $id=$data['id'];
$currentPassword=$data['currentPassword'];
$newPassword=$data['newPassword'];
$confirmPassword=$data['confirmPassword'];

//we take error-array for store multiple error
$errorFromServer=[];
//we send echo to client browser of data
$responseFromServer=[];
// this is uded for verify database connection
if($databaseconfig->connect_error){
    $errorFromServer[]="database connection failed";
}else{
    // Step 2: Check if user exists
    $sql="SELECT * FROM `registration` WHERE id=?";
    $stmt=$databaseconfig->prepare($sql);
    $stmt->bind_param('i',$id);
    $stmt->execute();
   $result= $stmt->get_result();
}

// verify result and data reget
if($result->num_rows>0){
    $row=$result->fetch_assoc();
    $username=$row['username'];
    $responseFromServe['username']=$username;
 
}else {
        //echo "no rows available in registraion table";
       $errorFromServer[]="no rows available in registraion table";
        //exit;
}

// Step 3: Match current password (assuming password is hashed)
if(!password_verify($currentPassword, $row['password'])){
    //echo "current password is incorrect";
    $errorFromServer[]="current password is incorrect";
    //exit;
}else{
   // echo "</br>current password is match";
    $responseFromServe['curr_passwordMatch']="current password is match";
}





// Step 4: Check new-password and confirm-Password are match
if($newPassword !== $confirmPassword){
     $errorFromServer[]="new-password and confirm-password did not match";

     
// Step 5: Update password message
}else{
    $responseFromServe['newPass_currPass_doneMatch']="new-password and confirm-password done match";
}


   // Step 6: If no errors, update the password
    if (count($errorFromServer) === 0) {
        $newhashpassword=password_hash($newPassword,PASSWORD_DEFAULT);
$newcreatedAt=date('y-m-d H:i:s');
$updateSql="UPDATE `registration` SET `password`=?,`cpassword`=?,`created_at`=? WHERE id=?";
$prepare=$databaseconfig->prepare($updateSql);
// check prepare become successful or not 
if ($prepare === false) {
    die("Prepare failed: (" . $databaseconfig->errno . ") " . $databaseconfig->error);
    //exit;
}else{
   // echo "</br>prepare not failed";  //comment remove you can check
}

//(bind parameter)
$prepare->bind_param('sssi',$newhashpassword,$newhashpassword,$newcreatedAt,$id);
//(execute statement)
//(verify result)
$updatePreparestatementExecute = $prepare->execute();
if($updatePreparestatementExecute){
    
    $responseFromServe['Pass_change_succ']="password change successfully";

}else{
   $errorFromServer[]="password not chnage successfully";
}
}
else{
    $errorFromServer[]="some littele errors occur";
}

//check error
if(count($errorFromServer)>0){
    echo json_encode($errorFromServer);
    exit;
}else{
    //if no error send ($responseFromServe)
echo json_encode($responseFromServe);
}
//for prepare and databaseconfig closing
$prepare->close();
$databaseconfig->close()


?>