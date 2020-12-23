<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use \ECPay_PaymentMethod as ECPayMethod;

class ProductController extends Controller
{
    //
    public function index()
    {
        $data = Product::all();
        return view('product', ['products' => $data]);
    }

    public function detail($id)
    {
        $data = Product::find($id);
        return view('detail', ['detail' => $data]);
    }

    public function search(Request $req)
    {
        //$data = Product::find($id);
        //return view('detail', ['detail' => $data]);
        $data = Product::where('name', 'like', '%' . $req->input('query') . '%')->get();
        return view('search', ['results' => $data]);
    }

    public function addToCart(Request $req)
    {
        if ($req->session()->has('user')) {
            $cart = new cart;

            // get ID from session
            $cart->user_id = $req->session()->get('user')['id'];

            // get product_id from form input
            $cart->product_id = $req->product_id;

            $cart->save();

            return redirect()->back();

        } else {
            return redirect('/login');
        }
    }

    public static function cartItem()
    {
        $userId = Session::get('user')['id'];
        return cart::where('user_id', $userId)->count();
    }

    public function cartList()
    {
        $userId = Session::get('user')['id'];
        $products = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->select('products.*', 'cart.id as cart_id')
            ->get();

        return view('carlist', ['products' => $products]);
    }

    public function removeCart($id)
    {
        cart::destroy('id', $id);
        return redirect('/cartlist');
    }

    public function orderNow()
    {
        $userId = Session::get('user')['id'];
        $userName = Session::get('user')['name'];
        $userEmail = Session::get('user')['email'];
        $total = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->sum('products.price');

        return view('ordernow', ['total' => $total, 'userName' => $userName, 'userEmail' => $userEmail]);
    }

