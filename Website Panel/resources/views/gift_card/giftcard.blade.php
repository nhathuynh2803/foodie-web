@include('layouts.app')


@include('layouts.header')

@php
    $cityToCountry= file_get_contents(asset('tz-cities-to-countries.json'));
    $cityToCountry=json_decode($cityToCountry,true);
    $countriesJs=array();
    foreach($cityToCountry as $key=>$value){
        $countriesJs[$key]=$value;
    }
@endphp


<div class="siddhi-checkout">

    <div class="container position-relative">

        <div class="py-5 row">

            <div class="col-md-8 mb-3 checkout-left">
                <div id="gift_card_img"></div>

                <div class="checkout-left-inner">

                    <div class="siddhi-cart-item overflow-hidden bg-white mb-3 mt-3">

                        <div class="bg-white clearfix delevery-partner">
                            <div class="border-bottom p-3 add-note">

                                <h3>{{trans('lang.add_amount')}}</h3>

                                <div class="tip-box">

                                    <div class="custom-control custom-radio border-bottom py-2">

                                        <input type="radio" name="gift_amount" id="1000" value="1000"
                                               class="this_gift_amount custom-control-input">

                                        <label class="custom-control-label" for="1000">
                                            <span class="currency-symbol-left"></span>
                                            <span class="decimal_digit">1000</span>
                                            <span class="currency-symbol-right"></span>
                                        </label>

                                    </div>

                                    <div class="custom-control custom-radio border-bottom py-2">

                                        <input type="radio" name="gift_amount" id="2000" value="2000"
                                               class="this_gift_amount custom-control-input">

                                        <label class="custom-control-label" for="2000">
                                            <span class="currency-symbol-left"></span>
                                            <span class="decimal_digit">2000</span>
                                            <span class="currency-symbol-right"></span>
                                        </label>

                                    </div>

                                    <div class="custom-control custom-radio border-bottom py-2">

                                        <input type="radio" name="gift_amount" id="5000" value="5000"
                                               class="this_gift_amount custom-control-input">
                                        <label class="custom-control-label" for="5000">
                                            <span class="currency-symbol-left"></span>
                                            <span class="decimal_digit">5000</span>
                                            <span class="currency-symbol-right"></span>
                                        </label>

                                    </div>

                                    <div class="custom-control custom-radio border-bottom py-2">

                                        <input type="radio" name="gift_amount" id="other_amount" value="Other"
                                               class="custom-control-input">

                                        <label class="custom-control-label"
                                               for="other_amount">{{trans('lang.other')}}</label>

                                    </div>

                                    <div class="custom-control custom-radio border-bottom py-2" style="display: none;"
                                         id="add_gift_amount_box">
                                        <h3 class="text-left">{{trans('lang.add_amount')}}</h3>
                                        <input type="number" name="giftAmount"
                                               id="giftAmount" onchange="changeGiftAmount()"
                                               value="">

                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="add-note">
                        <div class="p-3">
                            <h3>{{trans('lang.message')}}</h3>
                            <textarea name="gift-card-desc" id="gift-card-desc"></textarea>
                        </div>
                    </div>
                    <input type="text" name="giftId" id="giftId" hidden>

                    <div class="accordion mb-3 rounded shadow-sm bg-white checkout-left-box border"
                         id="accordionExample">

                        <!-- Net Banking -->

                        <div class="siddhi-card border-bottom overflow-hidden">

                            <div class="siddhi-card-header" id="headingTwo">

                                <h6 class="mb-2 ml-2 mt-2">{{trans('lang.select_payment_option')}}</h6>

                            </div>
                        </div>

                        <!-- END Net Banking -->


                        <div class="siddhi-card overflow-hidden checkout-payment-options">

                            <div class="custom-control custom-radio border-bottom py-2" style="display:none;"
                                 id="razorpay_box">

                                <input type="radio" name="payment_method" id="razorpay" value="razorpay"
                                       class="custom-control-input" checked>

                                <label class="custom-control-label"
                                       for="razorpay">{{trans('lang.razorpay')}}</label>

                                <input type="hidden" id="isEnabled">

                                <input type="hidden" id="isSandboxEnabled">

                                <input type="hidden" id="razorpayKey">

                                <input type="hidden" id="razorpaySecret">

                            </div>


                            <div class="custom-control custom-radio border-bottom py-2" style="display:none;"
                                 id="stripe_box">

                                <input type="radio" name="payment_method" id="stripe" value="stripe"
                                       class="custom-control-input">

                                <label class="custom-control-label" for="stripe">{{trans('lang.stripe')}}</label>


                                <input type="hidden" id="isStripeSandboxEnabled">

                                <input type="hidden" id="stripeKey">

                                <input type="hidden" id="stripeSecret">

                            </div>


                            <div class="custom-control custom-radio border-bottom py-2" style="display:none;"
                                 id="paypal_box">

                                <input type="radio" name="payment_method" id="paypal" value="paypal"
                                       class="custom-control-input">

                                <label class="custom-control-label" for="paypal">{{trans('lang.pay_pal')}}</label>


                                <input type="hidden" id="ispaypalSandboxEnabled">

                                <input type="hidden" id="paypalKey">

                                <input type="hidden" id="paypalSecret">

                            </div>

                            <div class="custom-control custom-radio border-bottom py-2" style="display:none;"
                                 id="payfast_box">

                                <input type="radio" name="payment_method" id="payfast" value="payfast"
                                       class="custom-control-input">

                                <label class="custom-control-label" for="payfast">{{trans('lang.pay_fast')}}</label>

                                <input type="hidden" id="payfast_isEnabled">

                                <input type="hidden" id="payfast_isSandbox">

                                <input type="hidden" id="payfast_merchant_key">

                                <input type="hidden" id="payfast_merchant_id">

                                <input type="hidden" id="payfast_notify_url">

                                <input type="hidden" id="payfast_return_url">

                                <input type="hidden" id="payfast_cancel_url">


                            </div>

                            <div class="custom-control custom-radio border-bottom py-2" style="display:none;"
                                 id="paystack_box">

                                <input type="radio" name="payment_method" id="paystack" value="paystack"
                                       class="custom-control-input">

                                <label class="custom-control-label"
                                       for="paystack">{{trans('lang.pay_stack')}}</label>

                                <input type="hidden" id="paystack_isEnabled">

                                <input type="hidden" id="paystack_isSandbox">

                                <input type="hidden" id="paystack_public_key">

                                <input type="hidden" id="paystack_secret_key">

                            </div>

                            <div class="custom-control custom-radio border-bottom py-2" style="display:none;"
                                 id="flutterWave_box">

                                <input type="radio" name="payment_method" id="flutterwave" value="flutterwave"
                                       class="custom-control-input">

                                <label class="custom-control-label"
                                       for="flutterwave">{{trans('lang.flutter_wave')}}</label>

                                <input type="hidden" id="flutterWave_isEnabled">

                                <input type="hidden" id="flutterWave_isSandbox">

                                <input type="hidden" id="flutterWave_encryption_key">

                                <input type="hidden" id="flutterWave_public_key">

                                <input type="hidden" id="flutterWave_secret_key">

                            </div>
                            <div class="custom-control custom-radio border-bottom py-2" style="display:none;"
                                 id="mercadopago_box">

                                <input type="radio" name="payment_method" id="mercadopago" value="mercadopago"
                                       class="custom-control-input">

                                <label class="custom-control-label"
                                       for="mercadopago">{{trans('lang.mercadopago')}}</label>

                                <input type="hidden" id="mercadopago_isEnabled">

                                <input type="hidden" id="mercadopago_isSandbox">

                                <input type="hidden" id="mercadopago_public_key">

                                <input type="hidden" id="mercadopago_access_token">

                                <input type="hidden" id="title">

                                <input type="hidden" id="quantity">

                                <input type="hidden" id="unit_price">
                            </div>
                            <div class="custom-control custom-radio border-bottom py-2" style="display:none;" id="xendit_box">    
                                <input type="radio" name="payment_method" id="xendit" value="xendit" class="custom-control-input">
                                <label class="custom-control-label" for="xendit">{{trans('lang.xendit')}}</label>
                                <input type="hidden" id="xendit_enable">
                                <input type="hidden" id="xendit_apiKey">
                                <input type="hidden" id="xendit_image">
                                <input type="hidden" id="xendit_isSandbox">
                            </div>
                             <div class="custom-control custom-radio border-bottom py-2" style="display:none;" id="midtrans_box">
                                    <input type="radio" name="payment_method" id="midtrans" value="midtrans" class="custom-control-input">
                                    <label class="custom-control-label" for="midtrans">{{trans('lang.midtrans')}}</label>
                                    <input type="hidden" id="midtrans_enable">
                                    <input type="hidden" id="midtrans_serverKey">
                                    <input type="hidden" id="midtrans_image">
                                    <input type="hidden" id="midtrans_isSandbox">
                            </div>
                            <div class="custom-control custom-radio border-bottom py-2" style="display:none;" id="orangepay_box">
                                    <input type="radio" name="payment_method" id="orangepay" value="orangepay" class="custom-control-input">
                                    <label class="custom-control-label" for="orangepay">{{trans('lang.orangepay')}}</label>
                                    <input type="hidden" id="orangepay_auth">
                                    <input type="hidden" id="orangepay_clientId">
                                    <input type="hidden" id="orangepay_clientSecret">
                                    <input type="hidden" id="orangepay_image">
                                    <input type="hidden" id="orangepay_isSandbox">
                                    <input type="hidden" id="orangepay_merchantKey">
                                    <input type="hidden" id="orangepay_cancelUrl">
                                    <input type="hidden" id="orangepay_notifyUrl">
                                    <input type="hidden" id="orangepay_returnUrl">
                                    <input type="hidden" id="orangepay_enable">
                            </div>
                        </div>

                    </div>


                </div>

            </div>

            <div class="col-md-4">

                <div class="siddhi-cart-item rounded rounded shadow-sm overflow-hidden bg-white sticky_sidebar"
                     id="cart_list">
                    <div class="sidebar-header p-3">
                        <h3 class="font-weight-bold h6 w-100">{{trans('lang.billing_summary')}}</h3>
                        <p>{{trans('lang.billing_summary_title')}}</p>
                    </div>
                    <div class="bg-white p-3 clearfix btm-total">

                        <p class="mb-2">
                            {{trans('lang.sub_total')}}
                            <span class="float-right text-dark">
        	                <span class="currency-symbol-left"></span>
              <span id="sub_total">0</span>
           	<span class="currency-symbol-right"></span>
        </span>
                        </p>
                        <hr>

                        <h6 class="font-weight-bold mb-0">{{trans('lang.total')}}
                            <p class="float-right">
                                <span class="currency-symbol-left"></span>
                                <span id="total">0</span>
                                <span class="currency-symbol-right"></span>
                            </p>
                        </h6>
                    </div>

                    <div class="p-3">
                        <a class="btn btn-primary btn-block btn-lg" href="javascript:void(0)"
                           onclick="finalCheckout()">{{trans('lang.pay')}} <span
                                    class="currency-symbol-left"></span>
                            <span id="payableAmount">0</span>
                            <span class="currency-symbol-right"></span><i class="feather-arrow-right"></i></a>

                    </div>
                    <input type="text" id="total_pay" hidden>

                </div>

            </div>

        </div>

    </div>
