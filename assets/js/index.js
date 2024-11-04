$(document).ready(function(){
    $('.dropdown-toggle').click(function(event) {
event.preventDefault(); // Prevent default anchor click behavior
$(this).next('.subnav').slideToggle(); // Toggle the subnav with a sliding effect
});
$('#toggle-menu').click(function() {
$('#left-menu').toggleClass('active'); // Toggle the active class
});
});

