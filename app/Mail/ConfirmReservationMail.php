<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ConfirmReservationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $date;
    public $hours;
    public $number_of_people;
    public $name;
    public $email;
    public $number;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($date,$hours,$number_of_people,$name,$email,$number)
    {
        $this->date = $date;
        $this->hours = $hours;
        $this->number_of_people = $number_of_people;
        $this->name = $name;
        $this->email = $email;
        $this->number = $number;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Confirmation de votre réservation de sortie en bateau',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.confirmreservation',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
