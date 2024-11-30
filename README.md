# TPE_Entrega3
## API RESTful : Movies/Reviews
### Description
This project is an API RESTful web service that allows access to the respective Movie Reviews database to make use of its data, allowing to get movies form it and "CRUD" reviews.

## Endpoints

* {apache_server_name}/api/movies/ (GET)
* {apache_server_name}/api/movies/:id (GET)

* {apache_server_name}/api/reviews/ (GET)
* {apache_server_name}/api/reviews/:id (GET)
* {apache_server_name}/api/reviews/ (POST)
* {apache_server_name}/api/reviews/:id (PUT)
* {apache_server_name}/api/reviews/:id (DELETE)

## Movies
### GET: /movies
Returns a list of movies.
* **e.g GET  https://localhost/WEB2TPE3/api/movies/** : returns all movies on database

Through query params it can be ordered by any column (id, title, director, synopsis, releaseDate, runtime or genre).
 * **e.g GET  https://localhost/WEB2TPE3/api/movies?orderBy=runtime** : returns all movies on database ordered (query param _orderBy_) by their runtime (ascending, default)
 * **e.g GET  https://localhost/WEB2TPE3/api/movies?orderBy=title&direct=DESC** : returns all movies on database ordered by their title (decscending, query param _direct_)

It can be filtered by GENRE through query params.
* **e.g GET  https://localhost/WEB2TPE3/api/movies?genre=Sci-Fi** : returns all movies on database which genre column corresponds to "Sci-Fi" (query param _genre_)

### GET: /movies/:id
Returns a movie with the specified id
* **e.g GET  https://localhost/WEB2TPE3/api/movies/1** : returns a movie which id is 1 ("The Lord of the Rings: The Fellowship of the Ring")

## Reviews
### GET: /reviews
Returns a list of reviews.
* **e.g GET  https://localhost/WEB2TPE3/api/reviews/** : returns all reviews on database

Through query params it can be ordered by any column (id, id_movie, body or rating).
 * **e.g GET  https://localhost/WEB2TPE3/api/reviews?orderBy=id_movie** : returns all reviews on database ordered (query param _orderBy_) by their runtime (ascending, default)
 * **e.g GET  https://localhost/WEB2TPE3/api/reviews?orderBy=rating&direct=DESC** : returns all reviews on database ordered by their rating (decscending, query param _direct_)

It can be filtered by ID_MOVIE through query params.
* **e.g GET  https://localhost/WEB2TPE3/api/reviews?id_movie=1** : returns all reviews on database which id_movie column corresponds to "1" (query param _id_movie_)

### GET: /reviews/:id
Returns a review with the specified id
* **e.g GET  https://localhost/WEB2TPE3/api/reviews/1** : returns a movie which id is 1

### POST: /reviews/
Creates a new review on database. Values are send through body.
* **e.g POST  https://localhost/WEB2TPE3/api/reviews/** : creates a new review with following data (send through HTTPRequest body) 
```json
 {
    "id_movie": "2",
    "body": "asdfasdf",
    "rating": 5
}

```
(_All fields are required_)

### PUT: /reviews/:id
Updates values (send through body) on a review on database.
* **e.g PUT  https://localhost/WEB2TPE3/api/reviews/1** : edits review with id 1 with following data (send through HTTPRequest body)
```json
 {
    "id_movie": "2",
    "body": "asdfasdf",
    "rating": 5
}

```
(_All fields are required_)

### DELETE: /reviews/:id
Deletes a review from database.
* **e.g DELETE  https://localhost/WEB2TPE3/api/reviews/1** : deletes review with id 1