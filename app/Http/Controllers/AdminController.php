<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\WalletTransaction;
use App\Models\User;
use App\Repositories\UserRepositoryInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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

        // latest 3 customers with revenue
        $latestCustomers = $this->userRepository->getLatestCustomersWithRevenue(3);

        return view('admin.index', compact('indexTitle', 'totalRevenue', 'totalProfits', 'userStats', 'range', 'latestCustomers'));
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
        $categories = Category::all();
        return view('admin.products', [
            'products' => Product::paginate(12)->withQueryString(),
            'categories' => $categories,
            'Categories' => $categories
        ]);
    }
    public function orders(Request $request)
    {   
        $orderTitle = 'Orders Management'; 
        $iconCard = ['priority', 'cancel', 'recommend', 'refresh'];
        $orderStat = ['completed', 'canceled', 'confirmed', 'pending'];
    
        // Count the number of orders for each state
        $nbr = [
            Order::where('state', 'complete')->count(),
            Order::where('state', 'cancel')->count(),
            Order::where('state', 'confirm')->count(),
            Order::whereIn('state', ['pending', 'processing'])->count(),
        ];
    
        $query = Order::with('product');
        
        if ($request->filled('status')) {
            if ($request->status === 'pending') {
                $query->whereIn('state', ['pending', 'processing']);
            } else {
                $query->where('state', $request->status);
            }
        }
        
        $sort = $request->query('filter');
        if ($sort === 'LowToHigh') {
            $query->select('orders.*')
                  ->join('products', 'orders.productOrdered', '=', 'products.id')
                  ->orderBy('products.rating', 'asc');
        } elseif ($sort === 'HighToLow') {
            $query->select('orders.*')
                  ->join('products', 'orders.productOrdered', '=', 'products.id')
                  ->orderBy('products.rating', 'desc');
        } elseif ($sort === 'Available') {
            $query->select('orders.*')
                  ->join('products', 'orders.productOrdered', '=', 'products.id')
                  ->where('products.quantity', '>', 0);
        } else {
            $query->orderBy('dateOrder', 'desc');
        }
        
        $orders = $query->paginate(15)->withQueryString();
        $categories = Category::all();
        
        return view('admin.orders', compact('orderTitle', 'iconCard', 'nbr', 'orderStat', 'orders', 'categories'));
    }
    

    public function customers(){
        $customersTitle='Customers';
        $iconCard=['group','flag','public','shopping_cart'];
        
        $totalCustomersCount = User::whereDoesntHave('roles', function($q) {
            $q->where('name', 'admin');
        })->count();
        
        $localCustomersCount = User::whereDoesntHave('roles', function($q) {
            $q->where('name', 'admin');
        })->where('country', 'Algeria')->count();
        
        $worldCustomersCount = User::whereDoesntHave('roles', function($q) {
            $q->where('name', 'admin');
        })->where(function($query) {
            $query->where('country', '!=', 'Algeria')->orWhereNull('country');
        })->count();
        
        $cartCount = DB::table('product_user')->count();
        
        $nbr = [$totalCustomersCount, $localCustomersCount, $worldCustomersCount, $cartCount];
        $cardName=['All','Local','World','Shopping Cart'];

        // Conversion Rate stats by Year
        $currentYear = date('Y');
        $customerYearly = User::whereDoesntHave('roles', function($q) {
            $q->where('name', 'admin');
        })
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('count(*) as count'))
            ->groupBy('year')
            ->pluck('count', 'year')
            ->toArray();
            
        $revenueYearly = WalletTransaction::where('type', 'order_payment')
            ->select(DB::raw('YEAR(created_at) as year'), DB::raw('sum(amount) as revenue'))
            ->groupBy('year')
            ->pluck('revenue', 'year')
            ->toArray();

        $years = collect(array_keys($customerYearly))
            ->merge(array_keys($revenueYearly))
            ->push($currentYear)
            ->unique()
            ->sort()
            ->reverse()
            ->values();

        $conversionRateData = [];
        foreach ($years as $yr) {
            $conversionRateData[] = [
                'year' => $yr,
                'customers' => $customerYearly[$yr] ?? 0,
                'revenue' => $revenueYearly[$yr] ?? 0
            ];
        }

        $customers = User::whereDoesntHave('roles', function($q) {
            $q->where('name', 'admin');
        })
            ->withSum(['walletTransactions as revenue' => function($q) {
                $q->where('type', 'order_payment');
            }], 'amount')
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.Customers',compact('customersTitle','iconCard','nbr','cardName','conversionRateData', 'customers'));
    }
    

}