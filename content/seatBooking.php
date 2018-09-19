<style>

    *, *:before, *:after {
        box-sizing: border-box;
    }

    .aud {
        margin: auto;
        margin-top: 10px;
        max-width: 1000px;
    }

    .borders {
        border-right: 5px solid #990000;
        border-left: 5px solid #990000;
    }

    ol {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .seats {
        display: flex;
        flex-direction: row;
        flex-wrap: nowrap;
        justify-content: flex-start;
    }
    
    .seats:nth-child(3) {
        display: flex;
        flex-direction: row;
        margin-bottom: 5%;
        flex-wrap: nowrap;
        justify-content: flex-start;
    }

    .seat {
        flex: 0 0 5%;

        position: relative;
    }
    .seat:nth-child(1){
        width: 500px
    }
    .seat:nth-child(3) {
        margin-right: 10%;
    }
    .seat:nth-child(13) {
        margin-right: 10%;
    }
    

    .seat input[type=checkbox] {
        position: absolute;
        opacity: 0;
    }
    .seat input[type=checkbox]:checked + label {
        background: #bada55;
        background-image: url('assets/img/seatIcon.png');
        background-repeat: no-repeat;
        background-size: 100% 100%;
        color:greenyellow;
        -webkit-animation-name: rubberBand;
        animation-name: rubberBand;
        animation-duration: 200ms;
        animation-fill-mode: both;
    }
    
    .seat input[type=checkbox]:not(:checked) + label {
    
    }
    .seat input[type=checkbox]:disabled + label {
        background: #dddddd;
        text-indent: -9999px;
                background-image: url('assets/img/seatIcon.png');
        background-repeat: no-repeat;
        background-size: 100% 100%;
        overflow: hidden;
    }
    .seat input[type=checkbox]:disabled + label:after {
        content: "X";
        color: red;
        text-indent: 0;
        position: absolute;
        top: 4px;
        left: 50%;
        transform: translate(-50%, 0%);
    }
    .seat input[type=checkbox]:disabled + label:hover {
        box-shadow: none;
        cursor: not-allowed;
    }
    .seat label {
        width: 100%;
        text-align: center;
        font-size: 14px;
        font-weight: bold;
        line-height: 1.5rem;
        padding: 4px 0;
        background: #c2d4dd;
        border-radius: 5px;
        animation-duration: 300ms;
        animation-fill-mode: both;
    }
    .seat label:before {
        content: "";
        position: absolute;
        width: 75%;
        height: 75%;
        top: 1px;
        left: 50%;
        transform: translate(-50%, 0%);
        border-radius: 3px;
    }
    .seat label:hover {
        cursor: pointer;
        box-shadow: 0 0 0px 2px #8bb393;
    }

    @-webkit-keyframes rubberBand {
        0% {
            -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1);
        }
        30% {
            -webkit-transform: scale3d(1.25, 0.75, 1);
            transform: scale3d(1.25, 0.75, 1);
        }
        40% {
            -webkit-transform: scale3d(0.75, 1.25, 1);
            transform: scale3d(0.75, 1.25, 1);
        }
        50% {
            -webkit-transform: scale3d(1.15, 0.85, 1);
            transform: scale3d(1.15, 0.85, 1);
        }
        65% {
            -webkit-transform: scale3d(0.95, 1.05, 1);
            transform: scale3d(0.95, 1.05, 1);
        }
        75% {
            -webkit-transform: scale3d(1.05, 0.95, 1);
            transform: scale3d(1.05, 0.95, 1);
        }
        100% {
            -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1);
        }
    }
    @keyframes rubberBand {
        0% {
            -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1);
        }
        30% {
            -webkit-transform: scale3d(1.25, 0.75, 1);
            transform: scale3d(1.25, 0.75, 1);
        }
        40% {
            -webkit-transform: scale3d(0.75, 1.25, 1);
            transform: scale3d(0.75, 1.25, 1);
        }
        50% {
            -webkit-transform: scale3d(1.15, 0.85, 1);
            transform: scale3d(1.15, 0.85, 1);
        }
        65% {
            -webkit-transform: scale3d(0.95, 1.05, 1);
            transform: scale3d(0.95, 1.05, 1);
        }
        75% {
            -webkit-transform: scale3d(1.05, 0.95, 1);
            transform: scale3d(1.05, 0.95, 1);
        }
        100% {
            -webkit-transform: scale3d(1, 1, 1);
            transform: scale3d(1, 1, 1);
        }
    }
    .rubberBand {
        -webkit-animation-name: rubberBand;
        animation-name: rubberBand;
    }
    
    #table_wrapper, .standings {
    width: 100%;
    height: 100%;
    overflow: auto;
}
</style> 

