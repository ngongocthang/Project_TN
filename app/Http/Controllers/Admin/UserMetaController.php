<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserMeta;
use Throwable;

class UserMetaController extends Controller
{

    /**
     * Show user meta
     */
    public function show(string $id)
    {
        try {
            $user = UserMeta::findOrFail($id);
            return view('admin.user-meta.show', compact('user'));
        } catch (Throwable $e) {
            return ('An error occurred: ' . $e->getMessage());
        }
    }
}
