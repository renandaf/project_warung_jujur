<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckDaganganOwnership
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Retrieve the item ID from the request, assuming the ID is passed as a query parameter or route parameter
        $itemId = $request->input('id');
        // Or: $itemId = $request->route('item_id');

        // Retrieve the authenticated user
        $user = $request->user();

        // Check if the item belongs to the user
        if (!$user->ownsDagangan($itemId)) {
            return response()->json(['message' => 'This item does not belong to you.'], 403);
        }
        return $next($request);
    }
}
