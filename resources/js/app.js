require('./bootstrap');

window.Noty = require('noty');
Noty.overrideDefaults({
    theme: 'bootstrap-v4',
    type: 'warning',
    layout: 'center',
    modal: true,
});

// Make 'Student_Administration' accessible inside the HTML pages
import Student_Administration from "./Student_Administration";
window.Student_Administration = Student_Administration;
// Run the hello() function
Student_Administration.hello();

$('#filterSelect').change(function () {
    $(this).parents("form").submit();
})

let loc = window.location.pathname;
$('#nav').find('a').each(function() {
    $(this).toggleClass('active', $(this).attr('href') == loc);
});


