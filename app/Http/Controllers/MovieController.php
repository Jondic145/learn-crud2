<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::all();

        return view('movies.index', compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('movies.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'title' => 'required|max:225',
            'genre' => 'required|max:100',
            'description' => '',
            'year' => 'required|integer|min:1900|max:2099',
            'rating' => 'required|numeric|min:0|max:5'
        ];

        $validated = $request->validate($rules);

        // ];

        Movie::create($validated);

        $request->session()->flash('success', "Successfully adding {$validated['title']}!");
        return redirect()->route('movies.index');
        //

        // $newMovie = new Movie();
        // $newMovie->title = $validated['title'];
        // $newMovie->genre = $validated['genre'];
        // $newMovie->description = $validated['description'];
        // $newMovie->year = $validated['year'];
        // $newMovie->rating = $validated['rating'];
        // $newMovie->save();


        return "Film Baru sudah di tambahkan";
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        return view(
            'movies.edit', compact('movie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        $rules = [
            'title' => 'required|max:225',
            'genre' => 'required|max:100',
            'description' => '',
            'year' => 'required|integer|min:1900|max:2099',
            'rating' => 'required|numeric|min:0|max:5'
        ];

        $validated = $request->validate($rules);


        $movie->update($validated);
        $request->session()->flash('success', "Berhasil memperbarui data film {$validated['title']}.");
        return redirect()->route('movies.index')->with('success', "Data Film {$movie['title']} Sudah Dihapus. ");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('movies.index')->with('success', "Data Film {$movie['title']} Sudah Dihapus. ");
    }
}
