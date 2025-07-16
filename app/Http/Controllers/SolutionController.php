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
}
