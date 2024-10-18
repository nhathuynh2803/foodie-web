@extends('layouts.app')


@section('content')
<div class="page-wrapper">


    <div class="row page-titles">

        <div class="col-md-5 align-self-center">

            <h3 class="text-themecolor restaurantTitle">{{trans('lang.restaurants_payout_plural')}}</h3>

        </div>

        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{url('/dashboard')}}">{{trans('lang.dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('lang.restaurants_payout_plural')}}</li>
            </ol>
        </div>

        <div>

        </div>

    </div>


    <div class="container-fluid">

        <div class="row">

            <div class="col-12">
                <?php if ($id != '') { ?>
                    <div class="menu-tab">
                        <ul>
                            <li>
                                <a href="{{route('restaurants.view',$id)}}">{{trans('lang.tab_basic')}}</a>
                            </li>
                            <li>
                                <a href="{{route('restaurants.foods',$id)}}">{{trans('lang.tab_foods')}}</a>
                            </li>
                            <li>
                                <a href="{{route('restaurants.orders',$id)}}">{{trans('lang.tab_orders')}}</a>
                            </li>
                            <li>
                                <a href="{{route('restaurants.coupons',$id)}}">{{trans('lang.tab_promos')}}</a>
                            <li class="active">
                                <a href="{{route('restaurants.payout',$id)}}">{{trans('lang.tab_payouts')}}</a>
                            </li>
                            <li>
                                <a
                                    href="{{route('payoutRequests.restaurants.view',$id)}}">{{trans('lang.tab_payout_request')}}</a>
                            </li>
                            <li>
                                <a href="{{route('restaurants.booktable',$id)}}">{{trans('lang.dine_in_future')}}</a>
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
                                        class="fa fa-list mr-2"></i>{{trans('lang.restaurants_payout_table')}}</a>
                            </li>

                            <?php if ($id != '') { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="{!! route('restaurantsPayouts.create') !!}/{{$id}}"><i
                                            class="fa fa-plus mr-2"></i>{{trans('lang.restaurants_payout_create')}}</a>
                                </li>
                            <?php } else { ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="{!! route('restaurantsPayouts.create') !!}"><i
                                            class="fa fa-plus mr-2"></i>{{trans('lang.restaurants_payout_create')}}</a>
                                </li>
                            <?php } ?>


                        </ul>
                    </div>
                    <div class="card-body">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                            style="display: none;">{{trans('lang.processing')}}
                        </div>

                        <div class="table-responsive m-t-10">


                            <table id="restaurantPayoutTable"
                                class="display nowrap table table-hover table-striped table-bordered table table-striped"
                                cellspacing="0" width="100%">

                                <thead>

                                    <tr>
                                        <?php if ($id == '') { ?>
                                            <th>{{ trans('lang.restaurant')}}</th>
                                        <?php } ?>
                                        <th>{{trans('lang.paid_amount')}}</th>
                                        <th>{{trans('lang.date')}}</th>
                                        <th>{{trans('lang.restaurants_payout_note')}}</th>
                                        <th>Admin {{trans('lang.restaurants_payout_note')}}</th>
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

</div>
</div>

@endsection

@section('scripts')

<script>

    var database = firebase.firestore();
    var intRegex = /^\d+$/;
    var floatRegex = /^((\d+(\.\d *)?)|((\d*\.)?\d+))$/;

    var getId = '{{$id}}';
    <?php if ($id != '') { ?>
        database.collection('vendors').where("id", "==", '<?php echo $id; ?>').get().then(async function (snapshots) {
            var vendorData = snapshots.docs[0].data();
            walletRoute = "{{route('users.walletstransaction',':id')}}";
            walletRoute = walletRoute.replace(":id", vendorData.author);
            $('#restaurant_wallet').append('<a href="' + walletRoute + '">{{trans("lang.wallet_transaction")}}</a>');
        });
        var refData = database.collection('payouts').where('vendorID', '==', '<?php echo $id; ?>').where('paymentStatus', '==', 'Success');
        var ref = refData.orderBy('paidDate', 'desc');

        const getStoreName = getStoreNameFunction('<?php echo $id; ?>');

    <?php } else { ?>
        var refData = database.collection('payouts').where('paymentStatus', '==', 'Success');
        var ref = refData.orderBy('paidDate', 'desc');
    <?php } ?>

    var currentCurrency = '';
    var currencyAtRight = false;
    var decimal_degits = 0;

    var refCurrency = database.collection('currencies').where('isActive', '==', true);
    refCurrency.get().then(async function (snapshots) {
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;

        if (currencyData.decimal_degits) {
            decimal_degits = currencyData.decimal_degits;
        }
    });

    var append_list = '';

    $(document).ready(function () {

        $(document.body).on('click', '.redirecttopage', function () {
            var url = $(this).attr('data-url');
            window.location.href = url;
        });

        jQuery("#data-table_processing").show();

        const table = $('#restaurantPayoutTable').DataTable({
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
                const orderableColumns = (getId != '') ? ['amount', 'paidDate', 'note', 'adminNote'] : ['restaurant', 'amount', 'paidDate', 'note', 'adminNote']; // Ensure this matches the actual column names
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

                    let records = [];
                    let filteredRecords = [];

                    await Promise.all(querySnapshot.docs.map(async (doc) => {
                        let childData = doc.data();
                        childData.restaurant = await payoutRestaurant(childData.vendorID);
                        childData.id = doc.id; // Ensure the document ID is included in the data              
                        if (searchValue) {
                            var date = '';
                            var time = '';
                            if (childData.hasOwnProperty("paidDate")) {
                                try {
                                    date = childData.paidDate.toDate().toDateString();
                                    time = childData.paidDate.toDate().toLocaleTimeString('en-US');
                                } catch (err) {
                                }
                            }
                            var paidDate = date + ' ' + time;
                            if (
                                (childData.restaurant && childData.restaurant.toString().toLowerCase().includes(searchValue)) ||
                                (childData.amount && childData.amount.toString().includes(searchValue)) ||
                                (paidDate && paidDate.toString().toLowerCase().indexOf(searchValue) > -1) ||
                                (childData.note && (childData.note).toLowerCase().includes(searchValue))||
                                (childData.adminNote && (childData.adminNote).toString().includes(searchValue))

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
                        if (orderByField === 'createdAt') {
                            try {
                                aValue = a[orderByField] ? new Date(a[orderByField].toDate()).getTime() : 0;
                                bValue = b[orderByField] ? new Date(b[orderByField].toDate()).getTime() : 0;
                            } catch (err) {

                            }
                        }
                         if (orderByField === 'amount') {
                                aValue = a[orderByField] ? parseFloat(a[orderByField]) : 0;
                                bValue = b[orderByField] ? parseFloat(b[orderByField]) : 0;
   
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
            order: [[2, 'desc']],
            columnDefs: [
                {
                    targets:  2,
                    type: 'date',
                    render: function (data) {
                        return data;
                    }
                },
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
    async function payoutRestaurant(restaurant) {
        var payoutRestaurant = '';
        await database.collection('vendors').where("id", "==", restaurant).get().then(async function (snapshotss) {
            if (snapshotss.docs[0]) {
                var restaurant_data = snapshotss.docs[0].data();
                payoutRestaurant = restaurant_data.title;
            }
        });
        return payoutRestaurant;
    }

    async function getStoreNameFunction(vendorId) {
        var vendorName = '';
        await database.collection('vendors').where('id', '==', vendorId).get().then(async function (snapshots) {
            if (!snapshots.empty) {
                var vendorData = snapshots.docs[0].data();

                vendorName = vendorData.title;
                $('.restaurantTitle').html('{{trans("lang.restaurants_payout_plural")}} - ' + vendorName);

                if (vendorData.dine_in_active == true) {
                    $(".dine_in_future").show();
                }
            }
        });

        return vendorName;

    }

  
    async function buildHTML(val) {
        var html = [];

        var price_val = '';
        var price = val.amount;

        if (intRegex.test(price) || floatRegex.test(price)) {

            price = parseFloat(price).toFixed(2);
        } else {
            price = 0;
        }

        if (currencyAtRight) {
            price_val = parseFloat(price).toFixed(decimal_degits) + "" + currentCurrency;
        } else {
            price_val = currentCurrency + "" + parseFloat(price).toFixed(decimal_degits);
        }
        <?php if ($id == '') { ?>
            var route = '{{route("restaurants.view",":id")}}';
            route = route.replace(':id', val.vendorID);
           
            html.push('<a href="' + route + '" class="redirecttopage" >' + val.restaurant + '</a>');
        <?php } ?>
        html.push('<span class="text-red">(' + price_val + ')</span>');
        var date = val.paidDate.toDate().toDateString();
        var time = val.paidDate.toDate().toLocaleTimeString('en-US');
        html.push('<span class="dt-time">' + date + ' ' + time + '</span>');

        if (val.note != undefined && val.note != '') {
           html.push(val.note);
        } else {
            html.push('');
        }
        if (val.adminNote != undefined && val.adminNote != '') {
            html.push(val.adminNote);
        } else {
            html.push('');
        }
        return html;
    }



</script>

@endsection