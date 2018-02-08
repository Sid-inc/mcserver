<?php
    include 'modules/simple_html_dom.php';  // Подключаем парсер

    function get_git($srclink, $dstlink){ 	// Функция выкачивания файлов с github.com
						// Входные параметры: ссылка на репозиторий и путь для загрузки файлов

	$convurl = $srclink;
	$filelink = str_replace("/tree/", "/blob/", $srclink);
	$dwnloadlink = str_replace("/tree/", "/", $srclink);
	if(!stristr($srclink,'tree')){				// Если в ссылке нет tree значит мы в корне
	    $convurl = str_replace("/blob/", "/", $srclink); // Убираем из ссылки на репозиторий /blob/
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
    	    file_put_contents($dstlink.$filename['basename'], file_get_contents($downloadurl.$filename['basename'])); // Качаем файлы
	    chmod($dstlink.$filename['basename'], 0755);
	};
	$html->clear(); // Подчищаем за собой
	unset($html);
	unlink($dstlink.'src.tmp');
	return;
    };

    function get_folders($srclink, $dstlink){    

	$convurl = $srclink;
	$filelink = str_replace("/tree/", "/blob/", $srclink);
	$dwnloadlink = str_replace("/tree/", "/", $srclink);
	if(!stristr($srclink,'tree')){				// Если в ссылке нет tree значит мы в корне
	    $convurl = str_replace("/blob/", "/", $srclink); // Убираем из ссылки на репозиторий /blob/
	    $folderurl = str_replace("/blob/", "/tree/", $srclink); // Делаем шаблон ссылки на папки
	    $dwnloadlink = $convurl;	
	    $convurl = str_replace("/master", "", $convurl);	// Значит убираем master из ссылки для загрузки страницы парса	    
	    $filelink = $srclink;
	};

	$downloadurl = "https://raw.githubusercontent.com".$dwnloadlink."/"; // Собираем ссылку для загрузки
	
	file_put_contents($dstlink.'src.tmp', file_get_contents("https://github.com".$convurl)); // Качаем страницу с гитхаба для поиска ссылок на файлы
        $html = file_get_html($dstlink.'src.tmp'); // Парсим страницу
        $folders = $html->find('a[href^='.$folderurl.'/]'); // Ищем ссылки на папки
        foreach($folders as $folder){
	    $foldername = pathinfo($folder->href);
            mkdir($dstlink.$foldername['basename'], 0777);
    	    get_git($folderurl."/".$foldername['basename'],$dstlink.$foldername['basename']."/");
	};
        $html->clear(); // Подчищаем за собой
        unset($html);
	unlink($dstlink.'src.tmp');
        return;
    };


    $url = "/Sid-inc/mcserver/blob/master";
    $downloadpath = "downloads/";

    get_git($url,$downloadpath);
    get_folders($url,$downloadpath);

    $mvsrcfolder = dirname(__FILE__);
    $mvdstfolder = "update_backup";
    $mvupfolders = "downloads";

    function mvfiles($srcfolder, $dstfolder){
	$nomv = array(
	"1" => ".",
	"2" => "..",
	"3" => "mcmap",
	"4" => ".cache",
	"5" => ".config",
	"6" => ".local",
	"7" => "back",
	"8" => "downloads",
	"9" => ".bash_history",
	"10" => ".htaccess",
	"11" => "update_backup",
	"12" => "download.php",
	"13" => "simple_html_dom.php"
        );
	if(is_dir($srcfolder)){
	    @mkdir($dstfolder);
	    $d = dir($srcfolder);
	    while (false !== ($entry = $d->read())){
		if(array_search($entry, $nomv)<>"") continue;
		mvfiles("$srcfolder/$entry","$dstfolder/$entry");
	    }
	    $d->close();
	}else{
	    copy($srcfolder, $dstfolder);
	    unlink($srcfolder);
	    echo $srcfolder;
	    echo "<br>";
	    echo $dstfolder;
	    echo "<br>";
	    
	    chmod($dstfolder, 0755);
	}
	
    }
    
    mvfiles($mvsrcfolder, $mvdstfolder);
    mvfiles($mvupfolders, $mvsrcfolder);



?>
