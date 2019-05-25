<?php

namespace Corp\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class MailtrapExample extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct(new \Corp\Repositories\MenusRepository(new \Corp\Menu));
        
        $this->template = env('THEME').'.contacts';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($request->isMethod('post')) {
            $messages = [
                'required' => "Поле :attribute обязательно к заполнению",
                'email' => "Поле :attribute должно содержать правильный адрес"
            ];

            $this->validate($request,[
                'name' => 'required|max:255',
                'email' => 'email|email',
                'text' => 'required'
            ],$messages);

            $data = $request->all();

        return $this-&gt;from($data['email'],$data['name'])
            -&gt;subject('Mailtrap Confirmation')
            -&gt;markdown(env('THEME').'.email')
            -&gt;with([
                'name' =&gt; 'New Mailtrap User',
                'link' =&gt; 'https://mailtrap.io/inboxes'
            ]);
        //return $this->view('view.name');
    }
}
