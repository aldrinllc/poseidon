// Registration
function rsb(event) {
    event.preventDefault();

    var email = document.getElementById("email").value;
    var pass = document.getElementById("password").value;
    var conpass = document.getElementById("password2").value;
    var username = document.getElementById("username").value;
    var invCode = document.getElementById("invitationcode").value;

    // Validate
    if (pass !== conpass) {
        alert("Passwords do not match.");
        return;
    }

    if (invCode !== "ako") {
        alert("Invalid invite code.");
        return;
    }

    const formData = new URLSearchParams();
    formData.append("email", email);
    formData.append("password", pass);
    formData.append("username", username);
    formData.append("invitationcode", invCode);
    alert("ja")
    fetch("assets/scripts/reg.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: formData.toString()
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        if (data.includes("success")) {
            // go back to top-level index.html
            window.location.href = "../index.html";
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Something went wrong. Check console.");
    });
}


// Login
function lga(event) {
    event.preventDefault();

    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    const formData = new URLSearchParams();
    formData.append("email", email);
    formData.append("password", password);

    fetch("assets/sripts/verify.php", {
        method: "POST",
        headers: { "Content-Type": "application/x-www-form-urlencoded" },
        body: formData.toString()
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        if (data.includes("successful")) {
            // go to dashboard inside same folder
            window.location.href = "../user/dashboard.php";
        }
    })
    .catch(error => {
        console.error("Error:", error);
        alert("Something went wrong. Check console.");
    });
}
