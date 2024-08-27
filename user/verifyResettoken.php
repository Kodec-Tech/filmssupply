<?php
include_once 'connection.php';
include_once "../config.php";



class VerifyResettoken
{
    private $token;
    private $newpassword;
    private $confirm_Password;
    private $conn;
    public $email;
    public $username;

    const INVALID_CREDENTIALS = 100;
    const INTERNAL_ERROR = 101;
    const TOKEN_EXPIRED = 102;
    const INVALID_TOKEN = 103;

    function __construct($conn, $token)
    {
        $this->conn = $conn;
          if (empty(trim($token))) {
               return json_encode(array("code" => VerifyResettoken::INVALID_CREDENTIALS, "error" => "Invalid  token "));
        }
        $this->token = $token;

        $this->email = $this->GetEmail();
        // $this->username = $this->GetUsername();
    }

    private function GetEmail()
    {

        if (empty($this->token)) {
            echo json_encode(["error" => "Invalid Credentials "]);
            die();
        }

        if ($this->checkTokenNotExpired() !== true) {
            return $this->checkTokenNotExpired();
        }


        $sql = "select email,token from forgot_password where token =?";
        $stmt = mysqli_prepare($this->conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $this->token);
        mysqli_execute($stmt);
        // echo $this->token;
        $result = mysqli_stmt_get_result($stmt);
        if (!$result) {
            echo json_encode(["error" => "Internal server error"]);
            die();
        }


        //   fetch the email 
        if (mysqli_num_rows($result) > 0) {
            return $result->fetch_assoc()['email'];

        } else {
            echo json_encode(["token" => $this->token, "error" => "email does not exist "]);
            die();
        }
    }


    private function GetUsername()
    {
        // TODO need to get username so i can know the table to be updated 
        $sql = "select C_email from customer_detail where C_Email =?";
        $stmt = mysqli_prepare($this->conn, $sql);
        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $this->email);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
        } else {
            echo json_encode(["error" => "Internal server error " . mysqli_error($this->conn)]);
            die();

        }



        if (!$result) {
            echo json_encode(["error" => "Internal server error"]);
            die();


        }


        //   fetch the email 
        if (mysqli_num_rows($result) == 1) {
            return $result->fetch_assoc()['C_email'];

        } else {
            echo json_encode(["error" => "email does not exist "]);
            die();
        }
    }

    public function checkTokenNotExpired()
    {
        $pattern = "/^[0-9a-f]{50}$/i"; // a regex pattern for hex string of 100 chars
        if (strlen(trim($this->token))<50) {
            return json_encode(array("code" => VerifyResettoken::INVALID_CREDENTIALS, "error" => "Invalid Credentials: token missmatched"));
        } else {
            $sql = "SELECT * FROM forgot_password where token = ? ";
            date_default_timezone_set(date_default_timezone_get());
            $current_date = date('Y-m-d H:i:s');

            $stmt = mysqli_prepare($this->conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $this->token);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            if (!$result) {
                return json_encode(array("code" => VerifyResettoken::INTERNAL_ERROR, "error" => "An internal error occurred!"));
            }

            if (mysqli_num_rows($result) == 1) {
                if ($current_date > $result->fetch_assoc()['expiry_time']) {
                    return json_encode(array("code" => VerifyResettoken::TOKEN_EXPIRED, "error" => "Token expired!"));
                }
            } else {
                return json_encode(["code" => VerifyResettoken::INVALID_CREDENTIALS, "error" => "Invalid Credentials"]);
            }
        }
        return true;

    }

    public function validatePassword($password, $confirm_Password)
    {
        $regex = "/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/m";

        if (empty($password)) {
            echo json_encode(["code" =>400, "error" => "Password can not be empty"]);
            die();
        }

        if (!preg_match($regex, $password)) {
            echo json_encode(["code" => 400, "error" => "Password must be between 8 and 16 characters long with 1 uppercase, 1 lowercase, and 1 special character"]);
            die();
        }
    
        if ($password !== $confirm_Password) {
            echo json_encode(["code" => 400, "error" => "Passwords don't match"]);
            die();
        }

        return true;
    }




    private function GetAccountNumber()
    {
        $sql = "Select Account_No from customer_detail where C_Email =  ?";
        $stmt = mysqli_prepare($this->conn, $sql);

        mysqli_stmt_bind_param($stmt, "s", $this->email);
        mysqli_stmt_execute($stmt);


        $result = mysqli_stmt_get_result($stmt);

        if (!$result) {
            return json_encode(array("code" => VerifyResettoken::INTERNAL_ERROR, "error" => "An internal error occurred!"));
        }

        return $result->fetch_assoc()['Account_No'];
    }

    public function UpdatePassword($password)
    {
        $tokenResult = $this->checkTokenNotExpired();
        if ($tokenResult !== true) {
            return $tokenResult;
        }
    
        $password = md5($password);
        $accountNo = $this->GetAccountNumber();
    
        $sql = "UPDATE login SET password = ? WHERE AccountNo = ?";
        $stmt = mysqli_prepare($this->conn, $sql);
    
        mysqli_stmt_bind_param($stmt, "ss", $password, $accountNo);
        mysqli_stmt_execute($stmt);
    
        // Check if the UPDATE operation was successful
        $affectedRows = mysqli_stmt_affected_rows($stmt);
        if ($affectedRows === -1) {
            return json_encode(array("code" => VerifyResettoken::INTERNAL_ERROR, "error" => "An internal error occurred!"));
        }
    
        return json_encode(['success' => 'Password Updated Successfully!', 'code' => 200]);
    }
    
}

$verify = new VerifyResettoken($conn, isset($_POST['token']) ? $_POST['token']: '');
$response = json_encode(array("code" => 003, "error" => "Unknown error"));
if (!empty($_POST['password']) && !empty($_POST['confirm_password'])) {
    if ($verify->validatePassword($_POST['password'], $_POST['confirm_password'])) {
        $response = $verify->UpdatePassword($_POST['password']);
    }else{
$response = json_encode(array("code" => 003, "error" => "Unknown error3"));

    }

}else{
$response = json_encode(array("code" => 003, "error" => "Unknown error2"));

}

echo $response;