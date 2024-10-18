@extends('layouts.app')

@section('content')

<div class="page-wrapper">


    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('lang.reviewattribute_plural')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.reviewattribute_plural')}}</li>
            </ol>
        </div>

        <div>

        </div>

    </div>


    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <div class="card">

                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i
                                        class="fa fa-list mr-2"></i>{{trans('lang.reviewattribute_table')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('reviewattributes.create') !!}"><i
                                        class="fa fa-plus mr-2"></i>{{trans('lang.reviewattribute_create')}}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                            style="display: none;">{{trans('lang.processing')}}
                        </div>

                        <div class="table-responsive m-t-10">


                            <table id="attributeTable"
                                class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                cellspacing="0" width="100%">

                                <thead>

                                    <tr>

                                        <th>{{trans('lang.reviewattribute_name')}}</th>

                                        <th>{{trans('lang.actions')}}</th>

                                    </tr>

                                </thead>

                                <tbody id="append_list1">


                                </tbody>

                            </table>
                        </div>
                    </div>

                </div>
            </div>


        </div>

    </div>

</div>

@endsection

@section('scripts')

<script type="text/javascript">

    var database = firebase.firestore();

    var ref = database.collection('review_attributes').orderBy('title');
    var append_list = '';

    var user_permissions = '<?php echo @session("user_permissions") ?>';
    user_permissions = Object.values(JSON.parse(user_permissions));
    var checkDeletePermission = false;
    if ($.inArray('reviewattributes.delete', user_permissions) >= 0) {
        checkDeletePermission = true;
    }
    $(document).ready(function () {

        jQuery("#data-table_processing").show();

        const table = $('#attributeTable').DataTable({
            pageLength: 10, // Number of rows per page
            processing: false, // Show processing indicator
            serverSide: true, // Enable server-side processing
            responsive: true,
            ajax: function (data, callback, settings) {
                const start = data.start;
                const length = data.length;
                const searchValue = data.search.value.toLowerCase();
                const orderColumnIndex = data.order[0].column;
                const orderDirection = data.order[0].dir;
                const orderableColumns = ['title']; // Ensure this matches the actual column names
                const orderByField = orderableColumns[orderColumnIndex]; // Adjust the index to match your table

                if (searchValue.length >= 3 || searchValue.length === 0) {
                    $('#data-table_processing').show();
                }

                ref.get().then(async function (querySnapshot) {
                    if (querySnapshot.empty) {
                        console.error("No data found in Firestore.");
                        $('#data-table_processing').hide(); // Hide loader
                        callback({
                            draw: data.draw,
                            recordsTotal: 0,
                            recordsFiltered: 0,
                            data: [] // No data
                        });
                        return;
                    }

                    let records = [];
                    let filteredRecords = [];

                    querySnapshot.forEach(function (doc) {
                        let childData = doc.data();
                        childData.id = doc.id; // Ensure the document ID is included in the data              

                        if (searchValue) {
                            if (
                                (childData.title && childData.title.toLowerCase().toString().includes(searchValue))

                            ) {
                                filteredRecords.push(childData);
                            }
                        } else {
                            filteredRecords.push(childData);
                        }
                    });

                    filteredRecords.sort((a, b) => {
                        let aValue = a[orderByField] ? a[orderByField].toString().toLowerCase() : '';
                        let bValue = b[orderByField] ? b[orderByField].toString().toLowerCase() : '';

                        if (orderDirection === 'asc') {
                            return (aValue > bValue) ? 1 : -1;
                        } else {
                            return (aValue < bValue) ? 1 : -1;
                        }
                    });

                    const totalRecords = filteredRecords.length;

                    const paginatedRecords = filteredRecords.slice(start, start + length);

                    await Promise.all(paginatedRecords.map(async (childData) => {
                        var getData = await buildHTML(childData);
                        records.push(getData);
                    }));

                    $('#data-table_processing').hide(); // Hide loader
                    callback({
                        draw: data.draw,
                        recordsTotal: totalRecords, // Total number of records in Firestore
                        recordsFiltered: totalRecords, // Number of records after filtering (if any)
                        data: records // The actual data to display in the table
                    });
                }).catch(function (error) {
                    console.error("Error fetching data from Firestore:", error);
                    $('#data-table_processing').hide(); // Hide loader
                    callback({
                        draw: data.draw,
                        recordsTotal: 0,
                        recordsFiltered: 0,
                        data: [] // No data due to error
                    });
                });
            },
            order: [[0, 'asc']],
            columnDefs: [

                { orderable: false, targets: [1] },
            ],
            "language": {
                "zeroRecords": "{{trans("lang.no_record_found")}}",
                "emptyTable": "{{trans("lang.no_record_found")}}",
                "processing": "" // Remove default loader
            },

        });
        table.columns.adjust().draw();

        function debounce(func, wait) {
            let timeout;
            const context = this;
            return function (...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }
        $('#search-input').on('input', debounce(function () {
            const searchValue = $(this).val();
            if (searchValue.length >= 3) {
                $('#data-table_processing').show();
                table.search(searchValue).draw();
            } else if (searchValue.length === 0) {
                $('#data-table_processing').show();
                table.search('').draw();
            }
        }, 300));


    })

    function buildHTML(val) {
        var html = [];

        newdate = '';

        var id = val.id;
        var route1 = '{{route("reviewattributes.edit",":id")}}';
        route1 = route1.replace(':id', id);

        html.push('<a href="' + route1 + '">' + val.title + '</a>');
        var actionHtml='';
        actionHtml+='<span class="action-btn"><a href="' + route1 + '"><i class="fa fa-edit"></i></a>';
        if (checkDeletePermission) {
            actionHtml+='<a id="' + val.id + '" name="reviewattributes-delete" class="delete-btn" href="javascript:void(0)"><i class="fa fa-trash"></i></a>';
        }
        actionHtml+='</span>';
        html.push(actionHtml);
        return html;
    }

  
    $(document).on("click", "a[name='reviewattributes-delete']", function (e) {
        var id = this.id;
        jQuery("#data-table_processing").show();
        database.collection('review_attributes').doc(id).delete().then(function (result) {
            window.location.href = '{{ route("reviewattributes")}}';
        });
    });


</script>

@endsection