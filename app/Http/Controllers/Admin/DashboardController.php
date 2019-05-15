<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Program;
use App\User;
use App\Subscription;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function getDashboard()
    {

    	$totalUsers = User::where('status',1)->count();
        $totalPrograms = Program::where('status',1)->count();
        $totalSubscribers = Subscription::where('status',1)->count();
        $totalUnsubscribers = Subscription::where('status',0)->count();
        $recentUsers = User::where('roll',3)->whereDate('created_at', '>', Carbon::now()->subDays(30))->get();
        $recentSubscribers = Subscription::whereDate('created_at', '>', Carbon::now()->subDays(30))->where('status',1)->orWhere('status',2)->get();

        $recentunSubscribers = Subscription::whereDate('created_at', '>', Carbon::now()->subDays(30))->where('status',0)->get();
    	return view('admin.index',compact('totalUsers','totalPrograms','totalUnsubscribers','totalSubscribers','recentUsers','recentSubscribers','recentunSubscribers'));
    }


public function statisticsData($year)
    {
        $data = collect();

        for ($i=1; $i <= 12; $i++) { 
            $startingTime = mktime(0, 0, 0, $i, 1, $year);
            $endingTime = strtotime('last day of this month', $startingTime);

            $startingDate = date("Y-m-d", $startingTime);
            $endingDate = date("Y-m-d", $endingTime);

            $invoice = 100;
            $invoiceAmount = 1000;
            $invoiceTax = 200;
            
            $expense = 200;
            $payout = 200;
            $otherExpense = 500;

            $data->push([
                'month' => $i,
                'year' => $year,
                'invoice' => $invoiceAmount,
                'tax' => $invoiceTax,
                'expense' => $expense,
                'payout' => $payout,
                'other_expense' => $otherExpense
            ]);
        }

        $overall = collect([
            'invoice' => 100,
            'tax' => 150,
            'expense' => 200,
            'payout' => 300,
            'other_expense' => 500,
        ]);

        $stats = collect([
            "overall" => $overall,
            "data" => $data
        ]);


        return response()->json($stats);
    }
}