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

            <!-- Buttons for Activation Section -->
            <div class="bg-white shadow-md rounded-lg mb-6 p-6">
                <h2 class="text-lg font-medium text-gray-900 mb-4">
                    <i class="fas fa-location-arrow ml-2 text-indigo-600"></i> تفعيل جمع البيانات
                </h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <!-- Activate Data Collection Button -->
                    <form action="{{ route('activate.location') }}" method="GET">
                        <button type="submit" class="inline-flex items-center px-6 py-3 text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            تفعيل جمع البيانات
                        </button>
                    </form>
                    <!-- Deactivate Data Collection Button -->
                    <form action="{{ route('deactivate.location') }}" method="GET">
                        <button type="submit" class="inline-flex items-center px-6 py-3 text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            إلغاء تفعيل جمع البيانات
                        </button>
                    </form>
                    <!-- Delete All Data Button -->
                    <form action="{{ route('delete.location') }}" method="GET">
                        <button type="submit" class="inline-flex items-center px-6 py-3 text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            حذف جميع البيانات
                        </button>
                    </form>
                    <!-- Insert Email Button -->
                    <form action="{{ route('insert.email.admin') }}" method="POST" class="flex items-center">
                        @csrf 
                        <input type="text" name="email" class="input-group p-3 border rounded-md" value="{{$adminEmail}}" placeholder="ادخل البريد الالكتروني" required />
                        <button type="submit" class="inline-flex items-center px-6 py-3 text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            تأكيد الإرسال
                        </button>
                    </form>
                </div>
            </div>

            <!-- Filters Section -->
            <div class="bg-white shadow-md rounded-lg mb-6 overflow-hidden">
                <div class="bg-gray-50 px-4 py-3 border-b border-gray-200 flex justify-between items-center">
                    <h2 class="text-lg font-medium text-gray-900">
                        <i class="fas fa-filter ml-2 text-indigo-600"></i> الفلاتر
                    </h2>
                </div>
                <div id="filter-section" class="filter-section px-4 py-4 bg-white">
                    <form id="filter-form" action="{{ route('admin.dashboard') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <!-- Date Filter -->
                        <div>
                            <label for="selected_date" class="block text-sm font-medium text-gray-700 mb-1">التاريخ</label>
                            <input type="date" id="selected_date" name="selected_date" value="{{ request('selected_date') }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <!-- IP Filter (Partial Match) -->
                        <div>
                            <label for="ip" class="block text-sm font-medium text-gray-700 mb-1">عنوان IP</label>
                            <input type="text" id="ip" name="ip" value="{{ request('ip') }}" placeholder="ابحث عن جزء من عنوان IP" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                        </div>

                        <div class="md:col-span-2 flex justify-end mt-2">
                            <button type="submit" class="mr-2 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <i class="fas fa-filter ml-2"></i> تطبيق الفلاتر
                            </button>
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                <i class="fas fa-sync ml-2"></i> إعادة الضبط
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
