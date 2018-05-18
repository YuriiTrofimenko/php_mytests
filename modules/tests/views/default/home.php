<div class="container">
	<div id="categories-container" class="row">
	</div>
</div>
<script type="text/javascript">
	app.handler(function() {
		//console.log('this ' + $(this));
		var $container = $(this).find("#categories-container");
		//console.log('container ' + $container);
		return function(params) {

			var preloaderHide = function() {
				$(".preloader-wrapper").css("display", "none");
			}
			
			$.ajax({
	            url: "index.php/?r=tests/category/get-categories",
	            dataType: 'json',
	            type: "POST",
	            cache : false
	        }).done(function(resp) {
	            
	            //В ответ получаем json-строку с данными о всех categories
	            var data = resp.data;
	            //Готовим шаблон таблицы categories при помощи библиотеки Hogan
			  	var template = Hogan.compile(
			  		'{{#data}}'
			  		+'<div class="col s12 m3 l3 xl3">'
						+'<div class="card">'
							+'<span class="card-title">{{name}}</span>'
							+'<div class="card-action">'
				          		+'<a href="#about">{{#parentId}}Разделы{{/parentId}}{{^parentId}}Тесты{{/parentId}}</a>'
							+'</div>'
						+'</div>'
					+'</div>'
					+'{{/data}}'
		  		);
			  	//Заполняем шаблон данными и помещаем на веб-страницу
		  		$('#categories-container').html(template.render(resp));
		  		preloaderHide();
	        });
	    }
	    
		//setTimeout(preloaderHide, 500);
	});
</script>