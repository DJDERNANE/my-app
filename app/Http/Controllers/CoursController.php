<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cours = Cours::with('media')->get();
        $coursData = $cours->map(function ($course) {
            return [
                'id' => $course->id,
                'title' => $course->title,
                'description' => $course->description,
                'icon' => $course->getFirstMediaUrl('icon'), // Retrieve the URL of the first image in the 'icon' collection
            ];
        });
        return response()->json(['success' => true, 'data' => $coursData]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cours $cours)
    {
        $cours = Cours::where('id', $cours->id)->with('media', 'coursSections')->get();
        $coursData = $cours->map(function ($course) {
            return [
                'id' => $course->id,
                'title' => $course->main_page_title,
                'price' => $course->price,
                'description' => $course->main_page_description,
                'sections' => $course->coursSections,
                'bg' => $course->getFirstMediaUrl('bg'), // Retrieve the URL of the first image in the 'icon' collection
                'discount' => $course->discount,
                'new_price' => $course->new_price
            ];
        });
        return response()->json(['success' => true, 'date' => $coursData]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cours $cours)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cours $cours)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cours $cours)
    {
        //
    }
}
