$(function(){

	callback = function(){
		$(".construction").each(function(){
			
			$construction = $(this);
			$remainingTime = $construction.find(".remaining-time");

			now = new Date();
			date = new Date($construction.data("finish-at"));
			difference = date - now;

			if(difference <= 0) {
				id = $construction.data("id");

				$.ajax({
					url: 		'queue/edit/' + id,
					success: 	function(){
						document.location.href = "http://" + document.location.host + "/game/building.html";
					},
					error: 		function(){
						document.location.href = "http://" + document.location.host + "/game/building.html";
					}
				});
			} else {
				$remainingTime.text(Math.floor(difference / 60) + " sec restantes…");
			}			
		});
	}

	setInterval(callback, 1000);
});