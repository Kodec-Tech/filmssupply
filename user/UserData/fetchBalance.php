<?php

// Do NOt put this file inside front end part 
// It is alreeady automatically imported in the auth .php file
//!!!!!!

if ( isset( $AccountNo ) ) {
    $sql = "select * from accounts where AccountNo ='$AccountNo'";
    $result = mysqli_query( $conn, $sql )or mysqli_error( $conn );

    if ( mysqli_num_rows( $result )> 0 ) {
        while( $row = mysqli_fetch_assoc( $result ) ) {

           
            $UsersaccountNo = $row[ 'AccountNo' ];
            $Usersbalance = $row[ 'Balance' ];
            $UserssavingBalance = $row[ 'SavingBalance' ];
            $UserssavingTarget = $row[ 'SavingTarget' ];
            $UsersaccountType = $row[ 'AccountType' ];
            $Usersstate = $row[ 'State' ];

        }

    }


}