<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Services\AlertServiceInterface;

class EmailVerificationNotificationController extends Controller
{
    public function __construct(private readonly AlertServiceInterface $alertService)
    {
    }
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->user()->sendEmailVerificationNotification();

        $this->alertService->success('A new verification link has been sent to the email address you provided during registration.');
        return back();
    }
}
