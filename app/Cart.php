<?php
namespace App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use App\Product;
use App\Discount;
class Cart extends Model
{
    private $cart;
    public function __construct(){
        parent::__construct();
        $this->cart = json_decode(Cookie::get('cart'),true) ?? [];
    }
    public function addItem($id,$quantity){
        $product =Product::where('id',$id)->first();
        if($quantity>$product->quantity) return false;
        $exists = $this->is_exists($id);
        $dc = new Discount;
        $percent = $dc->getMaxAvailablerForProduct($product->id) ?? 0;
        if($product->count() > 0 && $quantity > 0){
            if($exists){
                if($this->getQuantity($id)+$quantity > $product->quantity) return false;
                $this->editItem($id,$this->getQuantity($id)+$quantity);
            }else{
                $this->cart[]=[
                    'id' =>$id,
                    'quantity'=>$quantity,
                    'name' => $product->name,
                    'price' =>ceil($product->price - $percent*$product->price/100),
                    'avatar' =>$product->Avatar()->src?? ''
                ];
            }
        }
        $this->saveCart();
        return true;
    }
    public function getSellers(){
        $seller_ids = [];
        foreach($this->cart as $key =>$cart){
            $product = Product::where('id',$cart['id'])->first();
            $idsell = $product->Seller()->id;
            if(!array_search($idsell,$seller_ids)) $seller_ids[] = $idsell;
        }
        
        return $seller_ids;
    }
    public function getProductPerSeller(){
        $perSellers = collect();
        $seller_ids = [];
        foreach($this->cart as $key => $cart){
            $product = Product::where('id',$cart['id'])->first();
            $idsell = $product->Seller()->id;
            if(array_search($idsell,$seller_ids)===false) $seller_ids[] = $idsell;
        }
        foreach($seller_ids as $idsell){
            $perSellers->push($this->getProductBySeller($idsell));
        }
        return $perSellers;
    }
    public function getProductBySeller($idsell){
        $products = [];
        foreach($this->cart as $key =>$cart){
            $product = Product::where('id',$cart['id'])->first();
            $id = $product->Seller()->id;
            $dc = new Discount;
            $percent = $dc->getMaxAvailablerForProduct($product->id) ?? 0;
            if($idsell==$id) $products[] = [
                'id' =>$product->id,
                'quantity'=>$cart['quantity'],
                'name' => $product->name,
                'price' =>ceil($product->price - $percent*$product->price/100),
                'avatar' =>$product->Avatar()->src ?? ''
            ];
        }
        return $products;
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
            return true;
    }
    public function delItem($id){
        foreach ($this->cart as $key => $item) {
            if($item['id']==$id){
                array_splice($this->cart,$key,1);
                $this->saveCart();
                return true;
            }
        }
        return false;
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
        Cookie::queue('cart',json_encode($this->cart),999999999);
    }
    
}
