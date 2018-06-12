<div class="container">
	<div id="categories-container" class="row">
	</div>
</div>
<script type="text/javascript">
	app.handler(function(params) {
		//console.log('this ' + $(this));
		var $container = $(this).find("#categories-container");
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
			
			var getTests = function(_categoryid){

				var param = (_categoryid != "") ? "&parent=" + _categoryid : "";
				$.ajax({
		            url: "index.php/?r=tests/test/get-tests" + param,
		            dataType: 'json',
		            type: "POST",
		            cache : false
		        }).done(function(resp) {
		            
		            //В ответ получаем json-строку с данными о всех tests
		            var data = resp.data;
		            //Готовим шаблон таблицы tests при помощи библиотеки Hogan
				  	var template = Hogan.compile(
				  		'{{#data}}'
				  		+'<div class="col s12 m3 l3 xl3">'
							+'<div class="card">'
								+'<div class="card-content">'
									+'<span class="card-title">{{name}}</span>'
          							+'<p>{{description}}</p>'
        						+'</div>'
								+'<div class="card-action">'
					          		+'<a href="#tests:testid={{id}}">Пройти</a>'
								+'</div>'
							+'</div>'
						+'</div>'
						+'{{/data}}'
			  		);
			  		/*
						var template = Hogan.compile(
				  		'{{#data}}'
				  		+'<div class="col s12 m3 l3 xl3">'
							+'<div class="card">'
								+'<span class="card-title">{{name}}</span>'
								+'<div class="card-action">'
					          		+'<a href="#tests:categoryid={{id}}">{{#parentId}}Разделы{{/parentId}}{{^parentId}}Тесты{{/parentId}}</a>'
								+'</div>'
							+'</div>'
						+'</div>'
						+'{{/data}}'
			  			);
			  		*/
				  	//Заполняем шаблон данными и помещаем на веб-страницу
			  		$('#categories-container').html(template.render(resp));
			  		preloaderHide();
		        });
			}

			var getCategories = function(_categoryid){

				var param = (_categoryid != "") ? "&parent=" + _categoryid : "";
				$.ajax({
		            url: "index.php/?r=tests/category/get-categories" + param,
		            dataType: 'json',
		            type: "POST",
		            cache : false
		        }).done(function(resp) {

		        	console.log('test '+resp.status);
		        	if(resp == 'Forbidden (#403): Login Required'){

		        		alert('Auth error');
		        		return;
		        	}
		            
		            //В ответ получаем json-строку с данными о всех categories
		            if(resp.status){

		            	var data = resp.data;
			            //Готовим шаблон таблицы categories при помощи библиотеки Hogan
					  	var template = Hogan.compile(
					  		'{{#data}}'
					  		+'<div class="col s12 m3 l3 xl3">'
								+'<div class="card">'
									+'<div class="card-content">'
										+'<span class="card-title">{{name}}</span>'
									+'</div>'
									+'<div class="card-action">'
						          		+'<a href="#tests:categoryid={{id}}">Просмотр</a>'
									+'</div>'
								+'</div>'
							+'</div>'
							+'{{/data}}'
				  		);
				  		
					  	//Заполняем шаблон данными и помещаем на веб-страницу
				  		$('#categories-container').html(template.render(resp));
				  		preloaderHide();
		            } else {

		            	getTests(_categoryid);
		            }
		        }).fail(function(jqXHR, textStatus) {
				    //alert( "error" );
				    $('#categories-container').html(
				    	"<div>"
				    		+"<h6>Ошибка:</h6>"
				    		+"<span>"
				    			+ jqXHR.responseText
				    		+"</span>"
				    	+"</div>"
				    	);
				    preloaderHide();
				});
	        };

	        var getTest = function(_testid){

				var param = (_testid != "") ? "&testid=" + _testid : "";
				$.ajax({
		            url: "index.php/?r=tests/test/get-test" + param,
		            dataType: 'json',
		            type: "POST",
		            cache : false
		        }).done(function(resp) {
		            
		            //В ответ получаем json-строку с данными о test
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
			  		/*
						var template = Hogan.compile(
				  		'{{#data}}'
				  		+'<div class="col s12 m3 l3 xl3">'
							+'<div class="card">'
								+'<span class="card-title">{{name}}</span>'
								+'<div class="card-action">'
					          		+'<a href="#tests:categoryid={{id}}">{{#parentId}}Разделы{{/parentId}}{{^parentId}}Тесты{{/parentId}}</a>'
								+'</div>'
							+'</div>'
						+'</div>'
						+'{{/data}}'
			  			);
			  		*/
				  	//Заполняем шаблон данными и помещаем на веб-страницу
			  		$('#categories-container').html(template.render(resp));
			  		preloaderHide();
		        });
			}

	        if ('categoryid' in paramsObject) {

	        	getCategories(paramsObject.categoryid);
			} else if ('testid' in paramsObject) {

				getTest(paramsObject.testid);
			} else {

				getCategories("");
			}

	        /*
						var template = Hogan.compile(
				  		'{{#data}}'
				  		+'<div class="col s12 m3 l3 xl3">'
							+'<div class="card">'
								+'<span class="card-title">{{name}}</span>'
								+'<div class="card-action">'
					          		+'<a href="#tests:categoryid={{id}}">{{#parentId}}Разделы{{/parentId}}{{^parentId}}Тесты{{/parentId}}</a>'
								+'</div>'
							+'</div>'
						+'</div>'
						+'{{/data}}'
			  			);
			  		*/
	    }
	    
		//setTimeout(preloaderHide, 500);
	});
</script>