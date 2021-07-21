<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use SoapClient;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'payment';
    private $MerchantID;
    private $Amount;
    private $Description;
    private $CallbackURL;

    public function __construct($amount, $id = null)
    {
        $this->MerchantID = env('MerchantID'); //Required
        $this->Amount = $amount; //Amount will be based on Toman - Required
        $this->Description = env('PaymentDescription'); // Required
        $this->CallbackURL = env('ZARINPAL_CALLbACK_URL') . $id; // Required
    }

    public function doPayment()
    {
        $client = new SoapClient(env('ZARINPALWSDL'), ['encoding' => 'UTF-8']);

        $result = $client->PaymentRequest(
            [
                'MerchantID' => $this->MerchantID,
                'Amount' => $this->Amount,
                'Description' => $this->Description,
                'CallbackURL' => $this->CallbackURL,
            ]
        );
        return $result;
    }

    public function verifyPayment($authority, $status)
    {
        if ($status == 'OK') {

            $client = new SoapClient(env('ZARINPALWSDL'), ['encoding' => 'UTF-8']);

            $result = $client->PaymentVerification(
                [
                    'MerchantID' => $this->MerchantID,
                    'Authority' => $authority,
                    'Amount' => $this->Amount,
                ]
            );
            return $result;
        } else {
            return false;
        }
    }


}
