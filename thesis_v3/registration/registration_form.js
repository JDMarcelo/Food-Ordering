  // Modify the form submission to use AJAX
  console.log("js is working!")
  document.querySelector('form').addEventListener('submit', function (event) {
    event.preventDefault(); // Prevent the default form submission
    var isValid = validateForm();

    if (isValid) {
        // Use AJAX to submit the form data
        var otp = sendOTP(); //added by ferds
        var formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            body: formData
        })
            .then(response => response.json())
            .then(data => {
                if (data.errors) {
                    // Display errors in the form
                    Object.entries(data.errors).forEach(([field, error]) => {
                        document.getElementById(`${field}Error`).innerHTML = error;
                    });
                } else if (data.success) {
                    // Handle success (comment out or remove the redirection)
                     window.location.href = '../otp/otp_verification.php'; // Redirect to the OTP verification page
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

//added by ferds
    function sendMail(otp) {
                
                const email = document.getElementById("email").value;
            
                var params = {
                    name: document.getElementById("first_name").value,
                    email: email,
                    message: otp,
                    to_email: email, // Set the recipient's email dynamically
                    reply_to: email, // Set the reply_to field to the same email
                };

                
                const serviceID = "service_qyitfcq";
                const templateID = "template_069ofwp";
            
                emailjs.send(serviceID, templateID, params)
                    .then(res => {
                        console.log(res);
                        alert("Your message sent successfully!!");
                        window.otp = otp;
                        
                    })
                    .catch(err => console.log(err));
            }

        function generateOTP(length) {
        const digits = '0123456789';
        let OTP = '';
        for (let i = 0; i < length; i++) {
            OTP += digits[Math.floor(Math.random() * 10)];
        }
        return OTP;
    }

    function sendOTP() {
        const otps = generateOTP(6);
        console.log('Generated OTP:', otps);
        localStorage.setItem('Aotp', otps);

        // Use the OTP value in your logic to send it via email
        // Your email sending logic using emailjs or other services can be placed here
        sendMail(otps);
        // Return the generated OTP for later use
        return otp;
    }
    
    //end of na-add ni ferds

});