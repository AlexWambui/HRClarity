// Function to open the form popup
function popupForm() {
    var popupForms = document.getElementsByClassName("popupform_wrapper");
    popupForms[0].style.display = "block";
}

// Function to close the form popup and reset form values
function closeForm() {
    var popupForms = document.getElementsByClassName("popupform_wrapper");
    popupForms[0].style.display = "none";

    // Reset form values
    var form = document.getElementById("popup_form");
    form.reset();
}