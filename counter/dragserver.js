window.onload = $(function() {
    $(document).ready(function(){ //переименовать
        var link = window.location.pathname; //путь без хоста
        $('.nav li a[href="'+link+'"]').parents('li').addClass('lon');
    });
  //вытаскиванием координаты из локального хранилища
  //1. Получаем координаты (getItem).
  //2. Парсим (parse).
  //3. Получаем значения (values).
  var saved = Object.values(JSON.parse(localStorage.getItem('position')));
  //console.log(saved);
  //присваиваем стили блоку
  $(".box2").css({'left': saved[1], 'top': saved[0]});
  $('.box2').draggable({
    cursor: 'pointer',
    containment: 'parent', //перетаскивание в пределах body
    //остановка события (бросили элемент)
    stop: function(event, ui){ //ui - перетаскиваемый элемент
        var coords = {
            'top': ui.position.top,
            'left': ui.position.left
        };
        $(".box2").css({'left': coords[1], 'top': coords[0]}); //присваимваем стили
        localStorage.setItem("position", JSON.stringify(coords)); //делаем строкой и записываем в локальное хранилище
        }
    });
}).trigger('dragstop');


// window.onload = $(function() {
  
//   $('.box2').draggable({
//     cursor: 'pointer',
//     containment: 'parent' //перетаскивание в пределах body
// });
// });

// $(document).ready(function(){
//         var link = window.location.pathname; //путь без хоста
//         $('.nav li a[href="'+link+'"]').parents('li').addClass('lon');
//     });
