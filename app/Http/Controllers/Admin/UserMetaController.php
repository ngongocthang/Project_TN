<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserMeta;
use Illuminate\Http\Request;
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
            toastr()->timeOut(7000)->closeButton()->addError('An error occurred: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}
