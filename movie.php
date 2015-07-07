<!DOCTYPE html>
<html>
<head>
		<title>Rancid Tomatoes</title>
		<meta charset="utf-8" />
		<link href="movie.css" type="text/css" rel="stylesheet" />
        <!--Code to add favicon-->
		<link rel="icon" 
      		  type="image/gif" 
              href="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw2/images/rotten.gif"/>
</head>
 <body>
        <div id="Banner">
			<img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw2/images/banner.png" alt="Rancid Tomatoes" />
		</div>
    	<!-- request file form the user get file info.text-->
		<?php
			$inputmovie = $_REQUEST["film"];
			$fp = file("{$inputmovie}/info.txt");
			$fp[1] = trim($fp[1]); /* to truncate the extra spaces */
		?>

		<h1 id="MovieDesp"> <?php print "$fp[0]"; print "({$fp[1]})"; ?> </h1>

		<div id="ContentBox" >
        <div id="Overview">
		<div>
			<?php
			echo "<img src='$inputmovie/overview.png' alt='general overview'>"
			?>
		</div>
        <div id="TextDesp">
		<!-- Split string by string " : " so that heading can be seperated from the descriptions -->
	    <?php 
			$TextDesp = file("{$inputmovie}/overview.txt");
				foreach($TextDesp as $Text)
					{
						$Heading = explode(":", $Text, 2);
		?>
		<dt><?php print "$Heading[0]"; ?></dt>
		<dd><?php print "$Heading[1]"; ?></dd>
		<?php } ?>
		</div>
	    </div>

		<div id="LeftSection">
        <div id="RottenAlign">
				<?php
					if($fp[2] <60)/* if rating is less than 60 then image will change accordingly */
					{
				?>
			<img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw2/images/rottenbig.png" alt="Rotten">	
				<?php
					}
					else
					{
				?>
			<img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw3/images/freshbig.png" alt="Rotten">	
				<?php 
					} 
				print "{$fp[2]}%"; /* print the rating of the movie */
				?>
		</div>

		<div class="ReviewColumn">
			<?php 
				$reviewCount = glob($inputmovie . "/review*.txt"); /*returns an array of matching file names*/
				$countReviews = count($reviewCount); /*returns the number of elements in an array*/
				
				for($a = 0; $a <= ceil(($countReviews/2)-1); $a++){ ?>
				<p class="Review">
                		<!--unpacks an array into a set of variables; useful for dealing with fixed-size arrays of data-->
            			<?php 
						list($content, $position, $author, $publication) = file($reviewCount[$a]);
            			$content = trim($content);
            			$position = trim($position);
            			?>

					<img src = <?php 
						if($position == "ROTTEN")
						{
							echo "http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw3/images/rotten.gif";

						}
						else
						{
						   echo "http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw3/images/fresh.gif";
						}
					?>
					
	            	<q><?php echo $content; ?></q>
	            </p>

	            <p class = "ReviewerInfo">
	            	<img src = "http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw2/images/critic.gif" alt = "critic" />
	            	<span><?php print $author; ?></span>
	            	<lt><?php echo $publication; ?></lt>

	            </p>

	            <?php } ?>
	            
		</div>
        <!-- for second column of the reviews-->
	<div class="Reviewcolumn">
			
			<?php 
				$reviewCount = glob($inputmovie . "/review*.txt");
				$countReviews = count($reviewCount);
			
				for($a = ceil(($countReviews/2)); $a < $countReviews; $a++){ ?>
				<p class="Review">
            			<?php 
						list($content, $position, $author, $publication) = file($reviewCount[$a]);
            			$content = trim($content);
            			$position = trim($position);	
						?>

						<img src = <?php 
						if($position == "ROTTEN")
						{
							echo "http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw3/images/rotten.gif";
						}
						else
						{
							echo "http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw3/images/fresh.gif";
						} ?>
		
	            <q><?php echo $content; ?></q>
	            </p>
               
	            <p class = "ReviewerInfo">
	            	<img src = "http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw2/images/critic.gif" alt = "critic" />
	            	<span><?php print $author; ?> </span>
	            	<lt><?php echo $publication; ?></lt>

	            </p><?php } ?>
	    </div>
		</div>

		<p id="ReviewCounts">
		<?php echo "(1-$countReviews) of $countReviews"; ?> <!--* print the total and displayed reviews-->
		</p>
        
		</div>

		<div id="Position">
		    <p><span><a href="https://webster.cs.washington.edu/validate-html.php"><p class="Style"> <img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw2/images/w3c-xhtml.png" alt="Valid HTML5" /></p></a> </span>
			<span><a href="https://webster.cs.washington.edu/validate-css.php"><p class="Style"> <img src="http://ws.mss.icics.ubc.ca/~cics516/cur/hw/hw2/images/w3c-css.png" alt="Valid CSS" /></p></a></span></p>
		</div>
		

</body>
</html>
