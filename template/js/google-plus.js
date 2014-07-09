function gpReview() 
{
  var myParams = {
    'clientid' : '397622945009-50kknq4pn0b3sjhv6qu20agmt3rk2jfr.apps.googleusercontent.com',
    'cookiepolicy' : 'single_host_origin',
    'callback' : 'loginCallback',
    'approvalprompt':'force',
    'scope' : 'https://www.googleapis.com/auth/plus.profile.emails.read'
  };
  gapi.auth.signIn(myParams);
}
 
function loginCallback(result)
{
    if(result['status']['signed_in'])
    {
    	gapi.client.load('plus','v1', function(){
	        var request = gapi.client.plus.people.get(
	        {
	            'userId': 'me'
	        });
	        request.execute(function(resp) {
				email = resp['emails'].filter(function(v) {
					return v.type === 'account'; // Filter out the primary email
				})[0].value;
				name = resp.displayName;
				var content = $('#txt_content').val();
				var rating 	= $('input[name=rating]').val();
				var ref_id	= $('#attraction_id').val();
				var nationality = $('input#ip').val();
				var category_id = $('#category_id').val();

				$.ajax({
					type : 'POST',
					data : { author: resp.displayName, email: email, content: content, rating: rating, ref_id: ref_id, nationality: nationality, category_id:category_id},
					url : 'http://www.travelovietnam.com/vietnam/insertReview',
					success :   function(data){
						if (data[0]) {
							$('#txt_content').val('');
							$('#txt_fullname').val('');
							$('#txt_email').val('');
							openSuccessPopup();	
						}
					},async:false
				});
			});
 		});
    }
 
}
function onLoadCallback()
{
    gapi.client.setApiKey('AIzaSyAQovXmAmq0EJ6QoYKMyUHWgBAiloPBPR0');
    gapi.client.load('plus', 'v1',function(){});
}

(function() {
	var po = document.createElement('script');
	po.type = 'text/javascript'; po.async = true;
	po.src = 'https://apis.google.com/js/client:plusone.js?onload=render';
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(po, s);
 })();