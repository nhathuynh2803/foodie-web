@include('layouts.app')


@include('layouts.header')

<div class="siddhi-favorites">
<div id="data-table_processing" class="dataTables_processing panel panel-default" style="display: none;">{{trans('lang.processing')}}...</div>

    <div class="container most_popular py-5">
        <h2 class="font-weight-bold mb-3">{{trans('lang.favorite_stores')}}</h2>
        <div class="text-center py-5 not_found_div" style="display:none">

            <p class="h4 mb-4"><i class="feather-search bg-primary rounded p-2"></i></p>

            <p class="font-weight-bold text-dark h5">{{trans('lang.nothing_found')}} </p>

        </div>
        <div id="append_list1" class="row"></div>

        <div class="row fu-loadmore-btn">
            <a class="page-link loadmore-btn" href="javascript:void(0);" id="loadmore" onclick="moreload()"
               data-dt-idx="0" tabindex="0">{{trans('lang.load_more')}} </a>
        </div>

    </div>
</div>


@include('layouts.footer')

@include('layouts.nav')


<script type="text/javascript">

    var newdate = new Date();
    var todaydate = new Date(newdate.setHours(23, 59, 59, 999));

    var ref = database.collection('favorite_restaurant').where('user_id', '==', user_uuid);

    var pagesize = 10;
    var offest = 1;
    var end = null;
    var endarray = [];
    var start = null;
    var append_list = '';

    var place_image = '';
    var ref_place = database.collection('settings').doc("placeHolderImage");
    ref_place.get().then(async function (snapshots) {

        var placeHolderImage = snapshots.data();
        place_image = placeHolderImage.image;

    });


    $(document).ready(function () {


        jQuery("#loadmore").hide();
        $("#data-table_processing").show();
        append_list = document.getElementById('append_list1');
        append_list.innerHTML = '';

        ref.limit(pagesize).get().then(async function (snapshots) {

            if (snapshots.docs.length > 0) {
                var html = '';
                html = await buildHTML(snapshots);
                jQuery("#data-table_processing").hide();

                if (html != '') {
                    jQuery('.not_found_div').hide();
                    append_list.innerHTML = html;
                    start = snapshots.docs[snapshots.docs.length - 1];
                    endarray.push(snapshots.docs[0]);
                    $("#data-table_processing").hide();
                    if (snapshots.docs.length < pagesize) {

                        jQuery("#loadmore").hide();
                    } else {
                        jQuery("#loadmore").show();
                    }
                }else{
                    jQuery('.not_found_div').show();
                }
            }
        else{
            jQuery("#data-table_processing").hide();
                    jQuery('.not_found_div').show();
                }
        });

    })


    async function buildHTML(snapshots) {
        var html = '';
        var alldata = [];
        var number = [];
        var vendorIDS = [];
        for(listval of snapshots.docs){
            var datas = listval.data();
            datas.id=listval.id;
            var isInZone = await checkInZone(datas.restaurant_id);
            if(isInZone){
                alldata.push(datas);
            }
        }

        alldata.forEach((listval) => {

            var val = listval;
            if(val.restaurant_id != undefined){
                 const vendor_name = vendorName(val.restaurant_id);
            }

            html = html + '<div class="col-md-4 mb-3"><div class="list-card bg-white h-100 rounded overflow-hidden position-relative shadow-sm grid-card">';

            html = html + '<div class="list-card-image">';

            var fav = [val.user_id, val.restaurant_id];
            html = html + '<div class="favourite-heart text-danger position-absolute"><a href="javascript:void(0);"  onclick="unFeveroute(`' + fav + '`)"><i class="fa fa-heart" style="color:red"></i></a></div>';

            html = html + '<a href="#" class="rurl_' + val.restaurant_id + '"><img alt="#" src="'+place_image+'" class="img-fluid item-img w-100 rimage_' + val.restaurant_id + '"></a>';
            html = html + '</div>';

            html = html + '<div class="p-3 position-relative">';

            html = html + '<div class="list-card-body"><h6 class="mb-1"><a href="#" class="text-black rtitle_' + val.restaurant_id + '"></a></h6>';

            html = html + '<p class="text-gray mb-3 rlocation_' + val.restaurant_id + '"><span class="fa fa-map-marker"></span></p>';
        
            html = html + '</div>';

            html = html + '<div class="list-card-badge"><div class="star position-relative"><span class="badge badge-success rreview_' + val.restaurant_id + '"><i class="feather-star"></i></span></div></div>';
        
            html = html + '</div>';

            html = html + '</div></div>';


        });

        return html;

    }

    async function moreload() {
        if (start != undefined || start != null) {
            jQuery("#data-table_processing").hide();

            listener = ref.startAfter(start).limit(pagesize).get();
            listener.then(async (snapshots) => {

                html = '';
                html = await buildHTML(snapshots);

                jQuery("#data-table_processing").hide();
                if (html != '') {
                    append_list.innerHTML += html;
                    start = snapshots.docs[snapshots.docs.length - 1];

                    if (endarray.indexOf(snapshots.docs[0]) != -1) {
                        endarray.splice(endarray.indexOf(snapshots.docs[0]), 1);
                    }
                    endarray.push(snapshots.docs[0]);

                    if (snapshots.docs.length < pagesize) {

                        jQuery("#loadmore").hide();
                    } else {
                        jQuery("#loadmore").show();
                    }
                }
            });
        }
    }


    async function vendorName(vendorID) {

        var vendorName = '';
        var vendor_url = '';
        var vendor_photo = '';
        var vendor_location = '';
        var rating = 0;
        var reviewsCount = 0
        await database.collection('vendors').where("id", "==", vendorID).get().then(async function (snapshotss) {

            if (snapshotss.docs[0]) {

                var vendor = snapshotss.docs[0].data();
                vendorName = vendor.title;
                if(vendor.photo!='' && vendor.photo!=null){
                  vendor_photo = vendor.photo;
                }else{
                  vendor_photo =place_image;
                }

                vendor_location = vendor.location;

                vendor_url = "{{route('restaurant',':id')}}";
                vendor_url = vendor_url.replace(':id', 'id=' + vendor.id);

                if (vendor.hasOwnProperty('reviewsSum') && vendor.reviewsSum != 0 && vendor.hasOwnProperty('reviewsCount') && vendor.reviewsCount != 0) {
                     rating = (vendor.reviewsSum / vendor.reviewsCount);
                    rating = Math.round(rating * 10) / 10;
                    reviewsCount = vendor.reviewsCount;
                }

                jQuery(".rtitle_" + vendorID).html(vendorName);
                jQuery(".rtitle_" + vendorID).attr('href', vendor_url);
                jQuery(".rurl_" + vendorID).attr('href', vendor_url);
                jQuery(".rimage_" + vendorID).attr('src', vendor_photo);
                jQuery(".rlocation_" + vendorID).append(vendor_location);
                jQuery(".rreview_" + vendorID).append(rating + '(' + reviewsCount + '+)');

            } else {

                jQuery(".rtitle_" + vendorID).html('');
                jQuery(".rtitle_" + vendorID).attr('href', '#');

            }
        });
        return vendorName;
    }

    async function checkInZone(vendorID) {
        var vendor_zone_id = '';
        var snapshots = await database.collection('vendors').doc(vendorID).get();
        if(snapshots.exists){
            var vendor = snapshots.data();
            vendor_zone_id = vendor.zoneId;
        }
        return user_zone_id == vendor_zone_id ? true : false;
    }

    async function unFeveroute(id) {
        var data = id.split(",");
        var user_id = data[0];
        var store_id = data[1];


        const doc = await database.collection('favorite_restaurant').where('user_id', '==', user_id).where('restaurant_id', '==', store_id).get();
        doc.forEach(element => {
            element.ref.delete().then(function (result) {
                window.location.href = '{{ url()->current() }}';
            });

        });
    }


</script>
