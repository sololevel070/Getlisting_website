<?php  
    include('db.php');
    
    $listing_fetch = mysqli_query($conn,"SELECT * FROM listing WHERE active_deactive = 'active' order by avg_rating desc limit 3 ");

    $listing_auto_cat = mysqli_query($conn,"SELECT distinct(listing_category) FROM listing WHERE active_deactive = 'active'");
    $listing_auto_city = mysqli_query($conn,"SELECT distinct(listing_city) FROM listing WHERE active_deactive = 'active'");
           
      $listing_category_array_auto = array();
      $listing_city_array_auto = array();

      while($row_listing_auto_row_cat = mysqli_fetch_row($listing_auto_cat))
      {

        $list_cat = explode("<br>", $row_listing_auto_row_cat[0]);

        foreach ($list_cat as $cat)
        {
          $listing_category_array_auto[] = $cat;

        } 
      }

      while($row_listing_auto_row_city = mysqli_fetch_row($listing_auto_city))
      {

        $list_city = explode("<br>", $row_listing_auto_row_city[0]);

        foreach ($list_city as $city) 
        {
          $listing_city_array_auto[] = $city;

        } 
      }
       
        

?>
<?php  

    if (isset($_POST['home_srchbtn'])) 
    {
        if (isset($_POST['listing_category']) AND isset($_POST['listing_category'])) 
        {
          $listing_category = $_POST['listing_category'];
          $listing_city = $_POST['listing_city'];

          $select_search = "SELECT * FROM listing where active_deactive ='active' AND listing_city LIKE '%". $listing_city ."%' AND listing_category LIKE '%".$listing_category."%' ";  
                       
        }
        elseif (isset($_POST['listing_category']) AND !isset($_POST['listing_city'])) 
        {
          $listing_category = $_POST['listing_category'];

          $select_search = "SELECT listing_category FROM listing where active_deactive ='active' AND listing_category LIKE '%".$listing_category."%' ";   
                       
        }
        elseif (!isset($_POST['listing_category']) AND isset($_POST['listing_city'])) 
        {
          $listing_city = $_POST['listing_city'];

          $select_search = "SELECT listing_city FROM listing where active_deactive ='active' AND listing_city LIKE '%".$listing_city."%' ";  
                       
        }
        if (mysqli_num_rows($select_search)>0) 
        {
            $row = mysqli_fetch_array($select_search);
        }
    
    }

?>
<!DOCTYPE HTML>
<html>
  <head>
    <title>Getlisting</title>
    <link rel = "icon" href ="images/icon.png" 
        type = "image/x-icon">
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>

  </head>
  <body class="is-preload">

    <?php include('header.php'); ?>
    <style type="text/css">
      .home_a
      {
        color: white !important;
      }
    </style>
    <!-- Banner -->
      <section id="banner">
        <div class="inner">
          <h2>Explore The GET LISTING</h2>
          <div class="frmSearch">
            <form autocomplete="off" class="listing_form index banner_form" method="POST" action="explore.php#exp_section">
                <div class="autocomplete">
                  <input id="myInput" type="text" name="listing_category" placeholder="What are you looking for" class="banner_form_what">
                </div>
                <div class="autocomplete autocomplete2">
                  <input id="myInput2" type="text" name="listing_city" placeholder="Business City" class="banner_form_location">
                </div>
                <input type="submit" name="home_srchbtn" value="Search">
            </form>
          </div>  
          
        </div>
      </section>
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
      if (!val) { return false;}
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
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
/*An array containing all the country names in the world:*/


var countries = <?php echo json_encode($listing_category_array_auto); ?>;


/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput"), countries);
</script>
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
      if (!val) { return false;}
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
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
  });
}

/*An array containing all the country names in the world:*/
var countries = <?php echo json_encode($listing_city_array_auto); ?>;

