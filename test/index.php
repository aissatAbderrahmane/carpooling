<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title> Hammoudi Abdelmadjid  </title>
 <script type="text/javascript" lang="javascript">
		var envoyer;
		function ajaxi(obj){
				var xmls = new XMLHttpRequest();
				var parameters ="";
				
			if(typeof obj != "object"){
			 console.log("verify the parameters of ajax , parameters must be an obj ex: ajax({ ..... });");
			}else{
					
					xmls.open(obj.method, obj.action, true);
					xmls.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					
					xmls.onreadystatechange = function() {
						if(xmls.readyState == 4 && xmls.status == 200) {
							var return_data = xmls.responseText;
							document.getElementById("HELL").innerHTML = return_data;
						}
					}
					
					var i = 1;
					for(var OBJ in obj.values){
						
						parameters += OBJ+"="+obj.values[OBJ];
						if(Object.keys(obj.values).length > 1  & i != Object.keys(obj.values).length) parameters +="&";
						i++;
						
					}
					
					

				xmls.send(parameters);
				
			}
			
		}
		
		function connexion(elm){
		
			var DisableBody = document.createElement("div");
			var	Login = document.createElement("div");	
			DisableBody.style.width = "100%";
			DisableBody.style.height = "100%";
			DisableBody.style.background = "#000";
			DisableBody.style.display = "block";
			DisableBody.style.position = "absolute";
			DisableBody.style.opacity = "0.5";
			DisableBody.style.top = "0";
			Login.style.width = "auto";
			Login.style.height = "auto";
			Login.style.padding="26px";
			Login.style.background = "#fff";
			Login.style.position = "absolute";
			Login.style.top = "150px";
			Login.style.left = "560px";
			
				var LoginForm = document.createElement("div");
					var inputs = {
						"Email" : {
							"name" : "email",
							"type" : "text",
							"class" : "loginInput"
						},
						"Mot De Pass" : {
							"name" : "password",
							"type" : "password",
							"class" : "loginInput"
						}
					};
					
					//LoginForm.setAttribute("method","POST");
					//LoginForm.setAttribute("action","index.php?mode=cnx");
						var exitForm = document.createElement("button");
						var submitForm = document.createElement("input");
						submitForm.setAttribute("type","button");
						submitForm.setAttribute("value","Connexion");
						submitForm.setAttribute("id","submition");
						exitForm.innerHTML = "abondonner";

					for(var inp in inputs){
						
						var inps = document.createElement("input");
						var spn = document.createElement("span");
							spn.innerHTML = inp;
							for(var opt in inputs[inp]){	
								inps.setAttribute(opt,inputs[inp][opt]);
								
							}	
							
							LoginForm.appendChild(spn);
							LoginForm.appendChild(inps);
							
						var br = document.createElement("br");
							LoginForm.appendChild(inps);
							LoginForm.appendChild(br);
					}
				LoginForm.appendChild(br);
					
				LoginForm.appendChild(submitForm);
				Login.appendChild(LoginForm);
				Login.appendChild(exitForm);
			DisableBody.innerHTML = "?hsdlsijdlksdjlskjdl!";
			elm.appendChild(DisableBody);
			elm.appendChild(Login);

							
						document.getElementById("submition").onclick = function(){ 
								var EmailVal = document.getElementsByName("email")[0].value;
								var PassVal = document.getElementsByName("password")[0].value;
							  envoyer = {
								method : "POST",
								action : "cnx.php",
								values : {
									"email" : EmailVal,
									"password" : PassVal
								}
							};
						ajaxi(envoyer);
						elm.removeChild(Login);
						elm.removeChild(DisableBody);
						}	
					exitForm.onclick = function(){
						elm.removeChild(Login);
						elm.removeChild(DisableBody);
						
					};
		}
	 </script>
</head>
<body >

	
    <div id="header">

		<a href="javascript:connexion(document.body);">connexion</a>

		
	   </div>
    </div>
	<div id="HELL">	   
	</div>
	



</body>