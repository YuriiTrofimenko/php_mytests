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

			//Готовим функцию
			function nextQuestion() {

				$.ajax({
		            url: "index.php/?r=tests/question/get-question" + param,
		            dataType: 'json',
		            type: "POST",
		            cache : false
		        }).done(function(resp) {
		            
		            console.log(resp);
		            //В ответ получаем json-строку с данными о test
		            var data = resp.data;
		            //Готовим шаблон test при помощи библиотеки Hogan
				  	var template = Hogan.compile(
				  		'<div class="col s12 m12 l12 xl12">'
				  			+'<h6>Вопрос {{current_question_index}} из {{total_count}}:</h6>'
				  			+'<div>{{question}}</div>'
							+'<form id="send-answer" action="#">'
								+'{{#answers}}'
									+'<p>'
										+'<label>'
											+'<input name="sort-group" type="radio" value="{{id}}" />'
											+'<span>{{text}}</span>'
										+'</label>'
									+'</p>'
								+'{{/answers}}'
								+'<button class="btn waves-effect waves-light" type="submit" name="action">'
									+'Далее'
		                        	+'<i class="material-icons right">send</i>'
								+'</button>'
							+'</form>'
						+'</div>'
						
			  		);
				  	//Заполняем шаблон данными и помещаем на веб-страницу
			  		$('#question-container').html(template.render(data));

			  		$('form#send-answer button').unbind('click');
			  		//Обработчик 
				    $('form#send-answer button').click(function(ev){

				        ev.preventDefault();

				        //location.reload();

				        nextQuestion();

				        /*$.ajax({
				            url: "../api/orders.php",
				            //method : "POST",
				            dataType: 'json',
				            type: "POST",
				            data: { 
				                'action': 'create-order'
				                , 'date': $('#calendar').val()
				                , 'hours-id': $('#time-select select option:selected').val()
				                , 'manicurist-id': $('#manicurists-select select option:selected').val()
				            },
				            cache : false
				        }).done(function(data) {

				            //console.log(data);
				            //Проверяем, успешно ли выполнено создание записи о заказе
				            if (data.result == 'created') {
				                //Сообщаем пользователю об успешной отправке (далее можно заменить на отображение сообщения в форме)
				                //alert('Заказ успешно добавлен');
				                populateTable();
				            } //Иначе сообщаем об ошибке (далее можно заменить на отображение сообщения в форме)
				            else {
				                alert('Ошибка добавления заказа');
				            }
						});*/
					});

			  		preloaderHide();
		        });
	        }
	        
	        nextQuestion();
			
			setTimeout(preloaderHide, 500);
	    }
	});
</script>