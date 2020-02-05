<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Models\Banner;
use App\Models\Product;
use App\Models\Category;
use App\Cart;
use Session;
use App\Models\Orders;
use App\Models\OrdersDetail;
use DB;
use App\User;
use App\Models\Customer;
class HomeController extends Controller
{
    public function getHome()
    {   
        $pr=Product::count();
        $cat=Category::count();
        $user=User::count();
        $cu=Customer::count();
        $or=Orders::where('status',1)->get();
        if(request()->date_from&&request()->date_to){
            $or=Orders::where('status',1)->whereBetween('created_at',[request()->date_from,request()->date_to])->get();
        }
        return view('backend.home',compact('or','pr','cat','user','cu'));
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
    public function index(){
    	$product=Product::orderby('id','DESC')->limit(10)->get();
        $produc=Product::orderby('id','ASC')->limit(6)->get();
    	return view('frontend.layout.index',compact('product','produc'));
        
        // return view('frontend.layout.master');
    }
    public function list($id,$slug){
        $produ=Product::where(['id' => $id,'slug'=>$slug])->first();
        $ca=Category::where(['id' => $id,'slug'=> $slug])->first();
        if($ca){
            $products=Product::where(['category_id' => $ca->id])->get();
            return view('frontend.product.category',compact('ca'));
        }
        else{
            return view('frontend.product.product',compact('produ'));
        }
    }
    public function all(){
        $prod=DB::table('product')->join('category','product.category_id','=','category.id')->select('product.*','category.id as mid')->where('category_id','34')->get();
        $pro=DB::table('product')->join('category','product.category_id','=','category.id')->select('product.*','category.id as mid')->where('category_id','35')->get();
        $hat=DB::table('product')->join('category','product.category_id','=','category.id')->select('product.*','category.id as mid')->where('category_id','36')->get();
        $watch=DB::table('product')->join('category','product.category_id','=','category.id')->select('product.*','category.id as mid')->where('category_id','37')->get();
        $shoes=DB::table('product')->join('category','product.category_id','=','category.id')->select('product.*','category.id as mid')->where('category_id','38')->get();
        $bag=DB::table('product')->join('category','product.category_id','=','category.id')->select('product.*','category.id as mid')->where('category_id','39')->get();
        $acesstory=$bag=DB::table('product')->join('category','product.category_id','=','category.id')->select('product.*','category.id as mid')->where('category_id','40')->get();
        return view('frontend.product.productall',compact('prod','pro','hat','watch','shoes','bag','acesstory'));
        return view('frontend.product.product',compact('watch'));
    }
    public function getCheckout(){
        return view('frontend.checkout');
    }
    public function postCheckout(Request $request){
        $cart=Session::get('cart');
        $order=new Orders();
        $order->name=$request->name;
        $order->email=$request->email;
        $order->phone=$request->phone;
        $order->address=$request->address;
        $order->save();
        foreach ($cart as $key => $value) {
            $order_detail=new OrdersDetail();
            $order_detail->product_id=$key;
            $order_detail->orders_id=$order->id;
            $order_detail->quantity=$value['quantity'];
            $order_detail->price=$value['price'];
            $order_detail->save();
        }
        Session::forget('cart');
        return view('frontend.checkout-success')->with('thongbao','Đặt hàng thành công');
    }
    public function getSerch(){
        $products =  Product::paginate(8); 
        if (request()->q) {
            $products =  Product::where('name','LIKE','%'.request()->q.'%')->paginate(8); 
        }
        return view('frontend.product.search',compact('products'));
    }
    public function getAccount(){
        return view('frontend.create-account');
    }
    public function postAccount(Request $request){
        $this->validate($request,[
            'email' => 'unique:customer,email',
            'use_name' =>'min:6|unique:customer,use_name',
            'confirm_password' => 'same:password',
            'password' =>'min:6',
        ],[
            'email.unique' => 'Email này đã được sử dụng!',
            'use_name.unique' => 'Tài khoản này đã được sử dụng!',
            'use_name.min' => 'Tên tài khoản tối thiểu 6 kí tự!',
            'password.min' => 'Mật khẩu phải tối thiểu 6 ký tự!',
            'confirm_password.same' => 'Bạn phải nhập trùng mật khẩu!',
        ]);
        $password=bcrypt($request->password);
        $request->merge(['password'=>$password]);
        Customer::create($request->all());
        return view('frontend.success');
    }
    public function getLogin1(){
        return view('frontend.login-customer');
    }
    public function postLogin1(Request $request){
        $this->validate($request,[
            'use_name' => 'alpha_num',
            'password' => 'min:6',
        ],[
            'use_name.alpha_num' => 'Tên tài khoản không được chứa ký tự đặc biệt',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
        ]);
        $credentials = array('use_name'=>$request->use_name,'password' =>$request->password);
        if(Auth::guard('customer')->attempt($credentials)){
            return redirect()->route('frontend.layout');
        }
        else{
            return redirect()->back()->with(['flag'=>'danger','message'=>'Đăng nhập k thành công']);
        }
    }
    public function postLogout(){
        Auth::guard('customer')->logout();
        return redirect()->route('frontend.layout');
    }
}
