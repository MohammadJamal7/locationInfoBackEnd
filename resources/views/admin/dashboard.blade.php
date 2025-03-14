<!-- resources/views/admin/dashboard.blade.php -->
<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم بيانات المواقع</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Import Arabic font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Cairo', sans-serif;
        }
        .stats-card {
            transition: all 0.3s ease;
        }
        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .filter-section {
            transition: max-height 0.3s ease;
            overflow: hidden;
        }
        .location-row {
            transition: all 0.2s ease;
        }
        .location-row:hover {
            background-color: rgba(243, 244, 246, 1);
        }
        /* Fixed RTL issues for flatpickr */
        .flatpickr-calendar {
            direction: rtl;
        }
        /* Map container styles */
        .map-container {
            height: 400px;
            width: 100%;
            border-radius: 0.5rem;
        }
        /* Custom scrollbar for the table */
        .custom-scrollbar::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #555;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Navbar -->
        <nav class="bg-white shadow-md">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <div class="flex-shrink-0 flex items-center">
                            <i class="fas fa-map-marker-alt text-indigo-600 text-2xl ml-2"></i>
                            <span class="text-gray-900 font-semibold text-lg">لوحة تحكم المواقع</span>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <button id="export-btn" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-md text-sm font-medium flex items-center">
                            <i class="fas fa-file-export ml-2"></i> تصدير البيانات
                        </button>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
            <!-- Flash Messages -->
            @if(session('success'))
                <div class="bg-green-100 border-r-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Stats Cards -->
            <div class="mb-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="stats-card bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                                <i class="fas fa-database text-white"></i>
                            </div>
                            <div class="mr-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">إجمالي السجلات</dt>
                                    <dd class="text-3xl font-semibold text-gray-900">{{ $stats['total'] }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stats-card bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-green-500 rounded-md p-3">
                                <i class="fas fa-calendar-day text-white"></i>
                            </div>
                            <div class="mr-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">اليوم</dt>
                                    <dd class="text-3xl font-semibold text-gray-900">{{ $stats['today'] }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stats-card bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-blue-500 rounded-md p-3">
                                <i class="fas fa-calendar-week text-white"></i>
                            </div>
                            <div class="mr-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">هذا الأسبوع</dt>
                                    <dd class="text-3xl font-semibold text-gray-900">{{ $stats['this_week'] }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="stats-card bg-white overflow-hidden shadow rounded-lg">
                    <div class="px-4 py-5 sm:p-6">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-purple-500 rounded-md p-3">
                                <i class="fas fa-calendar-alt text-white"></i>
                            </div>
                            <div class="mr-5 w-0 flex-1">
                                <dl>
                                    <dt class="text-sm font-medium text-gray-500 truncate">هذا الشهر</dt>
                                    <dd class="text-3xl font-semibold text-gray-900">{{ $stats['this_month'] }}</dd>
                                </dl>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Map Visualization -->
            <div class="bg-white shadow-md rounded-lg mb-6 overflow-hidden">
                <div class="px-4 py-5 sm:p-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">خريطة المواقع</h2>
                    <div id="map" class="map-container"></div>
                </div>
            </div>

            <!-- Filters -->
            <div class="bg-white shadow-md rounded-lg mb-6 overflow-hidden">
                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-medium text-gray-900">
                        <i class="fas fa-filter ml-2 text-indigo-600"></i> الفلاتر
                    </h2>
                    <button id="toggle-filters" class="text-indigo-600 hover:text-indigo-800">
                        <i class="fas fa-chevron-down"></i>
                    </button>
                </div>
                <div id="filter-section" class="filter-section px-4 py-4 bg-white">
                    <form id="filter-form" action="{{ route('admin.dashboard') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="selected_date" class="block text-sm font-medium text-gray-700 mb-1">التاريخ</label>
                            <input type="date" id="selected_date" name="selected_date" value="{{ request('selected_date') }}" placeholder="اختر التاريخ" class="date-picker shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div>
                            <label for="ip" class="block text-sm font-medium text-gray-700 mb-1">عنوان IP</label>
                            <select id="ip" name="ip" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                <option value="">جميع عناوين IP</option>
                                @foreach($uniqueIps as $ip)
                                    <option value="{{ $ip }}" {{ request('ip') == $ip ? 'selected' : '' }}>{{ $ip }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="md:col-span-2 flex justify-end mt-2">
                            <button type="submit" class="mr-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus: