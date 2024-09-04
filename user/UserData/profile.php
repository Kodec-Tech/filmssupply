<style>
    .assessment {
    background-color: #f7f7f7;
    padding: 20px;
    border-radius: 8px;
    width: 300px;
    margin: 0 auto;
    text-align: center;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.credit-bar-container {
    background-color: #ddd;
    border-radius: 25px;
    height: 20px;
    width: 100%;
    margin: 10px 0;
    overflow: hidden;
}

.credit-bar {
    background-color: #4caf50;
    height: 100%;
    width: 70%; /* Default width, will be changed dynamically */
    border-radius: 25px;
    transition: width 0.5s ease-in-out;
}

.credit_level {
    margin-bottom: 10px;
    font-weight: bold;
}

.d_level {
    margin-top: 10px;
    font-weight: bold;
}

</style>





<div class="assessment">
    <h5>Credit Assessment:</h5>
    <div>
        <h6 class="credit_level">Your Credit Level</h6>
        <div class="credit-bar-container">
            <div class="credit-bar" id="creditBar"></div>
        </div>
        <h5 class="d_level" id="creditScore">70%</h5>
    </div>
</div>


<?php
// Assuming you have fetched the credit score from the database or set by admin
$creditScore = 100 . '%'; // Example value from the database
?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var creditScore = <?php echo $creditScore; ?>;

        var creditBar = document.getElementById('creditBar');
        var creditScoreText = document.getElementById('creditScore');

        creditBar.style.width = creditScore + "%"; 
        creditScoreText.textContent = creditScore + "%"; 
    });
</script>
