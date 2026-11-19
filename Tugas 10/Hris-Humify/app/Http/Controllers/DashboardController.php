<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Models\LeaveBalance;
use App\Models\LeaveRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(Request $request): View
    {
        /** @var User $user */
        $user = Auth::user();
        $employee = $user->employee;

        if ($user->isManager()) {
            return $this->managerDashboard($user, $employee);
        }

        if ($user->isHr() || $user->isSuperAdmin()) {
            return $this->hrDashboard($user, $employee);
        }

        return $this->employeeDashboard($user, $employee);
    }

    private function employeeDashboard($user, $employee): View
    {
        $currentYear = (int) date('Y');

        $leaveBalances = collect();
        if ($employee) {
            $leaveBalances = LeaveBalance::with('leaveType')
                ->where('employee_id', $employee->id)
                ->where('year', $currentYear)
                ->get();
        }

        $pendingRequestsCount = 0;
        if ($employee) {
            $pendingRequestsCount = LeaveRequest::where('employee_id', $employee->id)
                ->where('status', 'pending')
                ->count();
        }

        $recentAttendances = collect();
        if ($employee) {
            $recentAttendances = Attendance::with('workShift')
                ->where('employee_id', $employee->id)
                ->orderBy('attendance_date', 'desc')
                ->limit(5)
                ->get();
        }

        return view('dashboard', [
            'user' => $user,
            'employee' => $employee,
            'leaveBalances' => $leaveBalances,
            'pendingRequestsCount' => $pendingRequestsCount,
            'recentAttendances' => $recentAttendances,
        ]);
    }

    private function managerDashboard($user, $employee): View
    {
        $subordinateIds = [];
        if ($employee) {
            $subordinateIds = Employee::where('supervisor_id', $employee->id)->pluck('id')->all();
        }

        $pendingReviewsCount = Attendance::whereIn('employee_id', $subordinateIds)
            ->where('review_status', 'pending')
            ->count();

        $pendingRequestsCount = LeaveRequest::whereIn('employee_id', $subordinateIds)
            ->where('status', 'pending')
            ->count();

        $today = Carbon::today()->format('Y-m-d');
        $teamPresentTodayCount = Attendance::whereIn('employee_id', $subordinateIds)
            ->whereDate('attendance_date', $today)
            ->whereNotNull('check_in_time')
            ->count();

        $teamMembersCount = count($subordinateIds);

        $pendingReviews = Attendance::with(['employee.department', 'workShift'])
            ->whereIn('employee_id', $subordinateIds)
            ->where('review_status', 'pending')
            ->orderBy('attendance_date', 'desc')
            ->limit(5)
            ->get();

        $pendingRequests = LeaveRequest::with(['employee.department', 'leaveType'])
            ->whereIn('employee_id', $subordinateIds)
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('manager.dashboard', [
            'user' => $user,
            'employee' => $employee,
            'pendingReviewsCount' => $pendingReviewsCount,
            'pendingRequestsCount' => $pendingRequestsCount,
            'teamPresentTodayCount' => $teamPresentTodayCount,
            'teamMembersCount' => $teamMembersCount,
            'pendingReviews' => $pendingReviews,
            'pendingRequests' => $pendingRequests,
        ]);
    }

    private function hrDashboard($user, $employee): View
    {
        $totalEmployees = Employee::whereIn('employee_status', ['active', 'aktif'])->count();

        $pendingReviewsCount = Attendance::where('review_status', 'pending')->count();
        $pendingRequestsCount = LeaveRequest::where('status', 'pending')->count();

        $today = Carbon::today()->format('Y-m-d');
        $presentTodayCount = Attendance::whereDate('attendance_date', $today)
            ->whereNotNull('check_in_time')
            ->count();

        $pendingReviews = Attendance::with(['employee.department', 'workShift'])
            ->where('review_status', 'pending')
            ->orderBy('attendance_date', 'desc')
            ->limit(5)
            ->get();

        $pendingRequests = LeaveRequest::with(['employee.department', 'leaveType'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        return view('hr.dashboard', [
            'user' => $user,
            'employee' => $employee,
            'totalEmployees' => $totalEmployees,
            'pendingReviewsCount' => $pendingReviewsCount,
            'pendingRequestsCount' => $pendingRequestsCount,
            'presentTodayCount' => $presentTodayCount,
            'pendingReviews' => $pendingReviews,
            'pendingRequests' => $pendingRequests,
        ]);
    }
}
