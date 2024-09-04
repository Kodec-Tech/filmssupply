<style>
.assessment {
    width: 65%;
    margin: auto;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
}

.assessment div {
    display: flex;
    justify-content: center;
    align-items: center;
}

.credit_level {
    width: 300px; /* Default full width */
    height: 5.5px;
    background-color: #C70039;
    border-radius: 100px;
    position: relative;
}

.d_level {
    background-color: #C70039;
    padding: 0.5rem;
    border-radius: 10px;
    margin-left: -4px;
}


</style>





<div class="assessment">
    <h5>Credit Assessment:</h5>
    <div>
        <h6 class="credit_level" id="creditBar"></h6>
        <h5 class="d_level" id="creditScore">100%</h5>
    </div>
</div>



<?php
$creditScore = 60; // Example: Value fetched from the database or set by admin
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    var creditScore = <?php echo $creditScore; ?>;

    var creditBar = document.getElementById('creditBar');
    var creditScoreText = document.getElementById('creditScore');

    var maxWidth = 300;
    var newWidth = (creditScore / 100) * maxWidth;

    creditBar.style.width = newWidth + "px"; 
    creditScoreText.textContent = creditScore + "%";
});
</script>

