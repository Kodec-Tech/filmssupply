<div class="card gray_bg">
    <div class="card-body ">
        <!-- <h5 class="card-title light mb-4 ">Update Account Details</h5> -->


        <form
            id="regForm"
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
            method="POST"
            enctype="multipart/form-data">


            <!-- Tab 1 -->

            <div class="ta mb-3">

                <div class="px-3 text-center text-md-start">
                    <div class="d-block d-md-flex justify-content-between">
                        <img
                            class=' rounded-circle '
                            width=150
                            height="150"
                            src="<?php echo $EditProfileImage ?>"
                            style="object-fit:cover"
                            alt="profile image ">
                        <div class="text-white fs-5 fw-bold">
                            <?= " Balance: $currency" . number_format($WalletBalance); ?>
                        </div>
                    </div>


                    <div class="row g-2 mt-3 mb-5">
                        <!-- <div
                            class="d-flex align-items-center justify-content-center justify-content-md-start text-white">
                            <span class="<?= $kycBackground ?>  bg-opacity-50 rounded px-3 py-2">
                                <?= "Kyc " . $kycVerification ?>
                            </span>

                        </div> -->
                        <div
                            class="d-flex align-items-center justify-content-center justify-content-md-start text-white">
                            <?= "Joined " . $createDate ?>

                        </div>
                    </div>





                </div>





                <div class="row g-2 mb-3">
                    <div class="col-md">
                        <div class="col-md mb-3 text-white">


                            UID
                            <BR>
                            <input
                                type="text"
                                class="text-white form-control bg-transparent"
                                name="AccountNo"
                                value="<?php echo $EditAccountNo; ?>"
                                readonly>



                        </div>
                    </div>

                    <div class="col-md">
                        <div class="col-md mb-3 text-white">

                            UserName
                            <input
                                type="text"
                                name="username"
                                class="form-control bg-transparent light"
                                id="FAname"
                                placeholder="Father's Name"
                                value="<?php echo $username; ?>"
                                readonly>


                        </div>
                    </div>
                </div>







                <div class="row g-2 mb-3">
                    <div class="col-md">
                        <div class="col-md mb-3 text-white">



                            <input
                                type="hidden"
                                name="AccountNo"
                                value="<?php echo $EditAccountNo; ?>">
                            FirstName
                            <BR>
                            <input
                                type="text"
                                name="FirstName"
                                class="form-control bg-transparent light"
                                id="FirstName"
                                placeholder="First Name"
                                value="<?php echo $EditFname; ?>">


                        </div>
                    </div>
                    <div class="col-md">
                        <div class="col-md mb-3 text-white">

                            LastName<BR>
                            <input
                                type="text"
                                name="LastName"
                                class="form-control bg-transparent light"
                                id="Lname"
                                placeholder="Last Name"
                                value="<?php echo $EditLname; ?>">


                        </div>
                    </div>
                </div>




                <div class="row g-2 mb-3">

                    <div class="col-md">
                        <div class="col-md mb-3 text-white">
                            Email Address
                            <input
                                type="email"
                                name="email"
                                class="form-control bg-transparent light"
                                id="email"
                                placeholder="Email Address"
                                value="<?php echo $EditEmail; ?>">

                        </div>
                    </div>

                    <div class="col-md">
                        <div class="col-md mb-3 text-white">
                            Phone Number
                            <input
                                name="MobileNumber"
                                class="form-control bg-transparent light"
                                type="tel"
                                id="MobileNo"
                                placeholder="Mobile Number"
                                value="<?php echo $EditMobileNo ?>">

                        </div>
                    </div>
                </div>




                <div class="row g-2 mb-3">

                    <div class="col-md">
                        <div class="col-md mb-3 text-white">
                            Password
                            <input
                                type="text"
                                name="password"
                                class="form-control bg-transparent light"
                                id="email"
                                value="">

                        </div>
                    </div>

                    <div class="col-md">
                        <div class="col-md mb-3 text-white">
                            Withdrawal Pin <sub>(6digit)</sub>
                            <input
                                name="withdrawal_pin"
                                class="form-control bg-transparent light"
                                type="number"
                                id="MobileNo"
                                onkeypress="return isNumber(event)"
                                placeholder="Mobile Number"
                                value="<?php echo $withdrawal_pin ?>">

                        </div>
                    </div>


                </div>


                <div class="row g-2 mb-3">

                <div class="col-md">
                    <div class="col-md mb-3 text-white">
                        Wallet Balance
                        <input
                            name="balance"
                            class="form-control bg-transparent light"
                            type="text"
                            id="MobileNo"

                            value="<?php echo $WalletBalance ?>">

                    </div>
                </div>

                <div class="col-md">
                    <div class="col-md mb-3 text-white">
                        Credit Score
                        <input
                            name="balance"
                            class="form-control bg-transparent light"
                            type="text"
                            id="MobileNo"
                            placeholder="Credit Score"
                            value="">

                    </div>
                </div>




                </div>


                <div
                    class="mb-4"
                    style="margin-top:40px; display:flex; align-items: center; justify-content:center;">

                    <input
                        type="submit"
                        name="Update1"
                        value="Update"
                        class="btn btn-sm btn-primary shadow-sm light btn-custo"
                        style="font-size:20px; width: 200px; height:40px;">

                </div>
            </div>
        </form>

    </div>

</div>