<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactStoreRequest;
use App\Mail\ContactRequested;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;

class ContactController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ContactStoreRequest $request
     * @return Factory|View
     */
    public function store(ContactStoreRequest $request)
    {
        $recaptcha = $request->input('g-recaptcha-response', false);

        if (!$recaptcha) {
            return back()->withErrors([
                'recaptcha' => trans('recaptcha.failed'),
            ])->withInput();
        }

        $data = $request->except('_token');
        $this->sendMail($data);

        return view('contact.store');
    }

    private function sendMail(array $data)
    {
        $mailable = new ContactRequested($data);

        $mail = Mail::to(config('mail.to.address'));

        /*if (config('mail.reply_to.address')) {
            $mailable->cc(config('mail.reply_to.address'), config('mail.reply_to.name'));
        }*/

        $mail->send($mailable);
    }
}
