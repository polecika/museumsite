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
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
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
<nav class="navbar navbar-inverse top-line" role="navigation">
    <div class="container">
        <div class="row">
            <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            </div>
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="/">Главная</a></li>
                    <li><a href="/partners/">Партнерам</a></li>
                    <li><a href="">Аренда</a></li>
                    <li><a href="">Поддержка музея</a></li>
                    <?
						$query="SELECT * FROM  `pages` WHERE `parent`=0";
						$result= mysqli_query($link, $query);
						 while ($row = $result->fetch_array())
						{
							 $rows[] = $row;
						}
						$i=1;
						
						foreach($rows as $row) {
							if($row["id"]!='49') {
								 echo '<li class="nav'.$i.' dropdown visible-xs">        
								 <a href="/'.$row["pu"].'" data-toggle="dropdown" class="dropdown-toggle">'.$row['name'].' <b class="caret"></b></a>
								 <ul class="dropdown-menu">';
								 $dir=$row["id"];
								 $query3="SELECT * FROM  `pages` WHERE `parent`='".$dir."'";
								 $result3= mysqli_query($link, $query3);
								 while($row3 = $result3->fetch_array()) {
									$rows3[] = $row3;
								}
								 foreach($rows3 as $row3) {  
									 echo '<li><a href="/'.$row["pu"].'/'.$row3["pu"].'">'.$row3['name'].'</a></li>';
								}
								$rows3= array();
								 echo '</ul>
								 </li> ';
								 $i++;
								 $result3->free();
								 
							}
						}
						$rows= array();
						$result->free();
					?>  
                </ul>
            </div>
        </div>
    </div>	
</nav>

<div class="header">
    <div class="container">
        <div class="row noxs center-items">
            <!--первая колонка-->
			<div class="col-md-3 col-xs-12 logo">
                <a href="/"><img src="/img/logo2.png" width="200"></a>
            </div>
            
			<!--вторая колонка-->
			<div class="col-md-3 col-md-offset-0 col-xs-10 col-xs-offset-1 text hidden-xs">
			<div class="flright">
				<div class="head_inform">
                    <div class="numbers">	
						<div class="h_adr">Адрес</div>
						<div class="h_pl">
							г. Москва, метро Кузнецкий Мост<br />
							Кузнецкий Мост, 12<br />
						</div>
					</div>
				</div>
            </div>
			</div>
            
			<!--третья колонка-->
			<div class="col-md-3 col-xs-12 info hidden-xs">
				<div class="flright">
				<div class="head_inform1">
                    <div class="numbers">	
						<div class="h_adr">Телефон:</div>
						<div class="h_pl">
							+7 (495) 88-88-888<br />
						</div>
						<div class="h_adr">E-mail:</div>
						<div class="h_pl">
						<a href="#" mailto="">info@mm.ru</a>
						</div>
					</div>
				</div>
            </div>
			</div>
            
			<!--четвертая колонка-->
			<div class="col-md-3 col-md-offset-0 col-xs-10 col-xs-offset-1 telephone clearfix">
			<div class="red_button_click">	
				<div class="flleft_j hidden-xs">
					<div class="hea_but">
						<a href="#CallbackModal" data-toggle="modal">Купить билет</a>
					</div>
					<div class="hea_but">
                        <a href="">Мы на карте</a>
                    </div>
				</div>
		<div class="flleft_j hidden-md hidden-lg sov_h_b">
		    <div class="hea_but">
                        <a href="#CallbackModal" data-toggle="modal">Купить билет</a>
                    </div>
		    <div class="hea_but">
                        <a href="">Мы на карте</a>
            </div>
		</div>
            </div>
		</div>
        </div>
    </div>
</div>
	
<div class="container-fluid menushadow">
    <div class="container">
        <div class="row">
            <div class="topmenu">
                <ul class="col-md-9 hidden-xs menu">
						<?
							$result= mysqli_query($link, $query);
							 while ($row = $result->fetch_array())
							{
								 $rows[] = $row;
							}
							foreach($rows as $row) {
								if($row["id"]!='49') {
								echo '<li class="topmenu-dropdown dropdown-toggle">
							<a href="/'.$row["pu"].'">'.$row['name'].'</a>';
							
									
									$dir=$row["id"];
									 $query3="SELECT * FROM  `pages` WHERE `parent`='".$dir."'";
									 $result3= mysqli_query($link, $query3);
										while($row3 = $result3->fetch_array()) {
										$rows3[] = $row3;
									}
									
									if(count($rows3)!=0) {
									echo '<ul class="dropdown-menu">
										<li>
										
										<ul class="submenu">';
									foreach($rows3 as $row3) { 
											echo '<li>
												<a href="/'.$row["pu"].'/'.$row3["pu"].'">'.$row3['name'].'</a>
											</li>';
									}	
									$rows3= array();
									$result3->free();
									echo '</ul>
										</li>
										
									</ul>';
									}
									 
							echo '</li>';
							}
							}
							$rows= array();
							$result->free();
						?>
                        
							
						
                </ul>
                
            </div>
        </div>
    </div>
