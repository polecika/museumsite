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
			<li><a href="elements.php"><svg class="glyph stroked dashboard-dial"><use xlink:href="#stroked-dashboard-dial"></use></svg> Элементы сайта</a></li>
			<li><a href="news.php"><svg class="glyph stroked clipboard with paper"><use xlink:href="#stroked-clipboard-with-paper"/></svg> События</a></li>
			<li><a href="gallery.php"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> Галерея</a></li>
			<li><a href="souvenirs.php"><svg class="glyph stroked star"><use xlink:href="#stroked-star"></use></svg> Сувениры</a></li>
			<li><a href="comments.php"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> Отзывы </a></li>
			<li><a href="callbacks.php"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Запросы на звонок</a></li>
			<li><a href="mail.php"><svg class="glyph stroked chevron-down"><use xlink:href="#stroked-chevron-down"></use></svg> Почтовая рассылка</a></li>
		</ul>
	</div><!--/.sidebar-->
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Страницы</h1>
			</div>
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
		