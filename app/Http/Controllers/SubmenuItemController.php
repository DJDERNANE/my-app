<?php

namespace App\Http\Controllers;

use App\Models\submenuItem;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SubmenuItemController extends Controller
{
    /**
     * Display a listing of the submenu items.
     */
    public function index(): JsonResponse
    {
        $submenuItems = submenuItem::all();
        
        return response()->json([
            'success' => true,
            'data' => $submenuItems
        ]);
    }
} 