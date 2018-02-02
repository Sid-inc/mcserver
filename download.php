<?php
    
    function get_git($srclink, $dstlink){ 	// Функция выкачивания файлов с github.com
						// Входные параметры: ссылка на репозиторий и путь для загрузки файлов
	include 'modules/simple_html_dom.php';  // Подключаем парсер
	echo "1";
	$convurl = $srclink;
	$filelink = str_replace("/tree/", "/blob/", $srclink);
	$dwnloadlink = str_replace("/tree/", "/", $srclink);
	if(!stristr($srclink,'tree')){				// Если в ссылке нет tree значит мы в корне
	    $convurl = str_replace("/blob/", "/", $srclink); // Убираем из ссылки на репозиторий /blob/
	    $folderurl = str_replace("/blob/", "/tree/", $srclink); // Делаем шаблон ссылки на папки
	    $src = $convurl;					// Записываем ссылку с master на случай если мы в корневом каталоге
	    $dwnloadlink = $convurl;	
	    $convurl = str_replace("/master", "", $convurl);	// Значит убираем master из ссылки для загрузки страницы парса	    
	    $filelink = $srclink;
	};

	$downloadurl = "https://raw.githubusercontent.com".$dwnloadlink."/"; // Собираем ссылку для загрузки

	file_put_contents($dstlink.'src.tmp', file_get_contents("https://github.com".$convurl)); // Качаем страницу с гитхаба для поиска ссылок на файлы
	$html = file_get_html($dstlink.'src.tmp'); // Парсим страницу
	$links = $html->find('a[href^='.$filelink.']'); // Ищем ссылки на файлы


	foreach($links as $lin){		// Перебираем полученные ссылки
	    $filename=pathinfo($lin->href);	// Выделяем из них только имена файлов
	    if($filename['basename'] ==""){
	    return;
	    };
    	    file_put_contents($dstlink.$filename['basename'], file_get_contents($downloadurl.$filename['basename'])); // Качаем файлы
//	    echo $dstlink.$filename['basename'];
//	    echo "<br>";
//	    echo $downloadurl.$filename['basename'];
//	    echo "<br>";
	};


	$folders = $html->find('a[href^='.$folderurl.'/]'); // Ищем ссылки на папки
	if(count($folders)){
	    foreach($folders as $folder){
		$foldername = pathinfo($folder->href);
		echo $foldername['basename'];
		echo "<br>";
		mkdir($dstlink.$foldername['basename'], 0777);
		echo $folderurl."/".$foldername['basename'];
		echo "<br>";
		echo $dstlink.$foldername['basename']."/";
		get_git($folderurl."/".$foldername['basename'],$dstlink.$foldername['basename']."/");
		echo $folderurl."/".$foldername['basename'];
		echo "<br>";
		echo $dstlink.$foldername['basename']."/";
		echo "<br>";
	    };
	    $html->clear(); // Подчищаем за собой
	    unset($html);
	}else{
	    return;
	};
	return;
    };

    $url = "/Sid-inc/mcserver/blob/master";
//    $url = "/Sid-inc/mcserver/tree/master/counter";
    $downloadpath = "downloads/";
//    $downloadpath = "downloads/counter/";

    get_git($url,$downloadpath);


?>
