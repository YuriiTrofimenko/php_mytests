<div class="container">
	<div id="question-container" class="row">
		questions
	</div>
</div>
<script type="text/javascript">
	app.handler(function(params) {
		//console.log('this ' + $(this));
		var $container = $(this).find("#question-container");
		//console.log('container ' + $container);
		return function(params) {

			var preloaderHide = function() {
				$(".preloader-wrapper").css("display", "none");
			}

			console.log(params);

			params = (params != undefined) ? params : "";
			
			function urlParamsToObject(_params) {
			  
			  var result = {};
			  _params.split("&").forEach(function(part) {
			    var item = part.split("=");
			    result[item[0]] = decodeURIComponent(item[1]);
			  });
			  return result;
			}

			var paramsObject = urlParamsToObject(params);
			console.log(paramsObject);
			var param = (paramsObject.testid != "") ? "&testid=" + paramsObject.testid : "";
			$.ajax({
	            url: "index.php/?r=tests/question/get-question" + param,
	            dataType: 'json',
	            type: "POST",
	            cache : false
	        }).done(function(resp) {
	            
	            console.log(resp);
	            /*//В ответ получаем json-строку с данными о test
	            var data = resp.data;
	            //Готовим шаблон test при помощи библиотеки Hogan
			  	var template = Hogan.compile(
			  		'{{#data}}'
			  		+'<div class="col s12 m3 l3 xl3">'
						+'<div class="card">'
							+'<div class="card-content">'
								+'<span class="card-title">{{name}}</span>'
							+'</div>'
							+'<div class="card-action">'
				          		+'<a href="#tests:questionid={{id}}">Пройти</a>'
							+'</div>'
						+'</div>'
					+'</div>'
					+'{{/data}}'
		  		);
			  	//Заполняем шаблон данными и помещаем на веб-страницу
		  		$('#categories-container').html(template.render(resp));*/
		  		preloaderHide();
	        });
			
			setTimeout(preloaderHide, 500);
	    }
	});
</script>