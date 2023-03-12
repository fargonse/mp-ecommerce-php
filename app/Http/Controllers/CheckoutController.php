<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class CheckoutController extends Controller
{
    public function sendCheckout(Request $request) {
        $this->setupSDK();

        $preference = $this->buildPreference($request);

        return redirect($preference->init_point);
    }

    /**
     * @param Request $request
     * @return \MercadoPago\Item
     */
    private function getItems(Request $request): array
    {
        $item = new \MercadoPago\Item();
        $item->title = $request->title;
        $item->quantity = 1;
        $item->unit_price = $request->price;
        $item->picture_url = $request->img;

        return [$item];
    }

    /**
     * @return void
     */
    private function getPayer(): \MercadoPago\Payer
    {
        $payer = new \MercadoPago\Payer();
        $payer->name = 'Lalo';
        $payer->surname = 'Landa';
        $payer->email = 'test_user_36961754@testuser.com';

        $payer->phone = [
            "area_code" => "",
            "number" => "1132224455",
        ];

        $payer->address = [
            "zip_code" => "1603",
            "street_name" => "calle falsa",
            "street_number" => 123,
        ];

        return $payer;
    }

    /**
     * @return void
     */
    private function setupSDK(): void
    {
        \MercadoPago\SDK::setAccessToken('APP_USR-8709825494258279-092911-227a84b3ec8d8b30fff364888abeb67a-1160706432');
        \MercadoPago\SDK::setPlatformId("fargonse-mp-ecommerce-php");
        \MercadoPago\SDK::setIntegratorId("dev_24c65fb163bf11ea96500242ac130004");
    }

    /**
     * @param Request $request
     * @return \MercadoPago\Preference
     * @throws \Exception
     */
    private function buildPreference(Request $request): \MercadoPago\Preference
    {
        $preference = new \MercadoPago\Preference();
        $preference->items = $this->getItems($request);
        $preference->payer = $this->getPayer();
        $preference->back_urls = [
            'success' => URL::to('back/success'),
            'pending' => URL::to('back/pending'),
            'failure' => URL::to('back/failure'),
        ];
        $preference->auto_return = "all";
        $preference->notification_url = 'https://fargonse-mp-ecommerce-php.herokuapp.com/api/webhook';
        $preference->save();
        return $preference;
    }
}
