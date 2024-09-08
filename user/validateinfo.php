<?php
session_start();
include "connection.php";
include '../mail/mail_config.php';



//lets check if submit button is clickec
if (isset($_POST['submit-register'])) {
    //gathering basic details from user and setting some
    //setting some
    $Account_Type = "Saving";
    $Account_Status = "Active";
    $Balance = "0.0";
    $ref_bonus = "0.0";
    $SavingBalance = "0.0";
    $bonus = "300";





    // Function to generate a random 4-digit numeric string
    function generateNumericUID($length = 4)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[mt_rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }


    do {
        $Uid = generateNumericUID();

        //Check if Account_No (UID) already exist in db
        $sqlUid = "SELECT * FROM customer_detail WHERE Account_No = ?";
        $UidStmt = mysqli_prepare($conn, $sqlUid);
        mysqli_stmt_bind_param($UidStmt, "s", $Uid);
        mysqli_stmt_execute($UidStmt);
        $UidResult = mysqli_stmt_get_result($UidStmt);
    } while (mysqli_num_rows($UidResult) > 0);

    //assign our account number
    $Account_Number = $Uid;








    //Gathering user details

    $email = htmlspecialchars($_POST['email'] ?? '');
    $firstname = htmlspecialchars($_POST['firstname']);
    $lastname = htmlspecialchars($_POST['lastname']);
    $username = htmlspecialchars($_POST['username']);
    $invite_code = htmlspecialchars($_POST['invite-code']);
    $pwd = $_POST['password'];
    $cpwd = htmlspecialchars($_POST['retype-password']);
    $withdrawal_pin = htmlspecialchars($_POST['withdrawal_pin']);
    $currency = htmlspecialchars($_POST['currency']);
    $phone = htmlspecialchars($_POST['phone']);



    // ----------- Random Color Hex Generator for Profile ------------------

    $hex = '#';

    //Create a loop.
    foreach (array('r', 'g', 'b') as $color) {
        //Random number between 0 and 255.
        $val = mt_rand(0, 255);
        //Convert the random number into a Hex value.
        $dechex = dechex($val);
        //Pad with a 0 if length is less than 2.
        if (strlen($dechex) < 2) {
            $dechex = "0" . $dechex;
        }
        //Concatenate
        $hex .= $dechex;
    }

    //Print out our random hex color.
    // echo $hex;





    // =========== Hashing password ==============
    // $hashPass = md5($pwd);
    $hashPass = password_hash($pwd, PASSWORD_DEFAULT);





    // ============= Default invite code ===========
    $default_invite_code = "PWEVX";


    // ============= Generate Random user invite code ========
    function generateInviteCode()
    {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $inviteCode = '';
        $maxIndex = strlen($characters) - 1;
        $length = mt_rand(5, 5); // Random length between 5 and 6 characters

        for ($i = 0; $i < $length; $i++) {
            $inviteCode .= $characters[mt_rand(0, $maxIndex)];
        }

        return $inviteCode;
    }

    // Generate a unique invite code
    $inviteCode = generateInviteCode();
    $unique_invite_code = strtoupper($inviteCode);






    // Check if email already exists
    if(!empty($email)){
    $sqlEmail = "SELECT * FROM customer_detail WHERE C_Email = ?";
    $EmailStmt = mysqli_prepare($conn, $sqlEmail);
    mysqli_stmt_bind_param($EmailStmt, "s", $email);
    mysqli_stmt_execute($EmailStmt);
    $EmailResult = mysqli_stmt_get_result($EmailStmt);

    if (mysqli_num_rows($EmailResult) > 0 ) {
        // Email already exists, handle accordingly (e.g., display an error message)
        header('location: CreateAccount.php?signup=emailexist&firstname=' . $firstname . '&username=' . $username . '&lastname=' . $lastname);
    }
    }





    $DBusername = null; //initializing for clearity 

    // Check if username already exists
    $sql = "SELECT * FROM login WHERE Username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result_DBusername = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result_DBusername)) {
        while ($row = mysqli_fetch_assoc($result_DBusername)) {
            $DBusername = $row['Username'];
        }
    }


    //lets convert the usernames to lower strings
    if ($DBusername !== null) {
        $DBusernameLower = strtolower($DBusername);
    }

    $usernameLower = strtolower($username);



    // Check if invitation code already exist in DB

    $DBinvite_code = null; //initialization incase of error

    $sql = "SELECT * FROM accounts WHERE invite_code = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $invite_code);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result)) {
        while ($row = mysqli_fetch_assoc($result)) {
            $DBinvite_code = $row['invite_code'];
            $Refusername = $row['username'];
        }
    }



    // Checking for some errors

    // if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    //     header('location: CreateAccount.php?signup=invalidmail&username=' . $username . '&lastname=' . $lastname . '&firstname=' . $firstname);
    //     exit();
    // }
    // Check for the use of symbol characters
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        header("location: CreateAccount.php?signup=char&email=$email&firstname=$firstname&lastname=$lastname");
        exit();
    }
    // Pwd 6-8 character only

    elseif (!preg_match('/^.{6,8}$/', $pwd)) {
        header('location: CreateAccount.php?signup=lowpwd&email=' . $email . '&username=' . $username . '&firstname=' . $firstname . '&lastname=' . $lastname);
        exit();
    }
    // Check if pwd retype matches
    elseif ($pwd != $cpwd) {
        header('location: CreateAccount.php?signup=wrongpwd&email=' . $email . '&username=' . $username . '&firstname=' . $firstname . '&lastname=' . $lastname);
        exit();
    } elseif (empty($username)  || empty($pwd) || empty($cpwd) || empty($firstname) || empty($lastname)) {
        header('location: CreateAccount.php?signup=empty&email=' . $email . '&username=' . $username . '&firstname=' . $firstname . '&lastname=' . $lastname);
        exit();
    }
    // Check if username already exists
    elseif (isset($DBusernameLower) && $DBusernameLower === $usernameLower) {
        header('location: CreateAccount.php?signup=userExist&email=' . $email . '&firstname=' . $firstname . '&username=' . $username . '&lastname=' . $lastname);
        exit();
    }
    // Check if its not the default invite code and  check if exisiting in DB
    elseif (strtoupper($default_invite_code) != strtoupper($invite_code) && strtolower($DBinvite_code) != strtolower($invite_code)) {
        header('location: CreateAccount.php?signup=wrongInvite&email=' . $email . '&firstname=' . $firstname . '&username=' . $username . '&lastname=' . $lastname);
        exit();
    }

    //check for withdrawal pin for 6 digits
    elseif (!preg_match('/^\d{6}$/', $withdrawal_pin)) {
        header('location: CreateAccount.php?signup=wrongpin&email=' . $email . '&firstname=' . $firstname . '&username=' . $username . '&lastname=' . $lastname . '&invitecode=' . $invite_code);
        exit();
    } else {


        // Include Mail sending file
        //include '../mail/mail_config.php';
        $mail = $email;
        $name = $username;
        echo "<br>";

        // Create Otp
        $otp = rand(100000, 999999);

        echo "<br>";



        // storing otp to server 
        $_SESSION['otp'] = $otp;

        // Calling Otp Function to send email
        //sendOtp($mail, $otp, $name);


        // Inserting data to customer_detail table using prepared statement
        $sql = "INSERT INTO customer_detail (Account_No, C_First_Name, C_Last_Name, Gender, C_Father_Name, C_Mother_Name, C_Birth_Date, C_Adhar_No, C_Pan_No, C_Mobile_No, C_Email, C_Pincode, C_Adhar_Doc, C_Pan_Doc, ProfileColor, ProfileImage, Bio, Country, downline, withdrawal_pin, currency) VALUES (?, ?, ?, 'Not Available', '', '', '', '', '', ?, ?, '', '', '', ?, '', '', '', ?, ?, ?)";

        $stmt = mysqli_prepare($conn, $sql);

        // Binding variables to placeholders in mysqli_stmt_bind_param
        mysqli_stmt_bind_param($stmt, "sssssssss", $Account_Number, $firstname, $lastname, $phone, $email, $hex, $referrer, $withdrawal_pin, $currency);

        // No need to set values directly in mysqli_stmt_execute
        $result = mysqli_stmt_execute($stmt);

        if (!$result) {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }


        // SQL for account table using prepared statement
        $account_query = "INSERT INTO accounts (AccountNo, Balance, SavingBalance, SavingTarget, AccountType, State, username, ref_bonus, invite_code, referral, bonus) VALUES (?, ?, ?, '', ?, '0', ?, ?, ?, ?, ?)";

        $stmtAccount = mysqli_prepare($conn, $account_query);

        mysqli_stmt_bind_param($stmtAccount, "sssssssss", $Account_Number, $Balance, $SavingBalance, $Account_Type, $username, $ref_bonus, $unique_invite_code, $Refusername, $bonus);

        $accountresult = mysqli_stmt_execute($stmtAccount);

        if (!$accountresult) {
            echo "Error: " . $account_query . "<br>" . mysqli_error($conn);
        }

        // SQL for login using prepared statement
        $loginsql = "INSERT INTO login (AccountNo, Username, Password, Status, State, AuthKey) VALUES (?, ?, ?, ?, '0', '0')";

        $stmtLogin = mysqli_prepare($conn, $loginsql);

        mysqli_stmt_bind_param($stmtLogin, "ssss", $Account_Number, $username, $hashPass, $Account_Status);

        $result = mysqli_stmt_execute($stmtLogin);

        if (!$result) {
            echo "Error: " . $loginsql . "<br>" . mysqli_error($conn);
        }




        //Sql for membership table
        $membership_query = "INSERT INTO mymembership (AcctNo, username) VALUES (?, ?);";
        $stmtMembership = mysqli_prepare($conn, $membership_query);

        mysqli_stmt_bind_param($stmtMembership, "ss", $Account_Number, $username);

        $membershipResult = mysqli_stmt_execute($stmtMembership);

        if (!$membershipResult) {
            echo "Error: " . $membership_query . "<br>" . mysqli_error($conn);
        }










        //Storing Email and username in a session to Send Registration successful Mail
        $_SESSION['firstname'] = $username;
        $_SESSION['email'] = $email;


        //From this session we visit the validateotp to send them the email













        // header('location: UserData/Dashboard.php?signup=success');








        $query = "SELECT ID, Username, Password, AccountNo, Status, State FROM login WHERE Username= '{$username}'";


        $result = mysqli_query($conn, $query) or die("Query Fail.");

        if (mysqli_num_rows($result) > 0) {

            while ($row = mysqli_fetch_assoc($result)) {

                $status = $row['Status'];
                $state = $row['State'];
                $DbPassword = $row['Password'];

            if (password_verify($pwd, $DbPassword)) {

                if ($state == 0) {
                    if ($status == "Active") {


                        session_start();
                        $_SESSION['username'] = $row['Username'];
                        $_SESSION['verifyCode'] = $row['Username'];
                        // $_SESSION['id'] = $row['ID'];
                        $_SESSION['accountNo'] = $row['AccountNo'];
                        //For 2factor authentication 
                        //header("Location: ../user/twostepverify.php");
                        //header to dashboard directly




                        header("location: ../user/UserData/Dashboard.php");
                        mysqli_close($conn);
                    }
                }
            }

            }
        }
    }
} else {
    header("location: CreateAccount.php?signup=error");
}
