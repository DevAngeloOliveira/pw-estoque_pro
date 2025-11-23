<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    public $notifications = [];
    public $showNotifications = false;

    protected $listeners = [
        'notify' => 'addNotification',
        'notifySuccess' => 'notifySuccess',
        'notifyError' => 'notifyError',
        'notifyWarning' => 'notifyWarning',
        'notifyInfo' => 'notifyInfo',
    ];

    public function mount()
    {
        $this->loadNotifications();
    }

    public function loadNotifications()
    {
        // Carregar notificações da sessão
        $this->notifications = session('notifications', []);
    }

    public function addNotification($message, $type = 'info', $duration = 5000)
    {
        $notification = [
            'id' => uniqid(),
            'message' => $message,
            'type' => $type, // success, error, warning, info
            'timestamp' => now()->toDateTimeString(),
            'duration' => $duration
        ];

        array_unshift($this->notifications, $notification);

        // Limitar a 10 notificações
        $this->notifications = array_slice($this->notifications, 0, 10);

        // Salvar na sessão
        session(['notifications' => $this->notifications]);

        $this->emit('notificationAdded', $notification);
    }

    public function notifySuccess($message, $duration = 5000)
    {
        $this->addNotification($message, 'success', $duration);
    }

    public function notifyError($message, $duration = 8000)
    {
        $this->addNotification($message, 'error', $duration);
    }

    public function notifyWarning($message, $duration = 6000)
    {
        $this->addNotification($message, 'warning', $duration);
    }

    public function notifyInfo($message, $duration = 5000)
    {
        $this->addNotification($message, 'info', $duration);
    }

    public function removeNotification($notificationId)
    {
        $this->notifications = array_filter($this->notifications, function ($notification) use ($notificationId) {
            return $notification['id'] !== $notificationId;
        });

        $this->notifications = array_values($this->notifications);
        session(['notifications' => $this->notifications]);
    }

    public function clearAll()
    {
        $this->notifications = [];
        session()->forget('notifications');
    }

    public function toggleNotifications()
    {
        $this->showNotifications = !$this->showNotifications;
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
