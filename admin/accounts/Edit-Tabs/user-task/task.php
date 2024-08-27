<!-- css for the datatable -->
<link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">


<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>




<div class="table-responsive">
<?php
$AccountNo = $EditAccountNo;
$taskSql = "SELECT * FROM user_task WHERE acctNo = '$AccountNo' ORDER BY id DESC";
$result = mysqli_query($conn, $taskSql) or die(mysqli_error($conn));

if (mysqli_num_rows($result) > 0) {
    $serial = 1; // Initialize the serial number
    ?>

    <style>
    .table>:not(caption)>*>* {
        background-color: transparent !important;
    }
    tbody, td, tfoot, th, thead, tr {
        border: none !important;
        color: white !important;
    }
    thead {
        background-color: #00000050;
    }
    </style>

    <!-- Lets reset the user task  -->
    <?php
    $resetPath =  'reset_user_tasks.php';
    ?>
    <div style="margin: 20px 0;">
    <form id="resetForm" method="POST" action="<?php echo $resetPath ?>">
        <input type="hidden" name="acctNo" value="<?php echo $AccountNo ?>"> <!-- Replace USER_ACCOUNT_NUMBER with the actual account number -->
        <div style="display: flex; justify-content: flex-end">
        <button type="submit" class="bg-danger text-white" style="padding: 10px; border: none">Reset User Task</button>
        </div>
    </form>
    </div>




    <table id="taskList" class="table bg-transparent" style="width: 100%;">
        <thead class="border-0 text-white rounded">
            <tr class="border-0">
                <th>S/N</th>
                <th>AcctNo</th>
                <th>Username</th>
                <th>Movie Title</th>
                <th>Movie Thumbnail</th>
                <th>Movie Amount</th>
                <th>Earnings</th>
                <th>Status</th>
                <th>Reset</th>
                <th>Date Created</th>
            </tr>
        </thead>
        <tbody>
        <?php
        while ($user_task = mysqli_fetch_assoc($result)) {
        ?>
            <tr>
                <td><?php echo $serial++; ?></td>
                <td><?= $user_task['acctNo']; ?></td>
                <td><?= $user_task['username']; ?></td>
                <td><?= $user_task['product_title']; ?></td>
                <td><img src="<?= $user_task['product_img']; ?>" alt="" style="width: 80px; height: 75px; border-radius:30px"></td>
                <td><?= $user_task['product_amount'] . 'USDT'; ?></td>
                <td><?= $user_task['commission_earned'] . 'USDT'; ?></td>
                <td>
                    <span class="badge bg-<?php
                    $status = $user_task['status'];
                    if (strtolower($status) == 'completed') {
                        echo "success text-white";
                    } elseif (strtolower($status) == 'disabled') {
                        echo "danger";
                    } else {
                        echo 'success';
                    } ?> p-2">
                        <?php echo $status; ?>
                    </span>
                </td>
                <td>
                <span class="badge bg-<?php
                    $reset = $user_task['reset'];
                    if (strtolower($reset) == 'true') {
                        echo "danger ";
                    
                    } else {
                        echo 'success text-white';
                    } ?> p-2">
                        <?php echo $reset; ?>
                    </span>
                </td>
                <td><?= $user_task['created_date']; ?></td>
            </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
    <?php
} else {
    echo "<div class='text-secondary mt-5 text-center'>No Tasks performed by this user</div>";
}
?>
</div>



<script>
        document.getElementById('resetForm').addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission

            let formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire('Success', data.message, 'success').then(() => {
                        // Optionally reload the page or redirect
                        location.reload();
                    });
                } else {
                    Swal.fire('Error', data.message, 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'An error occurred', 'error');
            });
        });
    </script>




<!-- script for the datatable -->
<script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
<script>
    new DataTable('#taskList');
</script>
