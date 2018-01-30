$(document).ready(function(){
  $("#submit").click( function(){

  $("#hid_reg").html(''); //очищаем поле      
  var name = $('#name').val(); //получаем значение элемента
  var login = $('#log').val();
  var data= "name=" + name + "&login=" + login; //объединяем данные
  //var data = $form.serialize(); //разбор объекта (данных) на элементы
  $.ajax({
          method: "post",
          url: "PHPscripts/registration_test.php",
          data: data,
          success: function(data){
              $("#hid_reg").html(data);
              $('#name').val(''); //очищаем поля
              $('#log').val(''); 
          }
      });
  $("#formreg").submit(
          function() {return false;}
            );
    });
  $("#auth").click( function(){
  $("#hid_auth").html(''); //очищаем поле      
  var login = "login=" + ($('#logi').val());
  $.ajax({
          method: "post",
          url: "PHPscripts/authorization.php",
          data: login,
          success: function(data){
            var data = JSON.parse(data);
            console.log(data);
            if (data.status == 'false'){ //если авторизация неудачна - выводим соответствующее сообщение
              $("#hid_auth").html(data.message); //data true/false
              $('#logi').val('');
            }
            else {
              $("#hid_auth").html("Привет," + data + "!"); //если удачно - выодим переменную сессии
              $('#logi').val('');
              $("#formauth").slideUp();
            }
              //$("#hid_auth").html(data); //data true/false
              //$('#logi').val('');
              //$("#formauth").slideUp();
              //$("#hid_auth").html(''); //очищаем поле  срабатывает при true
          }
      });
  $("#formauth").submit(
          function() {return false;}
            );
    });
});



//валидация на js. сразу пишет что не так и блокирует кнопку отправки.

/*$(window).load(function(){
    $('#formlogin').validate({
            rules:{
                name:{required: false, email:true},
                login:{required: true, minlength: 3},
            },
            messages:{
                email:'fffffffffffffffffff',
                login: 'gggggggggg',
            },
            invalidHandler:function(){
                $('div.error').hide();
            },
            focusInvalid:true,
            onfocusout:false,
            submitHandler: function() {
               // never hits with chrome, and alert works in FF4, 
               // but still goes to contact.php
               $('#formlogin').ajaxSubmit();
           }
        });
});*/
