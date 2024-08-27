

// custom library built by baby
const alertInstance = new AlertHub();



// ---------------------------------------------------------------Update profile image  ------------------------------------------//

$(document).ready(function() {
    $("#profile").change(function() {
        var formData = new FormData();
        formData.append("profile", $("#profile")[0].files[0]);

        if (
            $("#profileimg-info").hasClass("bg-secondary") ||
            $("#profileimg-info").hasClass("bg-success")
        ) {
            $("#profileimg-info").removeClass("bg-secondary");
            $("#profileimg-info").removeClass("bg-success");
            $("#profileimg-info").removeClass("text-secondary");
            $("#profileimg-info").removeClass("text-success");
        }
        $("#profileimg-info").text("Updating .......");
        $("#profileimg-info").addClass("bg-info");

        $.ajax({
            url: "../php-files/uploadProfileImg.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function(response) {
                if (response.status === "success") {
                    // Handle success, e.g., update the displayed profile image
                    
                    // Remove existing classes
                    $("#profileimg-info").removeClass("bg-secondary bg-info bg-success text-secondary text-info text-success fw-bold");

                    // Set background color to #1c2440 and text color to white
                    $("#profileimg-info").addClass("bg-success"); // Background color
                    $("#profileimg-info").addClass("text-white"); // Text color
                    $("#profileimg-info").addClass("fw-bold"); // Bold text

                    // Update message
                    $("#profileimg-info").text("Your profile has been updated successfully");

                    // Show success alert
                    alertInstance.showAlert({
                        title: "",
                        description: response.message,
                        type: "success",
                        timeout: 5,
                        closeButton: true,
                        animation: "fade-in",
                    });
                } else {
                    alertInstance.showAlert({
                        title: "",
                        description: response.message,
                        type: "danger",
                        timeout: 5,
                        closeButton: true,
                        animation: "fade-in",
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle AJAX error
                alertInstance.showAlert({
                    title: "",
                    description: response.error,
                    type: "danger",
                    timeout: 5,
                    closeButton: true,
                    animation: "fade-in",
                });
            },
        });
    });


    // -------------------------------------------Update user kyc info ---------------------------------------------------------------//

    // Event listener for the national ID file input
    $("#validIdFileInput").change(function() {
        // Get the file name from the input element
        var fileName = $(this).val().split("\\").pop();

        // Update the image source using the ID "img-nationalId"
        $("#img-nationalId").attr("src", URL.createObjectURL(this.files[0]));

        $("#nationalIdfileName").text(fileName);
    });

    // Event listener for the selfie ID file input
    $("#selfieIdFileInput").change(function() {
        // Get the file name from the input element
        var fileName = $(this).val().split("\\").pop();

        // Update the image source using the ID "img-selfieId"
        $("#img-selfieId").attr("src", URL.createObjectURL(this.files[0]));

        $("#selfieFileName").text(fileName);
    });

    // Event listener for the form submission
    $("#submitKyc").on("click", function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the HTML form element using get(0)
        var formElement = $("#imageUploadForm").get(0);
        var formData = new FormData(formElement);
        // Check if both file inputs are empty
        if (!formData.get("nationalIdFile") || !formData.get("selfieIdFile")) {
            alertInstance.showAlert({
                title: "",
                description: "Please pick both a selfie and a Valid Identity Card" +
                    formData.get("nationalIdFile") +
                    ";" +
                    formData.get("selfieIdFile"),
                type: "danger",
                timeout: 5,
                closeButton: true,
                animation: "fade-in",
            });
        } else {
            // Send the FormData object to the PHP page for processing
            $.ajax({
                url: "../php-files/update-kyc.php", // Replace with the actual PHP page for processing
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(response) {
                    if (response.status === "success") {
                        alertInstance.showAlert({
                            title: "",
                            description: response.message + "",
                            type: "success",
                            timeout: 5,
                            closeButton: true,
                            animation: "fade-in",
                        });

                        setTimeout(() => {
                            window.location.href = "profile.php";
                        }, 5000);
                    } else {
                        alertInstance.showAlert({
                            title: "",
                            description: response.message,
                            type: "danger",
                            timeout: 5,
                            closeButton: true,
                            animation: "fade-in",
                        });
                    }
                },
                error: function(xhr, status, error) {
                    alertInstance.showAlert({
                        title: "",
                        description: "An Unknown error occured " + error,
                        type: "danger",
                        timeout: 5,
                        closeButton: true,
                        animation: "fade-in",
                    });
                },
            });
        }
    });






    //----------------------------- Update user password-------------------------// 
    $("#PasswordBtn").on("click", function(event) {
        event.preventDefault(); // Prevent the default form submission

        // Get the values from the input fields
        var oldPassword = $("#OldPassword").val();
        var newPassword = $("#NewPassword").val();
        var cPassword = $("#ConfirmPassword").val();

        // Validate the form inputs (you can add more validation as needed)
        if (oldPassword === "") {
            $("#OldPassError").text("Please enter your old password.");
            return;
        } else {
            $("#OldPassError").text("");
        }

        if (newPassword === "") {
            // Handle validation for the new password field
            return;
        }

        if (cPassword === "") {
            $("#ConfirmPassError").text("Please confirm your password.");
            return;
        } else if (newPassword !== cPassword) {
            $("#ConfirmPassError").text("Passwords do not match.");
            return;
        } else {
            $("#ConfirmPassError").text("");
        }

        // Send a POST request to the PHP file to update the password
        $.post("../php-files/update-pwd.php", {
                oldPassword: oldPassword,
                newPassword: newPassword,
                cPassword: cPassword,
                submitPassword: true,
            })
            .done(function(response) {
                // Handle the response from the PHP file
                try {
                    var data = JSON.parse(response);
                    if (data.status === "success") {
                        alertInstance.showAlert({
                            title: "",
                            description: data.message,
                            type: "success",
                            timeout: 5,
                            closeButton: true,
                            animation: "fade-in",
                        });
                    } else {
                        // Password update failed, display an error message
                        alertInstance.showAlert({
                            title: "",
                            description: data.message,
                            type: "danger",
                            timeout: 5,
                            closeButton: true,
                            animation: "fade-in",
                        });
                    }
                } catch (e) {
                    // Handle JSON parsing error
                    console.error("Error parsing JSON response: " + e.message + "//////" + response);
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown) {
                alertInstance.showAlert({
                    title: "",
                    description: "An error occurred while updating the password. " + errorThrown,
                    type: "danger",
                    timeout: 5,
                    closeButton: true,
                    animation: "fade-in",
                });
            });
    });


});