/*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
autocomplete(document.getElementById("myInput2"), countries);
</script>
    <!-- Highlights -->
    <?php  

      $listing_category_restourant = 'Restaurants';
      $listing_category_hospital = 'Hospital';
      $listing_category_school_and_college = 'Education';
      $listing_category_hotel_room = 'Hotel Room';
      $listing_category_manufacturing = 'Manufacturing';
      $listing_category_tour_travel = 'Transportation';

    ?>
      <section class="wrapper">
        <div class="inner">
          <header class="special">
            <h2>FIND LOCAL BUSINESS BY POPULAR CATEGORIES</h2>
            <p>Just click to get the best and featured business listing by business categories</p>
          </header>
          <div class="highlights">
            <section>
              <div class="content">
                <header>
                  <?php echo '<a href="listing_category.php?category='.$listing_category_restourant.'"><img src="images/restourant.png"></a>'; ?>
                  <h3>restaurant</h3>
                </header>
                <p>Are you hungry then explore restaurants by getlisting.</p>
              </div>
            </section>
            <section>
              <div class="content">
                <header>
                  <?php echo '<a href="listing_category.php?category='.$listing_category_hospital.'"><img src="images/hospital.png"></a>'; ?>
                  <h3>HOSPITAL</h3>
                </header>
                <p>Get the clean and nearest health center by just click in getlisting.</p>
              </div>
            </section>
            <section>
              <div class="content">
                <header>
                  <?php echo '<a href="listing_category.php?category='.$listing_category_school_and_college.'"><img src="images/school.png"></a>'; ?>
                  <h3>EDUCATION</h3>
                </header>
                <p>Find the best and nearest education trusts.</p>
              </div>
            </section>
            <section>
              <div class="content">
                <header>
                  <?php echo '<a href="listing_category.php?category='.$listing_category_hotel_room.'"><img src="images/hotel.png"></a>'; ?>
                  <h3>HOTEL ROOM</h3>
                </header>
                <p>Explore comforts bedroom and hotels by just click in getlisting.</p>
              </div>
            </section>
            <section>
              <div class="content">
                <header>
                  <?php echo '<a href="listing_category.php?category='.$listing_category_tour_travel.'"><img src="images/tour.png"></a>'; ?>
                  <h3>TRANSPORTATION</h3>
                </header>
                <p>Wanna go somewhere then just open getlisting and you will find the best tours.</p>
              </div>
            </section>
            <section>
              <div class="content">
                <header>
                  <?php echo '<a href="listing_category.php?category='.$listing_category_manufacturing.'"><img src="images/manufacturing.png"></a>'; ?>
                  <h3>MANUFACTURING</h3>
                </header>
                <p>Get the best and less expensive manufacturer from getlisting.</p>
              </div>
            </section>
          </div>
        </div>
      </section>

    <!-- Highlights -->
    <?php  

      $listing_city_mumbai = 'Mumbai';
      $listing_city_punjab = 'Punjab';
      $listing_city_delhi = 'Delhi';

    ?>
      <section class="wrapper">
        <div class="inner">
          <header class="special">
            <h2>FIND LOCAL BUSINESS BY POPULAR CITY</h2>
            <p>Just click to get the best and featured business listing by business city</p>
          </header>
          <div class="highlights">
            <section>
              <div class="content">
                <header>
                  <?php echo '<a href="listing_city.php?city='.$listing_city_delhi.'"><img src="images/delhi.png"></a>'; ?>
                  <h3>DELHI</h3>
                </header>
              </div>
            </section>
            <section>
              <div class="content">
                <header>
                  <?php echo '<a href="listing_city.php?city='.$listing_city_punjab.'"><img src="images/punjab.png"></a>'; ?>
                  <h3>PUNJAB</h3>
                </header>
              </div>
            </section>
            <section>
              <div class="content">
                <header>
                  <?php echo '<a href="listing_city.php?city='.$listing_city_mumbai.'"><img src="images/mumbai.png"></a>'; ?>
                  <h3>MUMBAI</h3>
                </header>
              </div>
            </section>
          </div>
        </div>
      </section>
    
    <!-- Testimonials -->
      <section class="wrapper wrapper_padding_reduce">
        <div class="inner">
          <header class="special">
            <h2>OUR TEAM</h2>
            <p>These are our group members who made the getlisting best and will make it more good in future.</p>
          </header>
          <div class="testimonials">
            <section>
              <div class="content">
                <div class="author">
                  <p class="credit credit_p"><strong>Jaimish Lakhani</strong></p>
                </div>
              </div>
            </section>
            <section>
              <div class="content">
                <div class="author">
                  <p class="credit credit_p"><strong>Sagar Koradiya</strong><br></p>
                </div>
              </div>
            </section>
            <section>
              <div class="content third_mem">
                <div class="author">                  
                  <p class="credit credit_p"><strong>Harsh Uchadiya</strong></p>
                </div>
              </div>
            </section>
          </div>
        </div>
      </section>
    <?php include('footer.php'); ?>
  </body>
</html>