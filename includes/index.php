<? 
include 'includes/config.php';
$url = mb_substr($_SERVER['REQUEST_URI'],1);
list($pu1, $pu2) = explode("/", $url);
if($pu1!="")
{	
	
	if($pu2!="")
	{
		$query1 = "SELECT  *  FROM  `pages` WHERE `pu`='".$pu2."'";
		
	} 
	else{
		$query1 = "SELECT  *  FROM  `pages` WHERE `pu`='".$pu1."'";
		
	}
}
else
{
	//Текст главной страницы
	$query1 = "SELECT  *  FROM  `pages` WHERE `id`='49'";
}
$result1 = mysqli_query($link, $query1);
$row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC);
$result1->free();

if(isset($_POST['add_comment']))
{
	$name=$_POST['name'];
	$date=date("Y-m-d");
	$text=$_POST['text'];
	$queryin="INSERT INTO `comments`(`name`, `text`, `date`) VALUES ('".$name."', '".$text."', '".$date."')";
	$resultin = mysqli_query($link, $queryin);
	header('Location: /otzivi/');
}
if(isset($_POST['add_email']))
{
	$email=$_POST['email'];
	$querymail="INSERT INTO `email`(`email`) VALUES ('".$email."')";
	$resultmail = mysqli_query($link, $querymail);
	header('Location: /'.$url.'');
	
}
if(isset($_POST['add_callback']))
{
	$name=$_POST['name'];
	$telephone=$_POST['telephone'];
	$querycall="INSERT INTO `callback`(`name`, `telephone`) VALUES ('".$name."', '".$telephone."')";
	$resultcall = mysqli_query($link, $querycall);
	header('Location: /'.$url.'');
}

$id=$row1['id'];
$way="";

//хлебные крошки
while($id > 0) {
	$sql="SELECT `parent`, `name`, `pu`  FROM `pages` WHERE `id`='".$id."'";
	$resultsql = mysqli_query($link, $sql);
	$rowsql = mysqli_fetch_array($resultsql, MYSQLI_ASSOC);
	$way='<a href="/'.$rowsql['pu'].'">'.$rowsql['name']."</a> &raquo ".$way;
	$id=$rowsql['parent'];
}


?>


<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<?
echo '<title>'.$row1['title'].'</title>
<meta name="description" content="'.$row1['description'].'" />
<meta name="keywords" content="'.$row1['keywords'].'" />';

?>

<link href="/css/bootstrap.css" rel="stylesheet">

<link rel="stylesheet" href="/css/style.css">
<link rel="stylesheet" href="/css/owl.carousel.min.css">
<link rel="stylesheet" href="/css/owl.theme.default.min.css">

<link rel="stylesheet" href='/css/info_page.css'>
<link rel="stylesheet" href="/css/add_style.css"> 
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="shortcut icon" href="http://fontawesome.io/assets/ico/favicon.ico">

<style>
.carousel {
 margin-top: 20px;
}
.item .thumb {
 width: 25%;
 cursor: pointer;
 float: left;
}
.item .thumb img {
 width: 100%;
 margin: 2px;
}
.item img {
 width: 100%; 
}


</style>
</head>
<body>    



<? include 'includes/nav1.php';
include 'includes/header.php';
include 'includes/nav2.php';
?>
	

     
<!--Вытащила отдельно блок visit.php чтобы можно было менять размеры слайдера, независимо от контентной части-->  

<div class="new_con"> 
	<? 
		if($row1['id']==49) {
			include 'includes/visit.php';
		}
	?>
</div>


<? 
if($row1['id']==49) 
{
	echo '<div class="container osn_s" id="content">';
	include 'includes/about.php';
	echo '</div>';
}
	?>


<div class="new_con">
	<? 
		if($row1['id']==49) {
			include 'includes/exposition.php';
		}
	?>
</div>
	  	  
