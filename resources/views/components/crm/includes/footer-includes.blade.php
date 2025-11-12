<script>
    // S Datatables
    $(document).ready(function () {

        @if(request()->route()->getName() == 'users->show')

        $('#users').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('datatables-users_show') }}",
            columns: [
                {data: 'id'},
                {data: 'firstname'},
                {data: 'lastname'},
                {data: 'email'},
                {data: 'user_level'},
                {data: 'created_at'},
                {data: 'updated_at'},
                {data: 'actions'},
            ],
            order: [[ 0, "desc" ]],
            "pageLength": 25,
            "language": {
                "paginate": {
                    "next": "<i class='fadeIn animated bx bx-chevron-right'></i>",
                    "previous": "<i class='fadeIn animated bx bx-chevron-left'></i>"
                }
            },
            'columnDefs' : [
                {
                    'visible' : false,
                    'targets': [0]
                }
            ],
            scrollX: false,
            scrollY: false,
        });

        @endif

        @if(request()->route()->getName() == 'attorneys->show')

        $('#attorneys').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('datatables-attorneys_show') }}",
            columns: [
                {data: 'id'},
                {data: 'firstname'},
                {data: 'lastname'},
                {data: 'company_name'},
                {data: 'company_address_state_code'},
                {data: 'company_address_city'},
                {data: 'company_address_zip_code'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'created_at'},
                {data: 'updated_at'},
                {data: 'actions'},
            ],
            order: [[ 0, "desc" ]],
            "pageLength": 25,
            "language": {
                "paginate": {
                    "next": "<i class='fadeIn animated bx bx-chevron-right'></i>",
                    "previous": "<i class='fadeIn animated bx bx-chevron-left'></i>"
                }
            },
            'columnDefs' : [
                // {
                //     "targets": 8,
                //     "data": "phone",
                //     "render": function (data) {
                //         return "<spam>" + data + "</span>";
                //     }
                // },
                {
                    'visible' : true,
                    'targets': [0]
                }
            ],
            scrollX: false,
            scrollY: false,
        });

        @endif

        @if(request()->route()->getName() == 'customers->show')

        $('#customers').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('datatables-customers_show') }}",
            columns: [
                {data: 'id'},
                {data: 'lastname'},
                {data: 'firstname'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'attorney_id'},
                {data: 'case_type'},
                {data: 'created_at'},
                {data: 'updated_at'},
                {data: 'actions'},
            ],
            order: [[ 0, "desc" ]],
            "pageLength": 25,
            "language": {
                "paginate": {
                    "next": "<i class='fadeIn animated bx bx-chevron-right'></i>",
                    "previous": "<i class='fadeIn animated bx bx-chevron-left'></i>"
                }
            },
            'columnDefs' : [
                {
                    'visible' : true,
                    'targets': [0]
                }
            ],
            scrollX: false,
            scrollY: false,
        });

        @endif

        @if(request()->route()->getName() == 'clients->show')

        $('#clients').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('datatables->clients_show') }}",
            columns: [
                {data: 'id'},
                {data: 'lastname'},
                {data: 'firstname'},
                {data: 'a_number'},
                {data: 'social_security'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'created_at'},
                {data: 'updated_at'},
                {data: 'cases'},
                {data: 'actions'},
            ],
            //order: [[ 2, "asc" ]],
            "aaSorting": [],
            "pageLength": 25,
            "language": {
                "paginate": {
                    "next": "<i class='fadeIn animated bx bx-chevron-right'></i>",
                    "previous": "<i class='fadeIn animated bx bx-chevron-left'></i>"
                }
            },
            'columnDefs' : [
                {
                    'visible' : true,
                    'targets': [0]
                }
            ],
            scrollX: false,
            scrollY: false,
        });

        @endif

        @if(request()->route()->getName() == 'cases->show')

        $('#customers').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('datatables-cases_show') }}",
            columns: [
                {data: 'id'},
                {data: 'lastname'},
                {data: 'firstname'},
                {data: 'email'},
                {data: 'phone'},
                {data: 'attorney_id'},
                {data: 'case_type'},
                {data: 'created_at'},
                {data: 'updated_at'},
                {data: 'actions'},
            ],
            order: [[ 0, "desc" ]],
            "pageLength": 25,
            "language": {
                "paginate": {
                    "next": "<i class='fadeIn animated bx bx-chevron-right'></i>",
                    "previous": "<i class='fadeIn animated bx bx-chevron-left'></i>"
                }
            },
            'columnDefs' : [
                {
                    'visible' : true,
                    'targets': [0]
                }
            ],
            scrollX: false,
            scrollY: false,
        });

        @endif

        @if(request()->route()->getName() == 'customers->edit')

        $('#customer_paymant_history_table_id').DataTable();

        @endif

        @if(request()->route()->getName() == 'clients->edit')

        $('#customer_paymant_history_table_id').DataTable();

        @endif


        @if(request()->route()->getName() == 'system_status->twilio')


        $('#system_status_twilio_messaging').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('datatables-system_status_twilio_messaging_show') }}",
            columns: [
                {data: 'id'},
                {data: 'client_id'},
                {data: 'case_id'},
                {data: 'phone_number'},
                {data: 'message_test'},
                {data: 'status'},
                {data: 'created_at'},
            ],
            order: [[ 0, "desc" ]]
        });

        @endif



    });

    // E Datatables
</script>
