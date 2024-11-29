<?php
require_once './api/models/review.api.model.php';
require_once './api/view/api.view.php';

class ReviewApiController {
    private $model;
    private $movieModel;
    private $view;

    public function __construct() {
        $this->model = new ReviewModel();
        $this->movieModel = new MovieModel();
        $this->view = new ApiView();
    }

    public function getReviews($req){
        $orderBy = false;
        $direct = 'ASC';
        if(isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;
            if (isset($req->query->direct))
                $direct = $req->query->direct;

        $id_movie = null;
        if(isset($req->query->id_review)) {
            $id_movie = $req->query->id_review;
        }
        
        $reviews=$this->model->getReviews($id_movie, $orderBy, $direct);

        if(!$reviews){ 
            return $this->view->response('No reviews found', 404);
        }

        return $this->view->response($reviews, 200);
        
    }

    public function getReview($req){
        $id = $req->params->id;
        $review = $this->model->getReview($id);
        if(!$review){
            return $this->view->response("No review found under id=$id", 404);
        }
        return $this->view->response($review, 200);
    }

    public function addReview($req){

        if (empty($req->body->id_movie)  || empty($req->body->body) || empty($req->body->rating)) {
            return $this->view->response('Please complete all fields', 400);
        }

        $movie=$this->movieModel->getMovie($req->body->id_movie);
        if(!$movie){
            return $this->view->response('Reviewed movie is not on DB', 400);
        }

        $id=$this->model->addReview($req->body->id_movie, $req->body->body, $req->body->rating);
        return $this->view->response("Added review under id $id", 201);
    }

    public function editReview($req){

        $review=$this->model->getReview($req->params->id);
        if(!$review){
            return $this->view->response('Review does not exist', 404);
        }

        if (empty($req->body->id_movie)  || empty($req->body->body) || empty($req->body->rating)) {
            return $this->view->response('Please complete all fields', 400);
        }

        $movie=$this->movieModel->getMovie($req->body->id_movie);
        if(!$movie){
            return $this->view->response('Reviewed movie is not on DB', 400);
        }

        $this->model->editReview($req->body->id_movie, $req->body->body, $req->body->rating, $req->params->id);

        $review = $this->model->getReview($req->params->id);

        return $this->view->response($review, 200);
    }

    public function deleteReview($req){
        $review=$this->model->getReview($req->params->id);
        if(!$review){
            return $this->view->response('Review does not exist', 404);
        }
        $this->model->deleteReview($req->params->id);
    }
}