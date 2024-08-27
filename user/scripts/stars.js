const stars = document.querySelectorAll('.star');
const ratingResult = document.querySelector('.rating-result');
const ratingInput = document.getElementById('rating-value');

stars.forEach(star => {
    star.addEventListener('click', () => {
        const rating = star.getAttribute('data-value');
        updateRating(rating);
        ratingInput.value = rating;  // Set the rating value in the hidden input
    });
});

function updateRating(rating) {
    stars.forEach(star => {
        if (star.getAttribute('data-value') <= rating) {
            star.classList.add('selected');
        } else {
            star.classList.remove('selected');
        }
    });
    ratingResult.textContent = `${rating}/5`;
}