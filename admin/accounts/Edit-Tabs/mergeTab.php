<!-- css for the datatable -->
<link rel="stylesheet" href="//cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">


<!-- Page Content --> 
 <div id="page-content-wrapper">


<div id="content">

    <div class="container-fluid  px-lg-5  px-md-0">
       

        <!-- Begin Page Content -->
        <div class="container-fluid  py-5 px-lg-4 dark_bg light ">
            <!-- <div class="row border-bottom">
         <div class="col">
            <p>Active Investments</p>
         </div>
        
        </div> -->


            <div class="col">
                <div class="row align-items-center justify-content-between" style="margin-bottom: 18px;">
                    <div class="col">
                        <h3 class="fs-3">Merged Movie</h3>

                    </div>

                    <div class="col text-right">
                        <form action="addMergeMovie.php" method="POST">
                            <input type="hidden" name="account_number" value="<?php echo $EditAccountNo ?>">
                            <input type="hidden" name="username" value="<?php echo $username ?>">
                        <button class="btn btn-primary px-3"><a
                                
                                style="text-decoration:none; color:white;"
                            >
                               <i class="fa fa-plus"></i> Add
                            </a></button>
                        </form>
                        
                        
                    </div>


                    
                </div>
                <div class="table-responsive">


                    <table
                    id="merge-product"
                        class="table table-striped border-top-0  w-100"
                        style="display:inline-tabl"
                    >
                        <thead>
                            <tr class="text-center">
                                <th class="border-top-0 bg-secondary text-white py-3 px-4">S/N</th>
                                <th class="border-top-0 bg-secondary text-white py-3 px-4">Title</th>
                                <th class="border-top-0 bg-secondary text-white py-3 px-4 text-center">
                                    Image</th>
                                <th class="border-top-0 bg-secondary text-white py-3 px-4">Amount</th>
                                <th class="border-top-0 bg-secondary text-white py-3 px-4">Grand Order Unit
                                </th>
                                <th class="border-top-0 bg-secondary text-white py-3 px-4">Level
                                </th>
                                
                                

                                <th class="border-top-0 bg-secondary text-white py-3 px-4 text-center ">
                                    Action</th>
                            </tr>
                        </thead>
                    <?php
                    $count=1;
                    $sql = "SELECT * FROM merge_product WHERE acctNo = '$EditAccountNo' ORDER BY `id` DESC";
                    $result = $conn->query($sql);

                    if ($result) { ?> <tbody>

                            <?php
                            if (mysqli_num_rows($result) > 0) {
                                while ($rows = mysqli_fetch_assoc($result)) { ?>
                            <tr>
                                <td class="text-center"><?=$count++ ?></td>
                                <td class="text-center">
                                     <?php echo $rows['product_title']; ?>
                                </td>
                               
                                
                                <td class="text-center ">
                                    <img src="<?= $rows['product_img'] ?>" alt="" 
                                    style="width: 80px; height: 75px; border-radius:30px">
                                
                                </td>
                                
                                <td class="text-center"><?= $rows['product_amount'] ?></td>

                                <td class="text-center"><?= $rows['grand_order'] ?></td>

                                <td class="text-center"><?= $rows['level'] ?></td>

                                

                                
                                
                                <td class="text-center dropdown show ">


                                    <a
                                        class=" dropdown-toggle"
                                        href="#"
                                        role="button"
                                        id="dropdownMenuLink"
                                        data-toggle="dropdown"
                                        aria-haspopup="true"
                                        aria-expanded="false"
                                    >
                                        <i class='custom-dropdown-icon bx bx-menu bx-sm'></i>

                                    </a>

                                    <div
                                        class="dropdown-menu bg-dark text-white"
                                        aria-labelledby="dropdownMenuLink"
                                    >
                                        <a
                                            class="dropdown-item text-white"
                                            href="addMergeMovie.php?page=update&id=<?php echo $rows['id']?>"
                                        >Update</a>
                                        <form action="../includes/deleteMergeMovies.inc.php" method="POST">
                                            <input type="hidden" name="id" value="<?php echo $rows['id']?>">
                                            <input type="hidden" name="amount_processing" value="<?php echo $amount_processing; ?>">
                                            <input type="hidden" name="account_number" value="<?php echo $EditAccountNo; ?>">
                                            <input type="hidden" name="level" value="<?php echo $level; ?>">

                                            <input type="submit" name="clear_submit" value="Clear" style="background: none; color:#fff; border: none; margin-left: 10px;">
                                        </form>

                                    </div>

                                </td>


                            </tr>
                            <?php
                                }
                            }
                    }


                    ?>


                        </tbody>

                    </table>




                    <?php
                if (mysqli_num_rows($result) < 1) { ?>
                    <div
                        class="text-center  d-flex align-items-center justify-content-center"
                        style="min-height:70vh"
                    >
                        <div class="col">
                            <img
                                src="../img/empty.svg"
                                class="img-fluid"
                                style="height:200px"
                                alt=""
                            >
                            <p
                                class="mt-5"
                                style="color:#999"
                            >This space is empty, enjoy the silence or upload a Merge movie </p>
                        </div>
                    </div>

                    <?php
                }
                
                ?>
                </div>

            </div>
          
           

        </div>
    </div>

</div>

</div>




<!-- script for the datatable -->
<script src="//cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>

<script>
    new DataTable('#merge-product');
</script>