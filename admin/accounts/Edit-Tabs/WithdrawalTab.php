<!-- css for the datatable -->
<link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">


<div class="card gray_bg text-white">
<?php
       
$sql = "SELECT * FROM transaction
LEFT JOIN customer_detail ON transaction.AccountNo = customer_detail.Account_No
WHERE transaction.AccountNo = '$EditAccountNo' AND transaction.type = 'withdrawal' 
ORDER BY transaction.id DESC";

        $result = mysqli_query($conn, $sql);
        
        if (!$result) {
            die("Query failed: " . mysqli_error($conn));
        }

        //checking for errors
        $resultcheck = mysqli_num_rows($result);

        if(!$resultcheck > 0){
            echo '<div class="text-center  d-flex align-items-center justify-content-center" style="min-height:70vh">
            <div class="col">
                <img
                    src="img/empty.svg"
                    class="img-fluid"
                    style="height:200px"
                    alt=""
                >
                <p class="mt-5" style="color:#999">This space is empty, there is no pending Withdrawal Requests </p>
            </div>
        </div>';

        }else {
           $count = 1;

            echo '<div class="table-responsive mt-4">
            <table
            id="taskListW"
                class="table table-striped border-top-0  w-100 text-white"
                style="display:inline-tabl; text-align: center;"
            >
                <thead style="background-color:#6c757d !important">
                    <tr>
                        <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">No</th>
                        <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Username</th>
                        <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Act No</th>
                        
                        <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Coin</th>
                        <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Network</th>
                        <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Address</th>
                        <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Amount</th>
                        <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Status</th>
                        
                        <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4">Date</th>
                        
                        <th class="border border-secondary order-top-0 bg-secondary text-white py-3 px-4"> Transaction Type</th>
                    </tr>
                </thead>
                <tbody>';
                while($row = mysqli_fetch_assoc($result)) {
                   
                    $id = $row['id'];
                    $account_No = $row['AccountNo'];
                    $walletAddress= $row['FAccountNo'];
                    $Amount = $row["Amount"];
                    $bankname = $row['Name'];
                    $fullname = $row["C_First_Name"].' '.$row['C_Last_Name'] ;
                    $wallet_network = $row['wallet_network'];
                   $type = $row['type'];
                    $Date = $row["Date"];
                    $status = $row['Status'];
             
                    // $date = $row["date"];
                
                echo '
                    
                    <tr>
                        <td class="p-md-3">' . $count++ . '</td>
                        <td class="p-md-3">'.$fullname  .'</td>
                        <td class="p-md-3">' . $account_No  . '</td>
                        <td class="p-md-3">' . $bankname . '</td>
                        <td class="p-md-3">' . $wallet_network . '</td>
                        <td class="p-md-3">' . $walletAddress . '</td>
                     
                        <td class="p-md-3">$'.number_format(str_replace('-','',$Amount))  .'</td>

                        <td class="p-md-3">';

    if($status == 'approve'){
        echo '<p style="color: #fff; background: green; padding: 2px; border-radius: 10px; font-size:12px"> approved </p>';
    }else{
        echo '<p style="color: #fff; background: red; padding: 2px; border-radius: 10px; font-size:12px"> rejected </p>';
    }
   echo '
</td>
                        
                        <td class="p-md-3">'.$Date  .'</td>

                       
                        <td class="p-md-3">
                       '.$type.'
                        
                        </td>
                    </tr>';
                    
                }
           
                echo'
            
                </tbody>
            
            </table>
            
            
            <!-- ============== Table for deposits stops here ============== -->
            
             </div>';
                
            
        }
        
        ?>
</div>




<!-- script for the datatable -->
<script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
<script>
    new DataTable('#taskListW');
</script>