function pwordval(){
    var l = document.getElementById("less");
    var m = document.getElementById("more");
    var e = document.getElementById("empty");
    var d = document.getElementById('a_password').value;
    var set = document.getElementById("a_password");
    var lColor = "red";
    var mColor = "green";
        
        if (document.getElementById('a_password').value.length < 8) {         
            l.setAttribute('style', 'display: block');
            l.style.color = lColor;
            set.setAttribute('style', 'border: 1px solid red');
            m.setAttribute('style', 'display: none');
            e.setAttribute('style', 'display: none');
            
        } 

        else{

            l.setAttribute('style', 'display: none');       
            m.setAttribute('style', 'display: block');
            e.setAttribute('style', 'display: none');
            m.style.color = mColor;
            set.setAttribute('style', 'border: 1px solid green');
        }
        
        if(d==null||d==""){
            e.setAttribute('style', 'display: block');
            e.style.color = lColor;
            m.setAttribute('style', 'display: none');
            l.setAttribute('style', 'display: none'); 
        }
}


function unameval(){
    var letters = /^[A-Za-z]+$/;
    var doc = document.getElementById("a_username").value;
    var msg = document.getElementById("icon");
    var uColor = "red";
    
        if(doc.match(letters)){
            msg.setAttribute('style', 'display: none');    
            return true;
        }
        
        else{
            msg.setAttribute('style', 'display: block');
            msg.style.color = uColor;
            return false;
        }          
}

function phoneval(){
    var p = document.getElementById("a_phone").value;
    var pAlert = document.getElementById("phone");
    var pColor = "red";
        
        if (isNaN(p)){         
            pAlert.setAttribute('style', 'display: block');
            pAlert.style.color = pColor;
            
        } 
        else{
            pAlert.setAttribute('style', 'display: none'); 
        }
}

function usernameval(){
    var docc = document.getElementById("a_username");
    var u_doc = document.getElementById("a_username").value;
    var error = document.getElementById("u_error");
    var letters = /^[a-zA-Z0-9\s]+$/;
    var ok = document.getElementById("u_ok");
    var msg1 = document.getElementById("u_emp");
    var errorColor = "red";
    var okColor = "green";
  
    
        if(u_doc.match(letters)){
            ok.setAttribute('style', 'display: none'); 
            docc.setAttribute('style', 'border: 1px solid green');
            error.setAttribute('style', 'display: none');
            msg1.setAttribute('style', 'display: none');
            return true;
        }
        
        else{
            error.setAttribute('style', 'display: block');
            error.style.color = errorColor;
            ok.setAttribute('style', 'display: none');
            docc.setAttribute('style', 'border: 1px solid red');
            msg1.setAttribute('style', 'display: none');
        }
        
        if(u_doc==null||u_doc==""){
            msg1.setAttribute('style', 'display: block');
            msg1.style.color = errorColor;
            error.setAttribute('style', 'display: none');
            
        }


    
}
    

        