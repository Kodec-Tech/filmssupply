


<nav class="fixed-top align-top" id="sidebar-wrapper" role="navigation">
            <div class="simplebar-content" style="padding: 0px;">
                <a class="sidebar-brand" href="../../index.php">
                    <span class="align-middle"><?php echo BANKNAME ?></span>
                </a>

                <ul class="navbar-nav align-self-stretch">

                    <!-- <li class="sidebar-header">
                        Pages
                    </li> -->
                    <li class="menuHover">

                        <a href="../Dashboard.php" class="nav-link text-left" role="button" aria-haspopup="true" aria-expanded="false">
                            <i class="flaticon-bar-chart-1"></i><i class="bx bxs-dashboard ico"></i> Dashboard
                        </a>
                    </li>

                    <li class="has-sub menuHover">
                        <!-- this link href="collapseExample1" shows submenue  -->
                        <a class="nav-link collapsed text-left" href="#collapseExample1" role="button" data-toggle="collapse">
                            <i class="flaticon-user"></i> <i class="bx bxs-wallet-alt Profile ico"></i> Wallet
                        </a>
                        <!-- id is a collapseExample1 -->
                        <div class="collapse menu mega-dropdown" id="collapseExample1">
                            <div class="dropmenu" aria-labelledby="navbarDropdown">
                                <div class="container-fluid ">
                                    <div class="row">
                                        <div class="col-lg-12 px-2">
                                            <div class="submenu-box">
                                                <ul class="list-unstyled m-0">
                                                    <li><a href="../wallet/Withdraw.php">Withdraw Money</a></li>
                                                    <li><a href="../wallet/Deposit.php">Deposit Money</a></li>

                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>


                    

                    <!-- <li class="menuHover">
                        <a href="../mdeposits.php" class="nav-link text-left" role="button">
                            <i class="flaticon-bar-chart-1"></i><i class="fa fa-download"></i> Manage Deposits
                        </a>
                    </li> -->

                   
                    <li class="menuHover">
                        <a href="../wallet/mwithdraw.php" class="nav-link text-left" role="button">
                            <i class="flaticon-bar-chart-1"></i><i class="fa fa-download"></i> Manage Withdrawal
                        </a>
                    </li>


                    <li class="has-sub menuHover">

<a class="nav-link collapsed text-left" href="#collapseExample3" role="button" data-toggle="collapse">
        <i class="flaticon-user"></i> <i class="fa fa-film"></i> Movies
    </a>


            <div class="collapse menu mega-dropdown" id="collapseExample3">
        <div class="dropmenu" aria-labelledby="navbarDropdown">
            <div class="container-fluid ">
                <div class="row">
                    <div class="col-lg-12 px-2">
                        <div class="submenu-box">
                            <ul class="list-unstyled m-0">
                                <li><a href="../normal/movies.php">Normal </a></li>
                                <li><a href="../vip/movies.php">VIP </a></li>

                                <li><a href="../vvip/movies.php">VVIP</a></li>

                                <li><a href="../vvvip/movies.php">VVVIP</a></li>

                                <li><a href="../gold/movies.php">Gold</a></li>
                                <li><a href="../diamond/movies.php">Diamond </a></li>

                                
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</li>




            <li class="menuHover">
                        <a href="../upgrade/user.php" class="nav-link text-left" role="button">
                            <i class="flaticon-bar-chart-1"></i><i class="fa fa-user"></i> Upgrade Users
                        </a>
            </li>




                    
                    


                    <li class="has-sub menuHover">
                        <a class="nav-link collapsed text-left active" href="#collapseExample2" role="button" data-toggle="collapse">
                            <i class="flaticon-user"></i> <i class="bx bx-user-circle Profile ico"></i> Customer Accounts
                        </a>
                        <!-- Show class show dropdown by default -->
                        <div class="collapse show menu mega-dropdown " id="collapseExample2">
                            <div class="dropmenu" aria-labelledby="navbarDropdown">
                                <div class="container-fluid ">
                                    <div class="row">
                                        <div class="col-lg-12 px-2">
                                            <div class="submenu-box">
                                                <ul class="list-unstyled m-0">
                                                    <li><a href="../accounts/EditAccount.php">Edit Account</a></li>
                                                    <!-- <li><a href="../accounts/KycValidation.php">Kyc Verification Requests</a></li> -->
                                                    <li><a href="../accounts/ActivateAccount.php">Activate Account</a></li>
                                                    <li><a href="../accounts/DeactivateAccount.php">Deactivate Account</a></li>
                                                    <li><a href="../accounts/CloseAccount.php">Close Account</a></li>


                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                   

               

                    
                   
                   
                    <li class="menuHover">
                <a href="../setting.php" class="nav-link text-left" role="button">
                    <i class="flaticon-bar-chart-1"></i><i class="bx bx-transfer ico"></i> Settings
                </a>
            </li>
                    
                    <li class="menuHover">
                        <a class="nav-link text-left" role="button" href="../logout.php">
                            <i class="flaticon-map"></i><i class="bx bx-log-out ico"></i> Logout
                        </a>
                    </li>

                </ul>


            </div>


        </nav>
        
    