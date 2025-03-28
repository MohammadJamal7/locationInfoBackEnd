<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>لوحة تحكم المواقع</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        body {
            font-family: 'Cairo', Arial, sans-serif;
            background-color: #f4f6f9;
        }
        .custom-shadow {
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .hover-lift {
            transition: all 0.3s ease;
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px -5px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="min-h-screen">
        <!-- Gradient Navbar -->
        <nav class="bg-gradient-to-r from-indigo-600 to-purple-600 shadow-lg">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center">
                        <i class="fas fa-map-marker-alt text-white text-2xl ml-3"></i>
                        <span class="text-white font-bold text-xl">لوحة تحكم المواقع</span>
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content Container -->
        <div class="container mx-auto px-4 py-8 space-y-6">


            
            @if(session('success'))
            <div id="success-toast" class="fixed top-0 right-0 m-6 w-80  p-5 bg-indigo-800 text-white rounded-lg shadow-xl opacity-0 transform translate-x-full transition-all duration-500 ease-in-out" role="alert">
                <div class="flex items-center">
                    <!-- Icon -->
                    <i class="fas fa-check-circle text-4xl ml-4"></i> <!-- More space and larger icon -->
                    <!-- Message -->
                    <span class="font-semibold text-lg">{{ session('success') }}</span>
                </div>
            </div>
    

            <script>
                window.onload = function() {
                    const toast = document.getElementById('success-toast');
                    toast.classList.remove('opacity-0', 'translate-x-full');
                    toast.classList.add('opacity-100', 'translate-x-0');
                    
                    // Hide the toast after 5 seconds
                    setTimeout(function() {
                        toast.classList.remove('opacity-100', 'translate-x-0');
                        toast.classList.add('opacity-0', 'translate-x-full');
                    }, 5000); // 5 seconds
                };
            </script>
        @endif
        
        
              
            <!-- Stats Cards Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="bg-white border border-gray-200 rounded-lg p-6 hover-lift custom-shadow flex items-center space-x-reverse space-x-4">
                    <div class="bg-indigo-500 text-white p-4 rounded-full">
                        <i class="fas fa-database text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm mb-1">إجمالي السجلات</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</h3>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg p-6 hover-lift custom-shadow flex items-center space-x-reverse space-x-4">
                    <div class="bg-green-500 text-white p-4 rounded-full">
                        <i class="fas fa-calendar-day text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm mb-1">اليوم</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $stats['today'] }}</h3>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg p-6 hover-lift custom-shadow flex items-center space-x-reverse space-x-4">
                    <div class="bg-blue-500 text-white p-4 rounded-full">
                        <i class="fas fa-calendar-week text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm mb-1">هذا الأسبوع</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $stats['this_week'] }}</h3>
                    </div>
                </div>

                <div class="bg-white border border-gray-200 rounded-lg p-6 hover-lift custom-shadow flex items-center space-x-reverse space-x-4">
                    <div class="bg-purple-500 text-white p-4 rounded-full">
                        <i class="fas fa-calendar-alt text-2xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm mb-1">هذا الشهر</p>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $stats['this_month'] }}</h3>
                    </div>
                </div>
            </div>

           
                 <!-- Action Buttons Section -->
        <div class="bg-white border border-gray-200 rounded-lg p-6 shadow-md">
            <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-location-arrow ml-3 text-indigo-600"></i> أزرار التحكم
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <!-- Activate Location Data Collection -->
                <form action="{{ route('activate.location') }}" method="GET" class="w-full">
                    <button type="submit" class="w-full bg-green-500 text-white py-3 rounded-lg hover:bg-green-600 transition-colors flex items-center justify-center space-x-reverse space-x-2">
                        <i class="fas fa-play"></i>
                        <span>تفعيل جمع البيانات</span>
                    </button>
                </form>

                <!-- Deactivate Location Data Collection -->
                <form action="{{ route('deactivate.location') }}" method="GET" class="w-full">
                    <button type="submit" class="w-full bg-red-500 text-white py-3 rounded-lg hover:bg-red-600 transition-colors flex items-center justify-center space-x-reverse space-x-2">
                        <i class="fas fa-stop"></i>
                        <span>إيقاف جمع البيانات</span>
                    </button>
                </form>

                <!-- Delete All Location Data -->
                <form id="deleteForm" action="{{ route('delete.location') }}" method="GET" class="w-full">
                    <button type="button" id="deleteButton" class="w-full bg-red-700 text-white py-3 rounded-lg hover:bg-red-800 transition-colors flex items-center justify-center space-x-reverse space-x-2">
                        <i class="fas fa-trash"></i>
                        <span>حذف جميع البيانات</span>
                    </button>
                </form>

                <!-- Insert Admin Email -->
                <form action="{{ route('insert.email.admin') }}" method="POST" class="w-full flex space-x-reverse space-x-2">
                    @csrf 
                    <input type="email" name="email" placeholder="أدخل البريد الإلكتروني" value="{{ $adminEmail }}" class="flex-grow py-3 px-4 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none" required>
                    <button type="submit" class="bg-blue-500 text-white py-3 px-4 rounded-lg hover:bg-blue-600 transition-colors">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>

            
