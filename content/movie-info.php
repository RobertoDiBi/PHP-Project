<script type="text/javascript">
    var childTickets = 0;
    var generalTickets = 0;
    var seniorTickets= 0;
    var maxTickets = 9;

    function addTicket(ticketType){
        if (childTickets + generalTickets + seniorTickets >= maxTickets){
            alert("You can only purchase a maximum of 9 tickets at a time.");
        }else{
            if(ticketType === 'child'){
                childTickets++;
                document.getElementById('child').value = childTickets;
            }else if (ticketType === 'general'){
                generalTickets++;
                document.getElementById('general').value = generalTickets;
            }else {
                seniorTickets++;
                document.getElementById('senior').value = seniorTickets;
            }
            document.getElementById("btnSubmit").disabled = false;
        }
        updateSelection();
    }

    function removeTicket(ticketType){
        if(ticketType === 'child'){
            if(childTickets !== 0){
                childTickets--;
                document.getElementById('child').value = childTickets;
            }
        }else if (ticketType === 'general'){
            if(generalTickets !== 0){
                generalTickets--;
                document.getElementById('general').value = generalTickets;
            }
        }else {
            if(seniorTickets !== 0){
                seniorTickets--;
                document.getElementById('senior').value = seniorTickets;
            }
        }
        if(childTickets + generalTickets + seniorTickets === 0){
            document.getElementById("btnSubmit").disabled = true;
        }
        updateSelection();
    }

    function resetTickets(){
        childTickets = 0;
        generalTickets = 0;
        seniorTickets = 0;
        document.getElementById('child').value = childTickets;
        document.getElementById('general').value = generalTickets;
        document.getElementById('senior').value = seniorTickets;
    }

    function setShowtime(showtime){
        document.getElementById("showTime").value = showtime;
    }
    
    function setDate(){
        var e = document.getElementById("showDate");
        document.getElementById("date").value = e.options[e.selectedIndex].value;
    }

    function updateSelection(){
        document.getElementById("childTickets").value = childTickets;
        document.getElementById("generalTickets").value = generalTickets;
        document.getElementById("seniorTickets").value = seniorTickets;
        //document.getElementById("showDate").value = document.getElementById("date").options[document.getElementById("date").selectedIndex].text;
    }
</script>
<div>
    <?php
    Database::initialize();
    $movie = Database::getMovieById($_POST['movieId']); ?>
    <hr style=" border: 2px solid #990000"><br/>
    <div class="clean-blog-post">
        <div class="row">
            <div class="col-lg-4" style="text-align: center"><img class="rounded img-fluid" src="<?php echo $movie->getPosterPath(); ?>" width="300"></div>
            <div class="col-lg-7">
                <h1 class="header" style="padding: 20px;"><?php echo $movie->getTitle(); ?></h1>
                <div class="info" style="padding: 20px;"><span class="text-muted"><?php echo $movie->getGenres(); ?></span></div>
                <p style="padding: 20px;"><?php echo $movie->getOverview(); ?></p>
                <br><br>
                <h3 class="header" style="padding: 10px;">Showtimes</h3>
                <form style="padding: 20px;">
                    
                    <?php if(isset($_SESSION['username'])):?>
                    <select class="form-control" name="showDate" id="showDate">
                        <option><?php echo date("Y-m-d"); ?></option>
                        <option><?php echo date("Y-m-d", strtotime(' +1 day')); ?></option>
                        <option><?php echo date("Y-m-d", strtotime(' +2 day')); ?></option>
                    </select><br>

                    <button onclick="setShowtime('3:30pm'); setDate()" type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#ticketsModal"
                            >3:30 PM</button>
                    <button onclick="setShowtime('7:10pm'); setDate()" type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#ticketsModal"
                            >7:10 PM</button>
                    <button onclick="setShowtime('10:30pm'); setDate()" type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#ticketsModal"
                            >10:30 PM</button>
                    <?php else:?>
                        <div class="alert alert-warning">You must Login or Register to purchase tickets for this movie.</div>
                    <?php endif;?>
                </form>
            </div>
        </div><br>
        <div class="modal fade" id="ticketsModal">
            <div class="modal-dialog">
                <div class="modal-content">

                    <!-- Modal Header -->
                    <div class="modal-header">
                        <h4 class="modal-title darkGreen">Select your tickets</h4>
                        <button onclick="resetTickets();" type="button" class="close" data-dismiss="modal">x</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body">
                        <form class="form-group">
                            <div class="form-inline">
                                <label for="child">Child (3-13):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <button type="button" onclick="removeTicket('child')" class="btn btn-outline-basic">-</button>
                                <input type="text" class="form-control" size="1" name="child" id="child" value="0" disabled="disabled"  style="text-align: center;"/>
                                <button type="button" onclick="addTicket('child')" class="btn btn-outline-basic">+</button>
                                <label>&nbsp; x 8.50$</label>
                            </div>
                            <br/>
                            <div class="form-inline">
                                <label for="general">General (14-64):&nbsp;&nbsp;</label>
                                <button type="button" onclick="removeTicket('general')" class="btn btn-outline-basic">-</button>
                                <input type="text" class="form-control" size="1" name="general" id="general" value="0" disabled="disabled"  style="text-align: center;"/>
                                <button type="button" onclick="addTicket('general')" class="btn btn-outline-basic">+</button>
                                <label>&nbsp; x 12.50$</label>
                            </div>
                            <br/>
                            <div class="form-inline">
                                <label for="senior">Senior (65+):&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
                                <button type="button" onclick="removeTicket('senior')" class="btn btn-outline-basic">-</button>
                                <input type="text" class="form-control" size="1" name="senior" id="senior" value="0" disabled="disabled"  style="text-align: center;"/>
                                <button type="button" onclick="addTicket('senior')" class="btn btn-outline-basic">+</button>
                                <label>&nbsp; x 8.99$</label>
                            </div>
                        </form>
                    </div>

                    <!-- Modal footer -->
                    <div class="modal-footer">
                        <form id="submitTickets" action="index.php?content=seatBooking" method="post">
                            <input type="hidden" name="movieId" value="<?php echo $movie->getId(); ?>"/>
                            <input type="hidden" name="childTickets" id="childTickets">
                            <input type="hidden" name="generalTickets" id="generalTickets">
                            <input type="hidden" name="seniorTickets" id="seniorTickets">
                            <input type="hidden" name="date" id="date">
                            <input type="hidden" name="showTime" id="showTime">
                            <button id="btnSubmit" type="submit" class="btn btn-success" disabled="disabled">Proceed to seat selection</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        
        <div class="row" style="margin-top: 5%;">
            <div style="text-align: center;" class="col-lg-12 container">
                <hr style=" border: 2px solid #990000">
                <h2 style="text-align: center; margin: 5% 0 5% 0;" class="header">Trailer</h2>
                <div class="container-flex" id="video">
                    <iframe width="100%" height="100%"
                        src="<?php echo $movie->getTrailerLink(); ?>">
                </iframe>
                </div>
            </div>
        </div><br>
        <article class="row">
            <div style="margin-left: 25px" class="col-lg-6">
                <?php include 'reviews.php'; ?>
            </div>
        </article>
    </div>
</div>