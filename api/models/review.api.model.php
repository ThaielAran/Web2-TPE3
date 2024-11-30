<?php

class ReviewModel extends ApiModel{

    public function getReviews($id_movie=null, $orderBy=null, $direct='ASC'){
        $sql = 'SELECT * FROM reviews';

        if ($id_movie){
            $sql .= ' WHERE id_movie='.$id_movie;
        }

        if ($orderBy) {
            switch ($orderBy) {
                case 'id_movie':
                    $sql .= ' ORDER BY id_movie';
                    break;
                case 'rating':
                    $sql .= ' ORDER BY rating';
                    break;
                case 'id_review':
                    $sql .= ' ORDER BY id_review';
                    break;
                case 'body':
                    $sql .= ' ORDER BY body';
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

        $reviews = $query->fetchAll(PDO::FETCH_OBJ);

        return $reviews;
    }

    public function getReview($id){
        $query = $this->db->prepare('SELECT * FROM reviews WHERE id_review=?');
        $query->execute([$id]);
    
        $review = $query->fetch(PDO::FETCH_OBJ);
        return $review;
    }

    public function addReview($id_movie, $body, $rating){
        $query = $this->db->prepare('INSERT INTO reviews (id_movie, body, rating) VALUES (?, ?, ?)');
        $query->execute([$id_movie, $body, $rating]);
        $id = $this->db->lastInsertId();
        return $id;
    }

    public function editReview($id_movie, $body, $rating, $id){
        $query = $this->db->prepare('UPDATE reviews SET id_movie=?, body=?, rating=? WHERE id_review=?');
        $query->execute([$id_movie, $body, $rating, $id]);
    }

    public function deleteReview($id){
        $query = $this->db->prepare('DELETE FROM reviews WHERE id_review=?');
        $query->execute([$id]);
    }

}