<div class="container osn_s" id='content'>
	<? 
	if($row1['id']==49) {
	
	//include 'includes/about.php';
	include 'includes/arenda.php';
	//include 'includes/visit.php';
	//include 'includes/exposition.php';
	include 'includes/events.php';
	//include 'includes/calendar.php';
	//include 'includes/contacts.php';
	include '/includes/gallery.php';
	}
	elseif($row1['id']==33) {
		echo '<a href="/">Главная</a> &raquo '.$way;
		echo '<h1 class="glavnaya_text">'.$row1['name'].'</h1>';
		include 'includes/otzivi.php';
	}
	else 
	{
		echo '<a href="/">Главная</a> &raquo '.$way; // Еще не готово
		echo '<h1 class="glavnaya_text">'.$row1['name'].'</h1>';
		echo '<p>'.$row1['text'].'</p>';
		if($row1['exposition']=="1") {
			include 'includes/exposition.php'; 
		}
		if($row1['arenda']=="1") { 
		include 'includes/arenda.php'; 
		}
		if($row1['gallery']=="1") { 
			include 'includes/gallery.php'; 
		}
		if($row1['events']=="1") { 
			include 'includes/events.php'; 
		}
		if($row1['calendar']=="1") {
			include 'includes/calendar.php';
		}
		if($row1['exposition_avtomati']=="1") { 
			include 'includes/exposition_avtomati.php'; 
		}
		if($row1['contacts']=="1") { 
			include 'includes/contacts.php'; 
		}
		if($row1['administration']=="1") {
			include 'includes/administration.php';
		}
		
	}
	
	
	?>
</div>







	<? 
		if($row1['id']==49) {
			echo '<div class="new_con1">';
			include 'includes/contacts.php';
			echo '</div>';
		}
	?>



<? 
include 'includes/footer.php'; 
include 'includes/modalcall.php';
include 'includes/modalfooter.php';
?>



<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/jquery.maskedinput.js"></script>
<script src="http://bootstraptema.ru/plugins/jquery/jquery-1.11.3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="/js/lightbox.js"></script>
<script type="text/javascript" src="/admin/js/jquery.xfade-1.0.min.js"></script>
<script type="text/javascript" src="/admin/js/gallery-admin.js"></script>
<script src="/js/jquery.scrollbox.js"></script>

<!--Слайдер на главной-->
<script src="/js/skdslider.js"></script>
<script src="/js/main.js"></script>
<script type="text/javascript" src="/admin/js/jquery-lenta.js"></script>
<script type="text/javascript" src="/admin/js/jquery.jcarousellite.js"></script>
<script type="text/javascript" src="/js/swap-gallery.js"></script>
<script src="/js/owl.carousel.js"></script>

<script>

 $(".new").owlCarousel({
        loop: true
        , margin: 10
        , nav: true
		, dots: false
		, autoplay: true
		, autoplayTimeout: 3000
        , responsive: {
            0: {
                items: 1
            }
            , 600: {
                items: 2
            }
            , 1000: {
                items: 5
            }
        }
    });

	
      function initMap() {
        var uluru = {lat: 55.76174565, lng: 37.62120557};
        
		var map = new google.maps.Map(document.getElementById('yandex-map'), {
          zoom: 17,
          center: uluru
        });
		
        var marker = new google.maps.Marker({
          position: uluru,
          map: map,
		  draggable:false,
		  icon:'/img/log_m.png'
        });
		
		
      }
	  
    </script>

<script>
$(document).ready(function() {
	$('.owl-carousel').owlCarousel({
		loop:true, //Зацикливаем слайдер
		margin:10, //Отступ от картино если выводите больше 1
		nav:true, //Отключил навигацию
		autoplay:true, //Автозапуск слайдера
		smartSpeed:2200, //Время движения слайда
		autoplayTimeout:4400, //Время смены слайда
		responsive:{ //Адаптация в зависимости от разрешения экрана
			0:{
				items:1
			},
			600:{
				items:1
			},
			1000:{
				items:1
			}
		}
	});
});
</script>
    <script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDYGkHYM5tuA_XTutEFgbvl0fTJF5V_VKA&callback=initMap">
    </script>
</body>
</html>