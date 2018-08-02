<?php

namespace App\Http\Controllers\Backend;

use App\Models\CreditCard;
use App\Http\Controllers\Controller;
use App\Services\CreditCardServices;
use App\Http\Requests\CreditCardStore;

class CreditCardController extends Controller
{

    protected $creditCardServices;

    public function __construct(CreditCardServices $creditCardServices)
    {
        $this->creditCardServices = $creditCardServices;
    }

    /**
     * @param string $user
     */
    public function getOneCredit($user)
    {
        $this->creditCardServices->getOneCredit($user);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteAll()
    {
        $this->creditCardServices->deleteAll();

        return redirect()->route('creditCard.index')->with(['success_message' => 'Delete all successful']);
    }

    /**
     * Create Credit Card
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('backend.creditCard.create');
    }


    /**
     * Store credit cards
     * @param CreditCardStore $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CreditCardStore $request)
    {
        $response = $this->creditCardServices->createCreditCards($request->all());

        return redirect()->route('creditCard.index')->with($response);
    }

    /**
     * List Credit Cards
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $creditCards = $this->creditCardServices->getCreditCards();

        return view('backend.creditCard.index', [
            'data' => $creditCards
        ]);
    }

    /**
     * Delete credit card.
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy($id)
    {
        $this->creditCardServices->deleteCreditCard($id);

        return redirect()->route('creditCard.index')->with(['success_message' => 'Delete successful']);
    }
}
