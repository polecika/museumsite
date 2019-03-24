<?php if(isset($_POST["add_file"])) { //если что то отправила из формы, то сработает эта хрень
$uploaddir = 'includes/images/'; //здесь прописываешь путь, где собираешься сохранять изображения на сервере
$error_flag = $_FILES["img"]["error"]; 
if($error_flag == 0) 
	{ 
		if($_FILES['img']['type'] == "image/gif" || $_FILES['img']['type'] == "image/jpg" || $_FILES['img']['type'] == "image/jpeg" || $_FILES['img']['type'] == "image/png") 
		//проверка, на то, что ты реально собираешься загрузить картинку
		{ 
			$uploadfile = $uploaddir .time().'_'. basename($_FILES['img']['name']); //имя формируется из текущего времени+названия, которое предоставили(это на случай, если чувак решит загрузить фото с одинаковыми именами и не получилось перезаписи или другой ошибки)
			
			if(move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile)) { //если запись прошла нормально, записываем в базу данных информацию
				$img=$uploadfile; //имя файла
				$query="INSERT INTO `gallery`(`img`) VALUES ('".$img."')"; 
				$result=mysqli_query($link, $query); 
			} 
			header('Location: help.php'); //перенаправляем на нашу страницу, чтобы стереть все геты и посты и чтобы файл не загрузился повторно при обновлении страницы
		} 
		else 
		{ 
		$error='Недопустимый формат изображения'; 
		} 
	} 
else { 
$error='Изображение не загружено. Попробуйте ещё раз'; 
}
echo $error;
?>
<form role="form" method="POST" action="help.php">
	<div class="col-md-6">
		<div class="form-group">
			<label>Добавьте еще фотографий</label>
			<input type="file" name="img" required>
		</div>

	</div>
					
</form>