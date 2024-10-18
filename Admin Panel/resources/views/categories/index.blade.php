@extends('layouts.app')

@section('content')

<div class="page-wrapper">

    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor">{{trans('lang.category_plural')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.category_plural')}}</li>
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
                                <a class="nav-link active" href="{!! url()->current() !!}"><i class="fa fa-list mr-2"></i>{{trans('lang.category_table')}}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('categories.create') !!}"><i
                                            class="fa fa-plus mr-2"></i>{{trans('lang.category_create')}}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">Processing...
                        </div>

                        <div class="table-responsive m-t-10">


                            <table id="categoriesTable"
                                   class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                   cellspacing="0" width="100%">

                                <thead>

                                <tr>
                                    <?php if (in_array('category.delete', json_decode(@session('user_permissions'),true))) { ?>
                                    <th class="delete-all"><input type="checkbox" id="is_active"><label class="col-3 control-label" for="is_active">
                                            <a id="deleteAll" class="do_not_delete" href="javascript:void(0)"><i class="fa fa-trash"></i> {{trans('lang.all')}}</a></label></th>
                                    <?php } ?>

                                    <th>{{trans('lang.category_image')}}</th>

                                    <th>{{trans('lang.faq_category_name')}}</th>
                                    <th>{{trans('lang.food_plural')}}</th>
                                    <th> {{trans('lang.item_publish')}}</th>
                                    <th>{{trans('lang.actions')}}</th>

                                </tr>

                                </thead>

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
   
    var ref = database.collection('vendor_categories').orderBy('title');
    
    var placeholderImage = '';

    var user_permissions = '<?php echo @session("user_permissions")?>';
    user_permissions = Object.values(JSON.parse(user_permissions));
    var checkDeletePermission = false;
    if ($.inArray('category.delete', user_permissions) >= 0) {
        checkDeletePermission = true;
    }

    $(document).ready(function () {

        jQuery("#data-table_processing").show();

        var placeholder = database.collection('settings').doc('placeHolderImage');
        placeholder.get().then(async function (snapshotsimage) {
            var placeholderImageData = snapshotsimage.data();
            placeholderImage = placeholderImageData.image;
        });

        const table = $('#categoriesTable').DataTable({
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
                const orderableColumns = (checkDeletePermission) ? ['','','title', 'totalProducts','',''] : ['','title', 'totalProducts','','']; // Ensure this matches the actual column names
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

                    await Promise.all(querySnapshot.docs.map(async (doc) => {
                        let childData = doc.data();
                        childData.id = doc.id; // Ensure the document ID is included in the data

                        if (childData.id) {
                            childData.totalProducts = await getProductTotal(childData.id);
                        }
                        else {
                            childData.totalProducts = 0;
                        }
                        
                        if (searchValue) {
                            if (
                                (childData.title && childData.title.toString().toLowerCase().includes(searchValue)) ||
                                (childData.totalProducts && childData.totalProducts.toString().includes(searchValue))
                            ) {
                                filteredRecords.push(childData);
                            }
                        } else {
                            filteredRecords.push(childData);
                        }
                    }));

                    filteredRecords.sort((a, b) => {
                        let aValue = a[orderByField] ? a[orderByField].toString().toLowerCase() : '';
                        let bValue = b[orderByField] ? b[orderByField].toString().toLowerCase() : '';
                        if (orderByField === 'totalProducts') {
                            aValue = a[orderByField] ? parseInt(a[orderByField]) : 0;
                            bValue = b[orderByField] ? parseInt(b[orderByField]) : 0;
                        }                        
                        if (orderDirection === 'asc') {
                            return (aValue > bValue) ? 1 : -1;
                        } else {
                            return (aValue < bValue) ? 1 : -1;
                        }
                    });

                    const totalRecords = filteredRecords.length;
                    
                    
                    filteredRecords.slice(start, start + length).forEach(function (childData) {
                        var id = childData.id;
                        var route1 = '{{route("categories.edit",":id")}}';
                        route1 = route1.replace(':id', id);
                        var url = '{{url("items?categoryID=id")}}';
                        url = url.replace("id", id);
                        records.push([
                            checkDeletePermission ? '<td class="delete-all"><input type="checkbox" id="is_open_' + childData.id + '" class="is_open" dataId="' + childData.id + '"><label class="col-3 control-label"\n' + 'for="is_open_' + childData.id + '" ></label></td>' : '',
                            childData.photo == '' || childData.photo == null ? '<img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="image">' : '<img onerror="this.onerror=null;this.src=\'' + placeholderImage + '\'" class="rounded" style="width:50px" src="' + childData.photo + '" alt="image">',
                            '<a href="' + route1 + '">' + childData.title + '</a>',
                            '<a href="' + url + '">'+childData.totalProducts+'</a>',
                            childData.publish ? '<label class="switch"><input type="checkbox" checked id="' + childData.id + '" name="isActive"><span class="slider round"></span></label>' : '<label class="switch"><input type="checkbox" id="' + childData.id + '" name="isActive"><span class="slider round"></span></label>',

                            '<span class="action-btn"><a href="' + route1 + '"><i class="fa fa-edit"></i></a><?php if(in_array('category.delete', json_decode(@session('user_permissions'),true))){ ?> <a id="' + childData.id + '" name="category-delete" class="delete-btn" href="javascript:void(0)"><i class="fa fa-trash"></i></a><?php } ?></span>'                           

                        ]);
                    });

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
            order: (checkDeletePermission) ? [2, 'asc'] : [1,'asc'],
            columnDefs: [
                
                { orderable: false, targets: (checkDeletePermission) ? [0, 1, 4, 5] : [0, 3, 4] },
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
            return function(...args) {
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
       

    });

   
    async function getProductTotal(id, section_id) {
        var vendor_products = database.collection('vendor_products').where('categoryID', '==', id);
        var Product_total = 0;
        if (section_id) {
            vendor_products = vendor_products.where('section_id', '==', section_id)
        }
        await vendor_products.get().then(async function (productSnapshots) {
            Product_total = productSnapshots.docs.length;
        });
        return Product_total;
    }


    $(document).on("click", "a[name='category-delete']", function (e) {
        var id = this.id;
        database.collection('vendor_categories').doc(id).delete().then(function (result) {
            window.location.href = '{{ route("categories")}}';
        });
    });


    $("#is_active").click(function () {
        $("#categoriesTable .is_open").prop('checked', $(this).prop('checked'));
    });

    $("#deleteAll").click(function () {

        if ($('#categoriesTable .is_open:checked').length) {

            if (confirm("{{trans('lang.selected_delete_alert')}}")) {
                jQuery("#data-table_processing").show();
                $('#categoriesTable .is_open:checked').each(function () {
                    var dataId = $(this).attr('dataId');
                    
                    database.collection('vendor_categories').doc(dataId).delete().then(function () {
                        setTimeout(function () {
                            window.location.reload();
                        }, 7000);

                    });

                });

            }
        } else {
            alert("{{trans('lang.select_delete_alert')}}");
        }
    });

    $(document).on("click", "input[name='isActive']", function (e) {
        var ischeck = $(this).is(':checked');
        var id = this.id;
        if (ischeck) {
            database.collection('vendor_categories').doc(id).update({'publish': true}).then(function (result) {

            });
        } else {
            database.collection('vendor_categories').doc(id).update({'publish': false}).then(function (result) {

            });
        }

    });

</script>

@endsection
