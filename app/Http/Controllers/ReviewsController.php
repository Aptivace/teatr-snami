<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use App\Models\Spectacle;
use Illuminate\Http\Request;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Reviews::query()->where(['status' => 'approved'])->get();
        $repertuar = Spectacle::all();
        return view('reviews', compact('reviews', 'repertuar'));
    }

    public function admin(Request $request)
    {

        $reviews = Reviews::query();
        if ($request->has('status')) {
            $reviews->where(['status' => $request->status]);
        } else {
            $reviews->where(['status' => 'pending']);
        }

        $reviews = $reviews->get();


        return view('admin-reviews', compact('reviews'));
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
        $data = $request->validate([
            'username' => 'required|string|max:255',
            'text' => 'required|string',
            'spectacle_id' => 'required|exists:spectacles,id',
        ]);

        Reviews::create([
            'username' => $data['username'],
            'text' => $data['text'],
            'status' => 'pending',
            'spectacle_id' => $data['spectacle_id'],
        ]);

        return back()->with('success', 'Отзыв успешно добавлен!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Reviews $reviews)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reviews $reviews)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reviews $reviews)
    {

        $data = $request->validate([
            'status' => 'required|string|in:pending,approved,rejected',

        ]);
        $reviews->update(['status' => $data['status']]);
        return redirect('/admin/reviews')->with('success', 'Статус отзыва обновлен!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reviews $reviews)
    {
        //
    }
}
