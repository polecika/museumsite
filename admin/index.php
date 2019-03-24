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
if(isset($_POST["add"])){
	$name=$_POST["name"];
	$title=$_POST["title"];
	$keywords=$_POST["keywords"];
	$description=$_POST["description"];
	$pu=$_POST["pu"];
	$date=$_POST["date"];
	$text=$_POST["text"];
	$exposition=$_POST["exposition"];
	$events=$_POST["events"];
	$calendar=$_POST["calendar"];
	$administration=$_POST["administration"];
	$contacts=$_POST["contacts"];
	$arenda=$_POST["arenda"];
	$exposition_avtomati=$_POST["exposition_avtomati"];
	$gallery=$_POST["gallery"];
	$parent=$_POST["parent"];
	$query="INSERT INTO `pages`(`name`, `title`, `keywords`, `description`, `pu`, `text`, `date`, `parent`, `exposition`, `events`, `calendar`,
	`administration`, `contacts`, `arenda`, `exposition_avtomati`, `gallery`) VALUES ('".$name."','".$title."','".$keywords."','".$description."','".$pu."','".$text."','".$date."','".$parent."',
	'".$exposition."', '".$events."', '".$calendar."', '".$administration."', '".$contacts."' , '".$arenda."', '".$exposition_avtomati."', '".$gallery."')";
	//echo $query;
	$result=mysqli_query($link, $query);
	header('Location: index.php');
}
if(isset($_POST["edit"])){
	$id=$_POST["id"];
	$name=$_POST["name"];
	$title=$_POST["title"];
	$keywords=$_POST["keywords"];
	$description=$_POST["description"];
	$pu=$_POST["pu"];
	$date=$_POST["date"];
	$text=$_POST["text"];
	$exposition=$_POST["exposition"];
	$events=$_POST["events"];
	$calendar=$_POST["calendar"];
	$administration=$_POST["administration"];
	$contacts=$_POST["contacts"];
	$arenda=$_POST["arenda"];
	$exposition_avtomati=$_POST["exposition_avtomati"];
	$gallery=$_POST["gallery"];
	$parent=$_POST["parent"];
	$query="UPDATE `pages` SET `name`='".$name."',`title`='".$title."',`keywords`='".$keywords."',`description`='".$description."',`pu`='".$pu."',`text`='".$text."',`date`='".$date."',`parent`='".$parent."', 
	`exposition`='".$exposition."', `events`='".$events."', `calendar`='".$calendar."', `administration`='".$administration."', `contacts`='".$contacts."',
	`arenda`='".$arenda."', `exposition_avtomati`='".$exposition_avtomati."', `gallery`='".$gallery."' WHERE `id` ='".$id."'";
	$result=mysqli_query($link, $query);
	header('Location: index.php');
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
<link rel="stylesheet" href="/css/add_style.css"> 

<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
<script type="text/javascript" src="js/jquery.xfade-1.0.min.js"></script>
<script type="text/javascript" src="js/gallery-admin.js"></script>
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
			<li class="active"><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Страницы</a></li>
			<li><a href="news.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Новости/События</a></li>
			<li><a href="gallery.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Галерея</a></li>
			<li><a href="souvenirs.php"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Сувениры</a></li>
			<li><a href="comments.php"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Отзывы </a></li>
			<li><a href="callbacks.php"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Запросы на звонок</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Страницы</h1>
			</div>
		</div><!--/.row-->';
		if(!empty($_POST['old-pass'])){
			
				
				if(($_SESSION['password']==$_POST['old-pass']) && ($_POST['new-pass1']!=$_SESSION['password'])) {
					if($_POST['new-pass1']==$_POST['new-pass2']) {
						$newpas=$_POST['new-pass1'];
						$login=$_SESSION['login'];
						$query="UPDATE `registration` SET `pass`='".$newpas."' WHERE `log`='".$login."'";
						$result = mysqli_query($link, $query);
						//echo $query;
						if($result) {
							echo '<div class="row"><div class="alert bg-success" role="alert">
							<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> Пароль успешно изменен
							</div></div>';
							$_SESSION['password']=$newpas;
						}
						else 
						{
							echo '<div class="alert bg-danger" role="alert">
							<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Пароль не был изменен. Попробуйте еще раз
							</div>';
						}
					}
					else 
					{
						
						echo '<div class="alert bg-danger" role="alert">
						<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Пароли не совпадают. Попробуйте еще раз
						</div>';
					}
	
				}
				else
				{	
					if($_POST['new-pass1']!=$_SESSION['password']) {
						echo '<div class="alert bg-danger" role="alert">
							<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg> Пароль введен не верно. Попробуйте еще раз
						</div>';
					}
				}
			
		}
		
		if(isset($_GET["add_page"])) {
			echo '
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Добавление новой страницы</div>
						<div class="panel-body">
							<form role="form" action="index.php" method="POST">
								<div class="col-md-6">
								<input hidden name="add">
									<div class="form-group">
										<label>Дерево</label>
										<select class="form-control" name="parent">
											<option value="0">0 - Корень</option>';
											$query1="SELECT  `id` ,  `name` FROM  `pages` WHERE  `parent` = 0";
											$result1=mysqli_query($link, $query1);
											while($row1 = $result1->fetch_array())
											{
												$rows1[] = $row1;
											}
											foreach($rows1 as $row1)
											{
											echo '<option value="'.$row1["id"].'">'.$row1["id"].' - '.$row1["name"].'</option>';
											}
										echo '</select>
									</div>
									<div class="form-group">
										<label>Название страницы</label>
										<input class="form-control" name="name" required>
									</div>
															
									<div class="form-group">
										<label>ЧПУ</label>
										<input class="form-control" name="pu">
										<p class="help-block">Вводить можно только латинкие символы в нижнем регистре без специальных знаков. Пример: admin</p>
									</div>
								
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>title</label>
										<input class="form-control" name="title">
									</div>
									
									<div class="form-group">
										<label>keywords</label>
										<input class="form-control" name="keywords">
									</div>
									
									<div class="form-group">
										<label>description</label>
										<input class="form-control" name="description">
									</div>
								</div>
								<div class="col-md-12">
									<div class="form-group">
										<label>Дата</label>
										<input type="date" name="date" class="form-control">
									</div>
									<div class="form-group">
										<label>Текст</label>
										<textarea class="form-control" name="text" id="editor1" rows="5"></textarea>
									</div>
									<div class="form-group">
										<label>Добавить шаблоны:</label>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="exposition" value="1"> Экспозиция
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="events" value="1"> События
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="calendar" value="1"> Новости
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="administration" value="1"> Администрация
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="contacts" value="1"> Контакты
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="arenda" value="1">  Аренда
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="exposition_avtomati" value="1">  Экспозиция автоматов
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="gallery" value="1">  Галерея
											</label>
										</div>
									</div>
									<button type="submit" class="btn btn-primary">Сохранить</button>
									<button type="reset" class="btn btn-default">Очистить</button>
								</div>
							</form>
						</div>
					</div>
				</div><!-- /.col-->
			</div><!-- /.row -->';
		/* free result set */
		$result->close();
		}
		elseif(isset($_GET["edit_page_id"]) || isset($_GET["page_id"])) {
			if(isset($_GET["edit_page_id"])) {
				$id=$_GET["edit_page_id"];
			}
			else
			{
				$id=$_GET["page_id"];
			}
			$query="SELECT * FROM  `pages` WHERE `id` = '".$id."'";
			$result= mysqli_query($link, $query);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			echo '<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">Редактирование страницы "'.$row["name"].'" </div>
					<div class="panel-body">
						<form role="form" action="index.php" method="POST">
							<div class="col-md-6">
								<input name="edit" hidden>
								<input name="id" value="'.$id.'" hidden>
								<div class="form-group">
									<label>Дерево</label>
									<select class="form-control" name="parent">
										<option value="0">0 - Корень</option>';
										$query1="SELECT  `id` ,  `name` FROM  `pages` WHERE  `parent` = 0";
										$result1=mysqli_query($link, $query1);
										while($row1 = $result1->fetch_array())
										{
											$rows1[] = $row1;
										}
										foreach($rows1 as $row1)
										{
											if($id!=$row1["id"]){
												echo '<option value="'.$row1["id"].'"';
                                                                                         if($row['parent']==$row1["id"]) {echo ' selected ';}
                                                                                        echo '>'.$row1["id"].' - '.$row1["name"].'</option>';
											}
										}
									echo '
									</select>
								</div>
								<div class="form-group">
									<label>Название страницы</label>
									<input class="form-control" name="name" value="'.$row['name'].'" required>
								</div>
								
								
																
								<div class="form-group">
									<label>ЧПУ</label>
									<input class="form-control" name="pu" value="'.$row["pu"].'">
									<p class="help-block">Вводить можно только латинкие символы в нижнем регистре без специальных знаков. Пример: admin</p>
								</div>
								
								
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label>title</label>
									<input class="form-control" name="title" value="'.$row["title"].'">
								</div>
								
								<div class="form-group">
									<label>keywords</label>
									<input class="form-control" name="keywords" value="'.$row["keywords"].'">
								</div>
								
								<div class="form-group">
									<label>description</label>
									<input class="form-control" name="description" value="'.$row["description"].'">
								</div>
							</div>
							<div class="col-md-12">
								<div class="form-group">
									<label>Дата</label>
									<input type="date" name="date" class="form-control" value="'.$row["date"].'">
								</div>
								<div class="form-group">
									<label>Текст</label>
									<textarea class="form-control" name="text" id="editor1" rows="5" >'.$row["text"].'</textarea>
								</div>
								<div class="form-group">
										<label>Добавить шаблоны:</label>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="exposition" value="1" ';
												if($row['exposition']=="1") {echo 'checked ';}
												echo '> Экспозиция
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="events" value="1" ';
												if($row['events']=="1") {echo 'checked ';}
												echo '> События
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="calendar" value="1"' ;
												if($row['calendar']=="1") {echo 'checked ';}
												echo '> Новости
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="administration" value="1" ';
												if($row['administration']=="1") {echo 'checked ';}
												echo '> Администрация
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="contacts" value="1" ';
												if($row['contacts']=="1") {echo 'checked ';}
												echo '> Контакты
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="arenda" value="1" ';
												if($row['arenda']=="1") {echo 'checked ';}
												echo '>  Аренда
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="exposition_avtomati" value="1" ';
												if($row['exposition_avtomati']=="1") {echo 'checked ';}
												echo '>  Экспозиция автоматов
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" name="gallery" value="1" ';
												if($row['gallery']=="1") {echo 'checked ';}
												echo '>  Галерея
											</label>
										</div>
										
									</div>
								<button type="submit" class="btn btn-primary">Сохранить</button>
								<button type="reset" class="btn btn-default">Очистить</button>
							</div>
						</div>
					</form>
				</div>
			</div><!-- /.col-->
		</div><!-- /.row -->';
		/* free result set */
		$result->close();
		}
		elseif(isset($_GET["del_page_id"])) {
			echo '<div class="row"><div class="alert bg-success" role="alert">
							<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> Страница успешно удалена
							</div></div>';
			$id=$_GET["del_page_id"];
			$query="DELETE FROM `pages` WHERE `id`='".$id."'";
			$result=mysqli_query($link,$query);
		}
		else {
		echo '
		
		<div class="row">
			<div class="col-xs-12 col-md-6 col-lg-4">
				<div class="panel panel-orange panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked empty-message"><use xlink:href="#stroked-empty-message"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">';
							//Выводим количестко комментариев
							$query="SELECT COUNT( * ) FROM  `comments`";
							$result= mysqli_query($link, $query);
							$row=mysqli_fetch_row($result);
							echo $row[0];
							echo '</div>
							<div class="text-muted">Комментариев</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-4">
				<div class="panel panel-teal panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked male-user"><use xlink:href="#stroked-male-user"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">';
							//Выводим количестко звонков
							$query="SELECT COUNT( * ) FROM  `callback`";
							$result= mysqli_query($link, $query);
							$row=mysqli_fetch_row($result);
							echo $row[0];
							echo '
							</div>
							<div class="text-muted">Заявок звонков</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-md-6 col-lg-4">
				<div class="panel panel-red panel-widget">
					<div class="row no-padding">
						<div class="col-sm-3 col-lg-5 widget-left">
							<svg class="glyph stroked app-window-with-content"><use xlink:href="#stroked-app-window-with-content"></use></svg>
						</div>
						<div class="col-sm-9 col-lg-7 widget-right">
							<div class="large">';
							//Выводим количестко страниц
							$query="SELECT COUNT( * ) FROM  `pages`";
							$result= mysqli_query($link, $query);
							$row=mysqli_fetch_row($result);
							echo $row[0];
							echo '</div>
							<div class="text-muted">Страниц</div>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->';
		}
		
		echo '						
		<div class="row">
			
			<div class="col-md-12">
			
				<div class="panel panel-blue">
					<div class="panel-heading dark-overlay"><svg class="glyph stroked clipboard-with-paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>Cписок страниц</div>
					<div class="panel-body">
						<ul class="todo-list">';
						//Выводим список страниц по их названиям
						$query="SELECT * FROM  `pages` WHERE `parent`=0";
						$result= mysqli_query($link, $query);
						while($row = $result->fetch_array())
						{
							$rows[] = $row;
						}
						foreach($rows as $row)
						{
							echo '
								<li class="todo-list-item">
									<div class="checkbox">
										<label for="checkbox"><a href="index.php?page_id='.$row["id"].'">'.$row["name"].'</a></label>
									</div>
									<div class="pull-right action-buttons">
										<a href="index.php?edit_page_id='.$row["id"].'" class="trash"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a>
									</div>
								</li>';
							$dir=$row["id"];
							$query3="SELECT * FROM  `pages` WHERE `parent`='".$dir."'";
							//echo $query3;
							$result3= mysqli_query($link, $query3);
							while($row3 = $result3->fetch_array())
							{
								$rows3[] = $row3;
							}
							foreach($rows3 as $row3) {
								echo '
								<li class="todo-list-item">
									<div class="checkbox">
										<label for="checkbox"><a href="index.php?page_id='.$row3["id"].'">&nbsp;&nbsp; &nbsp; - '.$row3["name"].'</a></label>
									</div>
									<div class="pull-right action-buttons">
										<a href="index.php?edit_page_id='.$row3["id"].'" class="trash"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a>
										<a href="index.php?del_page_id='.$row3["id"].'" class="trash"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"></use></svg></a>
									</div>
								</li>';
							}
							$rows3= array();
						}
						echo '
						</ul>
					</div>
					<div class="panel-footer">
						<div class="input-group">
							<span class="input-group-btn">
							<a href="index.php?add_page=1">
								<button class="btn btn-primary btn-md" id="btn-todo">Добавить страницу</button>
							</a>
							</span>
						</div>
					</div>
				</div>
								
			</div><!--/.col-->
		</div><!--/.row-->
	</div>	<!--/.main-->';
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
	<script src="ckeditor/ckeditor.js"></script>
	<script src="ajexfilemanager/ajex.js"></script>
	<script type="text/javascript" src="js/jquery-lenta.js"></script>
<script type="text/javascript" src="js/jquery.jcarousellite.js"></script>
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
		var editor = CKEDITOR.replace( 'editor1' );
		AjexFileManager.init({returnTo: 'ckeditor', editor: editor});
	</script>
</body>
</html>
		