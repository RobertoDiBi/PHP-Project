<?php
/**
 * @author roberto di biase
 */

class MovieAPI{
    public static function getMoviesNowPlaying(){
        $url = "https://api.themoviedb.org/3/movie/now_playing?api_key=9b4b290076ed71bdb51694dc5037e5cf&language=en-US&page=1";
        $nowPlayingContent = file_get_contents($url);
        $json = json_decode($nowPlayingContent, true);
        $moviesNowPlaying = $json["results"];
        return $moviesNowPlaying;
    }
    
    public static function getMoviesComingSoon(){
        $url = "https://api.themoviedb.org/3/movie/upcoming?api_key=9b4b290076ed71bdb51694dc5037e5cf&language=en-US&page=1";
        $nowPlayingContent = file_get_contents($url);
        $json = json_decode($nowPlayingContent, true);
        $moviesNowPlaying = $json["results"];
        return $moviesNowPlaying;
    }

    public static function getTrailerLink($movieId){
        $url = "http://api.themoviedb.org/3/movie/$movieId/videos?api_key=9b4b290076ed71bdb51694dc5037e5cf";
        $videos = file_get_contents($url);
        $json = json_decode($videos, true);
        $results = $json["results"];
        foreach ($results as $trailer){
            if($trailer["type"] == "Trailer"){
                return "https://www.youtube.com/embed/" . $trailer["key"];
            }
        }
    }

    public static function getComingSoon(){

    }

    public static function getGenres(){
        $url = "https://api.themoviedb.org/3/genre/movie/list?api_key=9b4b290076ed71bdb51694dc5037e5cf&language=en-US";
        $genresContent = file_get_contents($url);
        $json = json_decode($genresContent, true);
        $genres = $json["genres"];
        return $genres;
    }

}
