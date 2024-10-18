@extends('layouts.app')

@section('content')

<div class="page-wrapper">
    <div class="row page-titles">

        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor restaurantTitle">{{trans('lang.food_plural')}}</h3>
        </div>

        <div class="col-md-7 align-self-center">

            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.food_plural')}}</li>
            </ol>

        </div>
    </div>


    <div class="container-fluid">

        <div class="row">

            <div class="col-12">

                <?php if ($id != '') { ?>
                <div class="menu-tab">
                    <ul>
                        <li>
                            <a href="{{route('restaurants.view', $id)}}">{{trans('lang.tab_basic')}}</a>
                        </li>
                        <li class="active">
                            <a href="{{route('restaurants.foods', $id)}}">{{trans('lang.tab_foods')}}</a>
                        </li>
                        <li>
                            <a href="{{route('restaurants.orders', $id)}}">{{trans('lang.tab_orders')}}</a>
                        </li>
                        <li>
                            <a href="{{route('restaurants.coupons', $id)}}">{{trans('lang.tab_promos')}}</a>
                        <li>
                            <a href="{{route('restaurants.payout', $id)}}">{{trans('lang.tab_payouts')}}</a>
                        </li>
                        <li>
                            <a
                                href="{{route('payoutRequests.restaurants.view', $id)}}">{{trans('lang.tab_payout_request')}}</a>
                        </li>
                        <li>
                            <a href="{{route('restaurants.booktable', $id)}}">{{trans('lang.dine_in_future')}}</a>
                        </li>
                        <li id="restaurant_wallet"></li>

                    </ul>
                </div>
                <?php } ?>

                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs align-items-end card-header-tabs w-100">
                            <li class="nav-item">
                                <a class="nav-link active" href="{!! url()->current() !!}"><i
                                        class="fa fa-list mr-2"></i>{{trans('lang.food_table')}}</a>
                            </li>
                            <?php if ($id != '') { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('foods.create') !!}/{{$id}}"><i
                                        class="fa fa-plus mr-2"></i>{{trans('lang.food_create')}}</a>
                            </li>
                            <?php } else { ?>
                            <li class="nav-item">
                                <a class="nav-link" href="{!! route('foods.create') !!}"><i
                                        class="fa fa-plus mr-2"></i>{{trans('lang.food_create')}}</a>
                            </li>
                            <?php } ?>

                        </ul>
                    </div>
                    <div class="card-body">

                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                            style="display: none;">Processing...
                        </div>

                        <div class="table-responsive m-t-10">

                            <table id="foodTable"
                                class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                cellspacing="0" width="100%">

                                <thead>
                                    <tr>
                                        <?php if (in_array('foods.delete', json_decode(@session('user_permissions'), true))) { ?>
                                        <th class="delete-all"><input type="checkbox" id="select-all"><label
                                                class="col-3 control-label" for="select-all">
                                                <a id="deleteAll" class="do_not_delete" href="javascript:void(0)"><i
                                                        class="fa fa-trash"></i> {{trans('lang.all')}}</a></label></th>
                                        <?php } ?>
                                        <th>{{trans('lang.food_image')}}</th>
                                        <th>{{trans('lang.food_name')}}</th>
                                        <th>{{trans('lang.food_price')}}</th>
                                        <?php if ($id == '') { ?>
                                        <th>{{trans('lang.food_restaurant_id')}}</th>
                                        <?php } ?>

                                        <th>{{trans('lang.food_category_id')}}</th>
                                        <th>{{trans('lang.food_publish')}}</th>
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

</div>
</div>

@endsection

@section('scripts')

