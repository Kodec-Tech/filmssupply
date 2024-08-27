<?php

$mode = 'OFF'; // Default value

$sql = "SELECT setting_value FROM admin_settings WHERE setting_name = 'maintenance_mode'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $mode = $row['setting_value'];
}
?>

<style>
    
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            
            border-radius: 10px;
        }
        h4 {
            text-align: center;
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"] {
            width: 100%;
            height: 30px;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        input[type="submit"] {
            /* width: 100%; */
            height: 30px;
            
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .message {
            text-align: center;
            margin-top: 20px;
        }
        form{
            text-align: center;
        }

        .switch {
  position: relative;
  display: inline-block;
  width: 90px;
  height: 34px;
}

.switch input {
  display: none;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ca2222;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2ab934;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(55px);
  -ms-transform: translateX(55px);
  transform: translateX(55px);
}

/*------ ADDED CSS ---------*/
.on {
  display: none;
}

.on, .off {
  color: white;
  position: absolute;
  transform: translate(-50%, -50%);
  top: 50%;
  left: 50%;
  font-size: 10px;
  font-family: Verdana, sans-serif;
  user-select:none;
}

input:checked + .slider .on {
  display: block;
}

input:checked + .slider .off {
  display: none;
}

/*--------- END --------*/

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}

    </style>



<div class="container-fluid px-lg-4 dark_bg light" id="general" style="min-height:70vh">
    <div class="row">

    <div class="col-md-12 mt-lg-4 mt-4">
            <!-- Page Heading -->
          


    </div>

    <div class="col-sm-2"></div>
        <div class="col-sm-8">
            <div class="card gray_bg" style="min-height:50vh">




           
</head>
<body>
    <div class="container">
        <h4>Update Link</h4>
        <form id="telegram-form">
            <input type="text" id="whatsapp_link" name="whatsapp_link" placeholder="Whatsapp link">
            <input type="text" id="telegram_link" name="telegram_link" placeholder="Telegram Link">
            <input type="submit" value="Submit Link">
        </form>
        <div class="message" id="message"></div>


        <hr style="color: #fff;">
        <h4>Website Maintenance Mode</h4>
        <form action="">
            <label class="switch">
        <input type="checkbox" id="togBtn" onclick="toggleMaintenanceMode()" <?php echo $mode == 'OFF' ? '': 'checked' ?>>
        <div class="slider round"><!--ADDED HTML -->
            <span class="on">ON</span>
            <span class="off">OFF</span><!--END-->
        </div>
        </label>
        </form>


    </div>
            
           
            












            

            </div>
        </div>
    

    </div>

</div>



<script>
        document.getElementById('telegram-form').addEventListener('submit', function(e) {
    e.preventDefault();

    var formData = new FormData(this);

    fetch('includes/update_link.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        var messageDiv = document.getElementById('message');
        if (data.success) {
            messageDiv.textContent = data.message;
            messageDiv.style.color = 'green';
        } else {
            messageDiv.textContent = data.message;
            messageDiv.style.color = 'red';
        }
    })
    .catch(error => {
        console.error('Error:', error);
        var messageDiv = document.getElementById('message');
        messageDiv.textContent = 'An error occurred. Please try again later.';
        messageDiv.style.color = 'red';
    });
});

    </script>










<script>
        function toggleMaintenanceMode() {
            var checkBox = document.getElementById('togBtn');
            var xhr = new XMLHttpRequest();
            var url = "includes/toggle_maintenance.php";
            var params = "action=" + (checkBox.checked ? "enable" : "disable");
            xhr.open("POST", url, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText);
                }
            };
            xhr.send(params);
        }
    </script>