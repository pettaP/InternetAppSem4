$('.postit').click(function(){
	var userName = $('.postit').parent().find('.inputUser').val();
	var food = $('.postit').parent().find('.inputFood').val();
	var message = $('.postit').parent().find('.message').val();
	var date = $('.postit').parent().find('.inputDate').val();
	addComment(userName, food, message, date);
});

function addComment (userName, dish, message, date){

	if ( userName == null){
		$('.postit').parent().find('.message').html("You have to be logged in to comment");
	} else {
		$.ajax({
			method: "POST",
			url: "/postcomment.php",
			data: {
				user: userName,
				food: dish,
				msg: message,
				d: date
			},
			datatype: "text",
			success: function(response) {
				$('.postit').parent().find('.message').val("");
				var newHtml = "<div class='commentbox'>";
				newHtml += "<p>" + userName + "</p>";
				newHtml += "<p>" + date + "</p><br>";
				newHtml += "<p>" + message + "<p>";
				newHtml += "<div class='deletebutton'>";
				newHtml += "<button class='delete' type='submit' name='commentDelete'>Delete</button>";
				newHtml += "</div></div><script src='/js/test.js'></script>";
				$(newHtml).insertBefore('#box');
			}
		})
	}
}