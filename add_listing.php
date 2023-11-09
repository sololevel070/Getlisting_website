<?php include('header.php'); ?>
<style type="text/css">
	.plans_a {
		color: white !important;
	}
</style>
<title>Getlisting - Add Your Listing</title>
<?php include('prevent_user.php'); ?>
<?php

$user = mysqli_query($conn, "SELECT * FROM users WHERE id = '{$_SESSION['id']}'");
$user_row = mysqli_fetch_row($user);

if (isset($_POST['submit'])) {
	$listing_name = $_POST['listing_name'];
	$listing_location = $_POST['listing_location'];
	$listing_email = $user_row['2'];
	$listing_member = $user_row['1'];
	$listing_category = $_POST['listing_category'];
	$listing_city = $_POST['listing_city'];
	$listing_description = $_POST['listing_description'];
	$listing_contact = $user_row['3'];
	$listing_website = $_POST['listing_website'];
	$listing_facebook = $_POST['listing_facebook'];
	$listing_instagram = $_POST['listing_instagram'];
	$listing_telephone = $_POST['listing_telephone'];
	$listing_date = date("Y/m/d");
	$listing_latitude = $_POST['listing_latitude'];
	$listing_longitude = $_POST['listing_longitude'];

	/*  Image upload 1*/
	$tmp_name1 = $_FILES['listing_image1']['tmp_name'];
	$listing_imgpath1 = "listingimages/";
	$Filename1 = $_FILES['listing_image1']['name'];
	// $Filename1 = rand(10, 1000) . '-' . $Filename1;

	$new_filename1 = $listing_imgpath1 . $Filename1;

	/*  Image upload 2*/
	$tmp_name2 = $_FILES['listing_image2']['tmp_name'];
	$listing_imgpath2 = "listingimages/";
	$Filename2 = $_FILES['listing_image2']['name'];
	// $Filename2 = rand(10, 1000) . '-' . $Filename2;

	$new_filename2 = $listing_imgpath2 . $Filename2;

	/*  Image upload 3*/
	$tmp_name3 = $_FILES['listing_image3']['tmp_name'];
	$listing_imgpath3 = "listingimages/";
	$Filename3 = $_FILES['listing_image3']['name'];
	// $Filename3 = rand(10, 1000) . '-' . $Filename3;

	$new_filename3 = $listing_imgpath3 . $Filename3;
	move_uploaded_file($_FILES['listing_image1']['tmp_name'], $new_filename1);
	move_uploaded_file($_FILES['listing_image2']['tmp_name'], $new_filename2);
	move_uploaded_file($_FILES['listing_image3']['tmp_name'], $new_filename3);
	
		$insert_q = "INSERT INTO listing (listing_name,listing_location,listing_email,listing_member_name,listing_category,listing_city,listing_description,listing_contact,listing_date,listing_image1,listing_image2,listing_image3,listing_website_url,listing_facebook_url,listing_instagram_url,listing_telephone,listing_latitude,listing_longitude) VALUES ('$listing_name','$listing_location','$listing_email','{$user_row['1']}','$listing_category','$listing_city','$listing_description','$listing_contact','$listing_date','$Filename1','$Filename2','$Filename3','$listing_website','$listing_facebook','$listing_instagram','$listing_telephone','$listing_latitude','$listing_longitude')";

		$insert = mysqli_query($conn, $insert_q);

		if ($insert == TRUE) {
			header('location:dashboard/home.php');
		}
		else {
			echo "Sorry, something went wrong";
			exit;
		}
	
	
}
?>


