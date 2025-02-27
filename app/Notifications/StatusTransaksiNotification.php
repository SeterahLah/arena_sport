<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class StatusTransaksiNotification extends Notification
{
    use Queueable;

    private $transaksi;

    public function __construct($transaksi)
    {
        $this->transaksi = $transaksi;
    }

    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Status Transaksi Diperbarui')
            ->greeting('Halo, ' . $notifiable->name)
            ->line('Status transaksi Anda telah diperbarui menjadi: ' . ucfirst($this->transaksi->status))
            ->action('Lihat Detail', url('/transaksi/' . $this->transaksi->id))
            ->line('Terima kasih telah berbelanja dengan kami!');
    }

    public function toArray($notifiable)
    {
        return [
            'transaksi_id' => $this->transaksi->id,
            'status' => $this->transaksi->status,
            'message' => 'Status transaksi Anda telah diperbarui menjadi: ' . ucfirst($this->transaksi->status),
        ];
    }
}
