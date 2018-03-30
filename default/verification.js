function verification() {

            var pattern = /^[a-zA-Z0-9\.]*$/;
            var pass1 = document.getElementById("password").value;
            var pass2 = document.getElementById("password2").value;

            document.getElementById('password').style = 'border-color: red;';
            document.getElementById('password2').style = 'border-color: red;';

            if(pattern.test(pass1) && pass1.length >= 6){
                document.getElementById('password').style = 'border-color: green;';
            }
            if(pattern.test(pass2) && pass2.length >= 6){
                document.getElementById('password2').style = 'border-color: green;';
            }
            if(document.getElementById("username").value == "" || document.getElementById("username").value.length < 4) {
                document.getElementById("username").style = 'border-color: red;';
                
            }
            else
                document.getElementById("username").style = 'border-color: green;';
            if(document.getElementById("email").value == "") {
                document.getElementById("email").style = 'border-color: red;';
            
            }
            else
                document.getElementById("email").style = 'border-color: green;';
            if((pass1 != pass2 || pass1.length < 6 || pass2.length < 6) && pass1 != ""){
                document.getElementById('password2').style = 'border-color: red;';
                document.getElementById("msg").innerText = "Les Mots de passes doivent etre les meme";
                
            }
            else{
                document.getElementById("msg").innerText = "";
            }

        }