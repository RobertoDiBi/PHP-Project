<?php
class Review
{
    var $date;
    var $username;
    var $message;
    var $movieId;

    function __construct(array $review)
    {
        if ($review) {
            foreach ($review as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
        }
    }

    public function checkIfValid()
    {
        $errors = [];
        if (empty($this->username)) {
            $errors[] = "You must be logged in to write a review!";
        }

        if (empty($this->message)) {
            $errors[] = "Cannot submit empty reviews.";
        }

        if (empty($this->movieId)) {
            $errors[] = "Invalid movie ID";
        }

        // Valid
        if (empty($errors)) {
            return true;
        }

        return $errors;
    }
}
