<?php

/*

🧩 Problem: Movie Library Iterator
You are tasked with creating a Movie Library system, where you have a collection of movies, and you need to provide a way to iterate through the list of movies.

Requirements:
Create a Movie class that has properties like title, director, and release year.

Create a MovieLibrary class to hold a collection of Movie objects. The collection should allow for movies to be added to it.

Implement an Iterator that allows you to:

Iterate through the movie collection.

Get the next movie.

Check if there are more movies in the collection.

The client code should be able to iterate through the movies in the library without directly interacting with the collection structure.

Steps to Follow:
Movie class: It should have properties like title, director, and year. Add a constructor to initialize these values.

Iterator Interface: Define methods like hasNext() and next().

MovieIterator: This will implement the iterator interface and handle traversing the movie collection.

MovieLibrary: This should store movies and provide a method to create an iterator for traversing the collection.

*/

class Movie{
    private string $title;
    private string $director;
    private string $year;

    public function __construct(string $title, string $director, string $year){
        $this->title = $title;
        $this->director = $director;
        $this->year = $year;
    }
}

interface Iterator{
    public function hasNext(): bool;
    public function next(): Movie;
}

class MovieIterator implements Iterator{
    private array $movies;
    private int $index = 0;

    public function __construct(MovieLibrary $movies){
        $this->movies = $movies;
    }

    public function hasNext(): bool{
        return $this->index < count($this->movies);
    }

    public function next(): Movie{
        if($this->hasNext()){
            return $this->books[$this->index++];
        }

        return null;
    }
}

interface Aggregate{
    public function createIterator(): Iterator;
}

class MovieLibrary implements Aggregate{
    private array $movies = [];

    public function addMovie(Movie $movie): void{
        $this->movies[] = $movie;
    }
    
    public function createIterator(): Iterator{
        return new MovieIterator($this->movies);
    }
}

$inception = new Movie("Inception", "Christopher Nolan", "2011");
$prestige = new Movie("The Prestige", "Christopher Nolan", "2006");

$library = new MovieLibrary();
$library->addMovie($inception);
$library->addMovie($prestige);

$iterator = $library->createIterator();

while($iterator->hasNext()){
    $item = $iterator->next();
    echo "Title: " . $item->title . "\nDirector: " . $item->director . "\nYear:" . $item->year;
}