<form method="POST" class="listing_form listing_form_media" enctype="multipart/form-data" autocomplete="off">
	<h3 class="add_title">ADD YOUR LISTING WITH GET LISTING</h3>
	<label>Business Name</label>
	<input type="text" placeholder="Business Name" name="listing_name" required>
	<label>Business Address</label>
	<input type="text" placeholder="Business Address" name="listing_location" required>
	<label>Business Map Location</label>
	<input type="text" placeholder="Latitube" name="listing_latitude" required>
	<input type="text" placeholder="Longitube" name="listing_longitude" required>
	<label>Business Email</label>
		<label style="background: #7f737369;padding: 15px 16px;border-radius: 4px;color: #555555;"><?php echo $user_row[2]?></label>
	<label>Business Category</label>
		<div class="autocomplete">
		<input id="myInput2" type="text" name="listing_category" placeholder="Business Category" style="width: margin-bottom: 15px;" required autocomplete="off">
	</div>				
	<label style="margin-top: 3%;">Business City</label>
	<div class="autocomplete" style="width:300px;">
		<input id="myInput3" type="text" name="listing_city" placeholder="Business City" style="width: 316%;margin-bottom: 10%;" required autocomplete="off">
	</div>
	<label>Business Gallery Image #1</label>
	<input type="file" name="listing_image1" required>
	<label>Business Gallery Image #2</label>
	<input type="file" name="listing_image2">
	<label>Business Gallery Image #3</label>
	<input type="file" name="listing_image3">
	<label>Business Description</label>
	<textarea rows="5" cols="5" placeholder="Business Description" name="listing_description" required></textarea>
	<label>Business Phone Number</label>
		<label style="background: #7f737369;padding: 15px 16px;border-radius: 4px;color: #555555;"><?php echo $user_row[3]?></label>
	<label>Business Telephone Number</label>
	<input type="text" placeholder="Business Telephone Number" name="listing_telephone" required>
	<label>Business Website URL</label>
	<input type="text" placeholder="Business Website URL" name="listing_website">
	<label>Business Facebook URL</label>
	<input type="text" placeholder="Business Facebook URL" name="listing_facebook">
	<label>Business Instagram URL</label>
	<input type="text" placeholder="Business Instagram URL" name="listing_instagram">
	<input type="submit" name="submit" value="Add Listing">
</form>

		




