<?php
/**
 * Description of Seat
 *
 * @author roberto di biase
 */
class Seat {
    /**
     * @var id
     * @type integer
     */
    public $id;
    /**
     * @var title
     * @type string
     */
    public $row;
    /**
     * @var seat
     * @type integer
     */
    public $seat;
    
    public function getId(){
        return $this->id;
    }

    public function getRow() {
        return $this->row;
    }

    public function getSeat(){
        return $this->seat;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setRow($row) {
        $this->row = $row;
    }

    public function setSeat($seat) {
        $this->seat = $seat;
    }


}
