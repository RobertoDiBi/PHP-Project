<?php

/**
 * Description of SeatBooked
 *
 * @author roberto di biase
 */
class SeatBooked {
    /**
     * @var id
     * @type integer
     */
    public $id;
    /**
     * @var title
     * @type integer
     */
    public $userId;
    /**
     * @var seat
     * @type integer
     */
    public $movieId;
    /**
     * @var seat
     * @type integer
     */
    public $seatId;
    /**
     * @var seat
     * @type date
     */
    public $date;
    /**
     * @var seat
     * @type time
     */
    public $time;
    
    public function getId() {
        return $this->id;
    }

    public function getUserId(){
        return $this->userId;
    }

    public function getMovieId(){
        return $this->movieId;
    }

    public function getSeatId(){
        return $this->seatId;
    }

    public function getDate(){
        return $this->date;
    }

    public function getTime(){
        return $this->time;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function setMovieId($movieId) {
        $this->movieId = $movieId;
    }

    public function setSeatId($seatId) {
        $this->seatId = $seatId;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function setTime($time) {
        $this->time = $time;
    }


}
