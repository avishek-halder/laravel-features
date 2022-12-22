<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friends;


use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Admindetails;
use App\Posts;

use Dompdf\Dompdf;
use Dompdf\Options;

use Asynclib\TaskRunner;
use Razorpay\Api\Api;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class Pizzactrl extends Controller
{

    // public function __construct()
    // {
    // }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        //
        $pizzas = array(
            ["size" => "large", "color" => "yellow"],
            ["size" => "medium", "color" => "red"]
        );
        return view('details', $pizzas[$id]);
    }
    public function data()
    {
        $flights = Friends::all();

        foreach ($flights as $flight) {
            echo $flight->user_login;
        }
        // print_r($flights);
    }

    public function test()
    {
        // $matrix = Arr::crossJoin([1, 2, 3], ['a', 'b', 'c']);
        // // echo $matrix;
        // echo "<pre>";
        // var_dump($matrix);
        // $arr = array(
        //     ["a" => 1],
        //     ["b" => 2],
        //     ["c" => 3],
        //     ["d" => 4],
        // );
        // [$keys, $values] = Arr::divide(['a' => 1]);
        // print_r($keys);
        // foreach ($arr as $b => $a) {
        //     [$keys, $values] = Arr::divide($a);
        //     echo $keys."@@".$values;
        // }
        $array = [100, 200, 300, 110];

        echo $last = Arr::last($array, function ($value, $key) {
            return $value >= 200;
        });
    }

    public function getPdf()
    {
        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
$html = "<h1>HEllo Wordk</h>";

        $dompdf->loadHtml($html);

        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();
        // Output the generated PDF to Browser
        $dompdf->stream();
    }

    public function async()
    {
        $keyId = "rzp_test_7PKmkrSPh7f0Ac";
        $keySecret = "hYTRwMN75OHiG2ehnV07ISQl";

        $api = new Api($keyId, $keySecret);

        //
        // We create an razorpay order using orders api
        // Docs: https://docs.razorpay.com/docs/orders
        //
        $orderData = [
        'receipt'         => 3456,
        'amount'          => 2000 * 100, // 2000 rupees in paise
        'currency'        => 'INR',
        'payment_capture' => 1 // auto capture
        ];

        $razorpayOrder = $api->order->create($orderData);

        $razorpayOrderId = $razorpayOrder['id'];

        $_SESSION['razorpay_order_id'] = $razorpayOrderId;

        $displayAmount = $amount = $orderData['amount'];



        $data = [
        "key"               => $keyId,
        "amount"            => $amount,
        "name"              => "DJ Tiesto",
        "description"       => "Tron Legacy",
        "image"             => "https://s29.postimg.org/r6dj1g85z/daft_punk.jpg",
        "prefill"           => [
        "name"              => "Daft Punk",
        "email"             => "customer@merchant.com",
        "contact"           => "9999999999",
        ],
        "notes"             => [
        "address"           => "Hello World",
        "merchant_order_id" => "12312321",
        ],
        "theme"             => [
        "color"             => "#F37254"
        ],
        "order_id"          => $razorpayOrderId,
        ];


        $json = json_encode($data);

        require("checkout/manual.php");

    }



    public function getdata(){
        // $flights = Admindetails::all();

        // foreach ($flights as $flight) {
        //     echo $flight->user_pass;
        // }
        $comments = Admindetails::find(1)->posts
            ->where('post_status','publish')
            ->where('post_type','post');
        // dd($comments);
          echo $all_categories;  
        // foreach ($comments as $comment) {
        //     echo $comment->ID."<br>";
        // }
    }

    public function logmsg()
    {
        // $message = "kjlsadk hsjkdh jksadh jksad.";
        // Log::emergency($message);
        // Log::alert($message);
        // Log::critical($message);
        // Log::error($message);
        // Log::warning($message);
        // Log::notice($message);
        // Log::info($message);
        // Log::debug($message);
        // abort(404);
        abort(403, 'Unauthorized action.');
    }

    public function sendMail()
    {
        // Mail::to("avisheksh93@gmail.com")->send("new OrderShipped");
        $data = array('name'=>"Virat Gandhi");
        Mail::send(['text'=>'welcome'], $data, function($message) {
        $message->to("avisheksh93@gmail.com", 'Tutorials Point')->subject
        ('Laravel Basic Testing Mail');
        $message->from('xyz@gmail.com','Virat Gandhi');
        });

        echo Mail::raw('Hi, welcome user!', function ($message) {
            $message->to("avishekhalder@elphilltechnology.com")
              ->subject("test");
          });
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
}