    public function orderPlace(Request $req)
    {
        $userId = Session::get('user')['id'];
        // 取total price
        $total = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->where('cart.user_id', $userId)
            ->sum('products.price');

        // ----- ECPay API ------
        try {

            $obj = new \ECPay_AllInOne();

            //服務參數
            $obj->ServiceURL = "https://payment-stage.ecpay.com.tw/Cashier/AioCheckOut/V5"; //服務位置
            $obj->HashKey = '5294y06JbISpM5x9'; //測試用Hashkey，請自行帶入ECPay提供的HashKey
            $obj->HashIV = 'v77hoKGq4kWxNNIS'; //測試用HashIV，請自行帶入ECPay提供的HashIV
            $obj->MerchantID = '2000132'; //測試用MerchantID，請自行帶入ECPay提供的MerchantID
            $obj->EncryptType = '1'; //CheckMacValue加密類型，請固定填入1，使用SHA256加密

            //基本參數(請依系統規劃自行調整)
            $MerchantTradeNo = "Test" . time();
            $obj->Send['ReturnURL'] = "http://57c67c4dfa0b.ngrok.io/callback"; //付款完成通知回傳的網址
            $obj->Send['PeriodReturnURL'] = "http://57c67c4dfa0b.ngrok.io/callback"; //付款完成通知回傳的網址
            $obj->Send['ClientBackURL'] = "http://57c67c4dfa0b.ngrok.io/success"; //付款完成通知回傳的網址
            $obj->Send['MerchantTradeNo'] = $MerchantTradeNo; //訂單編號
            $obj->Send['MerchantTradeDate'] = date('Y/m/d H:i:s'); //交易時間
            $obj->Send['TotalAmount'] = $total; //交易金額
            $obj->Send['TradeDesc'] = "good to drink"; //交易描述
            $obj->Send['ChoosePayment'] = ECPayMethod::Credit; //付款方式:Credit
            $obj->Send['IgnorePayment'] = ECPayMethod::GooglePay; //不使用付款方式:GooglePay

            // 從購物車裡拿出來
            $products = DB::table('cart')
                ->join('products', 'cart.product_id', '=', 'products.id')
                ->where('cart.user_id', $userId)
                ->select('products.*', 'cart.id as cart_id')
                ->get();

            // 訂單的商品資料 (給ECPay 訂單頁面)
            foreach ($products as $item) {
                array_push($obj->Send['Items'], array('Name' => $item->name, 'Price' => $item->price,
                    'Currency' => "元", 'Quantity' => (int) "1", 'URL' => "dedwed"));
            }
            // 輸出成訂單資料，並刪除購物車
            $allCart = cart::where('user_id', $userId)->get();
            foreach ($allCart as $cart) {
                $order = new Order;
                $order->user_id = $cart['user_id'];
                $order->product_id = $cart['product_id'];
                $order->payment_method = $req->payment;
                $order->payment_status = 'pending';
                $order->status = 'pending';
                $order->address = $req->address;

                $order->save();
                cart::where('user_id', $userId)->delete();

            }

            //Credit信用卡分期付款延伸參數(可依系統需求選擇是否代入)
            //以下參數不可以跟信用卡定期定額參數一起設定
            $obj->SendExtend['CreditInstallment'] = ''; //分期期數，預設0(不分期)，信用卡分期可用參數為:3,6,12,18,24
            $obj->SendExtend['InstallmentAmount'] = 0; //使用刷卡分期的付款金額，預設0(不分期)
            $obj->SendExtend['Redeem'] = false; //是否使用紅利折抵，預設false
            $obj->SendExtend['UnionPay'] = false; //是否為聯營卡，預設false;

            //Credit信用卡定期定額付款延伸參數(可依系統需求選擇是否代入)
            //以下參數不可以跟信用卡分期付款參數一起設定
            // $obj->SendExtend['PeriodAmount'] = '' ;    //每次授權金額，預設空字串
            // $obj->SendExtend['PeriodType']   = '' ;    //週期種類，預設空字串
            // $obj->SendExtend['Frequency']    = '' ;    //執行頻率，預設空字串
            // $obj->SendExtend['ExecTimes']    = '' ;    //執行次數，預設空字串

            # 電子發票參數
            /*
            $obj->Send['InvoiceMark'] = ECPay_InvoiceState::Yes;
            $obj->SendExtend['RelateNumber'] = "Test".time();
            $obj->SendExtend['CustomerEmail'] = 'test@ecpay.com.tw';
            $obj->SendExtend['CustomerPhone'] = '0911222333';
            $obj->SendExtend['TaxType'] = ECPay_TaxType::Dutiable;
            $obj->SendExtend['CustomerAddr'] = '台北市南港區三重路19-2號5樓D棟';
            $obj->SendExtend['InvoiceItems'] = array();
            // 將商品加入電子發票商品列表陣列
            foreach ($obj->Send['Items'] as $info)
            {
            array_push($obj->SendExtend['InvoiceItems'],array('Name' => $info['Name'],'Count' =>
            $info['Quantity'],'Word' => '個','Price' => $info['Price'],'TaxType' => ECPay_TaxType::Dutiable));
            }
            $obj->SendExtend['InvoiceRemark'] = '測試發票備註';
            $obj->SendExtend['DelayDay'] = '0';
            $obj->SendExtend['InvType'] = ECPay_InvType::General;
             */
            //($obj);
            //產生訂單(auto submit至ECPay)
            $obj->CheckOut();

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function myOrders()
    {
        $userId = Session::get('user')['id'];

        $orders = DB::table('orders')
            ->join('products', 'orders.product_id', '=', 'products.id')
            ->where('orders.user_id', $userId)
            ->select('orders.*', 'products.gallery as gallery', 'products.name as name')
            ->get();

        return view('myorders', ['orders' => $orders]);
    }

    public function callback()
    {
        dd(request());
        //$order = Orders::where('uuid', '=', request('MerchantTradeNo'))->firstOrFail();
        //$order->paid = !$order->paid;
        //$order->save();
    }

    public function redirectFromECpay()
    {
        session()->flash('success', 'Order success!');
        return redirect('/');
    }

    public function addToCart2(Request $req)
    {
        if ($req->session()->has('user')) {
            $cart = new cart;

            // get ID from session
            $cart->user_id = $req->session()->get('user')['id'];

            // get product_id from form input
            $cart->product_id = $req->product_id;

            $cart->save();

            return redirect('/cartlist');

        } else {
            return redirect('/login');
        }
    }
}
