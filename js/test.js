$('.delete').click(function() {
	var array =$(this).parent().parent().find('p');
	var userName = $(array[0]).html();
	var date = $(array[1]).html(); 
	removeComment(userName, date, this);
});

function removeComment (userName, date, place){
	$.ajax({
		method: "POST",
		url: "/deleteusercomment.php",
		data: {
			user: userName,
			d: date
		},
		datatype: "text",
		success: function(response) {
			$(place).parent().parent().remove();
		}
	})

}