<script type="text/javascript">
    const urlParams = new URLSearchParams(location.search);
    for (const [key, value] of urlParams) {

        if (key == 'categoryID') {
            var categoryID = value;
        } else {
            var categoryID = '';
        }

    }
    var database = firebase.firestore();

    var currentCurrency = '';
    var currencyAtRight = false;
    var decimal_degits = 0;
    var storage = firebase.storage();
    var storageRef = firebase.storage().ref('images');
    var user_permissions = '<?php echo @session("user_permissions")?>';
    user_permissions = Object.values(JSON.parse(user_permissions));
    var checkDeletePermission = false;
    if ($.inArray('foods.delete', user_permissions) >= 0) {
        checkDeletePermission = true;
    }
    var restaurantID = "{{$id}}";
    if (categoryID != '' && categoryID != undefined) {
        var ref = database.collection('vendor_products').where('categoryID', '==', categoryID);
    } else {
        <?php if ($id != '') { ?>
        database.collection('vendors').where("id", "==", '<?php    echo $id; ?>').get().then(async function (snapshots) {
            var vendorData = snapshots.docs[0].data();
            walletRoute = "{{route('users.walletstransaction', ':id')}}";
            walletRoute = walletRoute.replace(":id", vendorData.author);
            $('#restaurant_wallet').append('<a href="' + walletRoute + '">{{trans("lang.wallet_transaction")}}</a>');
        });
        var ref = database.collection('vendor_products').where('vendorID', '==', '<?php    echo $id; ?>');
        const getStoreName = getStoreNameFunction('<?php    echo $id; ?>');
        <?php } else { ?>
        var ref = database.collection('vendor_products');
        <?php } ?>
    }
   

    var refCurrency = database.collection('currencies').where('isActive', '==', true);
    var append_list = '';

    refCurrency.get().then(async function (snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;

        if (currencyData.decimal_degits) {
            decimal_degits = currencyData.decimal_degits;
        }
    });

    var placeholderImage = '';
    var placeholder = database.collection('settings').doc('placeHolderImage');
    placeholder.get().then(async function (snapshotsimage) {
        var placeholderImageData = snapshotsimage.data();
        placeholderImage = placeholderImageData.image;
    })


    $(document).ready(function () {
        $('#category_search_dropdown').hide();

        $(document.body).on('click', '.redirecttopage', function () {
            var url = $(this).attr('data-url');
            window.location.href = url;
        });

        jQuery("#data-table_processing").show();

        const table = $('#foodTable').DataTable({
            pageLength: 10, // Number of rows per page
            processing: false, // Show processing indicator
            serverSide: true, // Enable server-side processing
            responsive: true,
            ajax: async function (data, callback, settings) {
                const start = data.start;
                const length = data.length;
                const searchValue = data.search.value.toLowerCase();
                const orderColumnIndex = data.order[0].column;
                const orderDirection = data.order[0].dir;
                @if($id != '')
                    const orderableColumns = (checkDeletePermission) ? ['', '', 'foodName', 'finalPrice', 'category', '', ''] : ['', 'name', 'finalPrice', 'category', '', '']; // Ensure this matches the actual column names
                @else
                    const orderableColumns = (checkDeletePermission) ? ['', '', 'foodName', 'finalPrice', 'restaurant', 'category', '', ''] : ['', 'name', 'finalPrice', 'restaurant', 'category', '', '']; // Ensure this matches the actual column names
                @endif
                const orderByField = orderableColumns[orderColumnIndex]; // Adjust the index to match your table

                if (searchValue.length >= 3 || searchValue.length === 0) {
                    $('#data-table_processing').show();
                }

                await ref.get().then(async function (querySnapshot) {
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
                    var restaurantNames={};
                    // Fetch restaurants names
                    @if($id == '')
                        const vendorDocs = await database.collection('vendors').get();
                        vendorDocs.forEach(doc => {
                            restaurantNames[doc.id] = doc.data().title;
                        });
                    @endif
                    var categoryNames={};
                    const categoryDocs = await database.collection('vendor_categories').get();
                    categoryDocs.forEach(doc => {
                        categoryNames[doc.id] = doc.data().title;
                    });
                    let records = [];
                    let filteredRecords = [];

                    await Promise.all(querySnapshot.docs.map(async (doc) => {
                        let childData = doc.data();
                        childData.id = doc.id; // Ensure the document ID is included in the data
                        var finalPrice = 0;
                        if (childData.hasOwnProperty('disPrice') && childData.disPrice != '' && childData.disPrice != '0') {
                            finalPrice = childData.disPrice;
                        } else {
                            finalPrice = childData.price;
                        }
                        childData.foodName=childData.name;
                        childData.finalPrice = parseInt(finalPrice);
                        childData.restaurant = restaurantNames[childData.vendorID] || '';
                        childData.category = categoryNames[childData.categoryID] || '';
                        if (searchValue) {
                            if (
                                (childData.name && childData.name.toString().toLowerCase().includes(searchValue)) ||
                                (childData.finalPrice && childData.finalPrice.toString().includes(searchValue))
                                || (childData.restaurant && childData.restaurant.toString().toLowerCase().includes(searchValue)) ||
                                (childData.category && childData.category.toString().toLowerCase().includes(searchValue))
                            ) {
                                filteredRecords.push(childData);
                            }
                        } else {
                            filteredRecords.push(childData);
                        }
                    }));
                    
                    filteredRecords.sort((a, b) => {
                        let aValue = a[orderByField] ;
                        let bValue = b[orderByField] ;                       
                        if (orderByField === 'finalPrice') {                       
                            aValue = a[orderByField] ? parseInt(a[orderByField]) : 0;
                            bValue = b[orderByField] ? parseInt(b[orderByField]) : 0;
                        }else{
                            aValue = a[orderByField] ? a[orderByField].toString().toLowerCase() : '';
                            bValue = b[orderByField] ? b[orderByField].toString().toLowerCase() : ''
                        }
                       
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
            order: (checkDeletePermission) ? [2, 'asc'] : [1, 'asc'],
            columnDefs: [
                {
                    orderable: false,
                    targets: (restaurantID == '') ? ((checkDeletePermission) ? [0, 1, 6, 7] : [0, 5, 6]) : ((checkDeletePermission) ? [0, 1, 5, 6] : [0, 4, 5])
                },
                 {
                    type: 'formatted-num',
                    targets: (checkDeletePermission) ? [3] : [2]
                }

            ],
            "language": {
                "zeroRecords": "{{trans("lang.no_record_found")}}",
                "emptyTable": "{{trans("lang.no_record_found")}}",
                "processing": "" // Remove default loader
            },

        });


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


    });
    async function buildHTML(val) {
        var html = [];
        newdate = '';
        var imageHtml = '';
        var id = val.id;
        var route1 = '{{route("foods.edit", ":id")}}';
        route1 = route1.replace(':id', id);

        <?php if ($id != '') { ?>

        route1 = route1 + '?eid={{$id}}';

        <?php } ?>
        if (val.photos != '' && val.photos != null) {
            imageHtml = '<img onerror="this.onerror=null;this.src=\'' + placeholderImage + '\'" class="rounded" style="width:50px" src="' + val.photo + '" alt="image">';


        } else if (val.photo != '' && val.photos != null) {
            imageHtml = '<img onerror="this.onerror=null;this.src=\'' + placeholderImage + '\'" class="rounded" style="width:50px" src="' + val.photo + '" alt="image">';


        } else {
            imageHtml = '<img class="rounded" style="width:50px" src="' + placeholderImage + '" alt="image">';


        }
        if (checkDeletePermission) {

            html.push('<td class="delete-all"><input type="checkbox" id="is_open_' + id + '" name="record" class="is_open" dataId="' + id + '"><label class="col-3 control-label"\n' +
                'for="is_open_' + id + '" ></label></td>');
        }

        html.push(imageHtml);

        html.push('<a href="' + route1 + '" >' + val.name + '</a>');


        if (val.hasOwnProperty('disPrice') && val.disPrice != '' && val.disPrice != '0') {
            if (currencyAtRight) {
                 html.push('<span class="text-green">' + parseFloat(val.disPrice).toFixed(decimal_degits) + '' + currentCurrency + '  <s>' + parseFloat(val.price).toFixed(decimal_degits) + '' + currentCurrency + '</s>');

            } else {
                 html.push('<span class="text-green">' + '' + currentCurrency + parseFloat(val.disPrice).toFixed(decimal_degits) + '  <s>' + currentCurrency + '' + parseFloat(val.price).toFixed(decimal_degits) + '</s>');

            }

        } else {

            if (currencyAtRight) {
                 html.push('<span class="text-green">' + parseFloat(val.price).toFixed(decimal_degits) + '' + currentCurrency );
            } else {
                 html.push('<span class="text-green">' + currentCurrency + '' + parseFloat(val.price).toFixed(decimal_degits));
            }
        }

        <?php if ($id == '') { ?>
        var restaurantroute = '{{route("restaurants.view", ":id")}}';
        restaurantroute = restaurantroute.replace(':id', val.vendorID);

         html.push('<a href="' + restaurantroute + '">' + val.restaurant + '</a>');
        <?php } ?>

        var caregoryroute = '{{route("categories.edit", ":id")}}';
        caregoryroute = caregoryroute.replace(':id', val.categoryID);

         html.push('<a href="' + caregoryroute + '">' + val.category + '</a>');
        if (val.publish) {
             html.push('<label class="switch"><input type="checkbox" checked id="' + val.id + '" name="isActive"><span class="slider round"></span></label>');
        } else {
             html.push('<label class="switch"><input type="checkbox" id="' + val.id + '" name="isActive"><span class="slider round"></span></label>');
        }
        var actionHtml='';
        actionHtml+='<span class="action-btn"><a href="' + route1 + '" class="link-td"><i class="fa fa-edit"></i></a>';
        if (checkDeletePermission) {
            actionHtml+='<a id="' + val.id + '" name="food-delete" href="javascript:void(0)" class="delete-btn"><i class="fa fa-trash"></i></a>';
        }
        actionHtml+='</span>';
        html.push(actionHtml);
        return html;
    }
    async function checkIfImageExists(url, callback) {
        const img = new Image();
        img.src = url;

        if (img.complete) {
            callback(true);
        } else {
            img.onload = () => {
                callback(true);
            };

            img.onerror = () => {
                callback(false);
            };
        }
    }

    $(document).on("click", "input[name='isActive']", function (e) {
        var ischeck = $(this).is(':checked');
        var id = this.id;
        if (ischeck) {
            database.collection('vendor_products').doc(id).update({
                'publish': true
            }).then(function (result) {

            });
        } else {
            database.collection('vendor_products').doc(id).update({
                'publish': false
            }).then(function (result) {

            });
        }

    });

    
    async function getStoreNameFunction(vendorId) {
        var vendorName = '';
        await database.collection('vendors').where('id', '==', vendorId).get().then(async function (snapshots) {
            if (!snapshots.empty) {
                var vendorData = snapshots.docs[0].data();

                vendorName = vendorData.title;
                $('.restaurantTitle').html('{{trans("lang.food_plural")}} - ' + vendorName);

                if (vendorData.dine_in_active == true) {
                    $(".dine_in_future").show();
                }
            }
        });

        return vendorName;

    }

   
    $(document).on("click", "a[name='food-delete']", function (e) {
        var id = this.id;
        database.collection('vendor_products').doc(id).delete().then(function (result) {
            window.location.href = '{{ url()->current() }}';
        });
    });

    $(document.body).on('change', '#selected_search', function () {

        if (jQuery(this).val() == 'category') {

            var ref_category = database.collection('vendor_categories');

            ref_category.get().then(async function (snapshots) {
                snapshots.docs.forEach((listval) => {
                    var data = listval.data();
                    $('#category_search_dropdown').append($("<option></option").attr("value", data.id).text(data.title));

                });

            });
            jQuery('#search').hide();
            jQuery('#category_search_dropdown').show();
        } else {
            jQuery('#search').show();
            jQuery('#category_search_dropdown').hide();

        }
    });

    $('#select-all').change(function () {
        var isChecked = $(this).prop('checked');
        $('input[type="checkbox"][name="record"]').prop('checked', isChecked);
    });

    $('#deleteAll').click(function () {
        if (confirm("{{trans('lang.selected_delete_alert')}}")) {
            jQuery("#data-table_processing").show();
            // Loop through all selected records and delete them
            $('input[type="checkbox"][name="record"]:checked').each(function () {
                var id = $(this).attr('dataId');
                // Perform deletion of record with id
                database.collection('vendor_products').doc(id).delete().then(function () {
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);

                });
            });

        }
    });
</script>


@endsection