</div>


@include('layouts.footer')


@include('layouts.nav')


<script src="https://unpkg.com/geofirestore/dist/geofirestore.js"></script>
<script type="text/javascript" src="{{asset('vendor/slick/slick.min.js')}}"></script>

<script type="text/javascript">

    cityToCountry = '<?php echo json_encode($countriesJs);?>';

    var currentCurrency = '';
    var currencyAtRight = false;

    var decimal_degits = 0;
    var refCurrency = database.collection('currencies').where('isActive', '==', true);
    var currencyData = '';
    refCurrency.get().then(async function (snapshots) {
        currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        currencyAtRight = currencyData.symbolAtRight;
        if (currencyData.decimal_degits) {
            decimal_degits = currencyData.decimal_degits;
        }
        loadcurrencynew();
    });

    cityToCountry = JSON.parse(cityToCountry);
    var userTimeZone = Intl.DateTimeFormat().resolvedOptions().timeZone;
    userCity = userTimeZone.split('/')[1];
    userCountry = cityToCountry[userCity];

    var wallet_amount = 0;
    var fcmToken = '';
    var id_gift = database.collection('tmp').doc().id;

    var userId = "<?php echo $id; ?>";

    var userDetailsRef = database.collection('users').where('id', "==", userId);

    var uservendorDetailsRef = database.collection('users');

    var vendorDetailsRef = database.collection('vendors');

    var AdminCommission = database.collection('settings').doc('AdminCommission');

    var razorpaySettings = database.collection('settings').doc('razorpaySettings');

    var codSettings = database.collection('settings').doc('CODSettings');

    var stripeSettings = database.collection('settings').doc('stripeSettings');

    var paypalSettings = database.collection('settings').doc('paypalSettings');

    var XenditSettings = database.collection('settings').doc('xendit_settings');

    var Midtrans_settings = database.collection('settings').doc('midtrans_settings');

    var OrangePaySettings = database.collection('settings').doc('orange_money_settings');

    var walletSettings = database.collection('settings').doc('walletSettings');
    taxSetting = [];

    var placeholderImage = '';
    var placeholder = database.collection('settings').doc('placeHolderImage');

    placeholder.get().then(async function (snapshotsimage) {
        var placeholderImageData = snapshotsimage.data();
        placeholderImage = placeholderImageData.image;
    })

    var reftaxSetting = database.collection('tax').where('country', '==', userCountry).where('enable', '==', true);
    reftaxSetting.get().then(async function (snapshots) {
        if (snapshots.docs.length > 0) {
            snapshots.docs.forEach((val) => {
                val = val.data();
                var obj = '';
                obj = {
                    'country': val.country,
                    'enable': val.enable,
                    'id': val.id,
                    'tax': val.tax,
                    'title': val.title,
                    'type': val.type,
                }
                taxSetting.push(obj);

            })
        }
    });
    var payFastSettings = database.collection('settings').doc('payFastSettings');

    var payStackSettings = database.collection('settings').doc('payStack');

    var flutterWaveSettings = database.collection('settings').doc('flutterWave');

    var MercadoPagoSettings = database.collection('settings').doc('MercadoPago');

    var giftRef = database.collection('gift_cards').where('isEnable', '==', true);

    function loadcurrencynew() {
        if (currencyAtRight) {
            jQuery('.currency-symbol-left').hide();
            jQuery('.currency-symbol-right').show();
            jQuery('.currency-symbol-right').text(currentCurrency);
        } else {
            jQuery('.currency-symbol-left').show();
            jQuery('.currency-symbol-right').hide();
            jQuery('.currency-symbol-left').text(currentCurrency);
        }

        $('.decimal_digit').each(function () {

            var amount = $(this).text();

            $(this).text(parseFloat(amount).toFixed(decimal_degits));
        });

        var amount = $('.decimal_digits').attr('data-val');
        jQuery('.decimal_digits').text(parseFloat(amount).toFixed(decimal_degits));

    }

    var orderPlacedSubject = '';
    var orderPlacedMsg = '';
    var scheduleOrderPlacedSubject = '';
    var scheduleOrderPlacedMsg = '';
    database.collection('dynamic_notification').get().then(async function (snapshot) {
        if (snapshot.docs.length > 0) {
            snapshot.docs.map(async (listval) => {
                val = listval.data();
                if (val.type == "order_placed") {
                    orderPlacedSubject = val.subject;
                    orderPlacedMsg = val.message;

                } else if (val.type == "schedule_order") {
                    scheduleOrderPlacedSubject = val.subject;
                    scheduleOrderPlacedMsg = val.message;
                }

            })
        }
    })
    $(document).ready(function () {
        getUserDetails();
    });


    async function getUserDetails() {

        razorpaySettings.get().then(async function (razorpaySettingsSnapshots) {

            razorpaySetting = razorpaySettingsSnapshots.data();

            if (razorpaySetting.isEnabled) {

                var isEnabled = razorpaySetting.isEnabled;

                $("#isEnabled").val(isEnabled);

                var isSandboxEnabled = razorpaySetting.isSandboxEnabled;

                $("#isSandboxEnabled").val(isSandboxEnabled);

                var razorpayKey = razorpaySetting.razorpayKey;

                $("#razorpayKey").val(razorpayKey);

                var razorpaySecret = razorpaySetting.razorpaySecret;

                $("#razorpaySecret").val(razorpaySecret);

                $("#razorpay_box").show();


            }

        });


        stripeSettings.get().then(async function (stripeSettingsSnapshots) {

            stripeSetting = stripeSettingsSnapshots.data();

            if (stripeSetting.isEnabled) {

                var isEnabled = stripeSetting.isEnabled;

                var isSandboxEnabled = stripeSetting.isSandboxEnabled;

                $("#isStripeSandboxEnabled").val(isSandboxEnabled);

                var stripeKey = stripeSetting.stripeKey;

                $("#stripeKey").val(stripeKey);

                var stripeSecret = stripeSetting.stripeSecret;

                $("#stripeSecret").val(stripeSecret);

                $("#stripe_box").show();


            }

        });


        paypalSettings.get().then(async function (paypalSettingsSnapshots) {

            paypalSetting = paypalSettingsSnapshots.data();

            if (paypalSetting.isEnabled) {

                var isEnabled = paypalSetting.isEnabled;

                var isLive = paypalSetting.isLive;

                if (isLive) {

                    $("#ispaypalSandboxEnabled").val(false);

                } else {

                    $("#ispaypalSandboxEnabled").val(true);

                }

                var paypalAppId = paypalSetting.paypalAppId;

                $("#paypalKey").val(paypalAppId);

                var paypalSecret = paypalSetting.paypalSecret;

                $("#paypalSecret").val(paypalSecret);

                $("#paypal_box").show();


            }

        });


        payFastSettings.get().then(async function (payfastSettingsSnapshots) {

            payFastSetting = payfastSettingsSnapshots.data();
            if (payFastSetting.isEnable) {

                var isEnable = payFastSetting.isEnable;

                $("#payfast_isEnabled").val(isEnable);

                var isSandboxEnabled = payFastSetting.isSandbox;

                $("#payfast_isSandbox").val(isSandboxEnabled);

                var merchant_id = payFastSetting.merchant_id;

                $("#payfast_merchant_id").val(merchant_id);

                var merchant_key = payFastSetting.merchant_key;

                $("#payfast_merchant_key").val(merchant_key);

                var return_url = payFastSetting.return_url;

                $("#payfast_return_url").val(return_url);

                var cancel_url = payFastSetting.cancel_url;

                $("#payfast_cancel_url").val(cancel_url);

                var notify_url = payFastSetting.notify_url;

                $("#payfast_notify_url").val(notify_url);

                $("#payfast_box").show();

            }

        });

        payStackSettings.get().then(async function (payStackSettingsSnapshots) {

            payStackSetting = payStackSettingsSnapshots.data();
            if (payStackSetting.isEnable) {

                var isEnable = payStackSetting.isEnable;

                $("#paystack_isEnabled").val(isEnable);

                var isSandboxEnabled = payStackSetting.isSandbox;

                $("#paystack_isSandbox").val(isSandboxEnabled);

                var publicKey = payStackSetting.publicKey;

                $("#paystack_public_key").val(publicKey);

                var secretKey = payStackSetting.secretKey;

                $("#paystack_secret_key").val(secretKey);

                $("#paystack_box").show();

            }

        });

        flutterWaveSettings.get().then(async function (flutterWaveSettingsSnapshots) {

            flutterWaveSetting = flutterWaveSettingsSnapshots.data();
            if (flutterWaveSetting.isEnable) {

                var isEnable = flutterWaveSetting.isEnable;

                $("#flutterWave_isEnabled").val(isEnable);

                var isSandboxEnabled = flutterWaveSetting.isSandbox;

                $("#flutterWave_isSandbox").val(isSandboxEnabled);

                var encryptionKey = flutterWaveSetting.encryptionKey;

                $("#flutterWave_encryption_key").val(encryptionKey);

                var secretKey = flutterWaveSetting.secretKey;

                $("#flutterWave_secret_key").val(secretKey);

                var publicKey = flutterWaveSetting.publicKey;

                $("#flutterWave_public_key").val(publicKey);

                $("#flutterWave_box").show();

            }

        });

        XenditSettings.get().then(async function (XenditSettingsSnapshots) {

            XenditSetting = XenditSettingsSnapshots.data();
            if (XenditSetting.enable) {
                $("#xendit_enable").val(XenditSetting.enable);
                $("#xendit_apiKey").val(XenditSetting.apiKey);
                $("#xendit_image").val(XenditSetting.image);
                $("#xendit_isSandbox").val(XenditSetting.isSandbox);
                $("#xendit_box").show();
            }
        });

        Midtrans_settings.get().then(async function (Midtrans_settingsSnapshots) {
            Midtrans_setting = Midtrans_settingsSnapshots.data();
            if (Midtrans_setting.enable) {
                $("#midtrans_enable").val(Midtrans_setting.enable);
                $("#midtrans_serverKey").val(Midtrans_setting.serverKey);
                $("#midtrans_image").val(Midtrans_setting.image);
                $("#midtrans_isSandbox").val(Midtrans_setting.isSandbox);
                $("#midtrans_box").show();
            }
        });

        OrangePaySettings.get().then(async function (OrangePaySettingsSnapshots) {
            OrangePaySetting = OrangePaySettingsSnapshots.data();
            if (OrangePaySetting.enable) {
                $("#orangepay_enable").val(OrangePaySetting.enable);
                $("#orangepay_auth").val(OrangePaySetting.auth);
                $("#orangepay_image").val(OrangePaySetting.image);
                $("#orangepay_isSandbox").val(OrangePaySetting.isSandbox);
                $("#orangepay_clientId").val(OrangePaySetting.clientId);
                $("#orangepay_clientSecret").val(OrangePaySetting.clientSecret);
                $("#orangepay_merchantKey").val(OrangePaySetting.merchantKey);
                $("#orangepay_notifyUrl").val(OrangePaySetting.notifyUrl);
                $("#orangepay_returnUrl").val(OrangePaySetting.returnUrl);
                $("#orangepay_cancelUrl").val(OrangePaySetting.cancelUrl);
                $("#orangepay_box").show();
            }
        });

        MercadoPagoSettings.get().then(async function (MercadoPagoSettingsSnapshots) {

            MercadoPagoSetting = MercadoPagoSettingsSnapshots.data();
            if (MercadoPagoSetting.isEnabled) {

                var isEnable = MercadoPagoSetting.isEnabled;

                $("#mercadopago_isEnabled").val(isEnable);

                var isSandboxEnabled = MercadoPagoSetting.isSandboxEnabled;

                $("#mercadopago_isSandbox").val(isSandboxEnabled);

                var PublicKey = MercadoPagoSetting.PublicKey;

                $("#mercadopago_public_key").val(PublicKey);

                var AccessToken = MercadoPagoSetting.AccessToken;

                $("#mercadopago_access_token").val(AccessToken);

                var AccessToken = MercadoPagoSetting.AccessToken;


                $("#mercadopago_box").show();

            }

        });
    }

    async function finalCheckout() {
        payableAmount = $('#giftAmount').val();
        if (payableAmount == 0 || payableAmount == '' || payableAmount == "0") {
            return false;

        }
        var giftId = $('#giftId').val();

        database.collection('gift_cards').where('id', '==', giftId).get().then(function (giftsnapshots) {
            var createdDate = firebase.firestore.FieldValue.serverTimestamp();

            var data = giftsnapshots.docs[0].data();
            var giftAmount = $('#giftAmount').val();
            var giftMessage = $('#gift-card-desc').val();
            var payment_method = $('input[name="payment_method"]:checked').val();
            var giftId = data.id;
            var giftTitle = data.title;
            var giftexpiry = data.expiryDay;
            var id = id_gift;
            var redeem = false;
            var user_id = userId;
            var giftPin = Math.floor(100000 + Math.random() * 900000);
            var date = new Date();
            var giftCode = date.getTime() + Math.floor(100 + Math.random() * 999);


            if (payment_method == "razorpay") {
                var razorpayKey = $("#razorpayKey").val();
                var razorpaySecret = $("#razorpaySecret").val();

                var gift_json = {
                    'giftId': giftId,
                    'price': giftAmount,
                    'message': giftMessage,
                    'redeem': false,
                    'userid': user_id,
                    'id': id,
                    'giftTitle': giftTitle,
                    'giftPin': giftPin,
                    'giftCode': giftCode,
                    'expiryDay': giftexpiry

                }
                $.ajax({

                    type: 'POST',

                    url: "<?php echo route('giftcard.processing'); ?>",

                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        order_json: gift_json,
                        razorpaySecret: razorpaySecret,
                        razorpayKey: razorpayKey,
                        payment_method: payment_method,
                        total_pay: giftAmount
                    },

                    success: function (data) {

                        data = JSON.parse(data);

                        $('#cart_list').html(data.html);
                        loadcurrencynew();

                        window.location.href = "<?php echo route('giftcard.pay'); ?>";

                    }

                });

            } else if (payment_method == "mercadopago") {

                var mercadopago_public_key = $("#mercadopago_public_key").val();
                var mercadopago_access_token = $("#mercadopago_access_token").val();
                var mercadopago_isSandbox = $("#mercadopago_isSandbox").val();
                var mercadopago_isEnabled = $("#mercadopago_isEnabled").val();
                var gift_json = {
                    'giftId': giftId,
                    'price': giftAmount,
                    'message': giftMessage,
                    'redeem': false,
                    'userid': user_id,
                    'id': id,
                    'giftTitle': giftTitle,
                    'giftPin': giftPin,
                    'giftCode': giftCode,
                    'expiryDay': giftexpiry

                }
                $.ajax({

                    type: 'POST',

                    url: "<?php echo route('giftcard.processing'); ?>",

                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        order_json: gift_json,
                        mercadopago_public_key: mercadopago_public_key,
                        mercadopago_access_token: mercadopago_access_token,
                        payment_method: payment_method,
                        id: id,
                        total_pay: giftAmount,
                        mercadopago_isSandbox: mercadopago_isSandbox,
                        mercadopago_isEnabled: mercadopago_isEnabled,
                        address_line1: '',
                        address_line2: '',
                        address_zipcode: '',
                        address_city: '',
                        address_country: ''
                    },

                    success: function (data) {

                        data = JSON.parse(data);

                        $('#cart_list').html(data.html);
                        loadcurrencynew();

                        window.location.href = "<?php echo route('giftcard.pay'); ?>";

                    }

                });
            } else if (payment_method == "stripe") {

                var stripeKey = $("#stripeKey").val();

                var stripeSecret = $("#stripeSecret").val();

                var isStripeSandboxEnabled = $("#isStripeSandboxEnabled").val();
                var gift_json = {
                    'giftId': giftId,
                    'price': giftAmount,
                    'message': giftMessage,
                    'redeem': false,
                    'userid': user_id,
                    'id': id,
                    'giftTitle': giftTitle,
                    'giftPin': giftPin,
                    'giftCode': giftCode,
                    'expiryDay': giftexpiry

                }


                $.ajax({

                    type: 'POST',

                    url: "<?php echo route('giftcard.processing'); ?>",

                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        order_json: gift_json,
                        stripeKey: stripeKey,
                        stripeSecret: stripeSecret,
                        payment_method: payment_method,
                        authorName: '',
                        total_pay: giftAmount,
                        isStripeSandboxEnabled: isStripeSandboxEnabled,
                        address_line1: '',
                        address_line2: '',
                        address_zipcode: '',
                        address_city: '',
                        address_country: ''
                    },

                    success: function (data) {

                        data = JSON.parse(data);

                        $('#cart_list').html(data.html);
                        loadcurrencynew();

                        window.location.href = "<?php echo route('giftcard.pay'); ?>";


                    }

                });


            } else if (payment_method == "paypal") {


                var paypalKey = $("#paypalKey").val();

                var paypalSecret = $("#paypalSecret").val();

                var ispaypalSandboxEnabled = $("#ispaypalSandboxEnabled").val();
                var gift_json = {
                    'giftId': giftId,
                    'price': giftAmount,
                    'message': giftMessage,
                    'redeem': false,
                    'userid': user_id,
                    'id': id,
                    'giftTitle': giftTitle,
                    'giftPin': giftPin,
                    'giftCode': giftCode,
                    'expiryDay': giftexpiry

                }

                $.ajax({

                    type: 'POST',

                    url: "<?php echo route('giftcard.processing'); ?>",

                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        order_json: gift_json,
                        paypalKey: paypalKey,
                        paypalSecret: paypalSecret,
                        payment_method: payment_method,
                        authorName: '',
                        total_pay: giftAmount,
                        ispaypalSandboxEnabled: ispaypalSandboxEnabled,
                        address_line1: '',
                        address_line2: '',
                        address_zipcode: '',
                        address_city: '',
                        address_country: ''
                    },

                    success: function (data) {

                        data = JSON.parse(data);

                        $('#cart_list').html(data.html);
                        loadcurrencynew();

                        window.location.href = "<?php echo route('giftcard.pay'); ?>";


                    }

                });


            } else if (payment_method == "payfast") {

                var payfast_merchant_key = $("#payfast_merchant_key").val();
                var payfast_merchant_id = $("#payfast_merchant_id").val();
                var payfast_return_url = $("#payfast_return_url").val();
                var payfast_notify_url = $("#payfast_notify_url").val();
                var payfast_cancel_url = $("#payfast_cancel_url").val();
                var payfast_isSandbox = $("#payfast_isSandbox").val();

                var gift_json = {
                    'giftId': giftId,
                    'price': giftAmount,
                    'message': giftMessage,
                    'redeem': false,
                    'userid': user_id,
                    'id': id,
                    'giftTitle': giftTitle,
                    'giftPin': giftPin,
                    'giftCode': giftCode,
                    'expiryDay': giftexpiry

                }

                $.ajax({

                    type: 'POST',

                    url: "<?php echo route('giftcard.processing'); ?>",

                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        order_json: gift_json,
                        payfast_merchant_key: payfast_merchant_key,
                        payfast_merchant_id: payfast_merchant_id,
                        payment_method: payment_method,
                        authorName: '',
                        total_pay: giftAmount,
                        payfast_isSandbox: payfast_isSandbox,
                        payfast_return_url: payfast_return_url,
                        payfast_notify_url: payfast_notify_url,
                        payfast_cancel_url: payfast_cancel_url,
                        address_line1: '',
                        address_line2: '',
                        address_zipcode: '',
                        address_city: '',
                        address_country: ''
                    },

                    success: function (data) {

                        data = JSON.parse(data);

                        $('#cart_list').html(data.html);
                        loadcurrencynew();

                        window.location.href = "<?php echo route('giftcard.pay'); ?>";


                    }

                });

            } else if (payment_method == "paystack") {

                var paystack_public_key = $("#paystack_public_key").val();
                var paystack_secret_key = $("#paystack_secret_key").val();
                var paystack_isSandbox = $("#paystack_isSandbox").val();

                var gift_json = {
                    'giftId': giftId,
                    'price': giftAmount,
                    'message': giftMessage,
                    'redeem': false,
                    'userid': user_id,
                    'id': id,
                    'giftTitle': giftTitle,
                    'giftPin': giftPin,
                    'giftCode': giftCode,
                    'expiryDay': giftexpiry

                }

                $.ajax({

                    type: 'POST',

                    url: "<?php echo route('giftcard.processing'); ?>",

                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        order_json: gift_json,
                        payment_method: payment_method,
                        authorName: '',
                        total_pay: giftAmount,
                        paystack_isSandbox: paystack_isSandbox,
                        paystack_public_key: paystack_public_key,
                        paystack_secret_key: paystack_secret_key,
                        address_line1: '',
                        address_line2: '',
                        address_zipcode: '',
                        address_city: '',
                        address_country: ''
                    },

                    success: function (data) {

                        data = JSON.parse(data);

                        $('#cart_list').html(data.html);
                        loadcurrencynew();

                        window.location.href = "<?php echo route('giftcard.pay'); ?>";


                    }

                });


            } else if (payment_method == "flutterwave") {

                var flutterwave_isenabled = $("#flutterWave_isEnabled").val();
                var flutterWave_encryption_key = $("#flutterWave_encryption_key").val();
                var flutterWave_public_key = $("#flutterWave_public_key").val();
                var flutterWave_secret_key = $("#flutterWave_secret_key").val();
                var flutterWave_isSandbox = $("#flutterWave_isSandbox").val();

                var gift_json = {
                    'giftId': giftId,
                    'price': giftAmount,
                    'message': giftMessage,
                    'redeem': false,
                    'userid': user_id,
                    'id': id,
                    'giftTitle': giftTitle,
                    'giftPin': giftPin,
                    'giftCode': giftCode,
                    'expiryDay': giftexpiry

                }

                $.ajax({

                    type: 'POST',

                    url: "<?php echo route('giftcard.processing'); ?>",

                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        order_json: gift_json,
                        payment_method: payment_method,
                        authorName: '',
                        total_pay: giftAmount,
                        flutterWave_isSandbox: flutterWave_isSandbox,
                        flutterWave_public_key: flutterWave_public_key,
                        flutterWave_secret_key: flutterWave_secret_key,
                        flutterwave_isenabled: flutterwave_isenabled,
                        flutterWave_encryption_key: flutterWave_encryption_key,
                        address_line1: '',
                        address_line2: '',
                        address_zipcode: '',
                        address_city: '',
                        address_country: '',
                        currencyData: currencyData
                    },

                    success: function (data) {

                        data = JSON.parse(data);

                        $('#cart_list').html(data.html);
                        loadcurrencynew();

                        window.location.href = "<?php echo route('giftcard.pay'); ?>";


                    }

                });
            } else if (payment_method == "xendit") {

                if (!['IDR', 'PHP', 'USD', 'VND', 'THB', 'MYR', 'SGD'].includes(currencyData.code)){
                    alert("Currency restriction");
                    return false;
                }
                var xendit_enable = $("#xendit_enable").val();
                var xendit_apiKey = $("#xendit_apiKey").val();
                var xendit_image = $("#xendit_image").val();
                var xendit_isSandbox = $("#xendit_isSandbox").val();        

                var gift_json = {
                    'giftId': giftId,
                    'price': giftAmount,
                    'message': giftMessage,
                    'redeem': false,
                    'userid': user_id,
                    'id': id,
                    'giftTitle': giftTitle,
                    'giftPin': giftPin,
                    'giftCode': giftCode,
                    'expiryDay': giftexpiry

                }

                $.ajax({

                    type: 'POST',

                    url: "<?php echo route('giftcard.processing'); ?>",

                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        order_json: gift_json,
                        payment_method: payment_method,
                        authorName: '',
                        total_pay: giftAmount,
                        xendit_enable: xendit_enable,
                        xendit_apiKey: xendit_apiKey,
                        xendit_image: xendit_image,
                        xendit_isSandbox: xendit_isSandbox,
                        address_line1: '',
                        address_line2: '',
                        address_zipcode: '',
                        address_city: '',
                        address_country: '',
                        currencyData: currencyData
                    },

                    success: function (data) {

                        data = JSON.parse(data);

                        $('#cart_list').html(data.html);
                        loadcurrencynew();

                        window.location.href = "<?php echo route('giftcard.pay'); ?>";


                    }

                });
            } else if (payment_method == "midtrans") {

                var midtrans_enable = $("#midtrans_enable").val();
                var midtrans_serverKey = $("#midtrans_serverKey").val();
                var midtrans_image = $("#midtrans_image").val();
                var midtrans_isSandbox = $("#midtrans_isSandbox").val();      

                var gift_json = {
                    'giftId': giftId,
                    'price': giftAmount,
                    'message': giftMessage,
                    'redeem': false,
                    'userid': user_id,
                    'id': id,
                    'giftTitle': giftTitle,
                    'giftPin': giftPin,
                    'giftCode': giftCode,
                    'expiryDay': giftexpiry

                }

                $.ajax({

                    type: 'POST',

                    url: "<?php echo route('giftcard.processing'); ?>",

                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        order_json: gift_json,
                        payment_method: payment_method,
                        authorName: '',
                        total_pay: giftAmount,
                        midtrans_enable: midtrans_enable,
                        midtrans_serverKey: midtrans_serverKey,
                        midtrans_image: midtrans_image,
                        midtrans_isSandbox: midtrans_isSandbox,
                        address_line1: '',
                        address_line2: '',
                        address_zipcode: '',
                        address_city: '',
                        address_country: '',
                        currencyData: currencyData
                    },

                    success: function (data) {

                        data = JSON.parse(data);

                        $('#cart_list').html(data.html);
                        loadcurrencynew();

                        window.location.href = "<?php echo route('giftcard.pay'); ?>";


                    }

                });
            } else if (payment_method == "orangepay") {

                var orangepay_enable = $("#orangepay_enable").val();
                var orangepay_auth = $("#orangepay_auth").val();
                var orangepay_image = $("#orangepay_image").val();
                var orangepay_isSandbox = $("#orangepay_isSandbox").val();
                var orangepay_clientId = $("#orangepay_clientId").val();
                var orangepay_clientSecret = $("#orangepay_clientSecret").val();
                var orangepay_merchantKey = $("#orangepay_merchantKey").val();
                var orangepay_notifyUrl = $("#orangepay_notifyUrl").val();
                var orangepay_returnUrl = $("#orangepay_returnUrl").val();
                var orangepay_cancelUrl = $("#orangepay_cancelUrl").val();   

                var gift_json = {
                    'giftId': giftId,
                    'price': giftAmount,
                    'message': giftMessage,
                    'redeem': false,
                    'userid': user_id,
                    'id': id,
                    'giftTitle': giftTitle,
                    'giftPin': giftPin,
                    'giftCode': giftCode,
                    'expiryDay': giftexpiry

                }

                $.ajax({

                    type: 'POST',

                    url: "<?php echo route('giftcard.processing'); ?>",

                    data: {
                        _token: '<?php echo csrf_token() ?>',
                        order_json: gift_json,
                        payment_method: payment_method,
                        authorName: '',
                        total_pay: giftAmount,
                        orangepay_enable: orangepay_enable,
                        orangepay_auth: orangepay_auth,
                        orangepay_image: orangepay_image,
                        orangepay_isSandbox: orangepay_isSandbox,
                        orangepay_clientId: orangepay_clientId,
                        orangepay_clientSecret: orangepay_clientSecret,
                        orangepay_merchantKey: orangepay_merchantKey,
                        orangepay_notifyUrl: orangepay_notifyUrl,
                        orangepay_returnUrl: orangepay_returnUrl,
                        orangepay_cancelUrl: orangepay_cancelUrl,
                        address_line1: '',
                        address_line2: '',
                        address_zipcode: '',
                        address_city: '',
                        address_country: '',
                        currencyData: currencyData
                    },

                    success: function (data) {

                        data = JSON.parse(data);

                        $('#cart_list').html(data.html);
                        loadcurrencynew();

                        window.location.href = "<?php echo route('giftcard.pay'); ?>";


                    }

                });

            }


        })
    }

    $(document).on("click", '#other_amount', function (event) {
        $("#giftAmount").val('');
        $("#add_gift_amount_box").show();
    });

    $(document).on("click", '.this_gift_amount', function (event) {
        $('.this_gift_amount').removeClass('tip_checked');

        var this_gift_amount = $(this).val();
        var data = $(this);
        $("#add_gift_amount_box").hide();

        if ((data).is('.tip_checked')) {
            data.removeClass('tip_checked');
            $(this).prop('checked', false);
            $("#giftAmount").val('');
            $('#sub_total').text(0);
            $('#total').text(0);
        } else {
            if (decimal_degits) {
                amount = parseFloat(this_gift_amount).toFixed(decimal_degits);
            } else {
                amount = parseFloat(this_gift_amount).toFixed(2);
            }
            $(this).addClass('tip_checked');
            $("#giftAmount").val(amount);
            $('#sub_total').text(amount);
            $('#total').text(amount);
            $('#payableAmount').text(amount);
        }


    });

    function changeGiftAmount() {
        var gift_amount = $('#giftAmount').val();

        if (gift_amount == '') {
            gift_amount = 0;
        }
        gift_amount = parseFloat(gift_amount).toFixed(decimal_degits);
        $('#sub_total').text(gift_amount);
        $('#total').text(gift_amount);
        $('#payableAmount').text(gift_amount);
    }

    giftRef.get().then(async function (giftSnapshots) {
        if (giftSnapshots.docs.length > 0) {
            var html = '';
            giftSnapshots.docs.forEach((val) => {
                var giftCardData = val.data();
                html += '<div class="banner-item">';
                html += '<div class="banner-img">';
                html += '<img onerror="this.onerror=null;this.src=\'' + placeholderImage + '\'" src="' + giftCardData.image + '" id="' + giftCardData.id + '">';
                html = html + '</div></div>';
            });
            $('#gift_card_img').html(html);
        } else {
            $('.checkout-left-inner').text('{{trans('lang.no_gift_card_available')}}');
        }
        slickcatCarousel();

    })

    function slickcatCarousel() {

        if ($("#gift_card_img").html() != "") {
            $('#gift_card_img').slick({
                slidesToShow: 1,
                dots: true,
                arrows: true
            });
        }
        var activeGiftCardId = $('.slick-active .banner-img').find("img").attr('id');
        $('#giftId').val(activeGiftCardId);

        giftRef.where('id', '==', activeGiftCardId).get().then(async function (Snapshots) {
            var data = Snapshots.docs[0].data();
            $('#gift-card-desc').val(data.message);

        })


    }

    $('#gift_card_img').on('afterChange', function (event, slick, currentSlide, nextSlide) {
        var currentSlide = $(slick.$slides[currentSlide]);
        var activeGiftCardId = currentSlide.find("img").attr('id');
        $('#giftId').val(activeGiftCardId);
        giftRef.where('id', '==', activeGiftCardId).get().then(async function (Snapshots) {
            var data = Snapshots.docs[0].data();
            $('#gift-card-desc').val(data.message);

        })
    });
</script>
