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
	$date=$_POST["date"];
	$text=$_POST["text"];
	$parent=$_POST["parent"];
	$query="INSERT INTO `pages`(`name`, `title`, `keywords`, `description`, `text`, `date`, `parent`
	) VALUES ('".$name."','".$title."','".$keywords."','".$description."','".$text."','".$date."','".$parent."'
	)";
	//echo $query;
	$result=mysqli_query($link, $query);
	header('Location: news.php');
}
if(isset($_POST["edit"])){
	$id=$_POST["id"];
	$name=$_POST["name"];
	$title=$_POST["title"];
	$keywords=$_POST["keywords"];
	$description=$_POST["description"];
	$date=$_POST["date"];
	$text=$_POST["text"];
	$parent=$_POST["parent"];
	$query="UPDATE `pages` SET `name`='".$name."',`title`='".$title."',`keywords`='".$keywords."',`description`='".$description."',`text`='".$text."',`date`='".$date."',`parent`='".$parent."' WHERE `id` ='".$id."'";
	$result=mysqli_query($link, $query);
	header('Location: news.php');
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
			<li><a href="index.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Страницы</a></li>
			<li class="active"><a href="news.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> Новости/События</a></li>
			<li><a href="gallery.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Галерея</a></li>
			<li><a href="souvenirs.php"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Сувениры</a></li>
			<li><a href="comments.php"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Отзывы </a></li>
			<li><a href="callbacks.php"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Запросы на звонок</a></li>
		</ul>
	</div><!--/.sidebar-->
		<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Новости и События</h1>
			</div>
		</div><!--/.row-->';		
		if(isset($_GET["add_page"])) {
			echo '
			<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Добавление новости/события</div>
						<div class="panel-body">
							<form role="form" action="news.php" method="POST">
								<div class="col-md-6">
								<input hidden name="add">
									<div class="form-group">
										<label>Раздел</label>
										<select class="form-control" name="parent">
											<option value="31">Новости</option>
											<option value="36">События</option>
										</select>
									</div>
									<div class="form-group">
										<label>Заголовок</label>
										<input class="form-control" name="name" required>
									</div>
									<div class="form-group">
										<label>Дата</label>
										<input type="date" name="date" class="form-control">
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
										<label>Текст</label>
										<textarea class="form-control" name="text" id="editor1" rows="5" ></textarea>
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
					<div class="panel-heading">Редактирование статьи "'.$row["name"].'" </div>
					<div class="panel-body">
						<form role="form" action="news.php" method="POST">
							<div class="col-md-6">
								<input name="edit" hidden>
								<input name="id" value="'.$id.'" hidden>
								<div class="form-group">
									<label>Дерево</label>
									<select class="form-control" name="parent">
										<option value="31" ';
										if($row["name"]==31) {echo 'selected';}
										echo ' >События</option>
										<option value="36" ';
										if($row["name"]==36) {echo 'selected';}
										echo '>Новости</option>
									</select>
								</div>
								<div class="form-group">
									<label>Заголовок</label>
									<input class="form-control" name="name" value="'.$row['name'].'" required>
								</div>
								<div class="form-group">
									<label>Дата</label>
									<input type="date" name="date" class="form-control" value="'.$row["date"].'">
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
									<label>Текст</label>
									<textarea class="form-control" name="text" id="editor1" rows="5" >'.$row["text"].'</textarea>
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
		echo '
		
		<div class="row">
			
			<div class="col-md-12">
			
				<div class="panel panel-blue">
					<div class="panel-heading dark-overlay"><svg class="glyph stroked clipboard-with-paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>Cписок страниц</div>
					<div class="panel-body">
						<ul class="todo-list">
							<li class="todo-list-item">
								<div class="checkbox">
									<label for="checkbox"><span>События</span></label>
								</div>
							</li>';
						//Выводим список событий
						$query="SELECT * FROM  `pages` WHERE `parent`=31";
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
										<label for="checkbox"><a href="news.php?page_id='.$row["id"].'">'.$row["name"].'</a></label>
									</div>
									<div class="pull-right action-buttons">
										<a href="news.php?edit_page_id='.$row["id"].'" class="trash"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a>
										<a href="news.php?del_page_id='.$row["id"].'" class="trash"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"></use></svg></a>
									</div>
								</li>';
						}
						echo '<li class="todo-list-item">
								<div class="checkbox">
									<label for="checkbox"><span>Новости</span></label>
								</div>
							</li>';
						$result->close();
						$rows= array();
						//Выводим список новостей
						$query="SELECT * FROM  `pages` WHERE `parent`=36";
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
										<label for="checkbox"><a href="news.php?page_id='.$row["id"].'">'.$row["name"].'</a></label>
									</div>
									<div class="pull-right action-buttons">
										<a href="news.php?edit_page_id='.$row["id"].'" class="trash"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a>
										<a href="news.php?del_page_id='.$row["id"].'" class="trash"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"></use></svg></a>
									</div>
								</li>';
						}
						echo '
						</ul>
					</div>
					<div class="panel-footer">
						<div class="input-group">
							<span class="input-group-btn">
							<a href="news.php?add_page=1">
								<button class="btn btn-primary btn-md" id="btn-todo">Добавить</button>
							</a>
							</span>
						</div>
					</div>
				</div>
								
			</div><!--/.col-->
		</div><!--/.row-->
	</div>	<!--/.main-->';
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