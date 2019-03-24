<div class="container-fluid menushadow">
    <div class="container">
        <div class="row">
            <div class="topmenu">
                <ul class="col-md-9 hidden-xs menu">
						<?
							$result= mysqli_query($link, $query);
							 while ($row = $result->fetch_array())
							{
								 $rows[] = $row;
							}
							foreach($rows as $row) {
								if($row["id"]!='49') {
								echo '<li class="topmenu-dropdown dropdown-toggle">
							<a href="/'.$row["pu"].'">'.$row['name'].'</a>';
							
									
									$dir=$row["id"];
									 $query3="SELECT * FROM  `pages` WHERE `parent`='".$dir."'";
									 $result3= mysqli_query($link, $query3);
										while($row3 = $result3->fetch_array()) {
										$rows3[] = $row3;
									}
									
									if(count($rows3)!=0) {
									echo '<ul class="dropdown-menu">
										<li>
										
										<ul class="submenu">';
									foreach($rows3 as $row3) { 
											echo '<li>
												<a href="/'.$row["pu"].'/'.$row3["pu"].'">'.$row3['name'].'</a>
											</li>';
									}	
									$rows3= array();
									$result3->free();
									echo '</ul>
										</li>
										
									</ul>';
									}
									 
							echo '</li>';
							}
							}
							$rows= array();
							$result->free();
						?>
                        
							
						
                </ul>
                
            </div>
        </div>
    </div>
</div>   