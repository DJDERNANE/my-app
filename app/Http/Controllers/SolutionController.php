<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Solution;

class SolutionController extends Controller
{
    public function getBySubmenu($submenuId)
    {
        $solutions = Solution::where('submenu_item_id', $submenuId)->get();
        return response()->json($solutions);
    }

    public function getSolutionWithDetails($solutionId)
    {
        $solution = Solution::with(['datil','detail.sections'])->find($solutionId);
        
        if (!$solution) {
            return response()->json(['message' => 'Solution not found'], 404);
        }
        
        return response()->json([
            'success' => true,
            'data' => $solution
        ]);
    }
}
