<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Admin\Product;
use App\Models\City;
use App\Models\Courier;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Ordernote;
use App\Models\Orderproduct;
use App\Models\User;
use App\Models\User\Notification;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function orderStatus($status = null)
    {
        $query = Order::with('user')->latest();
        if ($status != 'all') {
            $query->where('status', $status);
        }

        $orders = $query->paginate(15);

        $all_orders = Order::count();
        $pending    = Order::where('status', 'Pending')->count();
        $confirmed  = Order::where('status', 'Confirmed')->count();
        $ongoing    = Order::where('status', 'Ongoing')->count();
        $delivered  = Order::where('status', 'Delivered')->count();
        $canceled   = Order::where('status', 'Canceled')->count();
        $returned   = Order::where('status', 'Returned')->count();
        $rejected   = Order::where('status', 'Rejected')->count();

        return view('admin.pages.order.index', compact(
            'orders',
            'pending',
            'confirmed',
            'ongoing',
            'delivered',
            'canceled',
            'returned',
            'rejected',
            'all_orders',

        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $uniqueId = uniqid();
        $couriers = Courier::all();
        return view('admin.pages.order.create', ['couriers' => $couriers, 'uniqueId' => $uniqueId]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $superadmin_id = Admin::first();
        $user          = User::where('email', $request['data']['email'])->first();
        if ($user) {

        } else {
            $user = User::where('phone', $request['data']['phone'])->first();
        }

        $order = new Order();

        $order->invoiceID      = uniqid();
        $order->web_id         = 1;
        $order->admin_id       = $superadmin_id->id;
        $order->user_id        = $superadmin_id->id;
        $order->payment_method = 'cash_on_delivery';
        $order->name           = $request['data']['name'];
        $order->email          = $request['data']['email'];
        $order->phone          = $request['data']['phone'];
        $order->country        = $request['data']['country'];
        $order->hub_name       = $request['data']['hub_name'];
        $order->state          = $request['data']['state'];
        $order->city           = $request['data']['city'];
        $order->address        = $request['data']['address'];
        $order->zip_code       = $request['data']['zip_code'];
        $order->courier_id     = $request['data']['courierID'];
        $order->city_id        = $request['data']['cityID'] ?? null;
        $order->zone_id        = $request['data']['zoneID'] ?? null;
        $order->hub_name       = $request['data']['hub_name'];
        $order->subtotal       = $request['data']['subtotal'];
        $order->shippingCharge = $request['data']['shippingCharge'];
        $order->discount       = $request['data']['discount'];
        $order->paidAmount     = $request['data']['paidAmount'];
        $order->total          = $request['data']['total'];
        $order->orderDate      = date('Y-m-d');
        $order->save();
        $customar = Customer::create([
            'order_id'      => $order->id,
            'user_id'       => $superadmin_id->id,
            'customerName'  => $request['data']['name'],
            'customerEmail' => $request['data']['email'],
            'customerPhone' => $request['data']['phone'],
        ]);
        $ordernote = Ordernote::create([
            'order_id' => $order->id,
            'comment'  => $order->invoiceID . __('backend. Order Has Been Created for ') . $superadmin_id->name,
            'admin_id' => $superadmin_id->id,
        ]);

        $ordernote = Ordernote::create([
            'order_id' => $order->id,
            'comment'  => $superadmin_id->name . ' update this order info, ID: ' . $order->invoiceID,
            'admin_id' => $superadmin_id->id,
        ]);

        Notification::create([
            'user_id' => $superadmin_id->id,
            'title'   => 'Order Successfull',
            'type'    => 'order',
        ]);

        $products = $request['data']['products'];

        foreach ($products as $product) {
            $orp              = new Orderproduct();
            $orp->order_id    = $order->id;
            $orp->product_id  = $product['productID'];
            $orp->productSku  = $this->productsku($product['productID']);
            $orp->productName = $this->productname($product['productID']);
            $orp->color       = $product['color'];
            $orp->size_id     = $product['sizeID'];
            $orp->size        = $product['size'];
            // $orp->code_id = $product['codeID'] ?? null;
            $orp->code_id = isset($product['codeID']) ? (int) $product['codeID'] : null;

            $orp->code                = $product['code'] ?? null;
            $orp->weight_id           = $product['weightID'] ?? null;
            $orp->weight              = $product['weight'] ?? null;
            $orp->productvariation_id = $product['variationID'];
            $orp->price               = $product['price'];
            $orp->qty                 = $product['qty'];
            $orp->save();
        }
        $response['status']  = 'success';
        $response['message'] = $superadmin_id->name . ' Successfully Update Info of :' . $order->invoiceID;
        return json_encode($response);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $order = Order::with(['orderproducts.productvariation', 'orderproducts'])->findOrFail($id);
        return view('admin.pages.order.view', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $couriers = Courier::all();
        $order    = $order    = Order::with(['orderproducts.productvariation', 'orderproducts'])->findOrFail($id);
        return view('admin.pages.order.edit', compact('order', 'couriers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        $superadmin_id         = Admin::first();
        $order                 = Order::findOrfail($id);
        $order->name           = $request['data']['name'];
        $order->email          = $request['data']['email'];
        $order->phone          = $request['data']['phone'];
        $order->country        = $request['data']['country'];
        $order->state          = $request['data']['state'];
        $order->city           = $request['data']['city'];
        $order->address        = $request['data']['address'];
        $order->zip_code       = $request['data']['zip_code'];
        $order->courier_id     = $request['data']['courierID'];
        $order->city_id        = $request['data']['cityID'] ?? null;
        $order->zone_id        = $request['data']['zoneID'] ?? null;
        $order->hub_name       = $request['data']['hub_name'];
        $order->subtotal       = $request['data']['subtotal'];
        $order->shippingCharge = $request['data']['shippingCharge'];
        $order->vat            = $request['data']['vat'];
        $order->tax            = $request['data']['tax'];
        $order->discount       = $request['data']['discount'];
        $order->paidAmount     = $request['data']['paidAmount'];
        $order->status         = $request['data']['status'];
        $order->due_amount     = ($order->subTotal - $request['data']['paidAmount']);
        $order->update();

        $customar                = Customer::where('order_id', $order->id)->first();
        $customar->customerName  = $request['data']['name'];
        $customar->customerEmail = $request['data']['email'];
        $customar->customerPhone = $request['data']['phone'];
        $customar->update();

        $response['status']  = 'success';
        $response['message'] = $superadmin_id->name . ' Successfully Update Info of :' . $order->invoiceID;
        return json_encode($response);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {

        $result = Order::find($id);
        if ($result) {
            $result->delete();
            Customer::query()->where('order_id', '=', $id)->delete();
            Orderproduct::query()->where('order_id', '=', $id)->delete();
            Ordernote::query()->where('order_id', '=', $id)->delete();
        }

        return response()->json([
            'status'  => 'success',
            'message' => __('backend.Order Delete Successfully!'),
        ], 200);
    }

    public function details($id)
    {
        $order = Order::with(['orderproducts', 'user'])->findOrFail($id)->first();

        return view('admin.pages.order.view', compact('order'));
    }

    //assign user
    // public function assignuser(Request $request)
    // {
    //     $user_id = $request['user_id'];
    //     $ids     = $request['ids'];
    //     if ($ids) {
    //         foreach ($ids as $id) {
    //             $order           = Order::find($id);
    //             $order->admin_id = $user_id;
    //             $order->save();
    //             $comment           = new Ordernote();
    //             $user              = Admin::find($user_id);
    //             $comment->order_id = $id;
    //             $comment->comment  = Auth::guard('admin')->user()->name . ' Successfully Assign #RB00' . $id . ' Order to ' . $user->name;
    //             $comment->admin_id = Auth::guard('admin')->user()->id;
    //             $comment->save();
    //         }
    //         $response['status']  = 'success';
    //         $response['message'] = 'Successfully Assign User to this Order';
    //     } else {
    //         $response['status']  = 'failed';
    //         $response['message'] = 'Unsuccessful to Assign User to this Order';
    //     }
    //     return json_encode($response);
    // }

    // public function countorder()
    // {

    //     $admin                = Admin::where('email', Auth::guard('admin')->user()->email)->first();
    //     $response['allorder'] = DB::table('orders')->count();

    //     $response['all']        = DB::table('orders')->count();
    //     $response['pending']    = DB::table('orders')->where('status', 'like', 'Pending')->count();
    //     $response['confirmed']  = DB::table('orders')->where('status', 'like', 'Confirmed')->count();
    //     $response['ongoing']    = DB::table('orders')->where('status', 'like', 'Ongoing')->count();
    //     $response['delivered']  = DB::table('orders')->where('status', 'like', 'Delivered')->count();
    //     $response['canceled']   = DB::table('orders')->where('status', 'like', 'Canceled')->count();
    //     $response['returned']   = DB::table('orders')->where('status', 'like', 'Returned')->count();
    //     $response['rejected']   = DB::table('orders')->where('status', 'like', 'Rejected')->count();
    //     $response['products']   = DB::table('products')->get()->count();
    //     $response['totalsales'] = DB::table('orders')->whereIn('status', ['Ongoing', 'Confirmed', 'Delivered'])->sum('total') + DB::table('orders')->whereIn('status', ['Ongoing', 'Confirmed', 'Delivered'])->sum('paidAmount');
    //     $response['users']      = DB::table('users')->get()->count();

    //     $response['status'] = 'success';
    //     return json_encode($response);
    // }

    // public function users(Request $request)
    // {
    //     if (isset($request['q'])) {
    //         $users = Admin::where('status', '1')->query()->where([['name', 'like', '%' . $request['q'] . '%']])->get();
    //     } else {
    //         $users = Admin::where('status', '1')->get();
    //     }
    //     $user = [];
    //     foreach ($users as $item) {
    //         $user[] = [
    //             "id"   => $item['id'],
    //             "text" => $item['name'],
    //         ];
    //     }
    //     return json_encode($user);
    //     die();
    // }

    //product
    // public function admproduct(Request $request)
    // {
    //     if (isset($request['q'])) {
    //         $type0 = DB::table('sizes')
    //             ->select('sizes.*', 'products.product_name', 'products.product_sku', 'productvariations.image', 'productvariations.color', 'productvariations.code', 'productvariations.code_id')
    //             ->join('productvariations', 'productvariations.id', '=', 'sizes.varient_id')
    //             ->join('products', 'products.id', '=', 'sizes.product_id')
    //             ->where('product_name', 'like', '%' . $request['q'] . '%')->get();
    //         $type1 = DB::table('weights')
    //             ->select('weights.*', 'products.product_name', 'products.product_sku', 'productvariations.image', 'productvariations.color', 'productvariations.code', 'productvariations.code_id')
    //             ->join('productvariations', 'productvariations.id', '=', 'weights.varient_id')
    //             ->join('products', 'products.id', '=', 'weights.product_id')
    //             ->where('product_name', 'like', '%' . $request['q'] . '%')->get();
    //     } else {
    //         $type0 = DB::table('sizes')
    //             ->select('sizes.*', 'products.product_name', 'products.product_sku', 'productvariations.image', 'productvariations.color', 'productvariations.code', 'productvariations.code_id')
    //             ->join('productvariations', 'productvariations.id', '=', 'sizes.varient_id')
    //             ->join('products', 'products.id', '=', 'sizes.product_id')
    //             ->where('product_name', 'like', '%' . $request['q'] . '%')->get();
    //         $type1 = DB::table('weights')
    //             ->select('weights.*', 'products.product_name', 'products.product_sku', 'productvariations.image', 'productvariations.color', 'productvariations.code', 'productvariations.code_id')
    //             ->join('productvariations', 'productvariations.id', '=', 'weights.varient_id')
    //             ->join('products', 'products.id', '=', 'weights.product_id')
    //             ->where('product_name', 'like', '%' . $request['q'] . '%')->get();
    //     }

    //     $products = $type0->merge($type1);

    //     foreach ($products as $item) {
    //         if (App::environment('local')) {
    //             $item->image = url($item->image);
    //         } else {
    //             $item->image = url($item->image);
    //         }
    //         if (empty($item->weight)) {
    //             $product[] = [
    //                 "id"           => $item->id,
    //                 "product_id"   => $item->product_id,
    //                 "varient_id"   => $item->varient_id,
    //                 "size_id"      => $item->size_id,
    //                 "size"         => $item->size,
    //                 "weight_id"    => '',
    //                 "weight"       => '',
    //                 "code_id"      => $item->code_id,
    //                 "code"         => $item->code,
    //                 "SalePrice"    => $item->SalePrice,
    //                 "image"        => $item->image,
    //                 "color"        => $item->color,
    //                 "product_name" => $item->product_name,
    //                 "product_sku"  => $item->product_sku,
    //                 "stock"        => $item->stock,
    //             ];
    //         } else {
    //             $product[] = [
    //                 "id"           => $item->id,
    //                 "product_id"   => $item->product_id,
    //                 "varient_id"   => $item->varient_id,
    //                 "size_id"      => '',
    //                 "size"         => '',
    //                 "weight_id"    => $item->weight_id,
    //                 "weight"       => $item->weight,
    //                 "code_id"      => $item->code_id,
    //                 "code"         => $item->code,
    //                 "SalePrice"    => $item->SalePrice,
    //                 "stock"        => $item->stock,
    //                 "image"        => $item->image,
    //                 "color"        => $item->color,
    //                 "product_name" => $item->product_name,
    //                 "product_sku"  => $item->product_sku,
    //             ];
    //         }
    //     }

    //     $data['data'] = $product;
    //     return $data;
    //     die();
    // }

    //couriers
    // public function couriers(Request $request)
    // {
    //     if (isset($request['q'])) {
    //         $couriers = Courier::where([
    //             ['courierName', 'like', '%' . $request['q'] . '%'],
    //             ['status', 'like', 'Active'],
    //         ])->get();
    //     } else {
    //         $couriers = Courier::where('status', 'Active')->get();
    //     }
    //     $courier = [];
    //     foreach ($couriers as $item) {
    //         $courier[] = [
    //             "id"   => $item['id'],
    //             "text" => $item['courierName'],
    //         ];
    //     }
    //     return json_encode($courier);
    // }

    // Get City
    // public function city(Request $request)
    // {
    //     if (isset($request['q']) && $request['courierID']) {
    //         $cites = City::query()->where([
    //             ['cityName', 'like', '%' . $request['q'] . '%'],
    //             ['status', 'like', 'Active'],
    //             ['courier_id', '=', $request['courierID']],
    //         ])->get();
    //     } else {
    //         $cites = City::query()->where([
    //             ['status', 'Active'],
    //             ['courier_id', '=', $request['courierID']],
    //         ])->get();
    //     }
    //     $city = [];
    //     foreach ($cites as $item) {
    //         $city[] = [
    //             "id"   => $item['id'],
    //             "text" => $item['cityName'],
    //         ];
    //     }
    //     return json_encode($city);
    // }

    // Get Zone
    // public function zone(Request $request)
    // {
    //     if (isset($request['q'])) {
    //         $zones = Zone::query()->where([
    //             ['zoneName', 'like', '%' . $request['q'] . '%'],
    //             ['courier_id', '=', $request['courierID']],
    //             ['status', 'Active'],
    //             ['city_id', 'like', $request['cityID']],
    //         ])->get();
    //     } else {
    //         $zones = Zone::query()->where([
    //             ['courier_id', 'like', $request['courierID']],
    //             ['city_id', 'like', $request['cityID']],
    //             ['status', 'Active'],
    //         ])->get();
    //     }
    //     $zone = [];
    //     foreach ($zones as $item) {
    //         $zone[] = [
    //             "id"   => $item['id'],
    //             "text" => $item['zoneName'],
    //         ];
    //     }
    //     return json_encode($zone);
    // }

    // Get area
    // public function area(Request $request)
    // {
    //     if (isset($request['q'])) {
    //         $areas = Area::query()->where([
    //             ['areaName', 'like', '%' . $request['q'] . '%'],
    //             ['courier_id', '=', $request['courierID']],
    //             ['status', 'Active'],
    //             ['zone_id', 'like', $request['zoneID']],
    //         ])->get();
    //     } else {
    //         $areas = Area::query()->where([
    //             ['courier_id', 'like', $request['courierID']],
    //             ['zone_id', 'like', $request['zoneID']],
    //             ['status', 'Active'],
    //         ])->get();
    //     }
    //     $area = [];
    //     foreach ($areas as $item) {
    //         $area[] = [
    //             "id"   => $item['id'],
    //             "text" => $item['areaName'],
    //         ];
    //     }
    //     return json_encode($area);
    // }

    //update status
    public function updateorderstatus(Request $request)
    {
        $id = $request['id'];

        $status = $request['status'];
        if ($status == 'Delivered') {
            $order                 = Order::find($id);
            $order->payment_status = 'paid';
            $order->save();
        }
        $order         = Order::find($id);
        $order->status = $status;
        $result        = $order->save();

        if ($result) {
            $response['status']  = 'success';
            $response['message'] = __('backend.Successfully Update Status to ') . $request['status'];
        } else {
            $response['status']  = 'failed';
            $response['message'] = __('backend.Unsuccessful to update Status ') . $request['status'];
        }
        $comment           = new Ordernote();
        $comment->order_id = $id;
        $comment->comment  = Auth::guard('admin')->user()->name . ' Successfully Update #RB00' . $id . ' Order status to ' . $status;
        $comment->admin_id = Auth::guard('admin')->user()->id;
        $comment->status   = 1;
        $comment->save();

        return json_encode($response);
    }

    // public function statusList($status, $id)
    // {
    //     $allStatus = [
    //         'order' => [
    //             "Pending"   => [
    //                 "name"  => __('backend.Pending'),
    //                 "icon"  => "fe-tag",
    //                 "color" => "bg-primary",
    //             ],
    //             "Confirmed" => [
    //                 "name"  => __('backend.Confirmed'),
    //                 "icon"  => "fe-tag",
    //                 "color" => "bg-success",
    //             ],
    //             "Ongoing"   => [
    //                 "name"  => __('backend.Ongoing'),
    //                 "icon"  => "far fa-stop-circle",
    //                 "color" => "bg-info",
    //             ],
    //             "Delivered" => [
    //                 "name"  => __('backend.Delivered'),
    //                 "icon"  => "far fa-stop-circle",
    //                 "color" => "bg-success",
    //             ],
    //             "Canceled"  => [
    //                 "name"  => __('backend.Canceled'),
    //                 "icon"  => "far fa-stop-circle",
    //                 "color" => "bg-danger",
    //             ],
    //             "Returned"  => [
    //                 "name"  => __('backend.Returned'),
    //                 "icon"  => "fe-trash-2",
    //                 "color" => "bg-danger",
    //             ],
    //             "Rejected"  => [
    //                 "name"  => __('backend.Rejected'),
    //                 "icon"  => "fe-check-circle",
    //                 "color" => "bg-success",
    //             ],
    //         ],
    //     ];

    //     $temp = 'order';
    //     foreach ($allStatus as $key => $value) {
    //         foreach ($value as $kes => $val) {
    //             if ($kes == $status) {
    //                 $temp = $key;
    //             }
    //         }
    //     }
    //     $args = $allStatus[$temp];
    //     $html = '';
    //     foreach ($args as $value) {
    //         if ($args[$status]['name'] != $value['name']) {

    //             $html = $html . "<div class='dropdown-item'>
    //             <a class=' btn-sm dropdown-item btn-status' data-id='" . $id . "' data-status='" . $value['name'] . "' href='#'>" . $value['name'] . "</a>
    //             </div>";
    //         }
    //     }
    //     // $response = "<div class='has-dropdown'>
    //     //     <a type='button' style='color:white'  class=' btn-sm table-action-btn has-dropdown arrow-none btn " . $args[$status]['color'] . " btn-xs' data-toggle='dropdown' aria-expanded='false' >" . $args[$status]['name'] . " <i class='mdi mdi-chevron-down'></i></a>
    //     //     <div class='dropdown-menu'>
    //     //     " . $html . "
    //     //     </div>
    //     // </div>";

    //     $response = '<div class="dropdown-product-list order-status">
    //                         <button>' . $args[$status]['name'] . '</button>
    //                         <div id="myDropdown" class="dropdown-product-list-content">

    //                         ' . $html . '
    //                         </div>
    //                       </div>';

    //     return $response;
    // }

    public function getComment(Request $request)
    {
        $order_id = $request['id'];
        $comment  = Ordernote::where('order_id', $order_id)->latest()->get();

        $comment['data'] = $comment->map(function ($comment) {
            $admin         = DB::table('admins')->select('admins.name')->where('id', '=', $comment->admin_id)->get()->first();
            $comment->name = $admin->name;
            $comment->date = $comment->created_at->diffForHumans();
            return $comment;
        });
        return json_encode($comment);
    }

    public function updateComment(Request $request)
    {
        $id                     = $request['id'];
        $note                   = $request['comment'];
        $notification           = new Ordernote();
        $notification->order_id = $id;
        $notification->comment  = $note;
        $notification->admin_id = Auth::guard('admin')->user()->id;
        $request                = $notification->save();

        if ($request) {
            $response['status']  = 'success';
            $response['message'] = 'Note Successfully Added To This Order';
        } else {
            $response['status']  = 'failed';
            $response['message'] = 'Unsuccessful to Update Order note';
        }
        return json_encode($response);
        die();
    }

    // public function topsellpeoduct($id)
    // {}

    public function productname($id)
    {
        return Product::where('id', $id)->first()->product_name;
    }
    public function productsku($id)
    {
        return Product::where('id', $id)->first()->product_sku;
    }
    public function orderproduct()
    {
        return view('admin.pages.order.products');
    }

    // public function onlineorder()
    // {
    //     $admin  = Admin::where('email', Auth::guard('admin')->user()->email)->first();
    //     $status = "";
    //     return view('admin.pages.order.online', ['admin' => $admin, 'status' => $status]);
    // }
}
