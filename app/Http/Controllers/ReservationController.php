<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;
use League\Csv\Writer;

use App\Http\Requests;
use App\Http\Requests\CreateReservationRequest;
use App\Http\Controllers\Controller;
use App\Entities\Reservation;



class ReservationController extends Controller
{

    /**
     * @var App\Entities\Reservation
     */
    private $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = new Reservation;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return View::make('pages.reservation');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CreateReservationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReservationRequest $request)
    {
        $reservation = $this->reservation->create($request->all());

        $this->insertInCsv($reservation);

        Flash::success(trans('reservation.reservation_created'));

        //Return Redirect::route('reservation.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Show all reservation entries
     * from data.csv
     *
     * @return \Illuminate\Http\Response
     */
    public function entries()
    {
        dd($this->reservation->all());
        //return View::make();
    }

    private function insertInCsv(Reservation $reservation)
    {
        $file = new \SplFileObject("data.csv","a");
        $writer = Writer::createFromFileObject($file);
        $writer->setDelimiter(";"); //the delimiter will be the tab character
        $writer->setNewline("\r\n"); //use windows line endings for compatibility with some csv libraries
        $writer->setEncodingFrom("utf-8");

        $headers = ["Naam" , "Voornaam", "E-mail", "Bericht","Toegevoegd op"];
        $writer->insertOne($headers);
        $writer->insertAll($reservation->toArray());
        $writer->output('data.csv');
        //dd($writer);
    }
}
