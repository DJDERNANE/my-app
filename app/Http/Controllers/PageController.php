<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class PageController extends Controller
{
    /**
     * Display a listing of the pages.
     */
    public function index(): JsonResponse
    {
        $pages = Page::with('submenuItem')->get();
        
        return response()->json([
            'success' => true,
            'data' => $pages
        ]);
    }

    /**
     * Display the specified page.
     */
    public function show(Page $page): JsonResponse
    {
        $page->load('submenuItem');
        
        return response()->json([
            'success' => true,
            'data' => $page
        ]);
    }

    /**
     * Get page by submenu item.
     */
    public function getBySubmenu($submenuId): JsonResponse
    {
        $page = Page::where('submenu_id', $submenuId)
            ->with('submenuItem')
            ->first();
        
        return response()->json([
            'success' => true,
            'data' => $page
        ]);
    }
} 