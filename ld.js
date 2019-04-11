$(document).ready(function () {

	$(".like-btn").on("click", voting);
});

function voting() {
	var post_id = $(this).attr("data-id");
	$clicked_btn = $(this);
	if ($clicked_btn.hasClass("fa-thumbs-o-up")) {
		action = "upvote";
	} else if ($clicked_btn.hasClass("fa-thumbs-up")) {
		action = "un_upvote";
	}
	$.ajax({
		url: "op.php",
		type: "POST",
		data: {
			"action": action,
			"post_id": post_id
		},
		success: function (data) {
			res = JSON.parse(data);
			if (action == "upvote") {
				$clicked_btn.removeClass("fa-thumbs-o-up");
				$clicked_btn.addClass("fa-thumbs-up");
			} else if (action == "un_upvote") {
				$clicked_btn.removeClass("fa-thumbs-up");
				$clicked_btn.addClass("fa-thumbs-o-up");
			}

			$clicked_btn.siblings("span.votes").text(res['votes']);
		}
	});
}