
	
	function selectUser(){
	var uname = document.getElementById("name").value;
	
	$.ajax({
		url: "fetchdatauser.php",
		method: "POST",
		data:{
			x : uname
			 },
		dataType:"JSON",
		success: function(data)
			 {
		 	document.getElementById("mobile").value = data.mobileno;
		 	document.getElementById("email").value = data.emailid;
		 	document.getElementById("mobile").setAttribute('readonly',true);
		 	document.getElementById("email").setAttribute('readonly',true);

		 	}
		})

	}