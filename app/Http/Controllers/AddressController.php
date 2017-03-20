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
