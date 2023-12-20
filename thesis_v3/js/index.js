
function generateOTP(length) {
    const digits = '0123456789';
    let OTP = '';
    for (let i = 0; i < length; i++) {
      OTP += digits[Math.floor(Math.random() * 10)];
    }
    
    return OTP;
    
  }
  const otp = generateOTP(6);
    console.log('Generated OTP:', otp);
  
  // Generate a 6-digit OTP
  

function sendMail() {
   //const OTP = generateOTP();
    var params = {
        
      name: document.getElementById("name").value,
      email: document.getElementById("email").value,
      //message: document.getElementById("message").value,
      message: otp,
    };
  
    const serviceID = "service_qyitfcq";
    const templateID = "template_069ofwp";
  
      emailjs.send(serviceID, templateID, params)
      .then(res=>{
          document.getElementById("name").value = "";
          document.getElementById("email").value = "";
          document.getElementById("message").value = "";
          console.log(res);
          alert("Your message sent successfully!!")
  
      })
      .catch(err=>console.log(err));
  
  }

  