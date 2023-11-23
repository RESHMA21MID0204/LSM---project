<?php 
	include_once("includes/header.php"); 
	include_once("includes/db_connect.php"); 
	$SQL="SELECT * FROM `event`, theme WHERE event_theme_id = theme_id";
	$rs=mysqli_query($con,$SQL) or die(mysqli_error($con));
	global $SERVER_PATH;
?> 
	<div class="crumb">
    </div>
    <div class="clear"></div>
	<div id="content_sec">
		<div class="col1" style="width:100%">
			<h4 class="heading colr">All Available Events</h4>
			<div class="news" style="width:100%">
            <ul style="width:100%">
			<?php while($data = mysqli_fetch_assoc($rs)) {?>
				<li style="width:294px; margin-right: 15px;">
                	<h6 class="last"><?=$data['event_title']?></h6>
                    <a href="event_details.php?event_id=<?=$data[event_id]?>" class="thumb">
					<img src="uploads/<?=$data['event_image']?>" style="width:260px; height:250px">
					</a>
                    <p><?=substr($data['event_description'],0,150)?></p>
                    <div class="news_links">
                    	<a href="event_details.php?event_id=<?=$data[event_id]?>" class="readmore left">Read More</a>
                    </div>
                </li>
			<?php } ?>
			</ul>
			</div>
		</div>
	</div>
<?php include_once("includes/footer.php"); ?> 