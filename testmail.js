var	fnameS = document.getElementById("fname"), //FIRST LETS DECLARE WHATEVER VARIABLES WE CAN OUTSIDE OF THE FUNCTION
	emailS = document.getElementById("email"),	//THESE SHOULD BE THE ID's FROM YOUR FORM FIELDS
	mailS = document.getElementById("message"),
	send = document.getElementById("submit"),
	resp = document.getElementById("response"),
	error_c = document.getElementById("connect-err"),
	xmlhttp;									//DECLARE AJAX VARIABLE, FOR ODLER IE BROWSERS (5,6) USE ActiveXObject
        if (window.XMLHttpRequest) {			
            xmlhttp = new XMLHttpRequest();		
        } else {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
    function valInput() {
		var	fnamesend = fnameS.value,			//THESE ARE THE USER INPUT VALUES FROM FORM FIELDS, THEY HAVE TO BE
			emailsend = emailS.value,			//DECLARED INSIDE THE FUNCTION FOR FILTERS TO WORK PROPERLY
			mailsend = mailS.value,				
			params = ""
			+ "fname=" + encodeURIComponent(fnamesend) //IN ORDER FOR THE INPUTS TO REACH THE PHP FILE CORRECTLY,
			+ "&email=" + encodeURIComponent(emailsend)	//WE MUST USE encodeURIComponent
			+ "&message=" + encodeURIComponent(mailsend),
			conn_err = "<div class='connect-err'>Connection Lost! Please check your connection and submit again</div>";
														//ABOVE IS THE ERROR MESSAGE USERS WILL SEE IF THE AJAX
														//REQUEST FAILS TO GET A RESPONSE FROM THE SERVER
		
		resp.style.display = "block";	//ALLOW RESPONSES TO DISPLAY, YOU CAN HIDE THEM LATER 				
        
		xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {		//CHECK SERVER STAUS, EXECUTE FUNCTION IF 4,200
                valFunction(xmlhttp);									// 4 = REQUEST FINISHED, RESPONSE READY
            }															// 200 = STAUS OF REQUEST IS "OK'
        }
		
        xmlhttp.open("POST", "/test/test-contact.php", true);				//TELL AJAX WHICH PHP SCRIPT TO USE
        xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded"); //SET HEADERS
        xmlhttp.send(params);											//SEND OVER USER INPUTS TO PHP SCRIPT
        
		
		function valFunction() {
            valFunction.called = true;				//IF THE SERVER RESPONDED AND FUNCTION EXECUTED, SET VALUE TO TRUE
													//THIS IS WHAT WE WILL USE TO TELL USERS IF THEY WERE ABLE TO
													//CONNECT TO YOUR SERVER, IF NOT, THE conn_err MESSAGE WILL SHOW
            
			var data = xmlhttp.responseText;		//SET VARIABLE FOR OUR OUTPUT FROM PHP SCRIPT 
            resp.innerHTML = data;					//INSERT RESPONSES FROM OUR PHP SCRIPT INTO OUR FORM
            error_c.innerHTML = "";					//IF EVERYTHING EXECUTED CORRECLTY, CLEAR CONNECTION ERROR FIELD
        }
        setTimeout(function () {					//IF THE SERVER COULD NOT BE REACHED, SHOW THE CONNECTION ERROR
            if (!valFunction.called) {				//MESSAGE AFTER 5 SECONDS
                error_c.innerHTML = conn_err;
            }
        }, 5000);
    }
    window.timeDisplay = function () {				//THE FOLLOWING FUNCTIONS ARE FOR ERROR / SUCCESS MESSAGES
		
		
        resp.style.display = "none";				//HIDE THE RESPONSES IF YOU LIKE AFTER 5 SECONDS
        resp.innerHTML = "LOADING";					//THIS IS WHAT WILL SHOW WHILE THE AJAX REQUEST IS WAITING FOR PHP
													//SCRIPT TO RETURN THE RESPONSES. YOU CAN REPLACE WITH .GIF
        window.myTimer = setTimeout(timeDisplay, 5000);	
    }
    window.reset = function () {					//THIS FUNCTION IS USED TO MAKE SURE THE TIMEOUTS DON'T OVERLAP
        clearTimeout(window.myTimer);
        window.myTimer = setTimeout(timeDisplay, 5000);
    }
    window.myTimer = setTimeout(timeDisplay, 5000);
	
if (window.addEventListener) {						//CALLBACK FOR MODERN BROWSERS
	send.addEventListener("click", valInput, false);
    send.addEventListener("click", reset, false);
} else if (window.attachEvent) {					//CALLBACK FOR OLDER IE BROWSERS
    send.attachEvent("onclick", valInput);
    send.attachEvent("onclick", reset);
}
