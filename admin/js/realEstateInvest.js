// window.addEventListener('ready', () => {

const alertInstance = new AlertHub();

function addImage(inputElementId) {
    // Get the input element by its ID
    var inputElement = document.getElementById(inputElementId);

    // Trigger a click event on the input element to open the file picker
    inputElement.click();
}

function displayImage(inputElement, outputElementId) {
    // Get the output element by its ID
    var outputElement = document.getElementById(outputElementId);
    var lastNum = outputElementId.charAt(outputElementId.length - 1);
    var closeImgId = document.getElementById("closeImg" + lastNum);
    var addImageThumbnail = document.getElementById(
        "addImageThumbnail" + lastNum
    ); // Get the selected file from the input element
    var file = inputElement.files[0];

    // Check if a file is selected
    if (file) {
        var reader = new FileReader();

        // Set up the reader to display the selected image
        reader.onload = function (e) {
            outputElement.src = e.target.result;
        };

        // Read the selected file as a data URL
        reader.readAsDataURL(file);

        outputElement.style.display = "block";
        closeImgId.style.display = "flex";

        addImageThumbnail.style.display = "none";
    }
}

function deleteImage(closeImgId) {
    event.stopPropagation();
    var lastNum = closeImgId.id.charAt(closeImgId.id.length - 1);
    var imgToDelete = document.getElementById("image" + lastNum);
    var addImageThumbnail = document.getElementById(
        "addImageThumbnail" + lastNum
    );
    var inputElement = document.getElementById("fileInput" + lastNum);
    // console.log(closeImgId.id.charAt(closeImgId.id.length - 1))
    imgToDelete.removeAttribute("src");
    inputElement.value = "";
    imgToDelete.style.display = "none";
    closeImgId.style.display = "none";
    addImageThumbnail.style.display = "block";
}

let counter
if (isUpdating()) {
    counter = 6;
} else {
    counter = 1;
}

const clickButton = document.getElementById("clickButton");

function addOptionalDetails() {
 
    if (counter == 5) {
        clickButton.style.display = "none";
    }
    if (counter > 5) {
        const alerthub = new AlertHub();
        alerthub.showAlert({
            title: "",
            description: "You are only allowed to add up to 5 optional details ",
            type: "danger",
            timeout: 6,
            animation: "fade-in",
        });
        return;
    }

    const optionalDetails = document.getElementById("optional-details");
    const newRow = document.createElement("div");

    newRow.setAttribute("id", "newElementId");
    newRow.className = "d-block d-md-flex align-items-center mb-3 bg-transparent";

    newRow.innerHTML = `<div class="col px-0 mt-2 pr-md-2">
    <label for="optionName${counter}">Name</label>
    <input class="form-control bg-transparent" type="text" name="optionName${counter}" id="optioName${counter}" style="border:2px solid #616161 !important; border-radius:7px !important" placeholder="enter name">
</div>
<div class="col px-0 mt-2 pr-md-2">
    <label for="optionValue${counter}">Value</label>
    <input class="form-control bg-transparent" type="text" name="optionValue${counter}" id="optionValue${counter}" style="border:2px solid #616161 !important; border-radius:7px !important" placeholder="enter value">
</div>


<button type="button" class="btn bg-transparent  text-danger  roundedborder border-md-none border-danger mt-4 mt-md-auto" id="${counter}"  onclick="removeOptionalDetails(this)" >
                                       Remove
                                    </button>
                                   
`;

    optionalDetails.appendChild(newRow);
    counter++;
}

function removeOptionalDetails(button) {
    // Find the parent container of the button and remove it
    const parentContainer = button.parentElement;
    clickButton.style.display = "block";

    parentContainer.remove();
    counter--; // Decrement the counter
}

$("#submit").on("click", function (event) {
    var formElement = $("#investForm").get(0);

    var formData = new FormData(formElement);



    if (
        formData.get("img1").name == "" ||
        formData.get("img2").name == "" ||
        formData.get("img3").name == "" ||
        formData.get("img4").name == "" ||
        formData.get("img5").name == ""
    ) {

        if (!isUpdating()) {

            alertInstance.showAlert({
                title: "You need to upload all the images(5) for this investment",
                description: "",
                type: "danger",
                timeout: 7,
                animation: "fade-in",
            });
            return;
        }
    } 

  
        $.ajax({

            url: isUpdating() ? "../includes/updateInvestment.php" : "../includes/uploadInvestment.php",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            
            success: function (response) {
              console.log(response+"success")
                if (response.status != "error") {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: response.message + '',
                        confirmButtonText: 'Continue ',
                        customClass: {
                            popup: 'dark-mode-popup',
                            header: 'dark-mode-header',
                            title: 'dark-mode-title',
                            content: 'dark-mode-content',
                            confirmButton: 'dark-mode-confirm-button'
                        }
                    }).then(function () {
                        window.location.href = '../realEstate/estateInvestment.php';
                    });
                } else {
                    alertInstance.showAlert({
                        title: "",
                        description: response.message + "",
                        type: "danger",
                        timeout: 6,
                        animation: "fade-in",
                    });
                }
            },
            error: function (xhr, status, error) {
              console.log(error+"error")

                alertInstance.showAlert({
                    title: "",
                    description: error + "error occured ",
                    type: "danger",
                    timeout: 6,
                    animation: "fade-in",
                });
            },
        });
    
});

// checks if user is updating or not 
function isUpdating() {
    var url = window.location.href;
    var urlParams = new URLSearchParams(url);

    var id = urlParams.get('id');
    var page = urlParams.get('page');
    


    if (id !== null && page !== null && id !== "" && page !== "") {
        return true;
    } else {
        return false;
    }
}


// })