<section>
    
    <?php 
    
    Database::initialize();
    //Get info from movie-info page
    $movie = Database::getMovieById($_POST["movieId"]);
    $date = $_POST["date"];
    $date2 = strtotime($_POST["date"]);
    $time = strtotime($_POST["showTime"]);
    $timeformat = date("H:i:s",$time);
    $dateformat = date("D, M jS Y",$date2);
    
    
    //get number of tickets selected 
    $childTickets=(int)$_POST["childTickets"];
    $generalTickets=(int)$_POST["generalTickets"];
    $seniorTickets=(int)$_POST["seniorTickets"];
    
    //Calculate total Tickets selected
    $tot = $childTickets + $generalTickets + $seniorTickets;
    
    //Calculate single category price
    $childTotPrice = (double)$childTickets * 8.50;
    $generalTotPrice = (double)$generalTickets * 12.50;
    $seniorTotPrice = (double)$seniorTickets * 8.99;
    
    //Calculate total price
    $totPrice = $childTotPrice + $generalTotPrice + $seniorTotPrice;
    

    $seats = Database::getAllSeats();
    $seatsBooked = Database::getAllBookedSeats($movie->getId(), $date, $timeformat);
    

    
    ?>
    <section>
    <hr style=" border: 2px solid #990000">
    <div class="container row justify-content-center">
        <div class="block-heading ">
            <h2 class="header "><?php echo $movie->getTitle(). " - Seat Selection "; ?></h2>
        </div>
    </div>
    <hr style=" border: 2px solid #990000">
    <div>
        <div class="row info container" style="margin: 20px 0 20px 0;">
            <div class="col-lg-4">
            <?php if ($childTickets !== 0){  echo "Child: ".$childTickets." x ". number_format($childTotPrice,2). "$<br/>";}?>
            <?php if ($generalTickets !== 0){  echo "General: ".$generalTickets." x ". number_format($generalTotPrice,2). "$<br/>";}?>
            <?php if ($seniorTickets !== 0){  echo "Senior: ".$seniorTickets." x ". number_format($seniorTotPrice,2). "$<br/>";}?>
                <hr>
            Total Price: <?php echo number_format($totPrice,2);?>$
            </div>
            <div class="col-lg-4">
            Date: <?php echo $dateformat;?><br/>
            Time: <?php echo date("h:ia",$time)?><br/>
            <span hidden="" id="totSelected"><?php echo $tot?></span>
            Tickets selected: <span id="totTickets">0/<span><?php echo $tot?></span></span><br/> 
            </div>
        </div>
        <!--<div class="info"><span class="text-muted"><?php echo $movie->getGenres(); ?></span></div>-->
        <!--<p><?php echo $movie->getOverview(); ?></p>-->
    </div>
    <div class="container-flex row justify-content-center">
        <div style="width: 200px; height: 75px; border: solid black; text-align: center; line-height: 70px;" class="block-heading">SCREEN</div>
    </div>
    <div class="container">
        <form action="index.php?content=reviewAndPay" method="post">
        <div class="aud borders">
            <div id="table_wrapper"> 
                
                <table class="standings">
                <?php
                    foreach($seats as $key=>$seat):
                        $seatRow = $seat->getRow();
                        $seatNum = $seat->getSeat();
                        $seatId = $seat->getId();
                        if ($seatNum==1):      
                    ?>        
                        <tr class="seats">
                            <td class="seat ">
                                <input type="checkbox" name="seats[]" id="<?php echo  $seatRow.$seatNum ?>" value="<?php echo  $seatId.":".$seatRow.$seatNum; ?>" <?php foreach ($seatsBooked as $key => $seatBooked) {if($seat->getId()=== $seatBooked->getSeatId()){echo 'disabled';}}?>/>
                                <label for="<?php echo  $seatRow.$seatNum; ?>"><?php echo  $seatRow.$seatNum; ?></label>
                            </td>
                        <?php else:?>
                            <td class="seat">
                                <input type="checkbox" name="seats[]" id="<?php echo  $seatRow.$seatNum; ?>" value="<?php echo  $seatId.":".$seatRow.$seatNum; ?>" <?php foreach ($seatsBooked as $key => $seatBooked) {if($seat->getId()=== $seatBooked->getSeatId()){echo 'disabled';}}?> />
                                <label for="<?php echo  $seatRow.$seatNum; ?>"><?php echo  $seatRow.$seatNum; ?></label>
                            </td>
                        <?php endif; if ($seatNum==16):?>
                        </tr>
                        <?php endif;?>  
                <?php endforeach;?>
                </table> 
            </div>
        </div>
            <br/>
            <div class="block-heading" style="height:100px ; margin:auto;">
                <input type="hidden" name="movieId" value="<?php echo $movie->getId(); ?>"/>
                <input type="hidden" name="childTickets" value="<?php echo $childTickets ?>"/>
                <input type="hidden" name="generalTickets" value="<?php echo $generalTickets ?>"/>
                <input type="hidden" name="seniorTickets" value="<?php echo $seniorTickets ?>"/>
                <input type="hidden" name="childTotPrice" value="<?php echo $childTotPrice?>"/>
                <input type="hidden" name="generalTotPrice" value="<?php echo $generalTotPrice ?>"/>
                <input type="hidden" name="seniorTotPrice" value="<?php echo $seniorTotPrice ?>"/>
                <input type="hidden" name="date" value="<?php echo $date ?>"/>
                <input type="hidden" name="showTime" value="<?php echo $timeformat ?>"/>

                <button class="btn btn-success btn-lg float-right" style="margin-left: 10px;"type="submit" name="reviewAndPay" id="review" disabled="">Review and Pay</button>
                <button class="btn btn-success btn-lg float-right" type="button" name="cancel" id="cancel"><a href="index.php?content=movies" style="text-decoration:none; color: white;">Cancel</a></button>
            </div> 
        </form>      
    </div>
</section>
