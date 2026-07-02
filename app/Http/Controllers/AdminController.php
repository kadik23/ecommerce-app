<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use App\Models\WalletTransaction;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{   
    private UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('role:admin');
        $this->userRepository = $userRepository;
    }

    public function index(Request $request)
    {
        $indexTitle = 'Sales Analytics';

        // (sum of order_payment transaction amounts)
        $totalRevenue = WalletTransaction::where('type', 'order_payment')->sum('amount');

        $totalProfits = $totalRevenue * 0.85;

        // user statistics (default: 7days)
        $range = $request->query('range', '7days');
        $userStats = $this->userRepository->getRegistrationStats($range);

        return view('admin.index', compact('indexTitle', 'totalRevenue', 'totalProfits', 'userStats', 'range'));
    }

    public function userStats(Request $request)
    {
        $range = $request->query('range', '7days');
        $stats = $this->userRepository->getRegistrationStats($range);

        return response()->json($stats);
    }

    public function usersReport(Request $request)
    {
        $range = $request->query('range', '7days');
        
        $startDate = null;
        switch ($range) {
            case 'today':
                $startDate = Carbon::today();
                break;
            case 'yesterday':
                $startDate = Carbon::yesterday();
                break;
            case '30days':
                $startDate = Carbon::now()->subDays(30)->startOfDay();
                break;
            case '90days':
                $startDate = Carbon::now()->subDays(90)->startOfDay();
                break;
            case '7days':
            default:
                $startDate = Carbon::now()->subDays(7)->startOfDay();
                break;
        }

        $users = User::where('created_at', '>=', $startDate)->get(['id', 'username', 'fullName', 'email', 'created_at']);

        $csvFileName = 'users_report_' . $range . '_' . date('Y-m-d') . '.csv';
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$csvFileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = ['ID', 'Username', 'Full Name', 'Email', 'Registration Date'];

        $callback = function() use($users, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($users as $user) {
                fputcsv($file, [
                    $user->id,
                    $user->username,
                    $user->fullName,
                    $user->email,
                    $user->created_at->toDateTimeString()
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
    public function products()
    {
        return view('admin.products',['productsController' => Product::all()]);
    }
    public function orders()
    {   
        $orderTitle = 'Orders Management'; 
        $iconCard = ['priority', 'cancel', 'recommend', 'refresh'];
        $orderStat = ['completed', 'canceled', 'confirmed', 'pending'];
    
        // Count the number of orders for each state
        $nbr = [
            Order::where('state', 'complete')->count(),
            Order::where('state', 'cancel')->count(),
            Order::where('state', 'confirm')->count(),
            Order::where('state', 'pending')->count(),
        ];
    
        $orders = Order::with('product')->get();
        
        return view('admin.orders', compact('orderTitle', 'iconCard', 'nbr', 'orderStat', 'orders'));
    }
    

    public function customers(){
        $customersTitle='Customers';
        $iconCard=['group','flag','public','shopping_cart'];
        $nbr=[3600,23,370,12];
        $cardName=['All','Local','World','Shopping Cart'];
        return view('admin.Customers',compact('customersTitle','iconCard','nbr','cardName'));
    }
    // public function myprofile(){
    //     return view('admin.profile');
    // }
    

}