</div>   
     
<!--Вытащила отдельно блок visit.php чтобы можно было менять размеры слайдера, независимо от контентной части-->  

<div class="new_con">
	
     
	<? 
		if($row1['id']==49) {
			include 'includes/visit.php';
		}
	?>
	
	
</div>
	  	  
<div class="container osn_s" id='content'>
	<? 
	if($row1['id']==49) {
	
	//include 'includes/visit.php';
	include 'includes/exposition.php';
	include 'includes/events.php';
	//include 'includes/calendar.php';
	include 'includes/about.php';
	include 'includes/contacts.php';
	include '/includes/gallery.php';
	}
	elseif($row1['id']==33) {
		echo '<h1>Отзывы</h1>';
		$query="SELECT * FROM  `comments`";
		$result= mysqli_query($link, $query);
		while($row = $result->fetch_array())
		{
			$rows[] = $row;
		}
		foreach($rows as $row) {
			echo $row['name'].'    '.$row['date'];
			echo '<br><p>'.$row['text'].'</p>';
		}
	}
	else 
	{
		echo '<a href="/">Главная</a> &raquo; '.$way; // Еще не готово
		echo '<h1>'.$row1['name'].'</h1>';
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





<div class="footer_pre">
	<div class="container podpiska">
		<div class="col-md-7 col-xs-12">
			<b>ПОЧТОВАЯ РАССЫЛКА</b><br />
			Подпишитесь на нашу рассылку и получайте новости о последних мероприятиях Музея советских игровых автоматов первыми
		</div>
		<div class="col-md-5 col-xs-12">
			<div class="podp_fo">
			<input type="email" id="ot_fio" class="form-control sov_in_p" placeholder="Ваш Email" />
			<button type="submit" class="btn btn-default sov_btn_p"><span class="glyphicon glyphicon-chevron-right"></span></button>
			</div>
		</div>
            </div>
	</div>
</div>
<div class="footer">
    <div class="container">
        <div class="row">
            <div class="logo col-md-2 col-xs-12">
                <a href="#"><img src="/img/logo2.png" width="200"></a>
            </div>
            <div class="footer-menu col-md-4 col-md-offset-1 col-xs-10 col-xs-offset-1">
                <div class="row">
                    <div class="col-xs-6" >
                        <ul class="sovik_ul">
                            <li><a href="">Посещение</a></li>
                            <li><a href="">Календарь</a></li>
							<li><a href="">Выставки</a></li>
                            <li><a href="">События</a></li>
							<li><a href="">О музее</a></li>
                            <li><a href="">Коллекция</a></li>
							<li><a href="">Поддержка музея</a></li>
                        </ul>
                    </div>
                    <div class="col-xs-6">
                        <ul class="sovik_ul">
                            <li><a href=""><p  class="text_icon"> Вконтакте</p></a></li>
                            <li><a href=""><p class="text_icon"> Facebook</i></p></li>
							<li><a href=""><p class="text_icon"> Instagram</i></p></li>
                            <li><a href=""><p  class="text_icon"> Одноклассники</i></p></li>
							<li><a href=""><p  class="text_icon">Youtube</i></p></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-5 col-xs-12 info">
                <div class="row">
                    <div class="col-md-10 col-xs-10 col-xs-offset-1">
                        <div class="left posp">
                            <p class="address">
				<b>КОНТАКТЫ</b><br />
				г. Москва, метро Кузнецкий Мост
				Кузнецкий Мост, 12
				+7 (495) 88-88-888 
				info@mm.ru
			    </p>
                        </div>
                    </div>
                    <div class="col-md-10 col-xs-10 col-xs-offset-1">
                        <div class="right posp">
                            <p class="worktime">
				<b>ВРЕМЯ РАБОТЫ</b><br />
				Музей открыт для посещения ежедневно с 11:00 до 21:00 
				До одиннадцати утра вы можете организовать у нас детский праздник.
				А после девяти вечера — праздник для взрослых.
			    </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="footer">
    <div class="container">
	<div class="col-md-12 col-xs-12">
	    <a href="#rules" data-toggle="modal" class="policy">Правила посещения музея советских игровых автоматов</a> | <a href="#policy" data-toggle="modal" class="policy">Лицензионное соглашение</a>
	</div>
    </div>
</div>
<div class="footer">
    <div class="container">
	<div class="col-md-12 col-xs-12">
	    @ Музей советских игровых автоматов 2017
	</div>
    </div>
</div>
<div id="CallbackModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Заказать звонок</h4>
            </div>      
            <form>
                <div class="modal-body">       
                    <div class="form-group">
                        <input type="text" id="inputnamre1"  class="form-control" placeholder="Ваше имя">
                    </div>
                    <div class="form-group">      
                        <input type="text" id="inputphone1"  class="form-control phone_recall" placeholder="Номер телефона">
                    </div>              
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary callback-submit" onclick="s_frm_cart_main(2);return false;">Отправить</button>
                </div>  
            </form>
        </div>
    </div>
</div> 
<div id="policy" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Пользовательское соглашение</h4>
            </div>      
            
			<div class="modal-body">       
				<p><strong>1.Общие условия</strong></p>
				<p>1.1. Использование материалов и сервисов Сайта регулируется нормами действующего законодательства Российской Федерации.</p>
				<p>1.2. Настоящее Соглашение является публичной офертой. Получая доступ к материалам Сайта Пользователь считается присоединившимся к настоящему Соглашению.</p>
				<p>1.3. Администрация Сайта вправе в любое время в одностороннем порядке изменять условия настоящего Соглашения. Такие изменения вступают в силу по истечении 3 (Трех) дней с момента размещения новой версии Соглашения на сайте. При несогласии Пользователя с внесенными изменениями он обязан отказаться от доступа к Сайту, прекратить использование материалов и сервисов Сайта.</p>
				<p><strong>2. Обязательства Пользователя</strong></p>
				<p>2.1. Пользователь соглашается не предпринимать действий, которые могут рассматриваться как нарушающие российское законодательство или нормы международного права, в том числе в сфере интеллектуальной собственности, авторских и/или смежных правах, а также любых действий, которые приводят или могут привести к нарушению нормальной работы Сайта и сервисов Сайта. </p>
				<p>2.2. Использование материалов Сайта без согласия правообладателей не допускается (статья 1270 Г.К РФ). Для правомерного использования материалов Сайта необходимо заключение лицензионных договоров (получение лицензий) от Правообладателей. </p>
				<p>2.3. При цитировании материалов Сайта, включая охраняемые авторские произведения, ссылка на Сайт обязательна (подпункт 1 пункта 1 статьи 1274 Г.К РФ).</p>
				<p>2.4. Комментарии и иные записи Пользователя на Сайте не должны вступать в противоречие с требованиями законодательства Российской Федерации и общепринятых норм морали и нравственности.</p>
				<p>2.5. Пользователь предупрежден о том, что Администрация Сайта не несет ответственности за посещение и использование им внешних ресурсов, ссылки на которые могут содержаться на сайте.</p>
				<p>2.6. Пользователь согласен с тем, что Администрация Сайта не несет ответственности и не имеет прямых или косвенных обязательств перед Пользователем в связи с любыми возможными или возникшими потерями или убытками, связанными с любым содержанием Сайта, регистрацией авторских прав и сведениями о такой регистрации, товарами или услугами, доступными на или полученными через внешние сайты или ресурсы либо иные контакты Пользователя, в которые он вступил, используя размещенную на Сайте информацию или ссылки на внешние ресурсы.</p>
				<p>2.7. Пользователь принимает положение о том, что все материалы и сервисы Сайта или любая их часть могут сопровождаться рекламой. Пользователь согласен с тем, что Администрация Сайта не несет какой-либо ответственности и не имеет каких-либо обязательств в связи с такой рекламой.</p>
				<p><strong>3. Прочие условия</strong></p>
				<p>3.1. Все возможные споры, вытекающие из настоящего Соглашения или связанные с ним, подлежат разрешению в соответствии с действующим законодательством Российской Федерации.</p>
				<p>3.2. Ничто в Соглашении не может пониматься как установление между Пользователем и Администрации Сайта агентских отношений, отношений товарищества, отношений по совместной деятельности, отношений личного найма, либо каких-то иных отношений, прямо не предусмотренных Соглашением.</p>
				<p>3.3. Признание судом какого-либо положения Соглашения недействительным или не подлежащим принудительному исполнению не влечет недействительности иных положений Соглашения.</p>
				<p>3.4. Бездействие со стороны Администрации Сайта в случае нарушения кем-либо из Пользователей положений Соглашения не лишает Администрацию Сайта права предпринять позднее соответствующие действия в защиту своих интересов и защиту авторских прав на охраняемые в соответствии с законодательством материалы Сайта.</p>
			</div>
			<div class="modal-footer">
				 <button  class="btn btn-default" data-dismiss="modal">Закрыть</button>
			</div>  
            
        </div>
    </div>
</div> 
<div id="rules" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Правила посещения музея советских игровых автоматов</h4>
            </div>      
            
                <div class="modal-body">       
					<h5>Правила посещения МСИА:</h5>
					<ul>
						<li>Вход в Музей советских игровых автоматов осуществляется по входному билету. Находиться в зале музея без билета лицам старше семи лет запрещено.</li>
						<li>Лица до 16 лет могут пройти в музей только в сопровождении родителей.</li>
						<li>Посетители музея должны сохранять билет до конца посещения.</li>
						<li>Необходимо соблюдать технику безопасности при посещении музея:<br>
						- обращать внимание на предупреждающие надписи и знаки (в музее есть места с низким потолком)<br>
						- не трогать проводку<br>
						- не пытаться достать монеты из автоматов (в некоторых автоматах есть острые детали)<br>
						- следить за детьми
						</li>
						<li>В случае возникновения задымлений или пожара, а также ситуаций, которые могут повлиять на безопасность посетителей или музейного комплекса, следует немедленно известить об этом сотрудников музея.</li>
						<li>В случае обнаружения безнадзорных вещей и предметов, следует немедленно сообщить об этом сотрудникам музея.</li>
						<li>Лицо, причинившее материальный ущерб музею, обязано возместить его.</li>
						<li>Территория музея, экспозиции и выставочные павильоны контролируются видеокамерами.</li>
						<li>Посетители обязаны покинуть территорию музея ко времени его закрытия.</li>
					</ul> 
					<h5>Посетителям музея запрещается:</h5>
					<ul>
						<li>Входить в музей в нетрезвом виде, а также в состоянии наркотического или токсического опьянения; в грязной, дурно пахнущей одежде.</li>
						<li>Курить на территории и в помещениях музея (в том числе электронные сигареты).</li>
						<li>Приносить с собой и распивать спиртные напитки.</li>
						<li>Проносить и употреблять продукты питания (для этого есть зона кафе).</li>
						<li>Проводить или/и проносить любых животных любых размеров.</li>
						<li>Бегать по территории музея, особенно по лестницам.</li>
						<li>Причинять любой материальный ущерб находящемуся на территории движимому и недвижимому имуществу музея и сторонних организаций.</li>
						<li>Наносить вред экспонатам музея: бить по экспонатам или ломать их.</li>
						<li>Портить и срывать этикетки, выставочные тексты, информационные стенды и указатели.</li>
						<li>Наносить любые надписи на территории и в залах музея.</li>
						<li>Пытаться самостоятельно починить автомат.</li>
						<li>Трогать проводку, лазить за автоматами и под ними.</li>
						<li>Открывать или пытаться открыть автоматы.</li>
						<li>Опускать в монетоприемники автоматов современные деньги или любые другие посторонние предметы.</li>
						<li>Ставить на экспонаты сумки, личные вещи, стаканы или бутылки с водой, класть одежду.</li>
						<li>Засорять и загрязнять помещения и территорию музея;</li>
						<li>Заходить за ограждения объектов, в служебные помещения.</li>
						<li>Создавать ситуации угрожающие экспонатам и мешающие движению посетителей и экскурсионных групп.</li>
						<li>Оставлять детей без присмотра.</li>
						<li>Использовать площади музея без письменного разрешения его администрации для занятия коммерческой, рекламной, экскурсионной и иной деятельностью.</li>
					</ul>          
                </div>
                <div class="modal-footer">
                    <button  class="btn btn-default" data-dismiss="modal">Закрыть</button>
                </div>  
           
        </div>
    </div>
</div> 




<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="https://code.jquery.com/jquery-3.1.0.min.js"></script>

<script src="jquery-1.11.2.min.js"></script>


<script src="/js/bootstrap.min.js"></script>

<script src="/js/jquery.maskedinput.js"></script>
<script src="http://bootstraptema.ru/plugins/jquery/jquery-1.11.3.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="/admin/js/jquery.xfade-1.0.min.js"></script>
<script type="text/javascript" src="/admin/js/gallery-admin.js"></script>
<script src="/js/jquery.scrollbox.js"></script>



<!--Слайдер на главной-->
<script src="js/skdslider.js"></script>
<script src="js/main.js"></script>

<script type="text/javascript" src="/admin/js/jquery-lenta.js"></script>
<script type="text/javascript" src="/admin/js/jquery.jcarousellite.js"></script>
<script src="/js/owl.carousel.min.js"></script>
<script type="text/javascript" src="/js/swap-gallery.js"></script>





</body>
</html>