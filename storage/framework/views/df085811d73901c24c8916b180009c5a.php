<?php $__env->startSection('content'); ?>
<div class="container mx-auto px-4 py-6">
    <!-- Charts Section -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <!-- Department Distribution Chart -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Asset Distribution by Department</h3>
            <canvas id="departmentChart" data-statistics="<?php echo e(json_encode($departmentStats)); ?>"></canvas>
        </div>
        <!-- Status Distribution Chart -->
        <div class="bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">Asset Distribution by Status</h3>
            <canvas id="statusChart" data-statistics="<?php echo e(json_encode($statusStats)); ?>"></canvas>
        </div>
    </div>
    <!-- Value Trends Section -->
    <div class="bg-white rounded-lg shadow p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Asset Value Trends (Last 6 Months)</h3>
        <canvas id="valueTrendChart" data-trends="<?php echo e(json_encode($valueTrends)); ?>"></canvas>
    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
        <!-- Total Assets Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Total Assets</p>
                    <p class="text-2xl font-semibold text-gray-800"><?php echo e($totalAssets); ?></p>
                </div>
            </div>
        </div>

        <!-- Available Assets Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">Available Assets</p>
                    <p class="text-2xl font-semibold text-gray-800"><?php echo e($availableAssets); ?></p>
                </div>
            </div>
        </div>

        <!-- In-Use Assets Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">In-Use Assets</p>
                    <p class="text-2xl font-semibold text-gray-800"><?php echo e($inUseAssets); ?></p>
                </div>
            </div>
        </div>

        <!-- Maintenance Assets Card -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                    </svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-gray-600">In Maintenance</p>
                    <p class="text-2xl font-semibold text-gray-800"><?php echo e($maintenanceAssets); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activities and Assets Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <!-- Recent Activities -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow overflow-hidden h-full">
                <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-blue-500 to-blue-600">
                    <h2 class="text-xl font-semibold text-white">Recent Activities</h2>
                </div>
                <div class="p-6 space-y-6">
                    <div class="flow-root">
                        <ul class="-mb-8">
                            <?php $__currentLoopData = $recentAssets->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li>
                                <div class="relative pb-8">
                                    <?php if(!$loop->last): ?>
                                    <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                    <?php endif; ?>
                                    <div class="relative flex space-x-3">
                                        <div>
                                            <span class="h-8 w-8 rounded-full bg-blue-500 flex items-center justify-center ring-8 ring-white">
                                                <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                </svg>
                                            </span>
                                        </div>
                                        <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                            <div>
                                                <p class="text-sm text-gray-500">Asset <span class="font-medium text-gray-900"><?php echo e($asset->name); ?></span> was added to <?php echo e($asset->department->name); ?></p>
                                            </div>
                                            <div class="text-right text-sm whitespace-nowrap text-gray-500">
                                                <time datetime="<?php echo e($asset->created_at); ?>"><?php echo e($asset->created_at->diffForHumans()); ?></time>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Assets Table -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow overflow-hidden h-full">
                <div class="p-6 border-b border-gray-200 bg-gradient-to-r from-gray-700 to-gray-800">
                    <h2 class="text-xl font-semibold text-white">Recent Assets</h2>
                </div>
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Asset Code</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Department</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            <?php $__currentLoopData = $recentAssets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $asset): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($asset->asset_code); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($asset->name); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($asset->category); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                <?php if($asset->status === 'available'): ?> bg-green-100 text-green-800
                                <?php elseif($asset->status === 'in-use'): ?> bg-yellow-100 text-yellow-800
                                <?php elseif($asset->status === 'maintenance'): ?> bg-red-100 text-red-800
                                <?php else: ?> bg-gray-100 text-gray-800
                                <?php endif; ?>">
                                <?php echo e(ucfirst($asset->status)); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?php echo e($asset->department->name ?? 'N/A'); ?></td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <a href="<?php echo e(route('assets.edit', $asset)); ?>" class="text-indigo-600 hover:text-indigo-900 mr-3">Edit</a>
                            <form action="<?php echo e(route('assets.destroy', $asset)); ?>" method="POST" class="inline">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Are you sure you want to delete this asset?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
        <div class="px-6 py-4 border-t border-gray-200">
            <?php echo e($recentAssets->links()); ?>

        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Department Distribution Chart
    const departmentCtx = document.getElementById('departmentChart').getContext('2d');
    new Chart(departmentCtx, {
        type: 'pie',
        data: {
            labels: <?php echo json_encode($departmentStats->pluck('name')); ?>,
            datasets: [{
                data: <?php echo json_encode($departmentStats->pluck('count')); ?>,
                backgroundColor: [
                    '#4F46E5', '#7C3AED', '#EC4899', '#F59E0B', '#10B981',
                    '#6366F1', '#8B5CF6', '#F472B6', '#FBBF24', '#34D399'
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Status Distribution Chart
    const statusCtx = document.getElementById('statusChart').getContext('2d');
    new Chart(statusCtx, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($statusStats->pluck('status')); ?>,
            datasets: [{
                data: <?php echo json_encode($statusStats->pluck('count')); ?>,
                backgroundColor: [
                    '#10B981', // available
                    '#F59E0B', // in-use
                    '#EF4444'  // maintenance
                ]
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\The Rimz\Desktop\Management Asset Kementrian\resources\views/dashboard.blade.php ENDPATH**/ ?>