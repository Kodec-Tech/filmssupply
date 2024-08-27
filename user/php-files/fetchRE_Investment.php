<?php

$editing = false;
if ( isset( $_GET[ 'id' ] ) ) {
    $editing = true;
    $id =  $_GET[ 'id' ];

    // Note would return an error if there's no custom package details information 
    // $sql = ' SELECT * FROM real_estate_package RIGHT JOIN package_custom_details
    // ON real_estate_package.id = package_custom_details.package_id
    // WHERE real_estate_package.status = ? AND real_estate_package.id = ?;

    $sql = ' SELECT * FROM real_estate_package RIGHT JOIN package_custom_details
    ON real_estate_package.id = package_custom_details.package_id
    WHERE  real_estate_package.id = ?';
    $stmt = mysqli_prepare( $conn, $sql );
    // $status = 'Active';
    if ( $stmt ) {
        mysqli_stmt_bind_param( $stmt, 'i', $_GET[ 'id' ]);
        // Assuming 'id' is an integer
        $result = mysqli_stmt_execute( $stmt );
       
        if ( $result ) {
           
            // mysqli_stmt_store_result( $stmt );
            $result_set = mysqli_stmt_get_result( $stmt );
            // $numRows = mysqli_stmt_num_rows( $stmt );


            // if (mysqli_num_rows($result) > 0) {  
       
            // }
        
    //           $result_set = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result_set) <1) {
  
              
                // NOTE means probably the custom package details information for this package or some other issue
                 header('Location: ../error.php?error = Something went wrong with this investment. Kindly contact admin ');
                exit();
            }

    
            while ( $row = mysqli_fetch_assoc( $result_set ) ) {
                $title = $row[ 'title' ];

                $description = $row[ 'description' ];
                $invest_start = $row[ 'invest_start' ];
                $invest_end = $row[ 'invest_end' ];
                $roi = $row[ 'roi' ];
                $min_invest = $row[ 'min_invest' ];
                $max_invest = $row[ 'max_invest' ];
                $location = $row[ 'location' ];
                $status = $row[ 'status' ];
                $price = $row[ 'price' ];
                $property_type = $row[ 'property_type' ];
                $img1 = $row[ 'img1' ];
                $img2 = $row[ 'img2' ];
                $img3 = $row[ 'img3' ];
                $img4 = $row[ 'img4' ];
                $img5 = $row[ 'img5' ];
                $optionNames = array(
                    $row[ 'optionName1' ],
                    $row[ 'optionName2' ],
                    $row[ 'optionName3' ],
                    $row[ 'optionName4' ],
                    $row[ 'optionName5' ]
                );

                $optionValues = array(
                    $row[ 'optionValue1' ],
                    $row[ 'optionValue2' ],
                    $row[ 'optionValue3' ],
                    $row[ 'optionValue4' ],
                    $row[ 'optionValue5' ]
                );

                $investOwner = $row[ 'invest_owner' ];



                // etch theavourite 
                $isFavourite = false;
                $favouriteSql = 'SELECT * FROM favourite WHERE package_id = ? AND AccountNo = ?';
                $favStmt = mysqli_prepare($conn, $favouriteSql);
                
                if ($favStmt) {
                    mysqli_stmt_bind_param($favStmt, 'is', $id, $account_No);
                    $favResult = mysqli_stmt_execute($favStmt);
                
                    if ($favResult) {
                        // Store the result set
                        mysqli_stmt_store_result($favStmt);
                
                        // Check the number of rows
                        $favRows = mysqli_stmt_num_rows($favStmt);
                
                        if ($favRows > 0) {
                            $isFavourite = true;
                        }
                    }
                }
            }
        }
    }
} else {
    // Use the referrer header to get the previous page's URL
    $previousPage = $_SERVER[ 'HTTP_REFERER' ]??'';
    if ( empty( $previousPage ) ) {
        header( 'Location: ../error.php?error=An internal error occured, please refresh the page ' );
    } else {

        // Use the header function to redirect
        header( "Location: $previousPage" );
        exit();
        // Make sure to exit to prevent further execution
    }
}

// mysqli_stmt_close($stmt);