
<?php //echo str_replace($_SERVER["HTTP_HOST"],"",$_SERVER["HTTP_REFERER"]); ?>
<?php

$sq="SELECT * FROM blend_pages WHERE id={$output[11]}";
$dd=mysql_query($sq);
$dat=mysql_fetch_array($dd);

?>


<div class="container">
    
    <div class="breadcrumbs">	
        <ul class="breadcrumb">
            <li><a href="/">Главная</a></li>
            <li><a href="/<?php echo $dat["pu"]; ?>/"><?php echo $dat["name"]; ?></a></li>
            <li class="active"><?php echo $output[4]; ?></li>
        </ul>
    </div>
</div>
    
    
    <div class="container main-product-block">
    	<div class="col-md-4 col-xs-12">
        	
            <div class="connected-carousels">
                <div class="stage">
                    <div class="carousel carousel-stage">
                        <ul class="center-items">
                            <li><img class="img-responsive" src="/userfiles/<?php echo $output[7]; ?>"></li>
                        </ul>
                    </div>
                   
                </div>
                <!--
                <div class="navigation">
                    <div class="carousel carousel-navigation" data-jcarousel="true">
                        <ul class="center-items">
                            <li data-jcarouselcontrol="true"  class="active"><span><img class="img-responsive" src="/img/product-img.png"></span></li>
                            <li data-jcarouselcontrol="true"><span><img class="img-responsive" src="/img/other-product-img.png"></span></li>
                            <li data-jcarouselcontrol="true"><span><img class="img-responsive" src="/img/other-product-img.png"></span></li>

                        </ul>
                    </div>
                </div>
                -->
            </div>
                
        </div>

        
        
        
        <div class="col-md-8 col-xs-12">
        	<div class="product-info row">
                <div class="basic-params col-md-10 col-xs-12">
                	<h1 class="name"><?php echo $output[4]; ?></h1>
					<!--
                	<p class="zag">Основные характеристики</p>
                    <p class="parameter row"><span class="col-xs-6">Максимальная скорость</span> <span class="col-xs-6 black">20 км\ч</span></p>
                    <p class="parameter row"><span class="col-xs-6">Диаметр колёс</span> <span class="col-xs-6 black">10 дюймов (25 см)</span></p>
                    <p class="parameter row"><span class="col-xs-6">Максимальная нагрузка</span> <span class="col-xs-6 black">100 кг</span></p>
                    <p class="parameter row"><span class="col-xs-6">Масса</span> <span class="col-xs-6 black">14 кг</span></p>
                    -->
					
                    
					<div class="price">
                        <?php
                        if($output[5])
                        {
                        ?>
                        <div class="old-price"><span><?php echo $output[5]; ?> руб.</span></div>
                        <?php
                        }
                        ?>
                        <div class="new-price"><?php echo $output[6]; ?> руб.</div>
             	   </div>
                    <div class="buttons clearfix">
                        <p>
                            <!--<a class="one-click col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-0" href="#">Купить в 1 клик</a>-->
                            <a class="to-cart col-xs-8 col-xs-offset-2 col-md-4 col-md-offset-0" href="#" onclick="javascript:incart(<?php echo $output[10]; ?>);return false;">В корзину</a>
                        </p>
                    </div>
					<br />
					<?php
					
					echo $output[12];
					
					?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="container our-advantages product">
    
    

        	<div class="col-md-3 col-xs-10 col-xs-offset-1 col-md-offset-0 advantage center-items">
            	<div class="col-xs-3 icon">
                	<img src="/img/product-advantage-car.png">
                </div>
            	<div class="col-xs-8 col-xs-offset-1 text">
                	<p>Оперативная доставка по РФ</p>
                </div>
            </div>
            <div class="col-md-3 col-xs-10 col-xs-offset-1 col-md-offset-0 advantage center-items">
            	<div class="col-xs-3 icon">
                	<img src="/img/product-advantage-screwdriver.png">
                </div>
                <div class="col-xs-8 col-xs-offset-1 text">
                    <p>Гарантия 1 год, свой сервисный центр</p>
                </div>
            </div>
            <div class="col-md-3 col-xs-10 col-xs-offset-1 col-md-offset-0 advantage center-items">
            	<div class="col-xs-3 icon">
                	<img src="/img/product-advantage-hand.png">
                </div>
                <div class="col-xs-8 col-xs-offset-1 text">
                    <p>Оплата при получении, вне зависимости от региона</p>
                </div>
            </div>
            <div class="col-md-3 col-xs-10 col-xs-offset-1 col-md-offset-0 advantage center-items">
            	<div class="col-xs-3 icon">
                	<img src="/img/product-advantage-device.png">
                </div>
                <div class="col-xs-8 col-xs-offset-1 text">
                    <p>Большой ассортимент продукции, запчастей и аксессуаров</p>
                </div>
            </div>

    </div>
    
	
	<div class="product-tabs container">
        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#characteristics">Характеристики</a></li>
            <li><a data-toggle="tab" href="#special">Особенности</a></li>
            <li><a data-toggle="tab" href="#reviews">Отзывы</a></li>
        </ul>
        <div class="tab-content">
            <div id="characteristics" class="tab-pane fade in active">
                <div class="in-tab-content row">
                	<div class="col-md-6 col-xs-12">
                           <?php echo $output[9]; ?> 
                    </div>
                </div>
            </div>
            <div id="special" class="tab-pane fade">
                <div class="in-tab-content">
                	<?php echo $output[8]; ?> 
                </div>
            </div>
            <div id="reviews" class="tab-pane fade">
                <div class="in-tab-content">
                	<b>Здесь вы можете оставить комментарий о товаре</b><br /><br />
					<div class="gallery_menu">
						<form>
						  <fieldset class="form-group">
							<label for="exampleInputEmail1">Ваше ФИО <span style="color:red">*</span></label>
							<input type="email" id="ot_fio" class="form-control">
							<small class="text-muted"></small>
						  </fieldset>
						  <fieldset class="form-group">
							<label for="exampleInputEmail1">Ваш E-mail <span style="color:red">*</span></label>
							<input type="email" id="ot_mail" class="form-control">
							<small class="text-muted"></small>
						  </fieldset>
						  <fieldset class="form-group">
							<label for="ot_text">Текст сообщения <span style="color:red">*</span></label>
							<textarea class="form-control" id="ot_text" rows="3"></textarea>
						  </fieldset>
						  <button type="submit" class="btn btn-primary" onclick="comms(<?php echo $output[10]; ?>);return false;">Отправить</button>
						</form>
					</div>
					<br />
					<!--
					<div class="vopr">
						<b>Ирина</b>
						<br /><br />
						текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст 
						текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст 
					</div>
					<div class="otv">
						<b>Администратор</b>
						<br /><br />
						текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст 
						текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст текст 
					</div>-->
                </div>				
            </div>
        </div>
    </div>

         
	<div class="container main-catalog product">
		<p class="multizag">Похожие товары</p>
    	<div class="row double">
        	<div class="col-xs-12">
            	<div class="row">
                    <?php
		
					echo ind_cat($output[11]);
					
					?>
				</div>  
            
		</div>
        
    </div>
</div>
<?php include("block_html/color_form.php"); ?>