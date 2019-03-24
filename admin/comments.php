<?
session_start();
if(isset($_GET["out"]))
{
unset($_SESSION['login']);
unset($_SESSION['password']);
session_destroy();
header('Location: index.php');
}
include 'includes/config.php';
if(isset($_POST["add_comment"])){
	$name=$_POST["name"];
	$text=$_POST["text"];
	$date=$_POST["date"];
	if($_POST["hide"=="1"]) {$hide="1";}
	else {$hide="0";}
	$query="INSERT INTO `comments`(`name`, `text`, `date`, `hide`) VALUES ('".$name."','".$text."','".$date."','".$hide."')";
	//echo $query;
	$result=mysqli_query($link, $query);
	header('Location: comments.php');
}
if(isset($_POST["edit_comment"])){
	//echo 'Ну до сюда мы дошли';
	$id=$_POST["id"];
	$name=$_POST["name"];
	$text=$_POST["text"];
	$date=$_POST["date"];
	if($_POST["hide"=="1"]) {$hide="1";}
	else {$hide="0";}
	$query="UPDATE `comments` SET `name`='".$name."',`text`='".$text."',`hide`='".$hide."',`date`='".$date."'  WHERE `id` ='".$id."'";
	//echo $query;
	$result=mysqli_query($link, $query);
	
}
if(isset($_GET["del_id"])) {
	$id=$_GET["del_id"];
	$query="DELETE FROM `comments` WHERE `id`='".$id."'";
	$result=mysqli_query($link,$query);
	header('Location: comments.php');
}
if(isset($_GET["nohide_id"])) {
	$id=$_GET["nohide_id"];
	$hide="0";
	$query="UPDATE `comments` SET `hide`='".$hide."' WHERE `id` ='".$id."'";
	$result=mysqli_query($link, $query);
	header('Location: comments.php');
}
if(isset($_GET["hide_id"])) {
	$id=$_GET["hide_id"];
	$hide="1";
	$query="UPDATE `comments` SET `hide`='".$hide."' WHERE `id` ='".$id."'";
	$result=mysqli_query($link, $query);
	header('Location: comments.php');
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin</title>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/datepicker3.css" rel="stylesheet">
<link href="css/styles.css" rel="stylesheet">

<!--Icons-->
<script src="js/lumino.glyphs.js"></script>

<!--[if lt IE 9]>
<script src="js/html5shiv.js"></script>
<script src="js/respond.min.js"></script>
<![endif]-->

</head>
<body>
<? 
	if(isset($_POST["login"]) && isset($_POST["password"]) && !isset($_SESSION["login"])) 
	{
        $query1 = 'SELECT  `log`  FROM  `registration` ';
        $query2 = 'SELECT  `pass`  FROM  `registration` ';
        $result1 = mysqli_query($link, $query1);
        $result2 = mysqli_query($link, $query2);
        $row1 = mysqli_fetch_row($result1);
        $row2 = mysqli_fetch_row($result2);
        $login=$row1[0];
        $password=$row2[0];
        if(($login==$_POST["login"] && $password==$_POST["password"])) {
            $_SESSION['login'] = $_POST['login'];  
            $_SESSION['password'] = $_POST['password']; 
		}
        else {
            echo '<div class="row"><div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">Пароль введен неверно!</div></div>';
            include 'includes/login.php';
          
        }	
	}
	elseif(!isset($_POST["login"]) && !isset($_POST["password"]) && !isset($_SESSION["login"])) 
	{
		include 'includes/login.php';
	}
    if(isset($_SESSION['login']))
    {	
		
        echo '
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container-fluid">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="#"><span>Admin</span>Panel</a>
				<ul class="user-menu">
					<li class="dropdown pull-right">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown"><svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>'.$login.
                        '<span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							<li><a href="#" data-target="#myModal" data-toggle="modal"><svg class="glyph stroked gear"><use xlink:href="#stroked-gear"></use></svg> Сменить пароль</a></li>
							<li><a href="/admin/index.php?out=1"><svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Выход</a></li>
						</ul>
					</li>
				</ul>
			</div>
							
		</div><!-- /.container-fluid -->
	</nav>
		
	<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		
		<ul class="nav menu">
			<li><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Страницы</a></li>
			<li><a href="news.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Новости/События</a></li>
			<li><a href="gallery.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Галерея</a></li>
			<li><a href="souvenirs.php"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Сувениры</a></li>
			<li class="active"><a href="comments.php"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Отзывы </a></li>
			<li><a href="callbacks.php"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Запросы на звонок</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Отзывы</h1>
			</div>
		</div><!--/.row-->';
		if(isset($_GET["add_comment"]) || isset($_GET["edit_id"])) 
		{
			echo '<div class="row">
				<div class="col-lg-12">
				<div class="panel panel-default">';
				if(isset($_GET["add_comment"])) {
					echo '  <div class="panel-heading">Добавление нового комментария</div>
							<div class="panel-body">
								<form role="form" action="comments.php" method="POST">
									<input name="add_comment" type="hidden">
									<div class="col-md-6">
										<div class="form-group">
											<label>Имя</label>
											<input class="form-control" name="name">
										</div>
										<div class="form-group">
											<label>Дата</label>
											<input class="form-control" name="date">
										</div>
										<div class="form-group checkbox">
											<label>
											<input type="checkbox" value="1" name="hide">Показывать на странице</label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Text area</label>
											<textarea class="form-control" rows="3" name="text"></textarea>
											</div>
										</div>
										<button type="submit" class="btn btn-primary">Добавить комментарий</button>
										<button type="reset" class="btn btn-default">Очистить</button>
										
								</form>
							</div>';
				}
				if(isset($_GET["edit_id"])) {
					$id=$_GET["edit_id"];
					$query="SELECT * FROM  `comments` WHERE `id` = '".$id."'";
					$result= mysqli_query($link, $query);
					$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
					echo '  <div class="panel-heading">Редактирование комментария</div>
							<div class="panel-body">
								<form role="form" action="comments.php" method="POST">
									<input name="edit_comment" type="hidden">
									<input name="id" value="'.$row["id"].'" type="hidden">
									<div class="col-md-6">
										<div class="form-group">
											<label>Имя</label>
											<input class="form-control" name="name" value="'.$row["name"].'">
										</div>
										<div class="form-group">
											<label>Дата</label>
											<input class="form-control" name="date" value="'.$row["date"].'">
										</div>
										<div class="form-group checkbox">
											<label>
											<input type="checkbox" value="1" ';
											if($row["hide"]=="1") {echo ' checked ';}
											echo '>Показывать на странице</label>
										</div>
										
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>Text area</label>
											<textarea class="form-control" rows="3" name="text">'.$row['text'].'</textarea>
										</div>
										<button type="submit" class="btn btn-primary">Сохранить комментарий</button>
										<button type="reset" class="btn btn-default">Очистить</button>
									</div>
								</form>
							</div>';
				}
			echo 
			'</div>
			</div>
			</div>';
		}
		else {
		echo '
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default chat">
					<div class="panel-heading" id="accordion"><svg class="glyph stroked two-messages"><use xlink:href="#stroked-two-messages"></use></svg> Все отзывы</div>
				
					<div class="panel-body">
						<ul>';
						$query="SELECT * FROM  `comments`";
						$result= mysqli_query($link, $query);
						while($row = $result->fetch_array())
						{
							$rows[] = $row;
						}
						foreach($rows as $row) {
						
							echo '<li class="clearfix">
								<div class="chat-body clearfix">
									<div class="header">
										<strong class="primary-font">'.$row["name"].'</strong> <small class="text-muted">'.$row["date"].'</small>
									</div>
									<p>
										'.$row["text"].' 
									</p>
								</div>
								<div>
									<a href="comments.php?edit_id='.$row["id"].'"><button class="btn btn-primary">Редактировать</button></a>
									<a href="comments.php?del_id='.$row["id"].'"><button class="btn btn-danger">Удалить</button></a>';
									
									if($row["hide"]=="0")
									{ 
										echo 
											'<a href="comments.php?hide_id='.$row["id"].'">
												<button class="btn btn-success">Показывать на сайте</button>
											</a>';
									}
									else
									{echo '<a href="comments.php?nohide_id='.$row["id"].'"><button class="btn btn-default">Не показывать на сайте</button></a>';}
								echo '</div>
							</li>';
						}
						echo '</ul>
					</div>
					
					<div class="panel-footer">
						<div class="input-group">
							
							<span class="input-group-btn">
								<a href="comments.php?add_comment=1"><button class="btn btn-success btn-md" id="btn-chat">Добавить свой комментарий</button></a>
							</span>
						</div>
					</div>
				</div>
				
		
				</div><!--/.col-->
			</div><!--/.row-->';
			}
	echo '</div>	<!--/.main-->';
	include 'includes/changepass.php';
    }
	?>
    <script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script>
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>
</body>
</html>
