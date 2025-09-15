<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request, User $user)
    {
        // Получаем активную вкладку, по умолчанию вопросы
        $activeTab = $request->query('tab', 'questions');

        if ($activeTab == 'answers') {
            $items = $user->answers()->latest()->paginate(10);
        } else {
            $items = $user->questions()
                ->withCount('answers')
                ->latest()->paginate(10);
        }

        return view('user.profile', [
            'user' => $user,
            'items' => $items,
            'activeTab' => $activeTab,
        ]);
    }
}
