<?php
use yii\helpers\Html;
?>

<div class="parallax-container">
      <!-- <div class="parallax"><img src="images/parallax1.jpg"></div> -->
  	<h1 class="header center teal-text text-lighten-2">My Tests</h1>
  	<?php echo Html::img('@web/images/test-automation.png', ['class' => 'parallax']); ?>
  	<div class="row center">
  	<div class="col s12">
			<a href="#tests" id="download-button" class="btn-large waves-effect waves-light teal lighten-1">Начать тестирование</a>
		</div>
  	</div>
</div>
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