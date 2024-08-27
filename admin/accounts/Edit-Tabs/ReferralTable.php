
<style>
.table>:not(caption)>*>* {

background-color: transparent !important;
}


 tbody,
            td,
            tfoot,
            th,
            thead,
            tr {
                border: none !important;
                color: white !important;
            }

            thead {
                background-color: #00000050 !important;
            }
    </style>
<h2 class="mt-5">Downliners</h2>

        <div class="table-responsive">
         <table class=" table ">
         <thead class="border-0 text-white rounded">
                        <tr class="border-0">
                    <th class="">Downline</th>
                    <th class="">Username</th>
                    
                </tr>
            </thead>
            <tbody class="border-top">

        <?php
       
$RefSql = "SELECT * FROM accounts WHERE referral = '$username' ";
$result = mysqli_query($conn, $RefSql) or die(mysqli_error($conn));
$downlineCount = 1;


if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $referral = $row['username'];
        
        
    

    
            
        ?>

                <tr>
                    <td><?= 'Downline: ' . $downlineCount++ ?></td>
                    <td><?= $referral ?></td>
                   
                </tr>
                <!-- Add more rows as needed -->
            
            
            <?php
            }
        }else{
    echo "no result";
    }

        
            ?>


            </tbody>
        </table>
   
        </div>
