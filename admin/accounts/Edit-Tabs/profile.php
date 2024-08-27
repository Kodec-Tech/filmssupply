<div class="card gray_bg">
    <div class="card-body ">
        <!-- <h5 class="card-title light mb-4 ">Update Account Details</h5> -->


        <form
            id="regForm"
            action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"
            method="POST"
            enctype="multipart/form-data"
        >


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
                            alt="profile image "
                        >
                        <div class="text-white fs-5 fw-bold">
                            <?=" Balance: $". number_format($WalletBalance);?>
                        </div>
                    </div>


                    <div class="row g-2 mt-3 mb-5">
                        <!-- <div
                            class="d-flex align-items-center justify-content-center justify-content-md-start text-white">
                            <span class="<?=$kycBackground?>  bg-opacity-50 rounded px-3 py-2">
                                <?="Kyc ".$kycVerification ?>
                            </span>

                        </div> -->
                        <div
                            class="d-flex align-items-center justify-content-center justify-content-md-start text-white">
                            <?= "Joined ".$createDate ?>

                        </div>
                    </div>





                </div>





                <div class="row g-2 mb-3">
                    <div class="col-md">
                        <div class="col-md mb-3 text-white">


                            Account Number
                            <BR>
                            <input
                                type="text"
                                class="text-white form-control bg-transparent"
                                name="AccountNo"
                                value="<?php echo $EditAccountNo; ?>"
                            >



                        </div>
                    </div>
                    <div class="col-md">
                        <div class="col-md mb-3">




                        </div>
                    </div>
                </div>






                <div class="row g-2 mb-3">
                    <div class="col-md">
                        <div class="col-md mb-3 text-white">



                            <input
                                type="hidden"
                                name="AccountNo"
                                value="<?php echo $EditAccountNo; ?>"
                            >
                            FirstName
                            <BR>
                            <input
                                type="text"
                                name="FirstName"
                                class="form-control bg-transparent light"
                                id="FirstName"
                                placeholder="First Name"
                                value="<?php echo $EditFname; ?>"
                            >

                            <span
                                id="FnameError"
                                style="color: red;"
                            ><?php if (isset($_POST['Update1'])) {
                                                                                       echo $First_Name_error;
                                                                                   } ?></span>

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
                                value="<?php echo $EditLname; ?>"
                            >


                            <span
                                id="LnameError"
                                style="color: red;"
                            ><?php if (isset($_POST['Update1'])) {
                                                                                       echo $Last_Name_error;
                                                                                   } ?></span>


                        </div>
                    </div>
                </div>
                <div class="row g-2 mb-3">
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
                            >

                            <span
                                id="FAnameError"
                                style="color: red;"
                            ><?php if (isset($_POST['Update1'])) {
                                                                                       echo $Father_Name_error;
                                                                                   } ?></span>

                        </div>
                    </div>
                    <!-- <div class="col-md">
                        <div class="col-md mb-3 text-white">


                            <input
                                type="text"
                                name="MotherName"
                                class="form-control bg-transparent  light"
                                id="MAname"
                                placeholder="Mother's Name"
                                value="<?php echo $EditManame; ?>"
                            >

                            <span
                                id="MAnameError"
                                style="color: red;"
                            ><?php if (isset($_POST['Update1'])) {
                                                                                       echo $Mother_Name_error;
                                                                                   } ?></span>

                        </div>
                    </div> -->
                </div>
                <div class="row g-2 mb-3">
                    <div class="col-md">
                        <div class="col-md mb-3 text-white">

                            Date OF Birth
                            <BR> <input
                                type="date"
                                name="BirthDate"
                                class="form-control bg-transparent  light m-wrap"
                                id="BirthDate"
                                placeholder="Birth Date"
                                value="<?php echo strftime('%Y-%m-%d', strtotime($EditBDate)); ?>"
                            >

                            <!-- <input type="date" class="m-wrap" value="<?php echo strftime('%Y-%m-%d', strtotime($EditBDate)); ?>" name="date" /> -->
                            <span
                                id="AgeError"
                                style="color: red;"
                            ><?php if (isset($_POST['Update1'])) {
                                                                                   echo $Birth_Date_error;
                                                                               } ?></span>

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
                                pattern="[0-9]{10}"
                                placeholder="Mobile Number"
                                onkeypress="return isNumber(event)"
                                value="<?php echo $EditMobileNo ?>"
                            >

                            <span
                                id="MobileNoError"
                                style="color: red;"
                            ><?php if (isset($_POST['Update1'])) {
                                                                                           echo $Mobile_Number_error;
                                                                                       } ?></span>

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
                                value="<?php echo $EditEmail; ?>"
                            >

                            <span
                                id="EmailError"
                                style="color: red;"
                            ><?php if (isset($_POST['Update1'])) {
                                                                                       echo $Email_error;
                                                                                   } ?></span>

                        </div>
                    </div>

                </div>
                <div
                    class="mb-4"
                    style="margin-top:40px; display:flex; align-items: center; justify-content:center;"
                >

                    <input
                        type="submit"
                        name="Update1"
                        value="Update"
                        class="btn btn-sm btn-primary shadow-sm light btn-custo"
                        style="font-size:20px; width: 200px; height:40px;"
                    >

                </div>
            </div>
        </form>

    </div>

</div>