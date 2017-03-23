<?php

namespace App\Http\Controllers;

use Log;
use Illuminate\Http\Exception\HttpResponseException;
use Illuminate\Http\Request;
use App\Repositories\AddressRepository;
//use Auth;

class AddressController extends Controller {

    /**
     * Repository instance.
     *
     */
    protected $AddressRepository;

    /**
     * Validation rules.
     *
     */
    protected $rules = [
        'content' => 'required|max:2000',
    ];

    /**
     * Create a new AddressController controller instance.
     *
     * @param  App\Repositories\AddressRepository $AddressRepository
     * @return void
     */
    public function __construct(AddressRepository $AddressRepository)
    {
        $this->AddressRepository = $AddressRepository;

        //$this->middleware('auth', ['only' => ['store', 'update', 'destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return $this->AddressRepository->getAddress();
    }
	
	public function search(Request $request)
    {
		
		$criteria = $request->input('query');Log::info($criteria);
		return $this->AddressRepository->getAddressWithCriteria($criteria);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
		Log::info('Store');
        $this->validate($request, $this->rules);

        $this->AddressRepository->store($request->all());

        return $this->AddressRepository->getAddress();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
		Log::info('Update');
		
        $this->validate($request, $this->rules);

        if ($this->AddressRepository->update($request->all(), $id)) 
        {
            return ['result' => 'success'];
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if ($this->AddressRepository->destroy($id)) 
        {
            return ['result' => 'success'];
        }
    }

}

	/*
	Escape per evitare attacchi tramitefunzioni quali: htmlspecialchars(), htmlentities(), strip_tags()
	htmlspecialchars()
	echo htmlspecialchars("<a href='test'>Test</a>", ENT_QUOTES);
	# L'output sarà: 
	&lt;a href=&#039;test&#039;&gt;Test&lt;/a&gt; dato che converte i caratteri "particolari", in codice html.
	htmlentities
	echo htmlentities("I'm <b>bold</b>");
	# L'Output sarà di conseguenza: 
	I'm &lt;b&gt;bold&lt;/b&gt;
	strip_tags
	$text='<p>Testo interno al paragrafo.</p><!-- commento --> <a href="#ancora">Altro te-sto</a>';
	echo strip_tags($text);
	# Il particolare output di questa funzione, sarà: 
	Testo interno al paragrafo. Altro testo
	# E' possibile non rimuovere alcuni tag utilizzando il secondo parametro opzionale:
	echo strip_tags($text,'<p>');
	# Il particolare output di questa funzione, sarà: 
	<p>Testo interno al paragrafo.</p> Altro testo
	*/
