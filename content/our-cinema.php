<hr style=" border: 2px solid #990000">
<main class="page">
    <section class="clean-block clean-form">
        <div class="container row">
            <div class="col-md-6 col-sm-12 col-lg-6">
                <div class="block-heading">
                    <h2 class="header">Contact Us</h2>
                    <p>Send us your questions or suggestions to help us better improve your movie theatre experience.</p>
                </div>
                <form name="contactform" method="post" action="index.php?content=send_email_form" style="border-top-color: #8bb393; ">
                    <div class="form-group"><label>Name</label><input class="form-control" type="text" name="name" id="name" placeholder="First Name & Last Name"></div>
                    <div class="form-group"><label>Subject</label><input class="form-control" type="text" name="subject" id="subject"></div>
                    <div class="form-group"><label>Email</label><input class="form-control" type="email" name="email" id="email"></div>
                    <div class="form-group"><label>Message</label><textarea class="form-control" name="message" id="message"></textarea></div>
                    <div class="form-group"><button class="btn btn-outline-success btn-block" type="submit" name='sendemail' id="email">Send</button></div>
                </form>
            </div>
            <div class="col-md-6 col-sm-12 col-lg-6">
                <div class="container">
                    <div class="block-heading">
                        <h2 class="header"><i class="far fa-compass"></i> Locate Us</h2>
                        <p>977 Saint-Catherine St W, Montreal, QC H3B 4W3</p><br/>
                    </div>
                    <div id="map"></div>
                    <script>
                        function initMap() {
                            var myLatLng = {lat: 45.501291, lng: -73.572446};

                            var map = new google.maps.Map(document.getElementById('map'), {
                                zoom: 12,
                                center: myLatLng
                            });

                            var marker = new google.maps.Marker({
                                position: myLatLng,
                                map: map,
                                title: 'Hello World!'
                            });
                        }
                    </script>
                    <script async defer
                            src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCFc5bfeU0mkgOTJaup5InmKPTVPkvtu6E&callback=initMap">
                    </script>
                </div>
            </div>
        </div>
    </section>
    <section class="clean-block clean-gallery dark">
        <div class="container">
            <div class="block-heading">
                <h2 class="header" id="gallery">Gallery</h2>
                <p>Have a look at some of the many commodities offered in our cinema.</p>
            </div>
            <div class="row">
                <div class="col-md-6 col-lg-4 item"><a href="assets/img/cinema1.jpg" class="lightbox"><img class="img-thumbnail img-fluid image" src="assets/img/cinema1.jpg"></a></div>
                <div class="col-md-6 col-lg-4 item"><a href="assets/img/cinema4.jpg" class="lightbox"><img class="img-thumbnail img-fluid image" src="assets/img/cinema4.jpg"></a></div>
                <div class="col-md-6 col-lg-4 item"><a href="assets/img/cinema2.jpg" class="lightbox"><img class="img-thumbnail img-fluid image" src="assets/img/cinema2.jpg"></a></div>
                <div class="col-md-6 col-lg-4 item"><a href="assets/img/cinema5.jpg" class="lightbox"><img class="img-thumbnail img-fluid image" src="assets/img/cinema5.jpg"></a></div>
                <div class="col-md-6 col-lg-4 item"><a href="assets/img/cinema7.jpg" class="lightbox"><img class="img-thumbnail img-fluid image" src="assets/img/cinema7.jpg"></a></div>
                <div class="col-md-6 col-lg-4 item"><a href="assets/img/cinema4.jpg" class="lightbox"><img class="img-thumbnail img-fluid image" src="assets/img/cinema4.jpg"></a></div>
                <div class="col-md-6 col-lg-4 item"><a href="assets/img/cinema6.jpg" class="lightbox"><img class="img-thumbnail img-fluid image" src="assets/img/cinema6.jpg"></a></div>
                <div class="col-md-6 col-lg-4 item"><a href="assets/img/cinema3.jpg" class="lightbox"><img class="img-thumbnail img-fluid image" src="assets/img/cinema3.jpg"></a></div>
                <div class="col-md-6 col-lg-4 item"><a href="assets/img/cinema8.jpg" class="lightbox"><img class="img-thumbnail img-fluid image" src="assets/img/cinema8.jpg"></a></div>
            </div>
        </div>
    </section>
</main>