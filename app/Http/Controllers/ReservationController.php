<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Redirect;
use Laracasts\Flash\Flash;
use League\Csv\Writer;
use Config, File;

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

        return Redirect::route('reservation.index');
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

    /**
     * Create new csv if needed
     * and add request data to csv
     *
     * @param  Reservation $reservation
     * @return void
     */
    private function insertInCsv(Reservation $reservation)
    {
        $writer = Writer::createFromPath(Config::get('reservation.csv_path'), 'a');
        $writer->setDelimiter(";");
        $writer->setEncodingFrom("utf-8");

        if ( ! $this->checkIfCsvExists()) {
            // Only add header to first line
            $headers = ["Naam" , "Voornaam", "E-mail", "Bericht","Toegevoegd op"];
            $writer->insertOne($headers);
        }

        $writer->insertOne(array(
            $reservation->first_name,
            $reservation->last_name,
            $reservation->email,
            $reservation->message,
            $reservation->created_at->format('d/m/Y h:i')
        ));
    }

    /**
     * Check if file exists
     * if not create new data.csv file
     *
     * @return boolean
     */
    private function checkIfCsvExists()
    {
        $filePath = Config::get('reservation.csv_path');

        if( ! File::exists($filePath)) {
            $file = new \SplFileObject($filePath,"a");
            return false;
        }

        return true;
    }
}
