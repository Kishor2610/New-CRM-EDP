<?php

namespace App\Http\Controllers;

use App\CustomerQuery;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendReplyMail;

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
            
                $notifications = CustomerQuery::where('status', 0)->get();

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

        public function updateQueryStatus($id)
        {
            $query = CustomerQuery::findOrFail($id);
            $query->status = 1;
            $query->save();
        
            return response()->json(['message' => 'Query status updated successfully']);
        }


        public function view_query()
        {
             $queries_view = CustomerQuery::all();
             
             $queries_view->transform(function ($query) {

                $user = User::where('id', $query->user_id)->first();
                
                $query->user_name = $user ? $user->f_name . ' ' . $user->l_name : 'Unknown';
                
                return $query;
            });
          
            return view('customer_query.index', compact('queries_view'));
        }


        public function sendReply(Request $request)
        {

            // dd($request->all());

            try{

                // try {
                    $request->validate([
                        'id' => 'exists:query,customerId',
                        'solution' => 'required',
                    ]);
                // } catch (\Illuminate\Validation\ValidationException $e) {
                //     dd($e->errors());
                // }
                   

                    $customerQuery = CustomerQuery::findOrFail(1);


                    Mail::to($customerQuery->email)->send(new SendReplyMail($customerQuery, $request->solution));
            
                    return redirect()->back()->with('success', 'Reply sent successfully!');

            }catch(\Exception $e){

                dd($e);
            }
        }
        


}
