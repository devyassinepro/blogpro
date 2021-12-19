<?php

namespace App\Http\Controllers;

use App\DataTables\FreearticlesDataTable;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\CreateFreearticlesRequest;
use App\Http\Requests\UpdateFreearticlesRequest;
use App\Models\Freearticles;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;


class FreearticlesController extends AppBaseController
{
    /**
     * Display a listing of the Freearticles.
     *
     * @param FreearticlesDataTable $freearticlesDataTable
     * @return Response
     */
    public function index(FreearticlesDataTable $freearticlesDataTable)
    {
        return $freearticlesDataTable->render('freearticles.index');
    }


    public function home()
    {
        $apps = Freearticles::latest();
        return view('index' , compact('apps'));
   // return view('index');
    }

    /**
     * Show the form for creating a new Freearticles.
     *
     * @return Response
     */
    public function create()
    {
        return view('freearticles.create');
    }

    /**
     * Store a newly created Freearticles in storage.
     *
     * @param CreateFreearticlesRequest $request
     *
     * @return Response
     */
    public function store(CreateFreearticlesRequest $request)
    {
        $input = $request->all();

        /** @var Freearticles $freearticles */
        $freearticles = Freearticles::create($input);

        Flash::success('Freearticles saved successfully.');

        return redirect(route('freearticles.index'));
    }

    /**
     * Display the specified Freearticles.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Freearticles $freearticles */
        $freearticles = Freearticles::find($id);

        if (empty($freearticles)) {
            Flash::error('Freearticles not found');

            return redirect(route('freearticles.index'));
        }

        return view('freearticles.show')->with('freearticles', $freearticles);
    }

    /**
     * Show the form for editing the specified Freearticles.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        /** @var Freearticles $freearticles */
        $freearticles = Freearticles::find($id);

        if (empty($freearticles)) {
            Flash::error('Freearticles not found');

            return redirect(route('freearticles.index'));
        }

        return view('freearticles.edit')->with('freearticles', $freearticles);
    }

    /**
     * Update the specified Freearticles in storage.
     *
     * @param  int              $id
     * @param UpdateFreearticlesRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateFreearticlesRequest $request)
    {
        /** @var Freearticles $freearticles */
        $freearticles = Freearticles::find($id);

        if (empty($freearticles)) {
            Flash::error('Freearticles not found');

            return redirect(route('freearticles.index'));
        }

        $freearticles->fill($request->all());
        $freearticles->save();

        Flash::success('Freearticles updated successfully.');

        return redirect(route('freearticles.index'));
    }

    /**
     * Remove the specified Freearticles from storage.
     *
     * @param  int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Freearticles $freearticles */
        $freearticles = Freearticles::find($id);

        if (empty($freearticles)) {
            Flash::error('Freearticles not found');

            return redirect(route('freearticles.index'));
        }

        $freearticles->delete();

        Flash::success('Freearticles deleted successfully.');

        return redirect(route('freearticles.index'));
    }
}
