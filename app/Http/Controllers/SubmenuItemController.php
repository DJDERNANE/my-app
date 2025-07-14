<?php

namespace App\Http\Controllers;

use App\Models\SubmenuItem;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SubmenuItemController extends Controller
{
    /**
     * Display a listing of the submenu items.
     */
    public function index(): JsonResponse
    {
        $submenuItems = SubmenuItem::all();
        
        return response()->json([
            'success' => true,
            'data' => $submenuItems
        ]);
    }
} 