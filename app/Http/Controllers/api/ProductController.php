<?php

namespace App\Http\Controllers\api;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{

    public function show()
    {
        $products = Product::all();
        return view('welcome',['products'=>$products]);
    }

    public function search(Request $request)
    {
        if($request->ajax()){
            $data = Product::where('state','!=','delete')->where('name','LIKE',$request->name.'%')->get();
            $output = '';
            if(count($data) > 0){
                $output = '<ul class="list-group" style="display:block;position:relative;z-indez:1">';
                foreach($data as $row){
                    $output .= '<li class="list-group-item">'.$row->name.'</li>';
                }
                $output .= '</ul>';
            }
            else{
                $output .= '<br><li class="list-group-item" style="color:#ff0000;"><strong>NO Data Found!</strong></li>';
            }
            return $output;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    use apiResponseTrait;
    public function create(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = Product::create([
               'name'              => $request->name,
               'category'          => $request->category,
               'description'       => $request->description,
            ]);
            DB::commit();
            if ($data) {
                return redirect('welcome');
            } else {
                return $this->apiResponse('Application error please try again', [], $data, [], 400);
            }
        } catch (\Throwable $th) {
            DB::rollback();
            return $this->apiResponse('Application error please try again', [], $th, [], 400);
        }
    }
}
