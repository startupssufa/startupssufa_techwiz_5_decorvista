<?php

namespace App\Http\Controllers;

use App\Models\atc;
use App\Models\User;
use App\Http\Requests;
use App\Models\product;
use Illuminate\Http\Request;
use App\Models\seller_contact_view;
use App\Http\Controllers\decorvista;

class decorvista extends Controller
{
    public function contact_view(Request $req){
        $data = new seller_contact_view();
        $data->Name = $req->seller_name;
        $data->Email = $req->seller_email;
        $data->Furniture = $req->seller_furniture;
        $data->Message = $req->seller_message;
        $data->save();
        return redirect()->back();
    }
    public function contact(){
        $data = seller_contact_view::all();
        return view('dashboard-seller/dashboard-pages/Contact-seller/Contact-seller', compact('data'));
    }
    public function show(Request $req){
        $data = User::all();
        return view('dashboard-pages/tables/basic-table', compact('data'));
    }
    public function delete($dlid){
        $data = User::find($dlid);
        $data->delete();
        return redirect()->back();
    }
    public function update($uid){
        $data = User::find($uid);
        return view('update', compact('data'));
    }
    public function updateconfirm(Request $req,$uid){
        $data = User::find($uid);
        $data->name = $req->uname ;
        $data->email = $req->uemail ;
        $data->Password = $req->upass ;
        $data->save();
        return redirect('get');
    }
    public function productinsert(Request $req){
        $data = new product();
        $data->Product_name = $req->Product_name;
        $data->Product_price = $req->Product_price;
        $data->categories = $req->Category;
        $data->Product_seller_name = $req->Product_seller_name;

        $img = $req->Product_image;
        $ext = $img->getClientOriginalName(); 
        $path = $img->move("images/DesignerProducts",$ext);
        $data->Product_image = $path;   

        $data->save();
        return redirect()->back();
    }
    public function productuserinsert(){
        $data = product::all();
        return view('product', compact('data'));
    }
    public function seller_table_compact(){
        $data = product::all();
        return view('dashboard-seller/dashboard-pages/tables/basic-table', compact('data'));
    }
    public function admin_seller_table_compact(){
        $data = product::all();
        return view('dashboard-pages/tables/seller-table', compact('data'));
    }
    public function seller_view(){
        $data = product::all();
        return view('dashboard-seller/dashboard-pages/Products/View_seller', compact('data'));
    }
    public function pr_delete($pr_dl){
        $data = product::find($pr_dl);
        $data->delete();
        return redirect()->back();
    }
    public function at_delete($at_dl){
        $delete = User::find($at_dl);
        $delete->delete();
        return redirect()->back();
    }
    public function pr_update($pr_u){
        $data = product::find($pr_u);
        return view('product_update', compact('data'));
    }
    public function at_update($atuid){
        $update = User::find($atuid);
        return view('auth_update', compact('update'));
    }
    public function pr_updateconfirm(Request $req,$pr_u){
        $data = product::find($pr_u);
        $data->Product_name = $req->pr_uname ;
        $data->Product_image = $req->pr_uimage ;
        $data->Product_price = $req->pr_uprice ; 
        $data->Product_seller_name = $req->pr_usellern ;
        $data->Categories = $req->pr_ucate ;
        $data->save();
        return redirect('product-dashboard');
    }
    public function at_update_confirm(Request $req,$atuid){
        $data = User::find($atuid);
        $data->name = $req->auth_u_name ;
        $data->email = $req->auth_u_email ;
        $data->role = $req->auth_u_role ; 
        $data->save();
        $data = User::all();
        return view('dashboard-seller/dashboard-pages/Auth_data_seller/Auth_seller', compact('data'));
    }
    public function authdata(){
        $data = User::all();
        return view('dashboard-seller/dashboard-pages/Auth_data_seller/Auth_seller', compact('data'));
    }
    function addtocart1(Request $req){
        $data = atc::all();
        $data->Product_id = $req->id ;
        $data->Product_name = $req->name;
        $data->Product_price = $req->price;
        $data->Product_quantity= $req->quantity;
        $data->Product_Total_price = $req->totalPrice;
        $data->save();
        return redirect()->back();
    }
}