<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\Galaxy;
use App\Models\Backend\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GalaxyController extends Controller
{
    public function store(Request $request, $id)
    {

        $request->validate([
            'images' =>'required',
            'images.*' =>'image|mimes:png,jpg,gif,jpeg'
        ]);

        if($request->hasFile('images'))
        {
            foreach($_FILES['images']['tmp_name'] as $key => $val)
            {
                $image = base64_encode(file_get_contents($_FILES['images']['tmp_name'][$key]));

                $options = array('http' =>array(
                    'method' => "POST",
                    'header' => "Authorization: Bearer 3597bf9393d8155003c84329d6205961426482fc\n".
                        "Content-Type: application/x-www-form-urlencoded",
                    'content' => $image
                ));
                $context = stream_context_create($options);
                $imgurURL = "https://api.imgur.com/3/image";

                $response = file_get_contents($imgurURL, false, $context);
                $response = json_decode($response);
                $msg = $response->data->link;

                $galaxys = new Galaxy();
                $galaxys-> image = $msg;
                $galaxys->product_id = $id;
                $galaxys->save();
                $product = Product::find($id);
                if ($product->status == 'refused'){
                    $product->status = 'unavailable';
                    $product ->save();
                }
            }
        }
        return back()->with("success","Thêm ảnh thành công");
    }

    public function galaxys($id){
        $galaxys = Galaxy::where('product_id', $id)->paginate(5);
        $product = Product::find($id);
        return view('Backend.administration-partner.galaxys', compact('galaxys','product'));
    }

    public function edit($id){
        $galaxy = Galaxy::find($id);
        return view('Backend.administration-partner.edit-galaxy',compact('galaxy'));
    }

    public function update(Request $request, $id){
        $galaxy = Galaxy::find($id);
        if ($request ->image != null){
            $image = base64_encode(file_get_contents($_FILES['image']['tmp_name']));

            $options = array('http' =>array(
                'method' => "POST",
                'header' => "Authorization: Bearer 3597bf9393d8155003c84329d6205961426482fc\n".
                    "Content-Type: application/x-www-form-urlencoded",
                'content' => $image
            ));
            $context = stream_context_create($options);
            $imgurURL = "https://api.imgur.com/3/image";

            $response = file_get_contents($imgurURL, false, $context);
            $response = json_decode($response);
            $msg = $response->data->link;
            $galaxy -> image = $msg;
        }

        $galaxy->save();
        $request->session()->flash('success', 'Sửa ảnh thành công!');
        return back()->with("success","Sửa ảnh thành công");
    }
    public function destroys(Request $request,$id){
        Galaxy::find($id)->delete();
        $request->session()->flash('error', 'Xóa ảnh thành công!');
        return redirect()->back();
    }
}
