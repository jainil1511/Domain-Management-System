    function validation(){

                var first = document.getElementById('firstname').value;
                var last = document.getElementById('lastname').value;
                var email1 = document.getElementById('email').value;
                var pass = document.getElementById('password').value;
                var conpass = document.getElementById('confirmpassword').value;
                


                if(first == ""){
                    document.getElementById('first').innerHTML ="* Plaese fill the firstname ";
                    return false;
                }
                if(!isNaN(first)){

                    document.getElementById('first').innerHTML ="* only Character Allowed";
                    return false;
                }       
                if(last == ""){
                    document.getElementById('last').innerHTML ="* Plaese fill the lastname ";
                    return false;
                }
                if(!isNaN(last)){

                    document.getElementById('last').innerHTML ="* only Character Allowed";
                }
                if(email1 == ""){
                    document.getElementById('emailid').innerHTML ="* please fill the Emails ";
                    return false;
                }
               var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

   				 if (!filter.test(email.value)) {
					document.getElementById('emailid').innerHTML = "Please provide a valid email address";
				return false;
				}
                if(pass == ""){
                    document.getElementById('passwords').innerHTML ="* Plaese fill the password ";
                    return false;
                }
                if((pass.length <= 5) || (pass.length > 20)){
                    document.getElementById('passwords').innerHTML = "* Password length must be between 5 and 20 ";
                    return false;
                }

                if(conpass == ""){
                    document.getElementById('conpassword').innerHTML = "* please fill the confirm password"
                    return false;
                }

                if(pass != conpass){    
                    document.getElementById('passwords').innerHTML ="* password are not matching"
                    return false;
                }
            
            }
