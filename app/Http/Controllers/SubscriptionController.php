<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Website;
use Illuminate\Http\Request;

class SubscriptionController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Website $website)
    {
        // get user
        $user = User::where('email', $request->only(['email']))->first();

        $rules = [
            'email' => ['required', 'exists:users',
                // Create custom subscription validation rule
                function ($attribute, $value, $fail) use ($request, $website) {
                    if ($website->users()->where('email', $request->email)->count() > 0) {
                        $fail('This subscription already exists.');
                    }
                }
            ],

        ];

        $messages = [
            'exists' => 'Email does not exist.',
            'required' => 'The :attribute field is required.',
        ];

        $this->validate(
            $request,
            $rules,
            $messages
        );

        $website->users()->save($user);
        return response(['subscribed' => true], 201);
    }
}