<script>
	function autocomplete(inp, arr) {
		/*the autocomplete function takes two arguments,
		the text field element and an array of possible autocompleted values:*/
		var currentFocus;
		/*execute a function when someone writes in the text field:*/
		inp.addEventListener("input", function(e) {
			var a, b, i, val = this.value;
			/*close any already open lists of autocompleted values*/
			closeAllLists();
			if (!val) {
				return false;
			}
			currentFocus = -1;
			/*create a DIV element that will contain the items (values):*/
			a = document.createElement("DIV");
			a.setAttribute("id", this.id + "autocomplete-list");
			a.setAttribute("class", "autocomplete-items");
			/*append the DIV element as a child of the autocomplete container:*/
			this.parentNode.appendChild(a);
			/*for each item in the array...*/
			for (i = 0; i < arr.length; i++) {
				/*check if the item starts with the same letters as the text field value:*/
				if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
					/*create a DIV element for each matching element:*/
					b = document.createElement("DIV");
					/*make the matching letters bold:*/
					b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
					b.innerHTML += arr[i].substr(val.length);
					/*insert a input field that will hold the current array item's value:*/
					b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
					/*execute a function when someone clicks on the item value (DIV element):*/
					b.addEventListener("click", function(e) {
						/*insert the value for the autocomplete text field:*/
						inp.value = this.getElementsByTagName("input")[0].value;
						/*close the list of autocompleted values,
						(or any other open lists of autocompleted values:*/
						closeAllLists();
					});
					a.appendChild(b);
				}
			}
		});
		/*execute a function presses a key on the keyboard:*/
		inp.addEventListener("keydown", function(e) {
			var x = document.getElementById(this.id + "autocomplete-list");
			if (x) x = x.getElementsByTagName("div");
			if (e.keyCode == 40) {
				/*If the arrow DOWN key is pressed,
				increase the currentFocus variable:*/
				currentFocus++;
				/*and and make the current item more visible:*/
				addActive(x);
			} else if (e.keyCode == 38) { //up
				/*If the arrow UP key is pressed,
				decrease the currentFocus variable:*/
				currentFocus--;
				/*and and make the current item more visible:*/
				addActive(x);
			} else if (e.keyCode == 13) {
				/*If the ENTER key is pressed, prevent the form from being submitted,*/
				e.preventDefault();
				if (currentFocus > -1) {
					/*and simulate a click on the "active" item:*/
					if (x) x[currentFocus].click();
				}
			}
		});

		function addActive(x) {
			/*a function to classify an item as "active":*/
			if (!x) return false;
			/*start by removing the "active" class on all items:*/
			removeActive(x);
			if (currentFocus >= x.length) currentFocus = 0;
			if (currentFocus < 0) currentFocus = (x.length - 1);
			/*add class "autocomplete-active":*/
			x[currentFocus].classList.add("autocomplete-active");
		}

		function removeActive(x) {
			/*a function to remove the "active" class from all autocomplete items:*/
			for (var i = 0; i < x.length; i++) {
				x[i].classList.remove("autocomplete-active");
			}
		}

		function closeAllLists(elmnt) {
			/*close all autocomplete lists in the document,
			except the one passed as an argument:*/
			var x = document.getElementsByClassName("autocomplete-items");
			for (var i = 0; i < x.length; i++) {
				if (elmnt != x[i] && elmnt != inp) {
					x[i].parentNode.removeChild(x[i]);
				}
			}
		}
		/*execute a function when someone clicks in the document:*/
		document.addEventListener("click", function(e) {
			closeAllLists(e.target);
		});
	}

	
	/*An array containing all the category names:*/
	var categories = ["Automotive", "Business Support & Supplies", "Computers & Electronics", "Construction & Contractors", "Education", "Entertainment", "Food & Dining", "Health & Medicine", "Home & Garden", "Legal & Financial", "Manufacturing", "Wholesale", "Distribution", "Merchants", "Retail", "Miscellaneous", "Personal Care & Services", "Real Estate", "Transportation", "Food Service", "Investor", "Construction", "Real Estate", "Restaurants", "Advertising", "Hotel Room", "Hospital", "Clothing And Accessories", "Coaching", "Training", "Social Services", "Computers and Telecommunications", "Home Products", "Home Groceries", "Sports"];

	/*initiate the autocomplete function on the "myInput" element, and pass along the categories array as possible autocomplete values:*/
	autocomplete(document.getElementById("myInput2"), categories);


	/*An array containing all the city names india:*/
	var cities = ["Adoni", "Amaravati", "Anantapur", "Chandragiri", "Chittoor", "Dowlaiswaram", "Kadapa", "Kakinada", "Kurnool", "Machilipatnam", "Nagarjunakonda", "ajahmundry", "Srikakulam", "Tirupati", "Vijayawada", "Visakhapatnam", "Vizianagaram", "Yemmiganur", "Itanagar", "Dhuburi", "Dibrugarh", "Dispur", "Guwahati", "Jorhat", "Nagaon", "Silchar", "Tezpur", "Tinsukia", "Ara", "Baruni", "Begusarai", "Bettiah", "Bhagalpur", "Bihar Sharif", "Bodh Gaya", "Buxar", "Darbhanga", "Dehri", "Dinapur Nizamat", "Gaya", "Hajipur", "Jamalpur", "Katihar", "Madhubani", "Motihari", "Munger", "Muzaffarpur", "Patna", "Purnia", "Pusa", "Saharsa", "Samastipur", "Sasaram", "Sitamarhi", "Siwan", "Chandigarh", "Ambikapur", "Bhilai", "Bilaspur", "Dhamtari", "Durg", "Jagdalpur", "Raipur", "Rajnandgaon", "Silvassa", "Daman", "Diu", "Delhi", "New Delhi", "Panaji", "Madgaon", "Ahmadabad", "Amreli", "Bharuch", "Bhavnagar", "Bhuj", "Dwarka", "Gandhinagar", "Godhra", "Jamnagar", "Junagadh", "Kandla", "Khambhat", "Kheda", "Mahesana", "Morvi", "Nadiad", "Navsari", "Okha", "Palanpur", "Patan", "Porbandar", "Rajkot", "Surat", "Surendranagar", "Valsad", "Veraval", "Ambala", "Bhiwani", "Chandigarh", "Faridabad", "Firozpur Jhirka", "Gurgaon", "Hansi", "Hisar", "Jind", "Kaithal", "Karnal", "Kurukshetra", "Panipat", "Pehowa", "Rewari", "Rohtak", "Sirsa", "Sonipat", "Bilaspur", "Chamba", "Dalhousie", "Dharmshala", "Hamirpur", "Kangra", "Kullu", "Mandi", "Nahan", "Shimla", "Una", "Jammu and Kashmir", "Anantnag", "Baramula", "Doda", "Gulmarg", "Jammu", "Kathua", "Leh", "Punch", "Rajauri", "Srinagar", "Udhampur", "Bokaro", "Chaibasa", "Deoghar", "Dhanbad", "Dumka", "Giridih", "Hazaribag", "Jamshedpur", "Jharia", "Rajmahal", "Ranchi", "Saraikela", "Badami", "Ballari", "Bangalore", "Belgavi", "Bhadravati", "Bidar", "Chikkamagaluru", "Chitradurga", "Davangere", "Halebid", "Hassan", "Hubballi-Dharwad", "Kalaburagi", "Madikeri", "Mandya", "Mangaluru", "Mysuru", "Raichur", "Shivamogga", "Shravanabelagola", "Shrirangapattana", "Tumkuru", "Alappuzha", "Badagara", "Idukki", "Kannur", "Kochi", "Kollam<", "Kottayam", "Kozhikode", "Mattancheri", "Palakkad", "Thalassery", "Thiruvananthapuram", "Thrissur", "Balaghat", "Barwani", "Betul", "Bharhut", "Bhind", "Bhojpur", "Bhopal", "Burhanpur", "Chhatarpur", "Chhindwara<", "Damoh", "Datia", "Dewas", "Dhar", "Guna", "Gwalior", "Hoshangabad", "Indore", "Itarsi", "Jabalpur", "Jhabua", "Khajuraho", "Khandwa", "Khargon", "Maheshwar", "Mandla", "Mandsaur", "Mhow", "Morena", "Murwara", "Narsimhapur", "Narsinghgarh", "Narwar", "Neemuch", "Nowgong", "Orchha", "Panna", "Raisen", "Rajgarh", "Ratlam", "Rewa", "Sagar", "Sarangpur", "Satna", "Sehore", "Seoni", "Shahdol", "Shajapur", "Sheopur", "Shivpuri", "Ujjain", "Vidisha", "Ahmadnagar", "Akola", "Amravati", "Aurangabad", "Bhandara", "Bhusawal", "Bid", "Buldana", "Chandrapur", "Daulatabad", "Dhule", "Jalgaon", "Kalyan", "Karli", "Kolhapur", "Mahabaleshwar", "Malegaon", "Matheran", "Mumbai", "Nagpur", "Nanded", "Nashik", "Osmanabad", "Pandharpur", "Parbhani", "Ratnagiri", "Sangli", "Satara", "Sevagram", "Solapur", "Thane", "Ulhasnagar", "Vasai-Virar", "Wardha", "Yavatmal", "Imphal", "Manipur", "Meghalaya", "Shillong", "Cherrapunji", "Aizawl", "Lunglei", "Nagaland", "Kohima", "Mon", "Phek", "Wokha", "Balangir", "Baleshwar", "Baripada", "Bhubaneshwar", "Brahmapur", "Cuttack", "Dhenkanal", "Keonjhar", "Konark", "Koraput", "Paradip", "Phulabani", "Puri", "Sambalpur", "Udayagiri", "Karaikal", "Mahe", "Puducherry", "Yanam", "Amritsar", "Batala", "Chandigarh", "Faridkot", "Firozpur", "Gurdaspur", "Hoshiarpur", "Jalandhar", "Kapurthala", "Ludhiana", "Nabha", "Patiala", "Rupnagar", "Sangrur", "Abu", "Ajmer", "Alwar", "Amer", "Barmer", "Beawar", "Bharatpur", "Bhilwara", "Bikaner", "Bundi", "Chittaurgarh", "Churu", "Dhaulpur", "Dungarpur", "Ganganagar", "Hanumangarh", "Jaipur", "Jaisalmer", "Jhalawar", "Jhunjhunu", "Jodhpur", "Kishangarh", "Kota", "Merta", "Nagaur", "Nathdwara", "Pali", "Phalodi", "Pushkar", "Sawai Madhopur", "Shahpura", "Sikar", "Sirohi", "Tonk", "Udaipur", "Gangtok", "Gyalsing", "Lachung", "Mangan", "Arcot", "Chengalpattu", "Chennai", "Chidambaram", "Coimbatore", "Cuddalore", "Dharmapuri", "Dindigul", "Kanchipuram", "Kanniyakumari", "Kodaikanal", "Kumbakonam", "Madurai", "Mamallapuram", "Nagappattinam", "Nagercoil", "Palayankottai", "Pudukkottai", "Rajapalaiyam", "Ramanathapuram", "Salem", "Thanjavur", "Tiruchchirappalli", "Tirunelveli", "Tiruppur", "Tuticorin", "Udhagamandalam", "Vellore", "Hyderabad", "Karimnagar", ">Khammam", "Mahbubnagar", "Nizamabad", "Sangareddi", "Warangal", "Agartala", "Agra", "Aligarh", "Amroha", "Ayodhya", "Azamgarh", "Bahraich", "Ballia", "Banda", "Bara Banki", "Bareilly", "Basti", "Bijnor", "Bithur", "Budaun", "Bulandshahr", "Punjab", "Deoria", "Etah", "Etawah", "Faizabad", "Farrukhabad-cum-Fatehgarh", "Fatehpur", "Fatehpur Sikri", "Ghaziabad", "Ghazipur", "Gonda", "Gorakhpur", "Hamirpur", "Hardoi", "Hathras", "Jalaun", "Jaunpur", "Jhansi", "Kannauj", "Kanpur", "Lakhimpur", "Lalitpur", "Lucknow", "Mainpuri", "Mathura", "Meerut", "Mirzapur-Vindhyachal", "Moradabad", "Muzaffarnagar", "Partapgarh", "Pilibhit", "Prayagraj", "Rae Bareli", "Rampur", "Saharanpur", "Sambhal", "Shahjahanpur", "Sitapur", "Sultanpur", "Tehri", "Varanasi", "Almora", "Dehra Dun", "Haridwar", "Mussoorie", "Nainital", "Alipore", "Alipur Duar", "Asansol", "Baharampur", "Bally", "Balurghat", "Bankura", "Baranagar", "Barasat", "Barrackpore", "Basirhat", "Bhatpara", "Bishnupur", "Budge Budge", "Burdwan", "Chandernagore", "Darjiling", "Diamond Harbour", "Dum Dum", "Durgapur", "Halisahar", "Haora", "Ingraj Bazar", "Kalimpong", "Kamarhati", "Kanchrapara", ">Kharagpur", "Koch Bihar", "Kolkata", "Krishnanagar", "Malda", "Midnapore", "Murshidabad", "Navadwip", "Palashi", "Panihati", "Raiganj", "Santipur", "Shantiniketan", "Shrirampur", "Siliguri", "Tamluk", "Titagarh"];

	/*initiate the autocomplete function on the "myInput" element, and pass along the cities array as possible autocomplete values:*/
	autocomplete(document.getElementById("myInput3"), cities);

	jQuery(document).ready(function() {
		jQuery(".div_select2").select2();
	});
</script>

<?php


include('footer.php'); ?>