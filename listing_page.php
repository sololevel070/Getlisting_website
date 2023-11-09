<?php include('header.php'); ?>

<style type="text/css">
	#banner {
		background-position: center !important;
	}
</style>
<?php
global $listing_row;
error_reporting(0);

$lid = $_GET['lid'];

$listing = mysqli_query($conn, "SELECT * FROM listing WHERE id='{$lid}'");
$listing_row = mysqli_fetch_row($listing);

?>

<?php

if (mysqli_num_rows($listing) > 0) {
	$select_fav = mysqli_query($conn, "SELECT * FROM favourite WHERE listing_id = '{$lid}' ");
?>
	<div class="listing_page">
		<title>Getlisting - <?php echo $listing_row['1']; ?></title>
		<section id="banner" style="background: url('<?php echo "listed%20images/" . $listing_row['10']; ?>');background-size: cover;">
			<div class="inner inner_listing">
				<div class="banner_left">
					<h2><?php echo $listing_row['1']; ?></h2>
					<h3><?php echo $listing_row['2']; ?></h3>
					<h3><?php echo mysqli_num_rows($select_fav) . " Favourites"; ?></h3>
				</div>
				<div class="banner_right">
					<?php echo '<a href="add_to_favourite.php?listing_id=' . $listing_row['0'] . '">Add To Favourite</a>'; ?>
					<?php echo '<a href="write_review.php?lid=' . $listing_row['0'] . '">Write A Review</a>'; ?>
				</div>
			</div>
		</section>

		<section class="listingdtl">
			<div class="row">
				<div class="col-left">
					<div class="about_member_portion ldtlbx">
						<div class="about_portion">
							<label class="ttl">About The Listing</label>
							<div>
								<p><?php echo $listing_row['7']; ?></p>
							</div>
						</div>
					</div>
					<div class="tagline_category_city ldtlbx">
						<div class="title">
							<label>Category</label>
							<label>City</label>
						</div>
						<br>
						<hr>
						<div class="value">
							<label><?php echo $listing_row['5']; ?></label>
							<label><?php echo $listing_row['6']; ?></label>
						</div>
					</div>
					<div class="explore_other ldtlbx">
						<label class="ttl">Explore More From <?php echo $listing_row['1']; ?></label>
						<div>
							<?php echo '<a href="gallery.php?listing_id=' . $listing_row['0'] . '">Gallery</a>'; ?>
						</div>
					</div>
					<div class="review ldtlbx">
						<label class="ttl">People's Review About <?php echo $listing_row['1']; ?></label>

						<div>
							<?php

							$listing_review = mysqli_query($conn, "SELECT * FROM review WHERE listing_id = '{$listing_row['0']}' ");

							while ($listing_review_row = mysqli_fetch_row($listing_review)) {
								echo "

										<label>" . $listing_review_row['4'] . "</label>
										<label>" . $listing_review_row['6'] . "</label>
										<label style='margin-bottom:5px;'>Rating : </label>";
								for ($i = 1; $i <= $listing_review_row['7']; $i++) {
									echo '<img src="images/star.png" />&nbsp&nbsp&nbsp&nbsp';
								}


								echo "<label style='margin-top:5px;'>" . $listing_review_row['8'] . "</label>
										<hr>

									";
							}

							?>
						</div>
					</div>
				</div>
				<div class="col-right">
					<div class="member_portion lsdbrbx">
						<label class="ttl">Business Location</label>
						<div>
							<iframe width="100%" height="500" src="https://maps.google.com/maps?q=<?php echo $listing_row['19']; ?>,<?php echo $listing_row['20']; ?>&output=embed"></iframe>
						</div>
					</div>
					<div class="member_portion lsdbrbx">
						<label class="ttl">Member Profile</label>
						<div>
							<p><?php echo $listing_row['4']; ?></p>
							<p><?php echo $listing_row['3']; ?></p>
							<p><?php echo "Contact : " . $listing_row['8']; ?></p>
							<p><?php echo "Telephone : " . $listing_row['9']; ?></p>

						</div>
					</div>
					<div class="social_media lsdbrbx">
						<label class="ttl">Social Media About <?php echo $listing_row['1']; ?></label>

						<div>
							<label><?php echo $listing_row['1'] . "'s "; ?>Website</label><label class="value"><a style="word-break: break-all;" href=<?php echo $listing_row['14']; ?>><?php echo $listing_row['14']; ?></a></label>
							<label><?php echo $listing_row['1'] . "'s "; ?>Facbook</label><label class="value"><a style="word-break: break-all;" href=<?php echo $listing_row['16']; ?>><?php echo $listing_row['16']; ?></a></label>
							<label><?php echo $listing_row['1'] . "'s "; ?>Instagram</label><label class="value"><a style="word-break: break-all;" href=<?php echo $listing_row['17']; ?>><?php echo $listing_row['17']; ?></a></label>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
<?php

}
?>

<?php include('footer.php'); ?>