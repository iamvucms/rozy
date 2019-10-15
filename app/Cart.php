<?php
namespace App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use App\Product;
class Cart extends Model
{
    private $cart;
    public function __construct(){
        parent::__construct();
        $this->cart = Session::get('cart') ?? [];
    }
    public function addItem($id,$quantity){
        $product =Product::where('id',$id)->first();
        $exists = $this->is_exists($id);
        if($product->count() > 0 && $quantity > 0){
            if($exists){
                $this->editItem($id,$this->getQuantity($id)+$quantity);
            }else{
                $this->cart[]=[
                    'id' =>$id,
                    'quantity'=>$quantity,
                    'name' => $product->name,
                    'price' =>$product->sale_price,
                    'avatar' =>$product->Avatar()->src?? ''
                ];
            }
        }
        $this->saveCart();
    }
    public function editItem($id,$quantity){
            foreach($this->cart as $key => $item) {
                if($item['id']==$id){
                    if($quantity<=0){
                        $this->delItem($id);
                    }else{
                        $this->cart[$key]['quantity'] = $quantity;  
                    }
                    break;
                }
            }
            $this->saveCart();
    }
    public function delItem($id){
        foreach ($this->cart as $key => $item) {
            if(@$value['id']==$id){
                unset($this->cart[$key]);
                break;
            }
        }
        $this->saveCart();
    }
    public function getCart(){
        return $this->cart;
    }
    public function getTotal(){
        $vnd = 0;
        foreach($this->cart as $product){
            $vnd += $product['quantity']*$product['price'];
        }
        return $vnd;
    }
    public function getQuantityAll(){
        $quantity = 0;
        foreach($this->cart as $product){
            $quantity += $product['quantity'];
        }
        return $quantity;
    }
    public function getQuantity($id){
        foreach($this->cart as $product){
            if($id==$product['id']) return $product['quantity'];
        }
        return 0;
    }
    private function is_exists($id){
        $check = false;
        foreach($this->cart as $product){
            if($product['id']==$id){
                $check = true;
                break;
            }
        }
        return $check;
    }
    private function saveCart(){
        Session::put('cart',$this->cart);
        $this->__construct();
    }
    
}
