<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProfileRequest;
use App\Models\Profile;
use Illuminate\Support\Facades\DB;

class MypageController extends Controller
{
    public function index()
    {
        return view('mypage.index');
    }

    public function show(Request $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $soldItems = $user->sellingItems()->where('is_sold', true)->get();
        $notSoldItems = $user->sellingItems()->where('is_sold', false)->get();

        $purchases = $user->purchases()->with('item')->get();
        $purchasedItems = $purchases->pluck('item');

        $tab = $request->query('tab', 'selling');

        return view('mypage.mypage', compact(
            'user',
            'soldItems',
            'notSoldItems',
            'purchasedItems',
            'tab'
        ));
    }

    public function editProfile()
    {
        /** @var User $user */
        $user = Auth::user();

        $profile = Profile::firstOrCreate(
            ['user_id' => $user->id],
            [
                'post_code' => '',
                'address' => '',
                'building' => '',
                'profile_image_url' => null,
            ]
        );

        return view('mypage.profile_edit', compact('profile'));
    }

    public function updateProfile(ProfileRequest $request)
    {
        /** @var User $user */
        $user = Auth::user();

        $profileData = $request->only([
            'post_code',
            'address',
            'building',
        ]);

        DB::transaction(function () use ($request, $user, &$profileData) {

            $user->name = $request->name;
            $user->save();

            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('profiles', 'public');
                $profileData['profile_image_url'] = $imagePath;
            }

            Profile::updateOrCreate(
                ['user_id' => $user->id],
                $profileData
            );
        });

        return redirect()
            ->route('profile.edit')
            ->with('success', 'プロフィールを更新しました。');
    }
}
