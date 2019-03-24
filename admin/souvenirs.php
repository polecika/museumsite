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
if(isset($_POST["add_tovar"])) {
	$uploaddir = 'includes/images/';
	$error_flag = $_FILES["img"]["error"];
	if($error_flag == 0)
	{
		if($_FILES['img']['type'] == "image/gif" || $_FILES['img']['type'] == "image/jpg" || $_FILES['img']['type'] == "image/jpeg" || $_FILES['img']['type'] == "image/png") {
			$uploadfile = $uploaddir .time().'_'. basename($_FILES['img']['name']);
			if(move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile)) {
				$foto_tovar=$uploadfile;
				$name_tovar=$_POST['name_tovar'];
				$desc_tovar=$_POST['desc_tovar'];
				$price=$_POST['price'];
				$query="INSERT INTO `shop`( `price`, `name_tovar`, `desc_tovar`, `foto_tovar`) VALUES ('".$price."','".$name_tovar."','".$desc_tovar."','".$foto_tovar."')";
				$result=mysqli_query($link, $query);
			}
			header('Location: souvenirs.php');
		}
		else
		{
			$error='Недопустимый формат изображения';
		}
	}
	else {
		$error='Изображение не загружено. Попробуйте ещё раз';
	}
	
}
if(isset($_POST["edit_tovar_id"])){
	echo 'Ну до сюда мы дошли';
	$id=$_POST["id"];
	$name_tovar=$_POST['name_tovar'];
	$desc_tovar=$_POST['desc_tovar'];
	$price=$_POST['price'];
	$query="UPDATE `shop` SET `price`='".$price."',`name_tovar`='".$name_tovar."',`desc_tovar`='".$desc_tovar."' WHERE `id` ='".$id."'";
	echo $query;
	$result=mysqli_query($link, $query);
	header('Location: souvenirs.php');
}
if(isset($_GET["del_tovar_id"])) {
	$id=$_GET["del_tovar_id"];
	$sql="SELECT `foto_tovar` FROM `shop` WHERE `id`='".$id."'";
	$result1=mysqli_query($link,$sql);
	$row = mysqli_fetch_array($result1, MYSQLI_ASSOC);
	$query="DELETE FROM `shop` WHERE `id`='".$id."'";
	$result=mysqli_query($link,$query);
	unlink($row['foto_tovar']);
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
			<li class="active"><a href="souvenirs.php"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Сувениры</a></li>
			<li><a href="comments.php"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Отзывы </a></li>
			<li><a href="callbacks.php"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Запросы на звонок</a></li>
			
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Сувениры</h1>
			</div>
		</div><!--/.row-->';
		echo '	
		<div class="row">
		<div class="panel panel-default">
			<div class="panel-body">';
			if(isset($_GET['edit_tovar_id'])) {
			$id=$_GET["edit_tovar_id"];
			$query="SELECT * FROM  `shop` WHERE `id` = '".$id."'";
			$result= mysqli_query($link, $query);
			$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
			echo '
				<div class="panel-heading">Редактирование товара</div><br>
				<form role="form" enctype="multipart/form-data" method="POST" action="souvenirs.php">
				<input name="edit_tovar_id" hidden>
				<input name="id" hidden value="'.$row['id'].'">
					<div class="col-md-6">
						<div class="form-group"><img src="'.$row['foto_tovar'].'" height="50"></div>
						<div class="form-group">
							<label>Название</label>
							<input class="form-control" name="name_tovar" value="'.$row["name_tovar"].'">
						</div>
						<div class="form-group">
							<label>Стоимость</label>
							<input class="form-control" name="price" value="'.$row["price"].'">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Описание</label>
							<textarea class="form-control" rows="3" name="desc_tovar">'.$row['desc_tovar'].'</textarea><br>
							<button type="submit" class="btn btn-primary">Сохранить изменения</button>
							<button type="reset" class="btn btn-default">Очистить</button>
						</div>
					</div>
					
				</form>
				</div>';
			}
			else
			{
				echo '	<div class="panel-heading">Добавьте еще товары</div><br>
				<form role="form" enctype="multipart/form-data" method="POST" action="souvenirs.php">
				<input name="add_tovar" hidden>
					<div class="col-md-6">
						<div class="form-group">
							<label>Добавьте еще товаров</label>
							<input type="file" name="img" required>
						</div>
						<div class="form-group">
							<label>Название</label>
							<input class="form-control" name="name_tovar">
						</div>
						<div class="form-group">
							<label>Стоимость</label>
							<input class="form-control" name="price">
							
						</div>
						
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label>Описание</label>
							<textarea class="form-control" rows="3" name="desc_tovar"></textarea><br>
							<button type="submit" class="btn btn-primary">Добавить товар</button>
							<button type="reset" class="btn btn-default">Очистить</button>
						</div>
					</div>
					
				</form>
				</div>';

			}
		
		echo '				
		<div class="row">
			
			<div class="col-md-12">
			
				<div class="panel panel-blue">
					<div class="panel-heading dark-overlay"><svg class="glyph stroked clipboard-with-paper"><use xlink:href="#stroked-clipboard-with-paper"></use></svg>Все сувениры</div>
					<div class="panel-body">
						<ul class="todo-list">';
						
						$query="SELECT * FROM  `shop`";
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
										<label for="checkbox">
											<img src="'.$row["foto_tovar"].'" height="100">
											   '.$row["name_tovar"].' 
											  | Цена: '.$row["price"].'
										</label>
									</div>
									<div class="pull-right action-buttons">
										<a href="souvenirs.php?edit_tovar_id='.$row["id"].'" class="trash"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg></a>
										<a href="souvenirs.php?del_tovar_id='.$row["id"].'" class="trash"><svg class="glyph stroked trash"><use xlink:href="#stroked-trash"></use></svg></a>
									</div>
								</li>';
						}
						
					echo '	</ul>
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
