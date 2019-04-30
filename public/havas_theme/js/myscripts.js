jQuery(document).ready(function($){     
	
	//номерация комментариев
    $('.commentlist li').each(function(i){
        $(this).find('div.commentNumber').text('#' + (i+1));
    });

    $('#commentform').on('click', '#submit', function(e){
        e.preventDefault(); //отменяем отправку формы
        
        var comParent = $(this); //форма #commentform
        
        //var wrap_result = $('.wrap_result'); //блок для вывода сообщений в всплывающем окне
        
    	$('.wrap_result').text('Отправка')
            .css({'color':'green'})
            //плавное появление блока
            .fadeIn(500, function(){
                //получение данных из формы
                var data = $('#commentform').serialize();

                $.ajax({
                    url:$('#commentform').attr('action'),
                    data: data,
                    type: 'POST',
                    dataType: 'json', //формат данных которые должен передать сервер
                    //токен указанный в шапке (meta) 
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                      },
                    success: function(html){
                         if(html.error){
                            $('.wrap_result').css('color', 'red').append('<br /><strong>Ошибка: </strong>' + html.error.join('<br />'))
                            $('.wrap_result').delay(2000).fadeOut(500);
                         }
                         else if(html.success){
                            $('.wrap_result').append('<br /><strong>Save!</strong')
                            .delay(2000)
                            .fadeOut(500,function(){
                                if(html.data.parent_id>0){
                                comParent.parents('div#respond').prev().after('<ul class="children list-unstyled ml-5 mt-3">'+html.comment+'</ul>');
                                }
                                else{
                                    if($.contains('#comments', 'ul.list-unstyled')){
                                        $('ul.list-unstyled').append(html.comment);
                                    }
                                    else{
                                        $('#respond').before('<ul class="list-unstyled group">' + html.comment + '</ul>');
                                    }
                                }

                                $('#cancel-comment-reply-link').click();
                            })
                         }                                                                                
                        
                    },

                    //Ошибка AJAX
                    error: function(){
                        $('.wrap_result').css('color', 'red').append('<br><strong>Ошибка!</strong>');
                        $('.wrap_result').delay(2000).fadeOut(500, function(){
                            //имитируем нажатие кнопки отмены ответа на комментарий для возврата формы вниз
                            $('#cancel-comment-reply-link').click();
});
                    },
                });

            });				
    });

}); 
