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