<?php

namespace NeonTsunami\Http\Controllers\Admin;

use NeonTsunami\Series;
use NeonTsunami\Http\Requests\Series\StoreSeriesRequest;
use NeonTsunami\Http\Requests\Series\UpdateSeriesRequest;

class SeriesController extends Controller
{
    /**
     * GET /admin/series
     * Display all of the series.
     *
     * @return Response
     */
    public function index()
    {
        $series = Series::with('posts')
            ->latest()
            ->paginate(25);

        return view('admin.series.index', compact('series'))
            ->withTitle('All series');
    }

    /**
     * GET /admin/series/create
     * Display the form for creating a new series.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.series.create')
            ->withTitle('Create series');
    }

    /**
     * POST /admin/series
     * Store a new series in storage.
     *
     * @param  StoreSeriesRequest  $request
     * @return Response
     */
    public function store(StoreSeriesRequest $request)
    {
        $series = Series::create($request->all());

        return redirect()->route('admin.series.show', $series)
            ->withSuccess('The series was created.');
    }

    /**
     * GET /admin/series/series-slug
     * Display a specified series.
     *
     * @param  Series  $series
     * @return Response
     */
    public function show(Series $series)
    {
        return view('admin.series.show', compact('series'))
            ->withTitle('Show series');
    }

    /**
     * GET /admin/series/series-slug/edit
     * Display the form for editing a series.
     *
     * @param  Series  $series
     * @return Response
     */
    public function edit(Series $series)
    {
        return view('admin.series.edit', compact('series'))
            ->withTitle('Edit series');
    }

    /**
     * PUT /admin/series/series-slug
     * Update a given series in storage.
     *
     * @param  Series  $series
     * @param  UpdateSeriesRequest  $request
     * @return Response
     */
    public function update(Series $series, UpdateSeriesRequest $request)
    {
        $series->update($request->all());

        return redirect()->route('admin.series.show', $series)
            ->withSuccess('The series was updated.');
    }

    /**
     * DELETE /admin/series/series-slug
     * Remove a series from storage.
     *
     * @param  Series  $series
     * @return Response
     */
    public function destroy(Series $series)
    {
        $series->delete();

        return redirect()->route('admin.series.index')
            ->withSuccess('The series was deleted.');
    }
}
