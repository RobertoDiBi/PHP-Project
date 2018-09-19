<?php
/**
 * @author roberto di biase
 */

class Database
{
    private static $init = false;
    public static $conn;
    public static $userId;
    public static $userName;

    public static function initialize(){
        if(self::$init === true)return;
        self::$init = true;

        $servername = "159.203.101.106";
        $username = "alexJamieson";
        $password = "rectumspectrum";
        $database_name = "alexphp";

        self::$conn = new mysqli($servername, $username, $password, $database_name);
    }

    public static function refreshNowPlaying(){
        $deleteSQL = "DELETE FROM moviesNowPlaying;";
        mysqli_query(self::$conn, $deleteSQL);
        $movies = MovieAPI::getMoviesNowPlaying();
        foreach($movies as $movie) {
            $id = $movie["id"];
            $title = $movie["title"];
            $language = $movie["original_language"];
            $releaseDate = $movie["release_date"];
            $image_link = "https://image.tmdb.org/t/p/original/" . $movie["poster_path"];

            $split_image = pathinfo($image_link);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL , $image_link);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response= curl_exec ($ch);
            curl_close($ch);
            $poster_path = "assets/img/posters/".$split_image['filename'].".".$split_image['extension'];
            $file = fopen($poster_path , 'w') or die("X_x");
            fwrite($file, $response);
            fclose($file);
            $overview = $movie["overview"];
            $genre_ids = $movie["genre_ids"];
            $genres = array();
            foreach ($genre_ids as $genre_id){
                $sql = "SELECT * FROM genres WHERE id = $genre_id";
                $result = mysqli_query(self::$conn, $sql);
                $row = mysqli_fetch_assoc($result);
                array_push($genres, $row["name"]);
            }
            $genres_string = implode(', ', $genres);
            $trailer_link = MovieAPI::getTrailerLink($id);
            $sql = "INSERT INTO moviesNowPlaying (id, title, language, releaseDate, overview, posterPath, genres, trailerLink ) VALUES ('{$id}', '{$title}', '{$language}', '{$releaseDate}', '{$overview}', '{$poster_path}', '{$genres_string}', '{$trailer_link}');";
            mysqli_query(self::$conn, $sql);
        }
    }

    public static function getNowPlaying(){
        $movies = array();
        $sql = "SELECT * FROM moviesNowPlaying";
        $result = mysqli_query(self::$conn, $sql);
        $counter = 0;
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $movie = new Movie();
                $movie->setId($row["id"]);
                $movie->setTitle($row["title"]);
                $movie->setLanguage($row["language"]);
                $movie->setReleaseDate($row["releaseDate"]);
                $movie->setOverview($row["overview"]);
                $movie->setPosterPath($row["posterPath"]);
                $movie->setGenres($row["genres"]);
                $movie->setTrailerLink($row["trailerLink"]);
                $movies[$counter] = $movie;
                $counter++;
            }
        }
        return $movies;
    }

    public static function refreshAllMovies(){
        $insertNowPlaying = "INSERT INTO allMovies SELECT * FROM moviesNowPlaying WHERE NOT EXISTS (SELECT id from allMovies WHERE allMovies.id = moviesNowPlaying.id)";
        mysqli_query(self::$conn, $insertNowPlaying);
        $insertComingSoon = "INSERT INTO allMovies SELECT * FROM moviesComingSoon WHERE NOT EXISTS (SELECT id from allMovies WHERE allMovies.id = moviesComingSoon.id)";
        mysqli_query(self::$conn, $insertComingSoon);
    }

    public static function getAllMovies(){
        $movies = array();
        $sql = "SELECT * FROM allMovies";
        $result = mysqli_query(self::$conn, $sql);
        $counter = 0;
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $movie = new Movie();
                $movie->setId($row["id"]);
                $movie->setTitle($row["title"]);
                $movie->setLanguage($row["language"]);
                $movie->setReleaseDate($row["releaseDate"]);
                $movie->setOverview($row["overview"]);
                $movie->setPosterPath($row["posterPath"]);
                $movie->setGenres($row["genres"]);
                $movie->setTrailerLink($row["trailerLink"]);
                $movies[$counter] = $movie;
                $counter++;
            }
        }
        return $movies;
    }
    
    public static function refreshComingSoon(){
        $deleteSQL = "DELETE FROM moviesComingSoon;";
        mysqli_query(self::$conn, $deleteSQL);
        $movies = MovieAPI::getMoviesComingSoon();
        foreach($movies as $movie) {
            $id = $movie["id"];
            $title = $movie["title"];
            $language = $movie["original_language"];
            $releaseDate = $movie["release_date"];
            $image_link = "https://image.tmdb.org/t/p/original/" . $movie["poster_path"];

            $split_image = pathinfo($image_link);

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL , $image_link);
            curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US) AppleWebKit/525.13 (KHTML, like Gecko) Chrome/0.A.B.C Safari/525.13");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response= curl_exec ($ch);
            curl_close($ch);
            $poster_path = "assets/img/posters/".$split_image['filename'].".".$split_image['extension'];
            $file = fopen($poster_path , 'w') or die("X_x");
            fwrite($file, $response);
            fclose($file);
            $overview = $movie["overview"];
            $genre_ids = $movie["genre_ids"];
            $genres = array();
            foreach ($genre_ids as $genre_id){
                $sql = "SELECT * FROM genres WHERE id = $genre_id";
                $result = mysqli_query(self::$conn, $sql);
                $row = mysqli_fetch_assoc($result);
                array_push($genres, $row["name"]);
            }
            $genres_string = implode(', ', $genres);
            $trailer_link = MovieAPI::getTrailerLink($id);
            $sql = "INSERT INTO moviesComingSoon (id, title, language, releaseDate, overview, posterPath, genres, trailerLink ) VALUES ('{$id}', '{$title}', '{$language}', '{$releaseDate}', '{$overview}', '{$poster_path}', '{$genres_string}', '{$trailer_link}');";
            mysqli_query(self::$conn, $sql);
        }
    }
    
    public static function getComingSoon(){
        $movies = array();
        $sql = "SELECT * FROM moviesComingSoon";
        $result = mysqli_query(self::$conn, $sql);
        $counter = 0;
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $movie = new Movie();
                $movie->setId($row["id"]);
                $movie->setTitle($row["title"]);
                $movie->setLanguage($row["language"]);
                $movie->setReleaseDate($row["releaseDate"]);
                $movie->setOverview($row["overview"]);
                $movie->setPosterPath($row["posterPath"]);
                $movie->setGenres($row["genres"]);
                $movie->setTrailerLink($row["trailerLink"]);
                $movies[$counter] = $movie;
                $counter++;
            }
        }
        return $movies;
    }

    public static function getMovieById($movieId){
        $sql = "SELECT * FROM moviesNowPlaying WHERE id = $movieId";
        $result = mysqli_query(self::$conn, $sql);
        $row = mysqli_fetch_assoc($result);
        $movie = new Movie();
        $movie->setId($row["id"]);
        $movie->setTitle($row["title"]);
        $movie->setLanguage($row["language"]);
        $movie->setReleaseDate($row["releaseDate"]);
        $movie->setOverview($row["overview"]);
        $movie->setPosterPath($row["posterPath"]);
        $movie->setGenres($row["genres"]);
        $movie->setTrailerLink($row["trailerLink"]);
        return $movie;
    }

    public static function _registerUser(User $user){
        $firstName = $user->getFirstName();
        $lastName = $user->getLastName();        
        $email = $user->getEmail();
        $password = $user->getPassword();
        
        $query = "INSERT INTO users (firstName, lastName, email, password) VALUES ('$firstName','$lastName','$email','$password')";
        
        if (mysqli_query(self::$conn, $query)) {
            return true;
        }else{
            return false;
        }
    }
    
    public static function _checkUserExists($firstName,$lastName,$email){
        $userExists =false ;
        $user_check_query = "SELECT * FROM users WHERE firstName='$firstName' AND lastName='$lastName' OR email='$email' LIMIT 1";
        $result = mysqli_query(self::$conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);

        if ($user) { // if user exists

            if ($user['firstName'] === $firstName and $user['lastName'] === $lastName) {
                $_SESSION['message']="User already exists.";
                return $userExists=true;
            }

            if ($user['email'] === $email) {
                $_SESSION['message'] = "Email already exists.";
                return $userExists=true;
            }
        }else{
            return $userExists=false;
        }
    }
    
    public static function _checkUserInUsers($email,$password){
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $results = mysqli_query(self::$conn, $query);
        return $results;   
    }

    // only used once to load the genres in the database.
    public static function fetchGenres(){
        $genres = MovieAPI::getGenres();
        foreach($genres as $genre){
            $id = $genre["id"];
            $name = $genre["name"];
            $sql = "INSERT INTO genres VALUES ('{$id}', '{$name}');";
            mysqli_query(self::$conn, $sql);
        }
    }
    
    
    public static function getAllSeats(){
        $seats = array();
        $sql = "SELECT * FROM seats";
        $result = mysqli_query(self::$conn, $sql);
        $counter = 0;
        if ($result->num_rows > 0){
            while ($row = $result->fetch_assoc()){
                $seat = new Seat();
                $seat->setId($row["idseats"]);
                $seat->setRow($row["row"]);
                $seat->setSeat($row["seat"]);
                $seats[$counter] = $seat;
                $counter++;
            }
        }
        return $seats;
    }

    public function saveReview(Review $review)
    {
        // Check if review is valid
        $validation = $review->checkIfValid();
        if ($validation === true) {
            $sqlExists = "SELECT * FROM reviews WHERE movieId = $review->movieId AND username = '$review->username'";
            $sql = "INSERT INTO reviews (username, message, movieId) VALUES('$review->username', '$review->message', '$review->movieId');"; #SQL injection - add prepare statement
            try {
                $exists = mysqli_query(self::$conn, $sqlExists);
                if ($exists->num_rows > 0) {
                    return ['You can only save 1 review per movie.'];
                }
                return mysqli_query(self::$conn, $sql);
            } catch (Exception $e) {
                return ['Error saving review.'];
            }
        } else {
            return $validation;
        }   
    }

    public function getMovieReviews($id)
    {
        $sql = "SELECT * FROM reviews WHERE movieId = " . $id . ";";
        $result = mysqli_query(self::$conn, $sql);
        
        $rows = [];
        while($row = $result->fetch_array(MYSQLI_ASSOC))
        {
            $rows[] = $row;
        }

        return $rows;
    }
    
    
    public function getAllBookedSeats($movieId,$date,$time){
        $sql = "SELECT * FROM seatsBooked WHERE movieId=".$movieId." and date='".$date."' and time=' ".$time." ';";
        $result = mysqli_query(self::$conn, $sql);
        $seatsBooked = Array();
        $counter = 0;
        if ($result->num_rows >= 0){
            while ($row = $result->fetch_assoc()){
                $seat = new SeatBooked();
                $seat->setId($row["idseatsBooked"]);
                $seat->setUserId($row["userId"]);
                $seat->setMovieId($row["movieId"]);
                $seat->setSeatId($row["seatId"]);
                $seat->setDate($row["date"]);
                $seat->setTime($row["time"]);
                $seatsBooked[$counter] = $seat;
                $counter ++;
            }
        }
        return $seatsBooked;
    }
    
    
    public function addBookedSeat($movieId,$seatId,$date,$time){
        $sql = "INSERT INTO seatsBooked (movieId, seatId, date, time) VALUES('$movieId', '$seatId','$date','$time')";
   
        mysqli_query(self::$conn, $sql);

    }
}