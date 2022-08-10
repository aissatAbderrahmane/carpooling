		var envoyer;
		function redirects(loc){
			window.setTimeout(function() {location.href = loc;}, 2000);
		}
		function animations(elm,tops){
			var i = 0;
			var inter = setInterval(function(){
				if(i<=tops){
					elm.style.top = i+"px";
					i++;
				}else clearInterval(inter);
			},20);
			
		}
		function ajaxi(obj,dom,loc){
				var xmls = new XMLHttpRequest();
				var parameters ="";
				
			if(typeof obj != "object"){
			 console.log("verify the parameters of ajax , parameters must be an obj ex: ajax({ ..... });");
			}else{
					if(obj.method == "POST" || obj.method == "post"){
					xmls.open(obj.method, obj.action, true);
					xmls.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
					
					xmls.onreadystatechange = function() {
						if(xmls.readyState == 4 && xmls.status == 200) {
							var return_data = xmls.responseText;
							dom.innerHTML = return_data;
							redirects(loc);
							
						}
					}
					
					var i = 1;
					for(var OBJ in obj.values){
						
						parameters += OBJ+"="+obj.values[OBJ];
						if(Object.keys(obj.values).length > 1  & i != Object.keys(obj.values).length) parameters +="&";
						i++;
						
					}
					
					

				xmls.send(parameters);
				}else if(obj.method == "GET" || obj.method == "get"){
					var i = 1;
					for(var OBJ in obj.values){
						
						parameters += OBJ+"="+obj.values[OBJ];
						if(Object.keys(obj.values).length > 1  & i != Object.keys(obj.values).length) parameters +="&";
						i++;
						
					}
					xmls.onreadystatechange = function() {

						if(xmls.readyState == 4) {
							if (xmls.status==200 || window.location.href.indexOf("http")==-1)
							{
							var return_data = xmls.responseText;
							dom.innerHTML = return_data;
							}
						}

				}
				xmls.open(obj.method,obj.action+"?"+parameters,true);
				xmls.send(null);
			}
			
		}
		}
		function connexion(elm){
		
			var DisableBody = document.createElement("div");
			var	Login = document.createElement("div");	
			DisableBody.setAttribute("id","dsb_body");
					Login.setAttribute("id","box-form");
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
						var cent = document.createElement("center");
						var submitForm = document.createElement("input");
						submitForm.setAttribute("type","button");
						submitForm.setAttribute("value","Connexion");
						submitForm.setAttribute("id","submition");
						

					for(var inp in inputs){
						
						var inps = document.createElement("input");
						var spn = document.createElement("span");
							spn.innerHTML = inp;
							for(var opt in inputs[inp]){	
								inps.setAttribute(opt,inputs[inp][opt]);
								
							}	
							LoginForm.setAttribute("id","LogBox");
							LoginForm.appendChild(spn);
							LoginForm.appendChild(inps);
							
						var br = document.createElement("br");
							LoginForm.appendChild(inps);
							LoginForm.appendChild(br);
					}
				LoginForm.appendChild(br);
					
				LoginForm.appendChild(submitForm);
				cent.appendChild(LoginForm);
				Login.appendChild(cent);
			DisableBody.innerHTML = "";
			elm.appendChild(DisableBody);
			elm.appendChild(Login);
				animations(Login,"150");
							
						document.getElementById("submition").onclick = function(){ 
								var EmailVal = document.getElementsByName("email")[0].value;
								var PassVal = document.getElementsByName("password")[0].value;
							   envoyer = {
								method : "POST",
								action : "connexion.html",
								values : {
									"email" : EmailVal,
									"password" : PassVal
								}
							};
						ajaxi(envoyer,Login,"home.html");
						
						
						}	
					DisableBody.onclick = function(){
						elm.removeChild(Login);
						elm.removeChild(DisableBody);
						
					};
		}

function createBox(bd,val){
	var  DisableBody = document.createElement("div"),
	conts = document.createElement("div");
	// disabling Body
	DisableBody.setAttribute("id","dsb_body");

	bd.appendChild(DisableBody);

	// adding Box 
	conts.setAttribute("id","NewBox");
	bd.appendChild(conts);
	if(typeof val == "object"){
		for(var opt in val){
			var p = document.createElement("p"),
				span = document.createElement("span"),
				span2 = document.createElement("span");
				span.innerHTML = opt + " : ";
				span2.innerHTML = val[opt];
				p.appendChild(span);
				p.appendChild(span2);
				conts.appendChild(p);
				p.setAttribute("id","BoxValues");
				span.setAttribute("id","BoxValues-title");
		}


	}else conts.innerHTML = val;	
	DisableBody.onclick = function(){
		bd.removeChild(conts);
		bd.removeChild(this);
	};
}
