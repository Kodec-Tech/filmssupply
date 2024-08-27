<?php

check_if_banned(false, false, $conn);


// Function to check if user is banned
function check_if_banned($login_attempt = false, $login_success = false, $conn)
{
    //make sql connection
    
    

    // Give each login a limit
    $limit = 2;

    $ip = get_ip();

    // Query to retrieve threat information for the given IP
    $query = "SELECT * FROM threat_response WHERE ip_address = ? LIMIT 1";
    $stmt = mysqli_stmt_init($conn);

    if ($stmt) {
        if (mysqli_stmt_prepare($stmt, $query)) {
            mysqli_stmt_bind_param($stmt, 's', $ip);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);

            // Check if there are rows
            if (mysqli_num_rows($result) > 0) {
                // Fetch the first row
                $row = mysqli_fetch_assoc($result);

                $time = time();

                if ($row['banned'] > $time) {
                    // This user is banned
                    echo "Access Denied";
                    header("Location: denied.php");
                    die;
                } else {
                    if ($login_attempt) {
                        $expire = ($time + (60 * 5)); //60 seconds *5 = 5minute

                        if ($row['login_count'] >= $limit && $login_success == false) {
                            // User reached login limit, update the threat response
                            $query = "UPDATE threat_response SET banned = ?, login_count = 0 WHERE id = ? LIMIT 1";
                            mysqli_stmt_prepare($stmt, $query);
                            mysqli_stmt_bind_param($stmt, "ss", $expire, $row['id']);
                            mysqli_stmt_execute($stmt);

                            return;

                        } elseif ($login_success) {
                            // Reset login count on success
                            $login_count = 0;
                            $query = "UPDATE threat_response SET login_count = ? WHERE id = ? LIMIT 1";
                            mysqli_stmt_prepare($stmt, $query);
                            mysqli_stmt_bind_param($stmt, "ss", $login_count,  $row['id']);
                            mysqli_stmt_execute($stmt);

                            if($row['banned'] < $time){

                                // Reset banned on success
                                $login_count = 0;
                                $banned = 0;
                                $query = "UPDATE threat_response SET login_count = ?, banned = ? WHERE id = ? LIMIT 1";
                                mysqli_stmt_prepare($stmt, $query);
                                mysqli_stmt_bind_param($stmt, "sss", $login_count, $banned,  $row['id']);
                                mysqli_stmt_execute($stmt);
    
                                }

                       
                        } else {
                            // Add to login count on failure
                            $query = "UPDATE threat_response SET login_count = login_count + 1 WHERE id = ? LIMIT 1";
                            mysqli_stmt_prepare($stmt, $query);
                            mysqli_stmt_bind_param($stmt, "s", $row['id']);
                            mysqli_stmt_execute($stmt);
                        }
                    }
                }
                return;
            }
        }
    } else {
        echo "Error initializing statement: " . mysqli_error($conn);
    }

    // If no threat information found, insert a new record
    $login_count = 0;
    $banned = 0;
    $query = "INSERT INTO threat_response (ip_address, login_count, banned) VALUES (?, ?, ?)";
    mysqli_stmt_prepare($stmt, $query);
    mysqli_stmt_bind_param($stmt, "sii", $ip, $login_count, $banned);
    mysqli_stmt_execute($stmt);
}

// Function to get the user's IP address
function get_ip()
{
    $ip = "";

    if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } elseif (isset($_SERVER['REMOTE_ADDR'])) {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}




