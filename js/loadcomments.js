$(document).ready(function(){
	var initVal = -1;
	var commentFunc = function(noCom) {
		var userName = $('#username').html();
		$.getJSON ("/getComments.php?food="+$('#foodtag').val()+"&noCom="+noCom+"", function(comments) {
			noCom = comments.length;
			$('.commentsection').find('.commentbox').remove();
			var userName = $('#username').html();
			for (i = 0; i < comments.length; i++){
				addComments(comments[i], userName);
			}
			commentFunc(noCom);
		});
	}
	commentFunc(initVal);
});

function addComments(comment, userName) {
	var newHtml = "<div class='commentbox'>";
	newHtml += "<p>" + removeQuotes(comment.user) + "</p>";
	newHtml += "<p>" + removeQuotes(comment.date) + "</p><br>";
	newHtml += "<p>" + removeQuotes(comment.comment) + "<p>";
	if (userName === removeQuotes(comment.user)){
		newHtml += "<div class='deletebutton'>";
		newHtml += "<button class='delete' type='submit' name='commentDelete'>Delete</button></div>";
	}
	newHtml += "</div><script src='/js/test.js'></script>";
	$(newHtml).insertBefore('#box');
}

function removeQuotes(str) {
	return str.replace(/\"/g, "");
}