<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AnalyticsReport;
use App\Http\Resources\AnalyticsReportResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Storage;

class AnalyticsReportController extends Controller
{
    /**
     * Display a listing of analytics reports
     */
    public function index(Request $request): JsonResponse
    {
        $request->validate([
            'type' => 'nullable|string',
            'per_page' => 'nullable|integer|min:1|max:100',
            'page' => 'nullable|integer|min:1'
        ]);

        $query = AnalyticsReport::with('generatedBy:id,name')
            ->latest('generated_at');

        if ($request->has('type')) {
            $query->byType($request->get('type'));
        }

        $perPage = $request->get('per_page', 15);
        $reports = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'data' => [
                'reports' => AnalyticsReportResource::collection($reports->items()),
                'pagination' => [
                    'current_page' => $reports->currentPage(),
                    'last_page' => $reports->lastPage(),
                    'per_page' => $reports->perPage(),
                    'total' => $reports->total(),
                ]
            ]
        ]);
    }

    /**
     * Display the specified analytics report
     */
    public function show(Request $request, AnalyticsReport $report): JsonResponse
    {
        $report->load('generatedBy:id,name');

        return response()->json([
            'success' => true,
            'data' => new AnalyticsReportResource($report)
        ]);
    }

    /**
     * Remove the specified analytics report
     */
    public function destroy(AnalyticsReport $report): JsonResponse
    {
        // Delete associated file if exists
        if ($report->file_path && Storage::exists($report->file_path)) {
            Storage::delete($report->file_path);
        }

        $report->delete();

        return response()->json([
            'success' => true,
            'message' => 'Analytics report deleted successfully'
        ]);
    }
}
