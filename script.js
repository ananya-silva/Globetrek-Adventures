//vaidation for index page
function showForm(formId) {
  //select both form-box and removes the active class from both
  document
    .querySelectorAll(".form-box")
    .forEach((form) => form.classList.remove("active")); //and only add active for one form (login / register)
  document.getElementById(formId).classList.add("active"); //formId = which form to display
}

document.addEventListener("DOMContentLoaded", function () {
  //to check if the page is fully loaded before run the js
  const registerForm = document.querySelector("#register-form form"); //select the register form

  registerForm.addEventListener("submit", function (e) {
    //js runs after user clicks the register button
    const password = document.getElementById("registerPassword").value; //get the passwords from both fields
    const confirmPassword = document.getElementById("confirmPassword").value;

    if (password !== confirmPassword) {
      //compare the passwords to check if they match
      e.preventDefault(); //if there's a error then stops sending data to the db and display the error
      alert("Passwords do not match!");
    }
  });
});
