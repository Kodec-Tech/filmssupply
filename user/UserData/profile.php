<style>
/* General Styles */
.assessment {
    width: 65%;
    margin: auto;
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
}


/* Score Container */
.score-container {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

/* Credit Bar Wrapper */
.credit-bar-wrapper {
    width: 70%;
    background-color: #e9ecef;
    border-radius: 25px;
    overflow: hidden;
    position: relative;
}

/* Credit Bar */
.credit-bar {
    height: 10px;
    background-color: #28a745;
    border-radius: 25px;
    transition: width 0.5s ease-in-out;
}

/* Score Percentage */
.d_level {
    background-color: #28a745;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 5px;
    font-size: 1rem;
    min-width: 60px;
    text-align: center;
    transition: background-color 0.3s;
}

/* Responsive Design */
@media (max-width: 768px) {
    .assessment {
        width: 100%;
        padding: 10px;
    }

    .credit-bar-wrapper {
        width: 65%;
    }

    .d_level {
        font-size: 0.9rem;
        padding: 0.4rem 0.8rem;
    }
}

@media (max-width: 480px) {
    .score-container {
        flex-direction: column;
        gap: 5px;
    }

    .credit-bar-wrapper {
        width: 100%;
    }

    .d_level {
        width: 100%;
        margin-top: 5px;
    }
}


</style>





<div class="assessment">
    <div class="score-container">
        <div class="credit-bar-wrapper">
            <div class="credit-bar" id="creditBar"></div>
        </div>
        <h5 class="d_level" id="creditScore">70%</h5>
    </div>
</div>




<?php
$creditScore = 100; // Example: Value fetched from the database or set by admin
?>

<script>
document.addEventListener("DOMContentLoaded", function() {
    // Example: Fetch the credit score value from the server or admin setting
    var creditScore = <?php echo $creditScore ?>; // This would be fetched from the PHP backend

    // Update the bar width and the percentage display
    var creditBar = document.getElementById('creditBar');
    var creditScoreText = document.getElementById('creditScore');

    // Calculate the width of the bar based on the credit score
    var newWidth = creditScore + "%";

    creditBar.style.width = newWidth; // Set the new width of the bar
    creditScoreText.textContent = creditScore + "%"; // Update the percentage text

    // Optional: Change the color of the score text based on the score
    if (creditScore < 50) {
        creditScoreText.style.backgroundColor = "#dc3545"; // Red for low scores
        creditBar.style.backgroundColor = "#dc3545";
    } else if (creditScore < 80) {
        creditScoreText.style.backgroundColor = "#ffc107"; // Yellow for medium scores
        creditBar.style.backgroundColor = "#ffc107";
    } else {
        creditScoreText.style.backgroundColor = "#28a745"; // Green for high scores
        creditBar.style.backgroundColor = "#28a745";
    }
});

</script>

