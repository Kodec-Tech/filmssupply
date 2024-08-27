<?php
session_start();
include __DIR__ . '/../../connection.php';
// include_once __DIR__ . '/../../../mail/withdrawalEmailScript.php';


if (!isset($_SESSION['username'])) {
    header('Location: ../login.php');
    exit();
}

$AccountNo = $_SESSION['AccountNo'];
$email = $_SESSION['email'];
$color = $_SESSION['profilecolor'];

// Fetch account details
$query = "SELECT * FROM accounts WHERE AccountNo='$AccountNo'";
$result = mysqli_query($conn, $query);

if (!$result) {
    die('Query Error: ' . mysqli_error($conn));
}

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $balance = $row['Balance'];
} else {
    die('No account found for AccountNo: ' . $AccountNo);
}

// Fetch bind wallet details
$query_bind_wallet = "SELECT * FROM bind_wallet WHERE acctNo='$AccountNo'";
$result_bind_wallet = mysqli_query($conn, $query_bind_wallet);

if (!$result_bind_wallet) {
    die('Query Error: ' . mysqli_error($conn));
}

if (mysqli_num_rows($result_bind_wallet) > 0) {
    $row = mysqli_fetch_assoc($result_bind_wallet);
    $coin_type = $row['coin_type'];
    $wallet_network = $row['wallet_network'];
    $wallet_address = $row['wallet_address'];
} else {

    header("Location: ../withdraw.php?msg=noBindWallet");
    exit();
    // die('No bind wallet found for AccountNo: ' . $AccountNo);
}



if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit-withdrawal'])) {
    // Grab info
    $withdrawal_amount = floatval($_POST['withdrawal_amount']);
    $withdrawal_pin = htmlspecialchars($_POST['withdrawal_pin']);

    // Check if withdrawal pin matches
    $pin_check_query = "SELECT withdrawal_pin FROM customer_detail WHERE Account_No = ?";
    $stmt = mysqli_prepare($conn, $pin_check_query);
    mysqli_stmt_bind_param($stmt, 's', $AccountNo);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    $db_withdrawal_pin = $row['withdrawal_pin'];

    // Check for correct withdrawal pin
    if ($withdrawal_pin != $db_withdrawal_pin) {
        header("Location: ../withdraw.php?msg=incorrectPin");
        exit();
    }

    // Check for errors
    if ($withdrawal_amount < 20) {
        header('Location: ../withdraw.php?msg=invalidAmount&balance=' . $balance);
        exit();
    }

    if ($withdrawal_amount > $balance) {
        header('Location: ../withdraw.php?msg=insufficient&balance=' . $balance);
        exit();
    }

    // Update balance
    $newbalance = $balance - $withdrawal_amount;
    $sql = "UPDATE accounts SET Balance='$newbalance' WHERE AccountNo='$AccountNo'";
    if (!mysqli_query($conn, $sql)) {
        die('Internal error: ' . mysqli_error($conn));
    }

    // Add to transaction history
    $transactionsql = "INSERT INTO transaction (AccountNo, FAccountNo, Name, Amount, Status, Credit, Debit, type, wallet_network) VALUES ('$AccountNo', '$wallet_address', '$coin_type', '$withdrawal_amount', 'Pending', '0.0', '$withdrawal_amount', 'withdrawal', '$wallet_network')";
    if (!mysqli_query($conn, $transactionsql)) {
        die('Internal error: ' . mysqli_error($conn));
    }

    // Send mail via tax (assuming sendWithdrawalEmail function is available)
    // $fullname = ucfirst($_SESSION['C_First_Name'] . ' ' . $_SESSION['C_Last_Name']);
    // sendWithdrawalEmail($email, $fullname, $withdrawal_amount . 'USDT', $wallet_address, $wallet_network);

    header('Location: ../withdraw.php?msg=success');
    exit();
}
