<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Queue\SerializesModels;

class ScheduledReportMail extends Mailable
{
    use Queueable, SerializesModels;

    public $filePath;
    public $period;

    public function __construct($filePath, $period)
    {
        $this->filePath = filePath;
        $this->period = $period; // 'Hebdomadaire' ou 'Mensuel'
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: "[Rapport {$this->period}] Statistiques et Activités des Visites",
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.scheduled-report',
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromPath($this->filePath)
                ->as("Rapport_{$this->period}_" . now()->format('Y_m_d') . '.xlsx')
                ->withMime('application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'),
        ];
    }
}