window.fbAsyncInit = function() {
  FB.init({
	appId		: '208630569323561',
	status		: true, // check login status
	cookies		: true, // enable cookies to allow the server to access the session
	xfbml 		: true  // parse XFBML
  });


  };

  // Load the SDK asynchronously
(function(d){
	var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
	if (d.getElementById(id)) {return;}
	js = d.createElement('script'); js.id = id; js.async = true;
	js.src = "//connect.facebook.net/en_US/all.js";
	ref.parentNode.insertBefore(js, ref);
}(document));

  // Here we run a very simple test of the Graph API after login is successful. 
  // This testAPI() function is only called in those cases. 

function facebookLogin(controllerUrl,redirectUrl){
	FB.login(function(response) {
		if (response.authResponse) {
			FB.api('/me', function(info) {
				var id = info.id;

				$.ajax({
					type : 'POST',
					data : { id: info.id, fullname: info.name, email: info.email, username: info.username },
					url : controllerUrl,
					success :   function(data){
						window.location.href = data;
					}
				});
			});
		} else {
			console.log('User cancelled login or did not fully authorize.');
		}
	},{scope: 'email'});
}

function facebookLogout(redirectUrl){
	FB.logout(function(response) {
		window.location.href = redirectUrl;
	});
}

function fbReview(url,ref_id){
	FB.login(function(response) {
		if (response.authResponse) {
			FB.api('/me', function(info) {
				var p = {};
				p['content'] = $('#txt_content').val();
				p['author'] = info.name;
				p['email'] = info.email;
				p['rating'] = $('input[name=rating]').val();
				p['ref_id'] = ref_id;
				p['nationality'] = $('input#ip').val();
				p['category_id'] = $('#category_id').val();

				$.ajax({
					type: "POST",
					url: url,
					data: p,
					dataType: 'json',
					success: function(result){
						console.log(result);
						if (result[0]) {
							$('#txt_content').val('');
							$('#txt_fullname').val('');
							$('#txt_email').val('');
							openSuccessPopup();	
						}
					},async:false
				});
			});
		} else {
			console.log('User cancelled login or did not fully authorize.');
		}
	},{scope: 'email'});
}


  
  
