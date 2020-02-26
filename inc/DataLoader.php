<?php

require_once 'Database.php';


class DataLoader
{

    public function __construct()
    {
        $this->db = new Database();
    }
      
    function longestOpeningCrawl($args = null){
        return function() use ($args){
            $rawQuery = "
                SELECT
                    title,
                    COUNT(*) AS count 
                FROM
                    films_characters 
                    LEFT JOIN films ON films.id = films_characters.film_id
                    GROUP BY films.id
                    ORDER BY count DESC
                LIMIT 1
            ";

            $stmt = $this->db->singleton()->query($rawQuery);
            $stmt->execute();
            $row = $stmt->fetch();

            return $row['title'];
        };
    }


    function mostAppreadCharacter($args = null){
        return function() use ($args){
            $rawQuery = "
                SELECT
                    name,
                    COUNT(*) AS count 
                FROM
                    films_characters 
                    LEFT JOIN people ON people.id = films_characters.people_id
                GROUP BY
                    people.id 
                    ORDER BY count DESC
                LIMIT 1
            ";

            $stmt = $this->db->singleton()->query($rawQuery);
            $stmt->execute();
            $row = $stmt->fetch();

            
            return $row['name'];
        };
    }

    function mostAppreadSpecies($args = null){
        return function() use ($args){
            $rawQuery = "
                SELECT
                    species.name,
                    count(*) AS count
                FROM
                    `films_characters` 
                    LEFT JOIN people ON people.id = films_characters.people_id
                    LEFT JOIN species_people ON species_people.people_id = films_characters.people_id
                    LEFT JOIN species ON species.id = species_people.species_id
                    WHERE species_id IS NOT NULL
                GROUP BY
                    species_id
                    ORDER BY count DESC
                LIMIT 5
            ";

            $stmt = $this->db->singleton()->query($rawQuery);
            $stmt->execute();

            $res = array();
            foreach($stmt->fetchAll() as $row){
                $res[] = array('name' => $row['name'], 'count' => $row['count']);
            }

            return $res;
        };
    }

    function largestVehiclePilots($args = null){
        return function() use ($args){
            $rawQuery = "
                SELECT
                    planets.name AS planet,
                    COUNT( DISTINCT people_id ) AS count,
                    GROUP_CONCAT( DISTINCT people.name ) AS pilots 
                FROM
                    vehicles_pilots
                    LEFT JOIN people ON people.id = vehicles_pilots.people_id
                    LEFT JOIN planets ON planets.id = people.homeworld 
                GROUP BY
                    planets.id 
                ORDER BY
                    planets.id
                LIMIT 5
            ";

            $stmt = $this->db->singleton()->query($rawQuery);
            $stmt->execute();

            $res = array();
            foreach($stmt->fetchAll() as $row){
                $res[] = array('planet' => $row['planet'], 'count' => $row['count'], 'pilots' => $row['pilots']);
            }

            return $res;
        };
    }

          
    function login($args = null){
        $args = array_values($args);
        if(empty($args[0]) || empty($args[1])){

            return 'All fields are mandatory!'.print_r($args).$args[0];
        }
        



        //for the sake of this demo project passwords won't encrypt
        //I've changed my mind, it encrypted!

        $password = MD5($args[1]);

        $rawQuery = "SELECT * FROM user WHERE email = ? AND password = ? LIMIT 1";

        $stmt = $this->db->singleton()->prepare($rawQuery);
        $stmt->bindParam(1, $args[0]);
        $stmt->bindParam(2, $password);
        $stmt->execute();

        $row = $stmt->fetch();

        if(empty($row['token'])){
            return 'Email or Password is wrong!';
        }else{

            $token = md5(uniqid($row['email'].time(), true));

            $rawQuery = "UPDATE user SET token = ? WHERE user_id = ? LIMIT 1";
            $stmt = $this->db->singleton()->prepare($rawQuery);
            $stmt->bindParam(1, $token);
            $stmt->bindParam(2, $row['user_id']);
            if($stmt->execute()){
                return $token;
            }
        }


    }
          
    function signUp($args = null){
        $args = array_values($args);

        if(empty($args[0]) || empty($args[1])){
            return 'All fields are mandatory!';
        }elseif (!filter_var($args[0], FILTER_VALIDATE_EMAIL)) {
            return 'Email is not correct!';
        }elseif (strlen($args[1]) < 6) {
            return 'Your password must contain at least 6 characters';
        }

        $rawQuery = "SELECT COUNT(*) FROM user WHERE email = ? LIMIT 1";
        $stmt = $this->db->singleton()->prepare($rawQuery);
        $stmt->bindParam(1, $args[0]);
        $stmt->execute();
        if($stmt->fetchColumn() > 0){
            return 'This email is already in use';
        }

        $password = MD5($args[1]);
        $token = md5(uniqid($args[0].time(), true));

        $rawQuery = "INSERT INTO user (email, password, token) VALUES (?, ?, ?)";
        $stmt = $this->db->singleton()->prepare($rawQuery);
        $stmt->bindParam(1, $args[0]);
        $stmt->bindParam(2, $password);
        $stmt->bindParam(3, $token);
        if($stmt->execute()){
            return $token;
        }


    }

    function inj($inj)
    {

        $search = array("\\", "\x00", "\n", "\r", "'", '"', "\x1a");
        $replace = array("\\\\", "\\0", "\\n", "\\r", "\'", '\"', "\\Z");

        return str_replace($search, $replace, $inj);
    }



    function ip()
    {
        $client = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote = $_SERVER['REMOTE_ADDR'];

        if (filter_var($client, FILTER_VALIDATE_IP)) {
            $ip = $client;
        } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
            $ip = $forward;
        } else {
            $ip = $remote;
        }

        return $ip;
    }



}
