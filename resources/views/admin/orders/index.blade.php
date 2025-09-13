@extends('layouts.admin')

@section('content')
<div class="px-4 sm:px-6 lg:px-8">
    <!-- Page header -->
    <div class="sm:flex sm:items-center">
        <div class="sm:flex-auto">
            <h1 class="text-2xl font-semibold text-gray-900">Orders</h1>
            <p class="mt-2 text-sm text-gray-700">Manage all customer orders efficiently</p>
        </div>
    </div>

    <!-- Stats Cards - Compact -->
    <div class="mt-6 grid grid-cols-2 gap-4 sm:grid-cols-4">
        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3 w-0 flex-1">
                        <dl>
                            <dt class="text-xs font-medium text-gray-500 truncate">Total</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ number_format($stats['total']) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-yellow-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3 w-0 flex-1">
                        <dl>
                            <dt class="text-xs font-medium text-gray-500 truncate">Pending</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ number_format($stats['pending']) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-purple-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3 w-0 flex-1">
                        <dl>
                            <dt class="text-xs font-medium text-gray-500 truncate">Processing</dt>
                            <dd class="text-lg font-medium text-gray-900">{{ number_format($stats['processing']) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white overflow-hidden shadow rounded-lg">
            <div class="p-4">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="ml-3 w-0 flex-1">
                        <dl>
                            <dt class="text-xs font-medium text-gray-500 truncate">Today Revenue</dt>
                            <dd class="text-lg font-medium text-gray-900">${{ number_format($stats['revenue_today'], 2) }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters - Compact -->
    <div class="mt-6 bg-white shadow rounded-lg">
        <div class="p-4">
            <form method="GET" class="grid grid-cols-1 gap-4 sm:grid-cols-6">
                <div class="sm:col-span-2">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Search orders..." 
                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                </div>
                <div>
                    <select name="status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">All Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                        <option value="shipped" {{ request('status') == 'shipped' ? 'selected' : '' }}>Shipped</option>
                        <option value="delivered" {{ request('status') == 'delivered' ? 'selected' : '' }}>Delivered</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div>
                    <select name="payment_status" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                        <option value="">All Payments</option>
                        <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Failed</option>
                        <option value="refunded" {{ request('payment_status') == 'refunded' ? 'selected' : '' }}>Refunded</option>
                    </select>
                </div>
                <div class="sm:col-span-2 flex space-x-2">
                    <button type="submit" class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Filter
                    </button>
                    <a href="{{ route('admin.orders.index') }}" class="inline-flex items-center px-3 py-2 border border-gray-300 text-sm leading-4 font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Reset
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Orders List - Minimal Design -->
    <div class="mt-6 bg-white shadow rounded-lg overflow-hidden">
        <div class="min-w-full divide-y divide-gray-200">
            <!-- Header -->
            <div class="bg-gray-50 px-6 py-3">
                <div class="grid grid-cols-12 gap-4 text-xs font-medium text-gray-500 uppercase tracking-wider">
                    <div class="col-span-2">Order</div>
                    <div class="col-span-2">Customer</div>
                    <div class="col-span-1">Amount</div>
                    <div class="col-span-2">Status</div>
                    <div class="col-span-2">Payment</div>
                    <div class="col-span-2">Date</div>
                    <div class="col-span-1">Actions</div>
                </div>
            </div>

            <!-- Orders List -->
            <div class="divide-y divide-gray-200">
                @forelse($orders as $order)
                <div class="px-6 py-4 hover:bg-gray-50">
                    <div class="grid grid-cols-12 gap-4 items-center">
                        <!-- Order Number -->
                        <div class="col-span-2">
                            <div class="text-sm font-medium text-gray-900">{{ $order->order_number }}</div>
                            <div class="text-xs text-gray-500">ID: {{ $order->id }}</div>
                        </div>

                        <!-- Customer -->
                        <div class="col-span-2">
                            <div class="text-sm text-gray-900">{{ $order->customer_name }}</div>
                            <div class="text-xs text-gray-500">{{ $order->customer_email }}</div>
                        </div>

                        <!-- Amount -->
                        <div class="col-span-1">
                            <div class="text-sm font-medium text-gray-900">${{ number_format($order->total_amount, 2) }}</div>
                        </div>

                        <!-- Status -->
                        <div class="col-span-2">
                            <select class="status-select text-xs rounded-full px-2 py-1 font-medium {{ $order->status_color }}" 
                                    data-order-id="{{ $order->id }}" 
                                    data-current-status="{{ $order->status }}">
                                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="confirmed" {{ $order->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                                <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>

                        <!-- Payment Status -->
                        <div class="col-span-2">
                            <select class="payment-status-select text-xs rounded-full px-2 py-1 font-medium {{ $order->payment_status_color }}" 
                                    data-order-id="{{ $order->id }}" 
                                    data-current-status="{{ $order->payment_status }}">
                                <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                                <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                                <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                            </select>
                        </div>

                        <!-- Date -->
                        <div class="col-span-2">
                            <div class="text-sm text-gray-900">{{ $order->order_date->format('M j, Y') }}</div>
                            <div class="text-xs text-gray-500">{{ $order->order_date->format('g:i A') }}</div>
                        </div>

                        <!-- Actions -->
                        <div class="col-span-1">
                            <a href="{{ route('admin.orders.show', $order) }}" 
                               class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                View
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No orders found</h3>
                    <p class="mt-1 text-sm text-gray-500">Try adjusting your search or filter criteria.</p>
                </div>
                @endforelse
            </div>
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
        <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
            <div class="flex items-center justify-between">
                <div class="flex-1 flex justify-between sm:hidden">
                    @if($orders->onFirstPage())
                        <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 bg-white cursor-default">Previous</span>
                    @else
                        <a href="{{ $orders->previousPageUrl() }}" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Previous</a>
                    @endif

                    @if($orders->hasMorePages())
                        <a href="{{ $orders->nextPageUrl() }}" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">Next</a>
                    @else
                        <span class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-500 bg-white cursor-default">Next</span>
                    @endif
                </div>
                <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm text-gray-700">
                            Showing <span class="font-medium">{{ $orders->firstItem() }}</span> to <span class="font-medium">{{ $orders->lastItem() }}</span> of <span class="font-medium">{{ $orders->total() }}</span> results
                        </p>
                    </div>
                    <div>
                        {{ $orders->links() }}
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle status updates
    document.querySelectorAll('.status-select').forEach(select => {
        select.addEventListener('change', function() {
            const orderId = this.dataset.orderId;
            const newStatus = this.value;
            const currentStatus = this.dataset.currentStatus;
            
            if (newStatus === currentStatus) return;
            
            fetch(`/admin/orders/${orderId}/status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.Laravel.csrfToken
                },
                body: JSON.stringify({ status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.dataset.currentStatus = newStatus;
                    // Update visual feedback
                    this.className = this.className.replace(/bg-\w+-100 text-\w+-800/g, '');
                    // Add appropriate color class based on status
                    const colorMap = {
                        'pending': 'bg-yellow-100 text-yellow-800',
                        'confirmed': 'bg-blue-100 text-blue-800',
                        'processing': 'bg-purple-100 text-purple-800',
                        'shipped': 'bg-indigo-100 text-indigo-800',
                        'delivered': 'bg-green-100 text-green-800',
                        'cancelled': 'bg-red-100 text-red-800'
                    };
                    this.className += ' ' + (colorMap[newStatus] || 'bg-gray-100 text-gray-800');
                } else {
                    this.value = currentStatus; // Revert on error
                    alert('Failed to update status');
                }
            })
            .catch(error => {
                this.value = currentStatus; // Revert on error
                console.error('Error:', error);
                alert('Failed to update status');
            });
        });
    });

    // Handle payment status updates
    document.querySelectorAll('.payment-status-select').forEach(select => {
        select.addEventListener('change', function() {
            const orderId = this.dataset.orderId;
            const newStatus = this.value;
            const currentStatus = this.dataset.currentStatus;
            
            if (newStatus === currentStatus) return;
            
            fetch(`/admin/orders/${orderId}/payment-status`, {
                method: 'PATCH',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.Laravel.csrfToken
                },
                body: JSON.stringify({ payment_status: newStatus })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    this.dataset.currentStatus = newStatus;
                    // Update visual feedback
                    this.className = this.className.replace(/bg-\w+-100 text-\w+-800/g, '');
                    // Add appropriate color class based on payment status
                    const colorMap = {
                        'pending': 'bg-yellow-100 text-yellow-800',
                        'paid': 'bg-green-100 text-green-800',
                        'failed': 'bg-red-100 text-red-800',
                        'refunded': 'bg-gray-100 text-gray-800'
                    };
                    this.className += ' ' + (colorMap[newStatus] || 'bg-gray-100 text-gray-800');
                } else {
                    this.value = currentStatus; // Revert on error
                    alert('Failed to update payment status');
                }
            })
            .catch(error => {
                this.value = currentStatus; // Revert on error
                console.error('Error:', error);
                alert('Failed to update payment status');
            });
        });
    });
});
</script>
@endpush