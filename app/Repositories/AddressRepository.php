<?php

namespace App\Repositories;
use Log;
use App\Address;

class AddressRepository {

    /**
     * Get address
     *
     * @return collection
     */
    public function getAddress()
    {
        $address = Address::orderBy('name','asc')->orderBy('surname','asc')->get();
		
		Log::info("Address".json_encode($address));
        return $address;
    }
	
	public function getAddressWithCriteria($criteria)
	{		
        $add1 = Address::where('name', 'like', '%' . $criteria . '%')->get();
		$add2 = Address::where('number', 'like', '%' . $criteria . '%')->get();
		$add3 = Address::where('surname', 'like', '%' . $criteria . '%')->get();
		$address = $add1->merge($add2)->merge($add3);
		Log::info("Criteria".json_encode($address));
        return json_encode($address);
	}

    /**
     * Store a address.
     *
     * @param  array  $inputs
     * @return boolean
     */
    public function store($inputs)
    {
		Log::info('Store');
		Log::info(json_encode($inputs['content']['name']));
        $address = new Address;
		
		$address->name = $inputs['content']['name'];
		$address->surname = $inputs['content']['surname'];
		$address->number = $inputs['content']['number'];
        $address->save();
    }

    /**
     * Update a address.
     *
     * @param  array  $inputs
     * @param  integer $id
     * @return boolean
     */
    public function update($inputs, $id)
    {
		Log::info('Update');
        $address = $this->getById($id);
		$address->name = $inputs['content']['name'];
		$address->surname = $inputs['content']['surname'];
		$address->number = $inputs['content']['number'];
        return $address->save();
    }

    /**
     * Destroy a address.
     *
     * @param  integer $id
     * @return boolean
     */
    public function destroy($id)
    {
		Log::info('Destroy');
        $address = $this->getById($id);
		return $address->delete();
    }

    /**
     * Get a address by id.
     *
     * @param  integer $id
     * @return boolean
     */
    public function getById($id)
    {
        return Address::findOrFail($id);
    }

}
