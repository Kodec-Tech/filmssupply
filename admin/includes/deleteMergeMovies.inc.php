<?php
include "../connection.php";


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    if (isset($_POST['id'], $_POST['amount_processing'], $_POST['account_number'])) {

        $id = $_POST['id'];
        $amount_processing = $_POST['amount_processing'] ?? '';
        $account_number = $_POST['account_number'];


        //fetch user current level
        // ============ MEMBERSHIP STUFF STARTS HERE ============
        //give level empty to avoid errors
        $level = '';

        $member_sql = "SELECT level FROM mymembership WHERE AcctNo = ?;";
        $memberStmt = mysqli_prepare($conn, $member_sql);
        mysqli_stmt_bind_param($memberStmt, 's', $account_number);
        mysqli_stmt_execute($memberStmt);

        // Fetch the result
        $memberResult = mysqli_stmt_get_result($memberStmt);

        // Check if the user exists and fetch the level
        if (mysqli_num_rows($memberResult) > 0) {
            $row = mysqli_fetch_assoc($memberResult);

            $level = $row['level'];
        } else {
            $msgErr = "Invalid username or account number.";
        }


        //premium packate commissions
        if ($level == 'normal') {
            $commission = 0.07;
        }
        if ($level == 'vip') {
            $commission = 0.07;
        }
        if ($level == 'vvip') {
            $commission = 0.09;
        }
        if ($level == 'vvvip') {
            $commission = 0.12;
        }
        if ($level == 'gold') {
            $commission = 0.12;
        }
        if ($level == 'diamond') {
            $commission = 0.12;
        }

        //To clear the Grand order for the user
        $userCommission = (float)$commission * (float)$amount_processing;
        $NewBalance = (float)$amount_processing + (float)$userCommission;
        $NewAmountProcessing = (float)$amount_processing + $userCommission;





        // Prepare the SQL update statement
        $sql = "UPDATE accounts SET Balance = ?, amount_processing = ? WHERE AccountNo = ?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            // Bind the parameters
            mysqli_stmt_bind_param($stmt, "sss", $NewBalance, $NewAmountProcessing, $account_number);

            // Execute the statement
            if (mysqli_stmt_execute($stmt)) {

                $sqlDelete = "DELETE FROM merge_product WHERE id= '$id';";
                $resultDelete = mysqli_query($conn, $sqlDelete);

                if (!$resultDelete) {
                    die("Query failed: " . mysqli_error($conn));
                }


                header("location: ../accounts/EditAccount.php?msg=acctCleared");
            } else {

                header("location: ../accounts/EditAccount.php?msg=error");
            }
        }
    }
}
