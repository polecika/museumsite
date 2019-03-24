$id=$row1['id'];
	//Слайдер
	$query4="SELECT * FROM  `gallery` WHERE `id_page`='".$id."'";
	$result4 = mysqli_query($link, $query4);
	if(count(mysqli_fetch_array($result4))>0) {
		while ($row4 = $result4->fetch_array())
		{
			 $rows4[] = $row4;
		}
		echo '
		<div class="row">

			 <div class="col-md-8 col-md-offset-2">
				 <div id="carousel" class="carousel slide" data-interval="3000" data-ride="carousel">
					 <div class="carousel-inner">';

		foreach($rows4 as $row4) {
			echo '
				<div class="item ';
				if($row4['pos']=='1') {echo 'active';}
				echo '">
					<img src="/admin/'.$row4['img'].'">
				 </div>';
		}
		
				
				 
				echo ' 
			 </div>
		 </div>
		 <div class="clearfix">
			 <div id="thumbcarousel" class="carousel slide" data-interval="12000" data-ride="carousel">
			 <div class="carousel-inner">
			 ';
			
			$i=0; //порядок фотографий в слайдере
			$j=0; //помогает закрыть тег с первым листом фотографий
			echo '<div class="item active">';
			foreach($rows4 as $row4) {
				if($i<=3) {
					echo '
						 <div data-target="#carousel" data-slide-to="'.$i.'" class="thumb"><img src="/admin/'.$row4['img'].'"></div>
					';
					$i++;
				}
				else
				{	if($j==0) {
						echo '</div><div class="item">';
						$j=1;
					}
					
					echo '
						 <div data-target="#carousel" data-slide-to="'.$i.'" class="thumb"><img src="/admin/'.$row4['img'].'"></div>
					';
					$i++;
				}
				
			}
			
		echo '</div>
		</div>
			 <a class="left carousel-control" href="#thumbcarousel" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left"></span>
			 </a>
			 <a class="right carousel-control" href="#thumbcarousel" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right"></span>
			 </a>
			 </div>
		 </div>
	 </div>
</div><!-- /.row -->';

	}
	//конец слайдера