<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\WalletTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function getRegistrationStats(string $range): array
    {
        $startDate = null;
        $prevStartDate = null;
        $prevEndDate = null;
        $groupByFormat = null;
        $labelFormat = null;
        $days = 7;

        switch ($range) {
            case 'today':
                $startDate = Carbon::today();
                $prevStartDate = Carbon::yesterday();
                $prevEndDate = Carbon::today()->subSecond();
                $groupByFormat = '%H:00';
                $labelFormat = 'H:00';
                $days = 1;
                break;
            case 'yesterday':
                $startDate = Carbon::yesterday();
                $prevStartDate = Carbon::yesterday()->subDay();
                $prevEndDate = Carbon::yesterday()->subSecond();
                $groupByFormat = '%H:00';
                $labelFormat = 'H:00';
                $days = 1;
                break;
            case '30days':
                $startDate = Carbon::now()->subDays(30)->startOfDay();
                $prevStartDate = Carbon::now()->subDays(60)->startOfDay();
                $prevEndDate = Carbon::now()->subDays(30)->startOfDay()->subSecond();
                $groupByFormat = '%Y-%m-%d';
                $labelFormat = 'd M';
                $days = 30;
                break;
            case '90days':
                $startDate = Carbon::now()->subDays(90)->startOfDay();
                $prevStartDate = Carbon::now()->subDays(180)->startOfDay();
                $prevEndDate = Carbon::now()->subDays(90)->startOfDay()->subSecond();
                $groupByFormat = '%Y-%m-%d';
                $labelFormat = 'd M';
                $days = 90;
                break;
            case '7days':
            default:
                $startDate = Carbon::now()->subDays(7)->startOfDay();
                $prevStartDate = Carbon::now()->subDays(14)->startOfDay();
                $prevEndDate = Carbon::now()->subDays(7)->startOfDay()->subSecond();
                $groupByFormat = '%Y-%m-%d';
                $labelFormat = 'd M';
                $days = 7;
                break;
        }

        // Count current period registrations
        $currentCount = User::where('created_at', '>=', $startDate)->count();

        // Count previous period registrations
        $prevCount = User::whereBetween('created_at', [$prevStartDate, $prevEndDate])->count();

        // Calculate percentage growth
        $percentage = 0.0;
        if ($prevCount > 0) {
            $percentage = (($currentCount - $prevCount) / $prevCount) * 100;
        } elseif ($currentCount > 0) {
            $percentage = 100.0;
        }
        $percentage = round($percentage, 1);

        // Fetch grouped registrations for the chart
        $registrations = User::where('created_at', '>=', $startDate)
            ->select(DB::raw("DATE_FORMAT(created_at, '{$groupByFormat}') as date_label"), DB::raw('count(*) as aggregate'))
            ->groupBy('date_label')
            ->orderBy('date_label', 'asc')
            ->pluck('aggregate', 'date_label')
            ->toArray();

        // Build complete time series data and labels to avoid gaps
        $chartData = [];
        $chartLabels = [];

        if ($days === 1) {
            // Group by hour
            for ($i = 0; $i < 24; $i++) {
                $hourLabel = sprintf('%02d:00', $i);
                $chartLabels[] = $hourLabel;
                $chartData[] = $registrations[$hourLabel] ?? 0;
            }
        } else {
            // Group by day
            for ($i = $days - 1; $i >= 0; $i--) {
                $date = Carbon::now()->subDays($i);
                $key = $date->format('Y-m-d');
                $chartLabels[] = $date->format($labelFormat);
                $chartData[] = $registrations[$key] ?? 0;
            }
        }

        return [
            'count' => $currentCount,
            'percentage' => abs($percentage),
            'trend' => $percentage >= 0 ? 'up' : 'down',
            'chart_data' => $chartData,
            'chart_labels' => $chartLabels,
            'range_label' => $this->getRangeLabel($range)
        ];
    }

    public function getLatestCustomersWithRevenue(int $limit = 3): array
    {
        $users = User::orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->take($limit)
            ->get();

        $result = [];
        foreach ($users as $user) {
            $revenue = WalletTransaction::where('user_id', $user->id)
                ->where('type', 'order_payment')
                ->sum('amount');

            $initials = '';
            if (!empty($user->fullName)) {
                $words = explode(' ', $user->fullName);
                foreach ($words as $word) {
                    $initials .= strtoupper(substr($word, 0, 1));
                }
                $initials = substr($initials, 0, 2);
            }
            if (empty($initials)) {
                $initials = strtoupper(substr($user->username ?? 'U', 0, 2));
            }

            $result[] = [
                'id' => $user->id,
                'name' => $user->fullName ?: $user->username,
                'email' => $user->email,
                'revenue' => $revenue,
                'initials' => $initials,
                'profile_image' => $user->profileImage
            ];
        }

        return $result;
    }

    private function getRangeLabel(string $range): string
    {
        switch ($range) {
            case 'today': return t('admin.dashboard.users_today');
            case 'yesterday': return t('admin.dashboard.users_yesterday');
            case '30days': return t('admin.dashboard.users_this_month');
            case '90days': return t('admin.dashboard.users_last_90_days');
            case '7days':
            default:
                return t('admin.dashboard.users_this_week');
        }
    }
}