<!-- Header Include -->
<?php include('header.php'); ?>

<?php

$listing = mysqli_query($conn, "SELECT * FROM listing WHERE id = '{$_GET['listing_id']}'");
$listing_row = mysqli_fetch_row($listing);

if (mysqli_num_rows($listing) > 0) {
?>
	<title><?php echo $listing_row['1']; ?> - Gallery</title>
	<h2 class="listing_feature_h2">Business Listing Gallery From <?php echo $listing_row['1']; ?></h2>
	<div class="listing_page">
		<div class="listingdtl">
			<div class="ldtlbx listing_feature_gallery">
				<label>Business Listing Gallery</label>
				<?php echo "<img src='listingimages/" . $listing_row['10'] . "' class='img1'>" ?>
				<?php echo "<img src='listingimages/" . $listing_row['11'] . "' class='img2'>" ?>
				<?php echo "<img src='listingimages/" . $listing_row['12'] . "' class='img2'>" ?>
			</div>
			<?php echo "<a href='listing_page.php?lid=" . $listing_row['0'] . "' class='l_video_a'>Back To Listing</a>"; ?>
		</div>
	</div>

<?php } ?>



<?php include('footer.php'); ?>