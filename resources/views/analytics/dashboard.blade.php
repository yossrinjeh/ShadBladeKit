<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl leading-tight">
                Analytics Dashboard
            </h2>
            <div class="flex items-center space-x-2">
                <x-ui.button variant="outline" size="sm" onclick="refreshData()">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                    </svg>
                    Refresh
                </x-ui.button>
                <x-ui.button variant="outline" size="sm">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Export Report
                </x-ui.button>
            </div>
        </div>
    </x-slot>

    <div class="space-y-6">
        <!-- KPI Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Total Users -->
            <x-ui.card>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-blue-100 dark:bg-blue-900/20 rounded-lg">
                            <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.5-9a2.5 2.5 0 11-5 0 2.5 2.5 0 015 0z" />
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-medium text-muted-foreground">Total Users</p>
                            <div class="flex items-center">
                                <p class="text-2xl font-bold">{{ number_format($metrics['total_users']['value']) }}</p>
                                <span class="ml-2 text-sm {{ $metrics['total_users']['trend'] === 'up' ? 'text-green-600' : 'text-red-600' }}">
                                    {{ $metrics['total_users']['trend'] === 'up' ? '+' : '' }}{{ $metrics['total_users']['change'] }}%
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </x-ui.card>

            <!-- Active Users -->
            <x-ui.card>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-green-100 dark:bg-green-900/20 rounded-lg">
                            <svg class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-medium text-muted-foreground">Active Users</p>
                            <div class="flex items-center">
                                <p class="text-2xl font-bold">{{ number_format($metrics['active_users']['value']) }}</p>
                                <span class="ml-2 text-sm text-green-600">
                                    {{ $metrics['active_users']['percentage'] }}%
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </x-ui.card>

            <!-- Admin Users -->
            <x-ui.card>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-purple-100 dark:bg-purple-900/20 rounded-lg">
                            <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-medium text-muted-foreground">Admin Users</p>
                            <div class="flex items-center">
                                <p class="text-2xl font-bold">{{ number_format($metrics['admin_users']['value']) }}</p>
                                <span class="ml-2 text-sm text-muted-foreground">
                                    {{ $metrics['admin_users']['percentage'] }}%
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </x-ui.card>

            <!-- Recent Registrations -->
            <x-ui.card>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-orange-100 dark:bg-orange-900/20 rounded-lg">
                            <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6" />
                            </svg>
                        </div>
                        <div class="ml-4 flex-1">
                            <p class="text-sm font-medium text-muted-foreground">New This Week</p>
                            <div class="flex items-center">
                                <p class="text-2xl font-bold">{{ number_format($metrics['recent_registrations']['value']) }}</p>
                                <span class="ml-2 text-xs text-muted-foreground">
                                    {{ $metrics['recent_registrations']['period'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </x-ui.card>
        </div>

        <!-- Charts Row -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <!-- User Registrations Chart -->
            <x-ui.card>
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">User Registrations (30 Days)</h3>
                    <div class="h-64">
                        <canvas id="registrationsChart"></canvas>
                    </div>
                </div>
            </x-ui.card>

            <!-- Role Distribution Chart -->
            <x-ui.card>
                <div class="p-6">
                    <h3 class="text-lg font-semibold mb-4">Role Distribution</h3>
                    <div class="h-64">
                        <canvas id="rolesChart"></canvas>
                    </div>
                </div>
            </x-ui.card>
        </div>

        <!-- Activity Timeline -->
        <x-ui.card>
            <div class="p-6">
                <h3 class="text-lg font-semibold mb-4">Recent Activity</h3>
                <div class="space-y-4">
                    @foreach($recentActivity as $activity)
                    <div class="flex items-center space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center">
                                @if($activity['icon'] === 'user-plus')
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                                </svg>
                                @elseif($activity['icon'] === 'shield-check')
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                </svg>
                                @else
                                <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                </svg>
                                @endif
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm font-medium">{{ $activity['message'] }}</p>
                            <p class="text-xs text-muted-foreground">{{ $activity['user'] }} • {{ $activity['time'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </x-ui.card>
    </div>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // User Registrations Chart
        const registrationsCtx = document.getElementById('registrationsChart').getContext('2d');
        new Chart(registrationsCtx, {
            type: 'line',
            data: {
                labels: @json($chartData['user_registrations']['labels']),
                datasets: [{
                    label: 'New Users',
                    data: @json($chartData['user_registrations']['data']),
                    borderColor: 'rgb(59, 130, 246)',
                    backgroundColor: 'rgba(59, 130, 246, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        // Role Distribution Chart
        const rolesCtx = document.getElementById('rolesChart').getContext('2d');
        new Chart(rolesCtx, {
            type: 'doughnut',
            data: {
                labels: @json($chartData['role_distribution']['labels']),
                datasets: [{
                    data: @json($chartData['role_distribution']['data']),
                    backgroundColor: [
                        'rgb(59, 130, 246)',
                        'rgb(16, 185, 129)',
                        'rgb(245, 158, 11)',
                        'rgb(239, 68, 68)'
                    ]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });

        function refreshData() {
            // Simulate refresh
            location.reload();
        }
    </script>
</x-app-layout>