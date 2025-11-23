<div>
    <!-- Notification Bell Icon -->
    <div class="relative">
        <button wire:click="toggleNotifications"
            class="relative p-2 text-gray-600 hover:text-gray-800 focus:outline-none">
            <i class="fas fa-bell text-xl"></i>
            @if (count($notifications) > 0)
                <span
                    class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                    {{ count($notifications) }}
                </span>
            @endif
        </button>

        <!-- Notifications Dropdown -->
        @if ($showNotifications)
            <div class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-xl z-50 border border-gray-200">
                <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Notificações</h3>
                    @if (count($notifications) > 0)
                        <button wire:click="clearAll" class="text-sm text-red-600 hover:text-red-800">
                            Limpar todas
                        </button>
                    @endif
                </div>

                <div class="max-h-96 overflow-y-auto">
                    @forelse($notifications as $notification)
                        <div class="px-4 py-3 border-b border-gray-100 hover:bg-gray-50 transition-colors duration-150">
                            <div class="flex items-start justify-between">
                                <div class="flex items-start space-x-3 flex-1">
                                    <div class="flex-shrink-0">
                                        @if ($notification['type'] === 'success')
                                            <div
                                                class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-check text-green-600"></i>
                                            </div>
                                        @elseif($notification['type'] === 'error')
                                            <div
                                                class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-times text-red-600"></i>
                                            </div>
                                        @elseif($notification['type'] === 'warning')
                                            <div
                                                class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-exclamation text-yellow-600"></i>
                                            </div>
                                        @else
                                            <div
                                                class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                                                <i class="fas fa-info text-blue-600"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-800">{{ $notification['message'] }}</p>
                                        <p class="text-xs text-gray-500 mt-1">
                                            {{ \Carbon\Carbon::parse($notification['timestamp'])->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                <button wire:click="removeNotification('{{ $notification['id'] }}')"
                                    class="ml-2 text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-times text-sm"></i>
                                </button>
                            </div>
                        </div>
                    @empty
                        <div class="px-4 py-8 text-center text-gray-500">
                            <i class="fas fa-bell-slash text-4xl mb-2"></i>
                            <p>Nenhuma notificação</p>
                        </div>
                    @endforelse
                </div>
            </div>
        @endif
    </div>

    <!-- Toast Notifications (Auto-hide) -->
    <div class="fixed bottom-4 right-4 z-50 space-y-2">
        @foreach ($notifications as $index => $notification)
            @if ($index < 3)
                <div id="toast-{{ $notification['id'] }}"
                    class="flex items-center w-full max-w-xs p-4 text-gray-500 bg-white rounded-lg shadow-lg animate-slide-in-right"
                    x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, {{ $notification['duration'] }})">

                    <div
                        class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 rounded-lg
                                {{ $notification['type'] === 'success' ? 'text-green-500 bg-green-100' : '' }}
                                {{ $notification['type'] === 'error' ? 'text-red-500 bg-red-100' : '' }}
                                {{ $notification['type'] === 'warning' ? 'text-orange-500 bg-orange-100' : '' }}
                                {{ $notification['type'] === 'info' ? 'text-blue-500 bg-blue-100' : '' }}">
                        <i
                            class="fas fa-{{ $notification['type'] === 'success' ? 'check' : ($notification['type'] === 'error' ? 'times' : ($notification['type'] === 'warning' ? 'exclamation' : 'info')) }}"></i>
                    </div>

                    <div class="ml-3 text-sm font-normal flex-1">
                        {{ $notification['message'] }}
                    </div>

                    <button wire:click="removeNotification('{{ $notification['id'] }}')"
                        class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex h-8 w-8">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            @endif
        @endforeach
    </div>

    <style>
        @keyframes slide-in-right {
            from {
                transform: translateX(100%);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        .animate-slide-in-right {
            animation: slide-in-right 0.3s ease-out;
        }
    </style>
</div>
