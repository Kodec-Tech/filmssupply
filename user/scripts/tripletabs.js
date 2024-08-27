document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab');
    const tabContents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', function() {
            // Remove active class from all tabs
            tabs.forEach(t => t.classList.remove('active'));

            // Remove active class from all tab contents
            tabContents.forEach(content => content.classList.remove('active'));

            // Add active class to the clicked tab
            tab.classList.add('active');

            // Add active class to the corresponding tab content
            const tabContent = document.getElementById(tab.getAttribute('data-tab'));
            tabContent.classList.add('active');
        });
    });
});