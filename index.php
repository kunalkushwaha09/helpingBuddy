<?php

include_once "./include/header.php";

$cities = [" Satna", "Rewa", "Indore", "bhopal", "jabalpur ", "Gwalior", "sagar ", "ujjain", "dewas "];

?>
<style>
#myVideo {
  width: 100vw;
  height: 100vh;
  object-fit: cover;
  position: fixed;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
  z-index: -1;
}

main {
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  color: white;
}
section h2 {
  font-weight: 100;
  font-family: Helvetica, Arial, sans-serif;
}
.change_content:after {
  content: "";
  animation: changetext 8s infinite linear;
  color: #00cc00;
  text-align:center;
}

@keyframes changetext {
  5% {
    content: "Painter";
  }
  20% {
    content: "Carpenter";
  }
  35% {
    content: "Electrician";
  }
  60% {
    content: "Plumber";
  }
  80% {
    content: "Mobile Repairer";
  }
  100% {
    content: "Helper";
  }
}
</style>
<body>
<video autoplay muted loop id="myVideo">
  <source src="HOUSE2.mp4" type="video/mp4">
</video>
<div>
  <div>
    <h1 style="margin-top:10px;margin-left:10px;font-family: Helvetica, Arial, sans-serif;color:#00cc00;font-size:40px;">HelpingBuddy.com</h1>
    <h6 class ="Sub-text" style="margin-left:10px;color:white font: size 13px; font-family:Brush Script MT, Brush Script Std, cursive" >Keeps your House Maintain</h6><br>
    <div class="container" style="margin-top:5px; margin-bottom: 10px;"><br>
    <div>
       <main>
		    <section>
			    <h2 id= "pot" style = " margin-top:10px; text-align:center; color:white;font:size 150px;width=100px;height=100px;">Welcome To Helping Buddy</h2><br>
			    <h1>ARE YOU LOOKING FOR A | <span class="change_content"> </span> <span style="margin-top: -10px;">  </span>  </h1>
			    <p style ="color:#00cc00;">"Your satisfaction is our Priority"</p><br>
	    	</section>
	   </main>
   </div>
    <div class="row">
        <div class="form-group col-5">
            <label for="">City</label>
            <select class="form-control" name="city" id="city">
                <option value="none">-- Select City --</option>
                <?php foreach ($cities as $city) : ?>
                <option value="<?= $city ?>"> <?= $city ?>
                </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group col-5">
            <label for="">Who's Required</label>
            <select class="form-control" name="profession" id="profession">
                <option value="none">Select Profession</option>
                <option value="electrician">Electrician</option>
                <option value="plumber">Plumber</option>
                <option value="mobile">Mobile Repairer</option>
                <option value="painter">painter</option>
				 <option value="carpenter">carpenter</option>
            </select>
        </div>

        <div class="form-group col-2">
            <label for="">Action</label>
            <button id="search" class="form-control btn btn-success" type="button">Search</button>
        </div>

    <div class="table-responsive">
        <table id="providers" class="table">
            <thead>
                <tr>
                    <th>Photo</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Profession</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan='5' >Select city and profession..</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
</div>
</body>

</div>
<script src="js/jquery.js"></script>
<script>
    $(function() {
        $("#search").click(function() {
            var city = $("#city").val();
            var profession = $("#profession").val();

            if (city == "none" || profession == "none") {
                alert("Don't leave fields empty!");
                tbody = "<tr><td colspan='5'>please </td></tr>";
            } else {
                $.post('scripts/searchproviders.php', {
                    city: city,
                    profession: profession
                }, function(res) {
                    var providers = JSON.parse(res);
                    var tbody = "";

                    if (providers.failed == true) {
                        tbody = "<tr><td colspan='5'>No Service Providers found...</td></tr>";
                    } else {
                        providers.forEach(function(provider, i) {
                            tbody += "<tr>" +
                                "<td><img style='height:150px' src='images/" + provider
                                .photo +
                                "'/></td>" +
                                "<td>" + provider.name + "</td>" +
                                "<td>" + provider.adder1 + ",<br>" + provider.adder2 +
                                ",<br>" +
                                provider.city + "</td>" +
                                "<td>" + provider.profession + "</td>" +
                                "<td><a href='booking.php?provider=" + provider.id +
                                "' class='btn btn-primary btn-block'>Book</a></td>";
                        });
                    }
                    $("#providers tbody").html(tbody);
                });
            }
        });
    });
</script>


<?php include_once "./include/footer.php";

