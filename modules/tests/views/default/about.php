about
<script type="text/javascript">
	app.handler(function() {
		
		return function(params) {

			var preloaderHide = function() {
				$(".preloader-wrapper").css("display", "none");
			}
			setTimeout(preloaderHide, 500);
		}
	});
</script>