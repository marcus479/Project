const step1 = document.querySelector(".step1"),
      step2 = document.querySelector(".step2"),
      step3 = document.querySelector(".step3"),
      emailAddress = document.getElementById("emailAddress"),
      verifyEmail = document.getElementById("verifyEmail"),
      inputs = document.querySelectorAll(".otp-group input"),
      sendOtpButton = document.querySelector(".sendOtpButton"),
      verifyOtpButton = document.querySelector(".verifyOtpButton"),
      resetPasswordForm = document.getElementById("resetPasswordForm"),
      userEmailInput = document.getElementById("userEmail"); // Add this line

let OTP = "";
let userEmail = "";  // Store the user's email here

window.addEventListener("load", () => {
    emailjs.init("DWu-DSBMopke3OKAd"); 
    step2.style.display = "none";
    step3.style.display = "none";

    sendOtpButton.classList.add("disable");
    verifyOtpButton.classList.add("disable");
});

const validateEmail = (email) => {
    const re = /\S+@\S+\.\S+/;
    sendOtpButton.classList.toggle("disable", !re.test(email.trim()));
};

const generateOTP = () => {
    return Math.floor(1000 + Math.random() * 9000);
};

inputs.forEach((input) => {
    input.addEventListener("keyup", function (e) {
        if (this.value.length >= 1) {
            e.target.value = e.target.value.substr(0, 1);
        }
        const allFilled = Array.from(inputs).every(input => input.value !== "");
        verifyOtpButton.classList.toggle("disable", !allFilled);
    });
});

// Send OTP and save email
sendOtpButton.addEventListener("click", () => {
    sendOtpButton.innerHTML = "&#9889; Sending...";
    OTP = generateOTP(); 
    userEmail = emailAddress.value;  // Save the email entered by the user
    userEmailInput.value = userEmail; // Store email in the hidden input field
    const templateParameter = {
        from_name: "Selangor Sport Club",
        OTP: OTP,
        message: "Please find the attached file",
        reply_to: userEmail,
    };
    console.log("OTP: ", OTP);
    const serviceID = "service_p0hyfqc";
    const templateID = "template_l3xh7tz";
    
    emailjs.send(serviceID, templateID, templateParameter).then(
        (res) => {
            sendOtpButton.innerHTML = "Send OTP";
            verifyEmail.textContent = userEmail; 
            step1.style.display = "none";
            step2.style.display = "block";
            step3.style.display = "none";
        },
        (err) => {
            sendOtpButton.innerHTML = "Send OTP"; 
            alert("Failed to send OTP. Please try again.");
        }
    );
});

// Verify OTP and move to password reset step
verifyOtpButton.addEventListener("click", () => {
    const values = Array.from(inputs).map(input => input.value.trim()).join("");
    if (String(OTP) === String(values)) {
        step1.style.display = "none";
        step2.style.display = "none";
        step3.style.display = "block"; 
    } else {
        verifyOtpButton.classList.add("error-shake");
        setTimeout(() => {
            verifyOtpButton.classList.remove("error-shake");
        }, 1000);
    }
});

// Change email function
window.changeMyEmail = () => {
    step1.style.display = "block";
    step2.style.display = "none";
    step3.style.display = "none";
};