<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bookings') }}
        </h2>
    </x-slot>
    <x-slot name="script">
        <script>
            var dataTable = $('#dataTable').DataTable({
                processing: true,
                serverSide: true,
                stateSave: true,
                ajax: {
                    url: '{!! url()->current() !!}',
                },
                columns: [{
                        data: 'id',
                        name: 'id',
                    },
                    {
                        data: 'user.name',
                        name: 'user.name',
                    },
                    {
                        data: 'item.brand.name',
                        name: 'item.brand.name',
                    },
                    {
                        data: 'item.name',
                        name: 'item.name',
                    },
                    {
                        data: 'start_date',
                        name: 'start_date',
                    },
                    {
                        data: 'end_date',
                        name: 'end_date',
                    },
                    {
                        data: 'status',
                        name: 'status',
                    },
                    {
                        data: 'payment_status',
                        name: 'payment_status',
                    },
                    {
                        data: 'total_price',
                        name: 'total_price',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        width: '15%'
                    },
                ],
            })
        </script>
    </x-slot>

    <div class="py-12">
        <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
                <table id="dataTable" class="stripe hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Item</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>End Date</th>
                            <th>Booking Status</th>
                            <th>Payment Status</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
