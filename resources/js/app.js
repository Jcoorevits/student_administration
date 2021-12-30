require('./bootstrap');

// Make 'Student_Administration' accessible inside the HTML pages
import Student_Administration from "./Student_Administration";
window.Student_Administration = Student_Administration;
// Run the hello() function
Student_Administration.hello();

$('#filterSelect').change(function () {
    $(this).parents("form").submit();
})
