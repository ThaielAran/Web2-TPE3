<?php
require_once './api/models/movie.api.model.php';
require_once './api/view/api.view.php';

class MovieApiController {
    private $model;
    private $view;

    public function __construct() {
        $this->model = new MovieModel();
        $this->view = new ApiView();
    }

    public function getMovies($req, $res){
        
        $orderBy = false;
        $direct = 'ASC';
        if(isset($req->query->orderBy))
            $orderBy = $req->query->orderBy;
            if (isset($req->query->direct))
                $direct = $req->query->direct;

        $genre = null;
        if(isset($req->query->genre)) {
            $genre = $req->query->genre;
        }
        
        $movies=$this->model->getMovies($genre, $orderBy, $direct);

        if(!$movies){ 
            return $this->view->response('No movies found', 404);
        }

        return $this->view->response($movies, 200);
        
    }

    public function getMovie($req, $res){
        $id = $req->params->id;
        $movie = $this->model->getMovie($id);
        if(!$movie){
            return $this->view->response("No movie found under id=$id", 404);
        }
        return $this->view->response($movie, 200);
    }

}