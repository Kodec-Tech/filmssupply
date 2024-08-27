<div class="card gray_bg">


    <div class="container-fluid  px-lg-4 rounded dark_bg light  ">
        <div class="card gray_bg p-4">
          












            <div class="d-flex text-white">
                <!-- <div
                    class="tabview border py-2 px-4"
                    onclick="changeTab(1)"
                    id="tab1"
                >
            Realestate Investment</div> -->
                <div
                    class="tabview border py-2 px-4"
                    onclick="changeTab(2)"
                    id="tab2"
                >User Task Management </div>
                
            </div>

            

            

            <div
                id="tabContent1"
                class="tab-content-view text-white"
            >
            <?php include_once('user-task/task.php')?>

            </div>

            <script>
            document.addEventListener("DOMContentLoaded", function() {
                changeTab(1);
            });

            function changeTab(tabNumber) {
                // Hide all tab contents
                document.querySelectorAll('.tab-content-view').forEach(content => {
                    content.style.display = "none";
                });
                // Reset background color
                document.querySelectorAll('.tabview').forEach(tab => {
                    tab.style.backgroundColor = "transparent";
                    tab.style.opacity = .6
                });

                // Show the selected tab content
                document.getElementById(`tabContent${tabNumber}`).style.display = "block";

                // Set background color for the clicked tab
                document.getElementById(`tab${tabNumber}`).style.backgroundColor = "#424242";     
                document.getElementById(`tab${tabNumber}`).style.opacity = 1
            }
            </script>









        </div>

    </div>




















</div>