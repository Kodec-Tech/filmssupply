function showContent(contentId) {
    // Hide all dropdown content
    const contents = document.querySelectorAll('.dropdown-content');
    contents.forEach(content => content.classList.remove('active'));

    // Remove active class from all tabs
    const tabs = document.querySelectorAll('.tab');
    tabs.forEach(tab => tab.classList.remove('active'));

    // Show the clicked tab's content and set the tab as active
    document.getElementById(contentId).classList.add('active');
    document.getElementById(contentId.replace('content', 'tab')).classList.add('active');
}