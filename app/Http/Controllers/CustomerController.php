<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    //
    function get(Request $request)
    {
        $customer = DB::table('customer')
            ->select(
                'id',
                'name',
                'description'
            )
            ->get();
        return response()->json($customer);
    }

    function getById($id)
    {
        $customer_id = intval($id) !== null ? intval($id) : 0;
        $customer = DB::table('customer')
            ->select(
                'id',
                'name',
                'description'
            )
            ->where('id', $customer_id)
            ->first();
        return response()->json($customer);
    }

    function create(Request $request)
    {
        $customer = DB::table('customer')->insert(
            [
                'name' => $request->name,
                'description' => $request->description
            ]
        );
        if ($customer) {
            return response()->json(['status' => 'create successfully']);
        }
    }


    function update(Request $request)
    {
        $customer = DB::table('customer')
            ->where('id', $request->id)
            ->update(
                [
                    'name' => $request->name,
                    'description' => $request->description
                ]
            );
        if ($customer) {
            return response()->json(['status' => 'update successfully']);
        }
    }

    function delete(Request $request)
    {
        $customer = DB::table('customer')
            ->where('id', $request->id)
            ->delete();
        if ($customer){
            return response()->json(['status'=>'delete successfully']);
        }
    }

    //
}
