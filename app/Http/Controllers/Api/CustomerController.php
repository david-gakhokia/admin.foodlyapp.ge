<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');

        $query = Customer::select('id','name','email','phone_country_code','phone','email_verified_at')
            ->when($search, function($q, $search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });

        // თუ გვინდა 15-იან pagination
        $paginated = $query->paginate(50);

        // JSON გამოაქვს ავტომატურად: data, meta, links
        return response()->json($paginated);
    }
}
