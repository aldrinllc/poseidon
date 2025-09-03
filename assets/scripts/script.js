function rsb(event) {
    event.preventDefault();

    // Get values from the input fields
    var email = document.getElementById("email").value;
    var pass = document.getElementById("password").value;
    var conpass = document.getElementById("password2").value;
    var username = document.getElementById("username").value;
    var invCode = document.getElementById("invitationcode").value;

    // Validate passwords match
    if (pass !== conpass) {
        alert("Passwords do not match.");
        return;
    }

    // Validate invitation code
    if (invCode !== "ako") {
        alert("Invalid invite code.");
        return;
    }

    // If everything is good
    alert("Registration validation passed.");

    // Prepare data to send to PHP
    const formData = new URLSearchParams();
    formData.append("email", email);
    formData.append("password", pass);
    formData.append("username", username);
    formData.append("invitationcode", invCode);

    // Send data to your PHP file
    fetch("/../../../auth/reg.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/x-www-form-urlencoded"
        },
        body: formData.toString()
    })
    .then(response => response.text())
    .then(data => {
        alert(data); // This will be whatever your PHP returns
        if (data.includes("success")) {
            window.location.href = "../index.html";
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Something went wrong. Check console.");
    });
}
function lga(event){
    event.preventDefault();
    //var email, password;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    const formData = new URLSearchParams();
    formData.append("email",email);
    formData.append("password",password);
    fetch("/../../../../auth/verify.php",{
        method: "POST",
        body:formData,
    })
    .then(response =>response.text())
    .then(data => {
        alert(data);
        if(data.includes("successful")){
            window.location.href = "../../user/dashboard.php";
        }
    })
    .catch(error=> {
        console.error("Error: ", error);
    })
}