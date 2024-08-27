document.querySelectorAll('.tab').forEach(function(tab) {
    tab.addEventListener('click', function() {
        var targetTab = this.dataset.tab;
        var preloader = document.getElementById('preloader' + targetTab.charAt(targetTab.length - 1));
        var noTrans = document.querySelector(`#${targetTab} .trans_table.no_trans`);
        
        preloader.style.visibility = 'visible'; // Show the preloader
        
        setTimeout(function() {
            preloader.style.visibility = 'hidden'; // Hide the preloader after 1 second
            noTrans.style.display = 'block'; // Show the no transaction message (if exists)
        }, 1000);
    });
});