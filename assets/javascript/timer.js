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
						document.location.href = "http://192.168.233.129:2001/index.php/game/building.html";
					}
				});
			} else {
				$remainingTime.text(difference + " sec restantes…");
			}			
		});
	}

	setInterval(callback, 1000);
});