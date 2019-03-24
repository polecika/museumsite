<? 
include 'includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="description" content="Responsive Websites Using BootStrap - demo page">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="keywords" content="" />
	<meta name="description" content="" />
	<title>Музей</title>

    <!-- css stylesheets -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>

    

    <!-- Менюшка в шапке сайта фиксированная -->
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#b-menu-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="b-menu-1">
         <ul class="nav">
			
				<li><a href="#" style="color:white" >Партнерам</a> </li>
			
			<li><a href="#" style="color:white">Аренда</a></li>
			<li><a href="#" style="color:white">Поддержка музея</a></li>
		</ul>
        </div> 
      </div> 
    </div>
	
	<div class="row">
	<div class="menu123">
		<div class="col-xs-6 col-md-4"><div class="icon"><img src="img/img1.png" height="130px" width="200px" alt="Логотип" class="img-responsive"></div></div>
		<div class="col-xs-6 col-md-4">
			<p class="button1"><button type="button" class="btn" style="background:#DC143C; border:#DC143C; color:white;">Купить билет</button></p> 
			<p class="button2"><button type="button" class="btn" style="background:#DC143C; border:#DC143C; color:white;">Мы на карте</button></p>
		</div>
		<address class="adress">
			<strong>Адрес</strong><br />
			г.Москва, метро "Кузнецкий мост"<br />
			Кузнецкий мост, 12<br />
			<p class="phone">+7 (495) 628-45-15</p>
			<p class="mail">mdia@15kop.ru</p>
		</address>
	</div>
	</div>
	

    

    <!-- Container -->
    <div class="container">

      <!-- second menu bar -->
      <nav class="navbar navbar-default navbar-static">
       <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#b-menu-2">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>

        <!-- Главная менюшка сайта -->
       <div class="collapse navbar-collapse" id="b-menu-2">
          <ul class="nav navbar-nav">
			<? 
					$query="SELECT * FROM  `pages` WHERE `parent`=0";
					$result= mysqli_query($link, $query);
					while($row = $result->fetch_array())
					{
						$rows[] = $row;
					}
					foreach($rows as $row) {
						echo '<li class="dropdown">
					<a href="/'.$row["pu"].'" class="dropdown-toggle" data-toggle="dropdown"style="color:black"> '.$row["name"].' <b class="caret"></b></a>
					<ul class="dropdown-menu">
					';
						$dir=$row["id"];
						$query3="SELECT * FROM  `pages` WHERE `parent`='".$dir."'";
						$result3= mysqli_query($link, $query3);
						while($row3 = $result3->fetch_array())
							{
								$rows3[] = $row3;
							}
							foreach($rows3 as $row3) {
						echo '
							<li><a href="/'.$row["pu"].'/'.$row3["pu"].'" style="color:black"> '.$row3["name"].'</a></li>
							';
							$rows3= array();
						}
							
							echo '<li class="divider"></li>
							<li><a href="/'.$row["pu"].'">Посмотреть всё</a></li>
						</ul>
					</li>';
					}
				
			?>
			
			
          </ul>


        </div><!-- /.nav-collapse -->
      </nav>

      <!-- Место для текста -->
      <div class="row row-offcanvas row-offcanvas-right">
        <div class="col-xs-12 col-sm-9">
			 
			 <? echo //'Путь REDIRECT_URL: '.$_SERVER['REDIRECT_URL'];
			 //echo '<br>Путь REQUEST_URI: '.$_SERVER['REQUEST_URI'].'<br>';
			 $url = mb_substr($_SERVER['REQUEST_URI'],1);
			 list($pu1, $pu2) = explode("/", $url);
			 if($pu1!="")
			 {	
				
				if($pu2!="")
				{
					//echo '<br>$pu1'.$pu1.'<br>$pu2'.$pu2.'<br>';
					$query1 = "SELECT  *  FROM  `pages` WHERE `pu`='".$pu2."'";
					
				} //Кто пиздатый программист? Я пиздатый программист=)
				else{
					$query1 = "SELECT  *  FROM  `pages` WHERE `pu`='".$pu1."'";
					
				}
			}
			else
			{
				echo 'Текст главной страницы';
				//$query1 = "SELECT  *  FROM  `pages` WHERE `pu`=''";
			}
			$result = mysqli_query($link, $query1);
			$row1 = mysqli_fetch_array($result, MYSQLI_ASSOC);
			
            echo '<h1>'.$row1["name"].'</h1>
            <p>'.$row1["text"].'</p>';
        ?>
		</div><!--/span-->

       
          

         

        </div>

      </div>
	  
	  
	  <!-- Подвал сайта -->
    <footer id="footer">
	<div class="row">
		<div class="col-md-6 mail" >
			<h3>ПОЧТОВАЯ РАССЫЛКА</h3>
			<p class="text">Подпишитесь на нашу рассылку и получайте новости о последних мероприятиях Музея советских игровых автоматов первыми</p>
		</div>
		<div class="form">
		<div class="col-md-6">
			<form class="navbar-form navbar-left" role="search">
				<div class="form-group">
					<input type="text" class="form-control" placeholder="E-mail">
				</div>
					<button type="submit" class="btn btn-default"><span class="glyphicon glyphicon-chevron-right"></span></button>
			</form>
		</div>
		</div>
	</div>
	  
	  
    <div class="footer1">
	<div class="row">
		<div class="col-xs-6 col-sm-3"><div class="icon"><img src="../../img/logo2.png" height="130px" width="200px" alt="Логотип"></div></div>
		<div class="col-xs-6 col-sm-3">
			<p><a href="#"  class="text">Посещение</a></p>
			<p><a href="#"  class="text">Календарь</a></p>
			<p><a href="#"  class="text">Выставки</a></p>
			<p ><a href="#" class="text">События</a></p>
			<p ><a href="#" class="text">О музее</a></p>
			<p ><a href="#" class="text">Коллекция</a></p>
			<p ><a href="#" class="text">Поддержка музея</a></p>
		</div>
		<div class="col-xs-6 col-sm-3">
			<p><img src="../../img/1-1.png" height="20px" width="20px" alt="Логотип" class="icon1"><a href="#" class="text">Вконтакте</a></p>
			<p><img src="../../img/odnoklassniki-logo.png" height="20px" width="20px" alt="Логотип" class="icon1"><a href="#"  class="text">Одноклассники</a></p>
			<p><img src="../../img/facebook-logo-in-circular-button-outlined-social-symbol.png" height="20px" width="20px" alt="Логотип" class="icon1"><a href="#" class="text">Facebook</a></p>
			<p><img src="../../img/instagram.png" height="20px" width="20px" alt="Логотип" class="icon1"><a href="#" class="text">Instagram</a></p>
			<p><img src="../../img/tripadvisor-logotype.png" height="20px" width="20px" alt="Логотип" class="icon1"><a href="#" class="text">Tripadvisor</a></p>
		</div>
		<div class="col-xs-6 col-sm-3">
			<div class="col-xs-6 col-sm-4 cont">
				<h3>КОНТАКТЫ</h3>
				<p style="color:white">ул.Кузнецуий мост, 12</p>
				<p style="color:white">+7 (495) 628-45-15</p> 
				<p style="color:white">orub@15kop.ru</p>
			</div>
		</div>
	</div>
	</div>
	<div class="footer2">
		<div class="row">
  			<div class="col-xs-6 licen" ><a href="#"><p>Правила посещения музея советских мгровых автоматов| Лицензионное соглашение </p></a>
			</div>
			<div class="col-xs-6"></div>
		</div>
	</div>
	<div class="footer3">
		<div class="row">
  			<div class="col-xs-6 licen" ><p>Музей советских мгровх автоматов 2017</p>
			</div>
			<div class="col-xs-6 design" ><a href="#"><p>Дизайн и разработка</p></div>
		</div>
	</div>
      </footer>

    </div><!--/.container-->

    <!-- add javascripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>