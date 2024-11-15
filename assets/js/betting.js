$(document).ready(function () { 

	$("#bettingForm").on('submit', (function(e) {
		e.preventDefault();
	
		var finalamount = $('input#finalamount').val();
		var counter = $('input#counter').val();
		var userid = $('input#userid').val();
		var inputgameid = $('input#inputgameid').val();
		var tab = $('input#tab').val();
		var placedValue = $('input#placedValue').val();
		// location.reload();
		// Validation checks
		if (finalamount == 0) {
			$('#payment').modal('hide');
			$('#alert').modal({backdrop: 'static', keyboard: false});
			$('#alert').modal('show');
			document.getElementById('alertmessage').innerHTML = "<h4>Fail !</h4><p>Invalid contract count, please try again !</p>";
			return false;
		}
		if (finalamount < 10) {
			$('#payment').modal('hide');
			$('#alert').modal({backdrop: 'static', keyboard: false});
			$('#alert').modal('show');
			document.getElementById('alertmessage').innerHTML = "<h4>Fail !</h4><p>Invalid contract count, please try again !</p>";
			return false;
		}
		if (finalamount > 100000) {
			$('#payment').modal('hide');
			$('#alert').modal({backdrop: 'static', keyboard: false});
			$('#alert').modal('show');
			document.getElementById('alertmessage').innerHTML = "<h4>Fail !</h4><p>Invalid contract count, please try again !</p>";
			return false;
		}
	
		if (counter < 30) {
			$('#payment').modal('hide');
			$('#alert').modal({backdrop: 'static', keyboard: false});
			$('#alert').modal('show');
			document.getElementById('alertmessage').innerHTML = "<h4>Fail !</h4><p>Invalid period, please try again !</p>";
			return false;
		}
	
		if (!$('#presalerule').is(':checked')) {
			$('#payment').modal('hide');
			$('#alert').modal({backdrop: 'static', keyboard: false});
			$('#alert').modal('show');
			document.getElementById('alertmessage').innerHTML = "<h4>Fail !</h4><p>Please select presale rule !</p>";
			return false;
		}
	
		// Send AJAX request
		$.ajax({
			type: "POST",
			url: "betNow.php",
			data: new FormData(this),
			contentType: false,
			cache: false,
			processData: false,
			success: function(html) {
				var arr = html.split('~');
				if (arr[0] == 1) {
					waitlist(tab, userid, tab + 'wait');
					$('#payment').modal('hide');
					var balance = parseFloat(arr[1]).toFixed(2);
					document.getElementById('balance').innerHTML = balance;
					$('#alert').modal({backdrop: 'static', keyboard: false});
					$('#alert').modal('show');
					document.getElementById('alertmessage').innerHTML = "<h4>Completed</h4><p>Your contract has been successfully completed.</p>";
					// setTimeout(function() {
					// 	location.reload();
					// }, 1000);
				}
				if (arr[0] == 8) {
					$('#payment').modal('hide');
					$('#alert').modal({backdrop: 'static', keyboard: false});
					$('#alert').modal('show');
					document.getElementById('alertmessage').innerHTML = "<h4>Completed</h4><p>Your contract has been successfully completed.</p>";
					return false;
				}
				else if (arr[0] == 2) {
					$('#payment').modal('hide');
					$('#alert').modal({backdrop: 'static', keyboard: false});
					$('#alert').modal('show');
					document.getElementById('alertmessage').innerHTML = "<h4>Fail !</h4><p>Invalid action, please try again !</p>";
					return false;
				}
				else if (arr[0] == 3) {
					$('#payment').modal('hide');
					$('#alert').modal({backdrop: 'static', keyboard: false});
					$('#alert').modal('show');
					document.getElementById('alertmessage').innerHTML = "<h4>Fail !</h4><p>Invalid period, please try again !</p>";
					return false;
				}
				else if (arr[0] == 7) {
					$('#payment').modal('hide');
					$('#alert').modal({backdrop: 'static', keyboard: false});
					$('#alert').modal('show');
					document.getElementById('alertmessage').innerHTML = "<h4>Fail !</h4><p>You have already placed a bet in this period. You cannot place another bet.</p>";
					return false;
				}
				else if (arr[0] == 4) {
					$('#payment').modal('hide');
					$('#alert').modal({backdrop: 'static', keyboard: false});
					$('#alert').modal('show');
					document.getElementById('alertmessage').innerHTML = "<h4>Fail !</h4><p>Invalid contract count, please try again !</p>";
					return false;
				}
				else if (arr[0] == 5) {
					$('#payment').modal('hide');
					$('#alert').modal({backdrop: 'static', keyboard: false});
					$('#alert').modal('show');
					document.getElementById('alertmessage').innerHTML = "<h4>Fail !</h4><p>Invalid contract count, please try again !</p>";
					return false;
				}
				else if (arr[0] == 6) {
					$('#payment').modal('hide');
					$('#alert').modal({backdrop: 'static', keyboard: false});
					$('#alert').modal('show');
					document.getElementById('alertmessage').innerHTML = "<h4>Fail !</h4><p>The balance is not enough !</p>";
					return false;
				}
			}
		});
	}));
	
//=============================payment detail=========================================================================

});
function refreshbalance(id){
	$('#loader').modal({backdrop: 'static', keyboard: false})  
	$('#loader').modal('show');
   
   $.ajax({
	   type: "Post",
	   data:"userid=" + id,
	   url: "getwalletbalance.php",
	   success: function (html) {
		   console.log(html);
		
			   document.getElementById('balance').innerHTML =html;
		 return false;
		 },
		 error: function (e) {}
		 });
	   
	   }
function waitlist(category,userid,containerid)
{ //alert(containerid);
var inputgameid=$("#futureid").val();

	$.ajax({
    type: "Post",
    data:"category=" + category+ "& userid=" + userid +"& periodid=" + inputgameid,
    url: "getwaitlist.php",
    success: function (html) { //alert(html);
		document.getElementById(containerid).innerHTML=html;
		},
      error: function (e) {}
      });
	}

	history.pushState(null, null, window.location.href);

// Listen for the back button event
window.onpopstate = function () {
    history.pushState(null, null, window.location.href);
};
// document.addEventListener("contextmenu", function(event) {
//     event.preventDefault();
// });