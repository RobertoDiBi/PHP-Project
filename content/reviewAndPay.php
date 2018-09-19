<?php
    Database::initialize();
    //Get info from movie-info page
    $movie = Database::getMovieById($_POST["movieId"]);
    $date = $_POST["date"];
    $date2 = strtotime($_POST["date"]);
    $time = strtotime($_POST["showTime"]);
    $timeformat = date("H:i:s",$time);
    $dateformat = date("D, M jS Y",$date2);
    $timeformat2 = date("H:ia",$time);
    
    $ids= array();
    $seats= array();
    $idAndSeats = array();
    
    //get number of tickets selected 
    $childTickets=(int)$_POST["childTickets"];
    $generalTickets=(int)$_POST["generalTickets"];
    $seniorTickets=(int)$_POST["seniorTickets"];
    
    //Calculate total Tickets selected
    $tot = $childTickets + $generalTickets + $seniorTickets;

    $childTotPrice=(int)$_POST["childTotPrice"];
    $generalTotPrice=(int)$_POST["generalTotPrice"];
    $seniorTotPrice=(int)$_POST["seniorTotPrice"];
    
    //Calculate total price
    $totPrice = $childTotPrice + $generalTotPrice + $seniorTotPrice;
    
    if (!isset($_POST['confirmPurchase'])){
        if(!empty($_POST['seats'])) {
        // Counting number of checked checkboxes.
        $checked_count = count($_POST['seats']);
        }

        //$seatsId = ($_POST ('seatsid'));
        $selectedSeats = ($_POST['seats']);
        $count = 0;

        foreach ($selectedSeats as $seat){

            $idAndSeats[] = explode(':',$selectedSeats[$count]);
            $count++;
        }
        $count = 0; 

        foreach($idAndSeats as $row => $innerArray){
            for ($val = 0; $val < count($innerArray); $val++) {
                array_push($ids,$innerArray[0]);
                array_push($seats,$innerArray[1]);
                $val++;
            }
        }
    
        $formatList = implode('; ', $seats);
    }else{
        $ids = $_POST['ids'];
        foreach ( $ids as $id){  
        Database::addBookedSeat($movie->getId(),$id,$date,$timeformat); }
        header('location: index.php');
    }
?>


<main class="page">
    <hr style=" border: 2px solid #990000">
    <section class="clean-block features">
        <form class="container" action="index.php?content=reviewAndPay" method="post">
            <div class="block-heading">
                <h2 class="header"><?php echo'Showtime Information';?> </h2>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-3 feature-box">
                    <img src="<?php echo $movie->getPosterPath()?>" height="300" alt="Poster Image">
                </div>
                <div class="col-md-8 col-lg-8 feature-box">
                    <h4>Ticket Information</h4>
                    <hr>
                    <?php echo "Movie: ".$movie->getTitle()."<br/>"?>
                    <?php echo "Date: ".$dateformat."<br/>"?>
                    <?php echo "Showtime: ".$timeformat2."<br/>"?>
                    <hr>
                    <div class="col-md-12 col-lg-12 feature-box ">
                    <?php echo "You have selected the following seat(s):<br/>".$formatList."<br/><hr>"; ?>
                    <?php if($childTickets!=0){echo "Child: ".$childTickets."x". number_format($childTotPrice,2)."$<br/>";}?>
                    <?php if($generalTickets!=0){echo "General: ".$generalTickets."x". number_format($generalTotPrice,2)."$<br/>";}?>
                    <?php if($seniorTickets!=0){echo "Senior: ".$seniorTickets."x". number_format($seniorTotPrice,2)."$<br/>";}?>
                    <?php echo "Total Items: " . $tot."<br/><hr>Total Price: " .number_format($totPrice,2)."$<br/>"?>
                    </div><br/>
                    <h4><?php echo'Agree to Terms & Conditions';?> </h4>
                    <hr>
                    <p>
                       Details of your purchase are shown below.<br/>
                        Ensure you have selected the correct Theatre, Movie/Performance, Date, Showtime, type of Tickets, and total number of Tickets. <br/>
                        <b>Purchases are non-refundable. </b> 
                    </p>
                    <input type="checkbox" value="I Agree" name="agree" id="agree" required="" > I Agree <sup>*</sup>
                </div>
            </div>
                <div class="row justify-content-center">
                    <div class="col-md-6 col-lg-3 feature-box"></div>
                <div class="col-md-8 col-lg-8 feature-box ">
                    <h4>Payment Option</h4>
                    <hr>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc quam urna, dignissim nec auctor in, mattis vitae leo.</p>
                </div>
                <div class="col-md-5 feature-box">
                <input type="hidden" name="movieId" value="<?php echo $movie->getId(); ?>"/>
                <input type="hidden" name="childTickets" value="<?php echo $childTickets ?>"/>
                <input type="hidden" name="generalTickets" value="<?php echo $generalTickets ?>"/>
                <input type="hidden" name="seniorTickets" value="<?php echo $seniorTickets ?>"/>
                <input type="hidden" name="childTotPrice" value="<?php echo $childTotPrice?>"/>
                <input type="hidden" name="generalTotPrice" value="<?php echo $generalTotPrice ?>"/>
                <input type="hidden" name="seniorTotPrice" value="<?php echo $seniorTotPrice ?>"/>
                <input type="hidden" name="totTikets" value="<?php echo $tot?>"/>
                <input type="hidden" name="totPrice" value="<?php echo $totPrice ?>"/>
                <?php foreach($ids as $id):?>
                    <input type="hidden" name="ids[]" value="<?php echo $id ?>"/>
                <?php endforeach;?>
                <input type="hidden" name="date" value="<?php echo $date ?>"/>
                <input type="hidden" name="showTime" value="<?php echo $timeformat ?>"/>                      
                <button class="btn btn-success btn-lg float-right" style="margin-left: 10px;"type="submit" name="confirmPurchase" id="confirmPurchase"  value="Submit" onclick="alert('Your seats are successfully reserved. \nYou will be redirected to the Home page.')" >Confirm Purchase</button>
                <button class="btn btn-success btn-lg float-right" type="button" name="cancel" id="cancel"><a href="index.php?content=movies" style="text-decoration:none; color: white;">Cancel</a></button>
                </div>
            </div>
        </form>
    </section>
</main>
                 
