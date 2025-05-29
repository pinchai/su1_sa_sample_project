<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BranchController extends Controller
{
    //
    function index(Request $request)
    {
        return view('admin.branch.branch');
    }


    function get(Request $request)
    {
        $data = Branch::all();
        return response()->json($data);
    }

    function create(Request $request)
    {
        $image = $request->file('image');
        $imageName = null;
        if ($image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
        }

        $branch = new Branch();
        $branch->name = $request->name;
        $branch->phone = $request->phone;
        $branch->location = $request->location;
        $branch->description = $request->description;
        $branch->logo = $imageName;
        $branch->save();

        return response()->json([
            'status' => 'create successfully',
            'data' => $branch,
        ]);
    }

    function delete(Request $request)
    {
        $id = $request->item['id'];
        $branch = Branch::find($id);
        if ($branch) {
            $branch->delete();
        }

        return response()->json([
            'status' => 'delete successfully',
            'data' => $branch,
        ]);
    }

    function update(Request $request)
    {
        $imageName = null;
        if ($request->image != $request->old_image) {
            $image = $request->file('image');
            $imageName = $request->old_image;
            if ($image) {
                $image->move(public_path('images'), $imageName);
            }
        }
        $branch = Branch::find($request->id);

        if ($branch) {
            $branch->name = $request->name;
            $branch->phone = $request->phone;
            $branch->location = $request->location;
            $branch->description = $request->description;
            if ($imageName != null){
                $branch->logo = $imageName;
            }
            $branch->save();
        }

        return response()->json([
            'status' => 'update successfully',
            'data' => $branch,
        ]);
    }


    //
}
