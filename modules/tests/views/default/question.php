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

			//console.log(params);

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
			//console.log(paramsObject);
			var param = (paramsObject.testid != "") ? "&testid=" + paramsObject.testid : "";

			//Готовим функцию
			function nextQuestion() {

				var checkedRadioButton = $('input[name=answer-group]:checked', 'form#send-answer');
				console.log(checkedRadioButton);
				var checkedRadioButtonValue = ($(checkedRadioButton).length == 1) ? $(checkedRadioButton).val() : null;
				console.log(checkedRadioButtonValue);
				$.ajax({
		            url: "index.php/?r=tests/question/get-question" + param,
		            dataType: 'json',
		            type: "POST",
		            data: {selection : checkedRadioButtonValue},
		            cache : false
		        }).done(function(resp) {
		            
		            //console.log(resp);
		            //В ответ получаем json-строку с данными о test
		            var data = resp.data;
		            var template = "";
		            //Готовим шаблон test при помощи библиотеки Hogan
		            if(data.hasOwnProperty('question')){

		            	template = Hogan.compile(
					  		'<div class="col s12 m12 l12 xl12">'
					  			+'<h6>Вопрос {{current_question_index}} из {{total_count}}:</h6>'
					  			+'<div>{{question}}</div>'
								+'<form id="send-answer" action="#">'
									+'{{#answers}}'
										+'<p>'
											+'<label>'
												+'<input name="answer-group" type="radio" value="{{id}}" />'
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

				  		$('#question-container').append(
				  			'<div class="col s12 m12 l12 xl12">'
				  				+ '<img class="responsive-img" src="../../web/images/test-automation.png" alt="">'
			  				+'</div>'
			  			);

				  		$('form#send-answer button').unbind('click');
				  		//Обработчик 
					    $('form#send-answer button').click(function(ev){

					        ev.preventDefault();
					        nextQuestion();
						});

						//Блокируем кнопк
						$('form#send-answer button').attr('disabled', '');

						//$('form input[type=radio]').unbind('click');
				  		//Обработчик 
					    $('form input[type=radio]').click(function(ev){

					        $('form input[type=radio]').unbind('click');
					        $('form#send-answer button').removeAttr('disabled');

						});
		            } if (data.hasOwnProperty('totalScore')){

		            	template = Hogan.compile(
					  		'<div class="col s12 m12 l12 xl12">'
					  			+'<h6>Вы набрали {{totalScore}} баллов из {{total}}</h6>'
					  			+'<div>Результат отправлен администратору на электронную почту</div>'
								+'<form id="send-answer" action="#">'
									+'<button class="btn waves-effect waves-light" type="submit" name="action">'
										+'Ok'
			                        	+'<i class="material-icons right">send</i>'
									+'</button>'
								+'</form>'
							+'</div>'
				  		);

				  		//Заполняем шаблон данными и помещаем на веб-страницу
				  		$('#question-container').html(template.render(data));
				  		$('#question-container').append(
				  			'<div class="col s12 m12 l12 xl12">'
				  				+ '<img class="responsive-img" src="../../web/images/test-automation.png" alt="">'
			  				+'</div>'
			  			);

				  		$('form#send-answer button').unbind('click');
				  		//Обработчик 
					    $('form#send-answer button').click(function(ev){

					        ev.preventDefault();
					        window.location.href = "#tests";
						});
		            }
			  		preloaderHide();
		        });
	        }
	        
	        nextQuestion();
			
			setTimeout(preloaderHide, 500);
	    }
	});
</script>