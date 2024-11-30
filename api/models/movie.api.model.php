<?php
require_once 'api.model.php';
class MovieModel extends ApiModel{

    public function getMovies($genre=null, $orderBy=null, $direct='ASC'){
        $sql = 'SELECT * FROM movies';

        if ($genre){
            $sql .= ' WHERE genre=';
            switch ($genre) {
                case stristr($genre, 'Adventure'):
                    $sql .= ' "Adventure"';
                    break;
                case stristr($genre, 'Comedy'):
                    $sql .= ' "Comedy"';
                    break;
                case stristr($genre, 'Drama'):
                    $sql .= ' "Drama"';
                    break;
                case stristr($genre, 'Fantasy'):
                    $sql .= ' "Fantasy"';
                    break;
                case stristr($genre, 'Horror'):
                    $sql .= ' "Horror"';
                    break;
                case stristr($genre, 'Sci-Fi'):
                    $sql .= ' "Sci-Fi"';
            }
        }

        if ($orderBy) {
            switch ($orderBy) {
                case 'id_movie':
                    $sql .= ' ORDER BY id_movie';
                    break;
                case 'title':
                    $sql .= ' ORDER BY title';
                    break;
                case 'director':
                    $sql .= ' ORDER BY director';
                    break;
                case 'synopsis':
                    $sql .= ' ORDER BY synopsis';
                    break;
                case 'release_date':
                    $sql .= ' ORDER BY release_date';
                    break;
                case 'runtime':
                    $sql .= ' ORDER BY runtime';
                    break;
                case 'genre':
                    $sql .= ' ORDER BY genre';
                    break;
            }
            if ($direct === 'DESC') {
                $sql .= ' DESC';
            } else {
                $sql .= ' ASC';
            }
        }


        $query = $this->db->prepare($sql);
        $query->execute();

        $films = $query->fetchAll(PDO::FETCH_OBJ);

        return $films;
    }

    public function getMovie($id){
        $query = $this->db->prepare('SELECT * FROM movies WHERE id_movie=?');
        $query->execute([$id]);
    
        $movie = $query->fetch(PDO::FETCH_OBJ);
        return $movie;
    }

    public function addMovie($title, $director, $synopsis, $releaseDate, $runtime, $genre){
        $query = $this->db->prepare('INSERT INTO movies (title, director, synopsis, release_date, runtime, genre) VALUES (?, ?, ?, ?, ?, ?)');
        $query->execute([$title, $director, $synopsis, $releaseDate, $runtime, $genre]);
        $id = $this->db->lastInsertId();
        return $id;
    }

    public function editMovie($title, $director, $synopsis, $releaseDate, $runtime, $genre, $id){
        $query = $this->db->prepare('UPDATE movies SET title = ?, director = ?, synopsis = ?, release_date = ?, runtime = ?, genre = ? WHERE id_movie = ?');
        $query->execute([$title, $director, $synopsis, $releaseDate, $runtime, $genre, $id]);
    }

    public function deleteMovie($id){
        $query = $this->db->prepare('DELETE FROM movies WHERE id = ?');
        $query->execute([$id]);

    }

}