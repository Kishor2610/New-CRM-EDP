<?php

namespace App\Http\Controllers;

use App\CustomerQuery;
use App\Models\Query;

use Illuminate\Http\Request;

class CustomerQueryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function create()
    {
        return view('customer.queryform');
    }


    public function submitQuery(Request $request)
    {   
        $request->validate([
            'query_subject'=>'required|string|max:255',
            'query_message'=>'required|string',
            ]);
        $query = new CustomerQuery();
        $query->user_id = auth()->user()->id; 
        $query->email = auth()->user()->email; 
        $query->query_subject = $request->query_subject;
        $query->query_message = $request->query_message;
        $query->status = 0; // Set status to 0
        $query->save();

        return redirect()->back()->with('message', 'Query send Succesfully');    }

        public function viewQueries()
        {
            $queries = CustomerQuery::all();

            //  dd($queries);
            return view('customer.viewqueries', compact('queries'));
        }
        public function fetchNotifications()
        {
            $notifications = CustomerQuery::all();
            return response()->json($notifications);
        }

        public function showHeader()
        {
            $queries = CustomerQuery::all(); // Fetch queries
            return view('partials.header', ['queries' => $queries]);
        }

        public function fetchNotificationsCount()
        {
            $count = CustomerQuery::where('status', 0)->count();
            return response()->json(['count' => $count]);
            
        }
  

}