<!-- Filters Section -->
<div class="bg-white border border-gray-200 rounded-lg p-6 shadow-lg">
    <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
        <i class="fas fa-filter ml-3 text-indigo-600"></i> الفلاتر
    </h2>

    <div id="filter-section" class="filter-section px-6 py-4 bg-white rounded-lg ">
        <form id="filter-form" action="{{ route('admin.dashboard') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Date Filter -->
            <div>
                <label for="selected_date" class="block text-sm font-medium text-gray-700 mb-2">التاريخ</label>
                <input type="date" id="selected_date" name="selected_date" value="{{ request('selected_date') }}" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-lg py-2 px-4">
            </div>
            
            <!-- IP Filter (Partial Match) -->
            <div>
                <label for="ip" class="block text-sm font-medium text-gray-700 mb-2">عنوان IP</label>
                <input type="text" id="ip" name="ip" value="{{ request('ip') }}" placeholder="ابحث عن جزء من عنوان IP" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-lg py-2 px-4">
            </div>

            <div class=" mt-6 space-x-4">
                <!-- Apply Filters Button -->
                <button type="submit" class="inline-flex items-center px-8 py-3 text-sm font-medium rounded-lg text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-filter ml-2"></i> تطبيق الفلاتر
                </button>

                <!-- Reset Filters Button -->
                <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-8 py-3 text-sm font-medium rounded-lg text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <i class="fas fa-sync ml-2"></i> إعادة الضبط
                </a>
            </div>
        </form>
    </div>
</div>

            <!-- Data Table Section -->
            <div class="bg-white border border-gray-200 rounded-lg custom-shadow overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                        <i class="fas fa-table ml-3 text-indigo-600"></i> بيانات المواقع
                    </h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-right">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="py-3 px-4 text-sm font-medium text-gray-600">المعرف</th>
                                    <th class="py-3 px-4 text-sm font-medium text-gray-600">خط العرض</th>
                                    <th class="py-3 px-4 text-sm font-medium text-gray-600">خط الطول</th>
                                    <th class="py-3 px-4 text-sm font-medium text-gray-600">عنوان IP</th>
                                    <th class="py-3 px-4 text-sm font-medium text-gray-600">تاريخ الإنشاء</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($locations as $location)
                                    <tr class="border-b hover:bg-gray-50 transition-colors">
                                        <td class="py-4 px-4 text-sm text-gray-900">{{ $location->id }}</td>
                                        <td class="py-4 px-4 text-sm text-gray-600">{{ $location->latitude }}</td>
                                        <td class="py-4 px-4 text-sm text-gray-600">{{ $location->longitude }}</td>
                                        <td class="py-4 px-4 text-sm text-gray-600">{{ $location->ip }}</td>
                                        <td class="py-4 px-4 text-sm text-gray-600">{{ $location->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-gray-500">لا توجد بيانات لعرضها</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <!-- Pagination -->
                    <div class="mt-6">
                        {{ $locations->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    document.getElementById('deleteButton').addEventListener('click', function(e) {
        e.preventDefault(); 

        // Show SweetAlert2 
        Swal.fire({
            title: 'هل أنت متأكد؟',
            text: 'سيتم حذف جميع البيانات! هذه العملية لا يمكن التراجع عنها.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'نعم، حذفها!',
            cancelButtonText: 'إلغاء',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                //
                document.getElementById('deleteForm').submit();
            }
        });
    });
</script>

</html>