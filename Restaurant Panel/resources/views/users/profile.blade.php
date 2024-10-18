@extends('layouts.app')

@section('content')
    <div class="page-wrapper">
        <div class="row page-titles">

            <div class="col-md-5 align-self-center">
                <h3 class="text-themecolor">{{trans('lang.user_profile')}}</h3>
            </div>
            <div class="col-md-7 align-self-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{!! route('dashboard') !!}">{{trans('lang.dashboard')}}</a>
                    </li>
                    <li class="breadcrumb-item active">{{trans('lang.user_profile_edit')}}</li>
                </ol>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <div class="resttab-sec">
                        <div id="data-table_processing" class="dataTables_processing panel panel-default"
                             style="display: none;">{{ trans('lang.processing')}}</div>
                        <div class="error_top"></div>
                        <div class="row restaurant_payout_create">
                            <div class="restaurant_payout_create-inner">

                                <fieldset>
                                    <legend>{{trans('lang.basic_details')}}</legend>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.first_name')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control user_first_name" required>
                                            <div class="form-text text-muted">
                                                {{ trans("lang.user_first_name_help") }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.last_name')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control user_last_name">
                                            <div class="form-text text-muted">
                                                {{ trans("lang.user_last_name_help") }}
                                            </div>
                                        </div>
                                    </div>


                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.email')}}</label>
                                        <div class="col-7">
                                            <input type="email" class="form-control user_email" required>
                                            <div class="form-text text-muted">
                                                {{ trans("lang.user_email_help") }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.user_phone')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control user_phone">
                                            <div class="form-text text-muted w-50">
                                                {{ trans("lang.user_phone_help") }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-3 control-label">{{trans('lang.profile_pic')}}</label>
                                        <div class="col-9">
                                            <input type="file" onChange="handleFileSelectowner(event,'vendor')">
                                            <div id="uploding_image_owner"></div>
                                            <div class="uploaded_image_owner mt-3" style="display:none;"><img
                                                        id="uploaded_image_owner" src="" width="150px" height="150px;">
                                            </div>
                                            <div class="form-text text-muted">
                                                {{ trans("lang.restaurant_image_help") }}
                                            </div>
                                        </div>
                                    </div>


                                </fieldset>

                                <fieldset>
                                    <legend>{{trans('lang.password')}}</legend>
                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.old_password')}}</label>
                                        <div class="col-7">
                                            <input type="password" class="form-control user_old_password" required>
                                            <div class="form-text text-muted">
                                                {{ trans("lang.user_password_help") }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.new_password')}}</label>
                                        <div class="col-7">
                                            <input type="password" class="form-control user_new_password" required>
                                            <div class="form-text text-muted">
                                                {{ trans("lang.user_password_help") }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-12 text-center">
                                        <button type="button" class="btn btn-primary  change_user_password"><i
                                                    class="fa fa-save"></i>{{trans('lang.change_password')}}</button>
                                    </div>

                                </fieldset>
                                <fieldset>
                                    <legend>{{trans('lang.restaurant_details')}}</legend>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.restaurant_name')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control restaurant_name">
                                            <div class="form-text text-muted">
                                                {{ trans("lang.restaurant_name_help") }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.wallet_amount')}}</label>
                                        <h5 class="col-3 control-label text-primary user_wallet"><span
                                                    id="wallet_balance"></span></h5>

                                    </div>


                                    <div class="form-group row">
                                        <label class="col-3 control-label">{{trans('lang.restaurant_cuisines')}}</label>
                                        <div class="col-7">
                                            <select id='restaurant_cuisines' class="form-control">
                                                <option value="">Select Cuisines</option>
                                            </select>
                                            <div class="form-text text-muted">
                                                {{ trans("lang.restaurant_cuisines_help") }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-3 control-label">{{trans('lang.restaurant_phone')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control restaurant_phone">
                                            <div class="form-text text-muted">
                                                {{ trans("lang.restaurant_phone_help") }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-3 control-label">{{trans('lang.restaurant_address')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control restaurant_address">
                                            <div class="form-text text-muted">
                                                {{ trans("lang.restaurant_address_help") }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row width-50">
                                        <label class="col-3 control-label">{{trans('lang.zone')}}<span
                                                    class="required-field"></span></label>
                                        <div class="col-7">
                                            <select id='zone' class="form-control">
                                                <option value="">{{ trans("lang.select_zone") }}</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-3 control-label">{{trans('lang.restaurant_latitude')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control restaurant_latitude">
                                            <div class="form-text text-muted">
                                                {{ trans("lang.restaurant_latitude_help") }}
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-3 control-label">{{trans('lang.restaurant_longitude')}}</label>
                                        <div class="col-7">
                                            <input type="text" class="form-control restaurant_longitude">
                                            <div class="form-text text-muted">
                                                {{ trans("lang.restaurant_longitude_help") }}
                                            </div>
                                        </div>
                                        <div class="form-text text-muted ml-3">
                                            Don't Know your cordinates ? use <a target="_blank" href="https://www.latlong.net/">Latitude and Longitude Finder</a>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <label class="col-3 control-label ">{{trans('lang.restaurant_description')}}</label>
                                        <div class="col-7">
                                            <textarea rows="7" class="restaurant_description form-control"
                                                      id="restaurant_description"></textarea>
                                        </div>
                                    </div>

                                    <!-- <div class="form-group row">
                                        <label class="col-3 control-label">{{trans('lang.restaurant_image')}}</label>
                                        <div class="col-7">
                                            <input type="file" onChange="handleFileSelect(event,'photo')">
                                            <div id="uploding_image"></div>
                                            <div class="uploaded_image" style="display:none;"><img id="uploaded_image"
                                                                                                   src="" width="150px"
                                                                                                   height="150px;">
                                            </div>
                                            <div class="form-text text-muted">
                                                {{ trans("lang.restaurant_image_help") }}
                                            </div>
                                        </div>
                                    </div> -->

                                </fieldset>

                                <fieldset>
                                    <legend>{{trans('lang.gallery')}}</legend>

                                    <div class="form-group row width-50 restaurant_image">
                                        <div class="col-12">
                                            <div id="photos"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12">
                                            <input type="file" id="galleryImage"
                                                   onChange="handleFileSelect(event,'photos')">
                                            <div id="uploding_image_photos"></div>
                                        </div>
                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>{{trans('lang.services')}}</legend>

                                    <div class="form-group row">

                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Free_Wi_Fi">
                                            <label class="col-3 control-label"
                                                   for="Free_Wi_Fi">{{trans('lang.free_wi_fi')}}</label>
                                        </div>
                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Good_for_Breakfast">
                                            <label class="col-3 control-label"
                                                   for="Good_for_Breakfast">{{trans('lang.good_for_breakfast')}}</label>
                                        </div>
                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Good_for_Dinner">
                                            <label class="col-3 control-label"
                                                   for="Good_for_Dinner">{{trans('lang.good_for_dinner')}}</label>
                                        </div>
                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Good_for_Lunch">
                                            <label class="col-3 control-label"
                                                   for="Good_for_Lunch">{{trans('lang.good_for_lunch')}}</label>
                                        </div>

                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Live_Music">
                                            <label class="col-3 control-label"
                                                   for="Live_Music">{{trans('lang.Live_Music')}}</label>
                                        </div>

                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Outdoor_Seating">
                                            <label class="col-3 control-label"
                                                   for="Outdoor_Seating">{{trans('lang.outdoor_seating')}}</label>
                                        </div>

                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Takes_Reservations">
                                            <label class="col-3 control-label"
                                                   for="Takes_Reservations">{{trans('lang.takes_reservations')}}</label>
                                        </div>

                                        <div class="form-check width-100">
                                            <input type="checkbox" id="Vegetarian_Friendly">
                                            <label class="col-3 control-label"
                                                   for="Vegetarian_Friendly">{{trans('lang.vegetarian_friendly')}}</label>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>{{trans('lang.working_hours')}}</legend>

                                    <div class="form-group row">
                                        <label class="col-12 control-label"
                                               style="color:red;font-size:15px;">{{trans('lang.working_hour_note')}}</label>
                                        <div class="form-group row width-100">
                                            <div class="col-7">
                                                <button type="button"
                                                        class="btn btn-primary  add_working_hours_restaurant_btn">
                                                    <i></i>{{trans('lang.add_working_hours')}}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="working_hours_div" style="display:none">

                                            <div class="form-group row mb-0">
                                                <label class="col-1 control-label">{{trans('lang.sunday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary add_more_sunday"
                                                            onclick="addMorehour('Sunday','sunday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>


                                            <div class="restaurant_working_hour_Sunday_div restaurant_discount mb-5 form-group row mt-2"
                                                 style="display:none">
                                                <div class="col-12">
                                                    <table class="booking-table" id="working_hour_table_Sunday">
                                                        <tr>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.from')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.to')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                            </th>
                                                        </tr>

                                                    </table>
                                                </div>

                                            </div>

                                            <div class="form-group row mb-0">
                                                <label class="col-1 control-label">{{trans('lang.monday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary add_more_sunday"
                                                            onclick="addMorehour('Monday','monday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="restaurant_working_hour_Monday_div restaurant_discount mb-5 form-group row mt-2"
                                                 style="display:none">
                                                <div class="col-12">
                                                    <table class="booking-table" id="working_hour_table_Monday">
                                                        <tr>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.from')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.to')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label class="col-1 control-label">{{trans('lang.tuesday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="addMorehour('Tuesday','tuesday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="restaurant_working_hour_Tuesday_div restaurant_discount mb-5 form-group row mt-2"
                                                 style="display:none">
                                                <div class="col-12">
                                                    <table class="booking-table" id="working_hour_table_Tuesday">
                                                        <tr>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.from')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.to')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                            </th>
                                                        </tr>

                                                    </table>
                                                </div>
                                            </div>
                                            <div class="form-group row mb-0">
                                                <label class="col-1 control-label">{{trans('lang.wednesday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="addMorehour('Wednesday','wednesday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>


                                            <div class="restaurant_working_hour_Wednesday_div restaurant_discount mb-5 form-group row mt-2"
                                                 style="display:none">
                                                <div class="col-12">
                                                    <table class="booking-table" id="working_hour_table_Wednesday">
                                                        <tr>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.from')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.to')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                            </th>
                                                        </tr>

                                                    </table>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <label class="col-1 control-label">{{trans('lang.thursday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="addMorehour('Thursday','thursday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="restaurant_working_hour_Thursday_div restaurant_discount mb-5 form-group row mt-2"
                                                 style="display:none">
                                                <div class="col-12">
                                                    <table class="booking-table" id="working_hour_table_Thursday">
                                                        <tr>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.from')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.to')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                            </th>
                                                        </tr>

                                                    </table>
                                                </div>
                                            </div>

                                            <div class="form-group row mb-0">
                                                <label class="col-1 control-label">{{trans('lang.friday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="addMorehour('Friday','friday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="restaurant_working_hour_Friday_div restaurant_discount mb-5 form-group row mt-2"
                                                 style="display:none">
                                                <div class="col-12">
                                                    <table class="booking-table" id="working_hour_table_Friday">
                                                        <tr>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.from')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.to')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                            </th>
                                                        </tr>

                                                    </table>
                                                </div>
                                            </div>


                                            <div class="form-group row mb-0">
                                                <label class="col-1 control-label">{{trans('lang.Saturday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="addMorehour('Saturday','Saturday','1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="restaurant_working_hour_Saturday_div restaurant_discount mb-5 form-group row mt-2"
                                                 style="display:none">
                                                <div class="col-12">
                                                    <table class="booking-table" id="working_hour_table_Saturday">
                                                        <tr>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.from')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.to')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset class="dineInFuture hide">
                                    <legend>{{trans('lang.dine_in_future_setting')}}</legend>

                                    <div class="form-group row">

                                        <div class="form-group row width-50">
                                            <div class="form-check width-100">
                                                <input type="checkbox" id="dine_in_feature" class="">
                                                <label class="col-3 control-label"
                                                       for="dine_in_feature">{{trans('lang.enable_dine_in_feature')}}</label>
                                            </div>
                                        </div>

                                        <div class="divein_div" style="display:none">

                                            <div class="form-group row width-50">
                                                <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                <div class="col-7">
                                                    <input type="time" class="form-control" id="openDineTime" required>
                                                </div>
                                            </div>

                                            <div class="form-group row width-50">
                                                <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                <div class="col-7">
                                                    <input type="time" class="form-control" id="closeDineTime" required>
                                                </div>
                                            </div>

                                            <div class="form-group row width-50">
                                                <label class="col-3 control-label">Cost</label>
                                                <div class="col-7">
                                                    <input type="number" class="form-control restaurant_cost" required>
                                                </div>
                                            </div>
                                            <div class="form-group row width-100 restaurant_image">
                                                <label class="col-3 control-label">Menu Card Images</label>
                                                <div class="col-12">
                                                    <div id="photos_menu_card"></div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12">
                                                    <input type="file" onChange="handleFileSelectMenuCard(event)">
                                                    <div id="uploaded_image_menu"></div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>
                                <fieldset>
                                    <legend>{{trans('lang.deliveryCharge')}}</legend>

                                    <div class="form-group row">

                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{ trans('lang.delivery_charges_per_km')}}</label>
                                            <div class="col-7">
                                                <input type="number" class="form-control" id="delivery_charges_per_km">
                                            </div>
                                        </div>
                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{ trans('lang.minimum_delivery_charges')}}</label>
                                            <div class="col-7">
                                                <input type="number" class="form-control" id="minimum_delivery_charges">
                                            </div>
                                        </div>
                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{ trans('lang.minimum_delivery_charges_within_km')}}</label>
                                            <div class="col-7">
                                                <input type="number" class="form-control"
                                                       id="minimum_delivery_charges_within_km">
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset>
                                    <legend>{{trans('lang.bankdetails')}}</legend>

                                    <div class="form-group row">

                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{
              trans('lang.bank_name')}}</label>
                                            <div class="col-7">
                                                <input type="text" name="bank_name" class="form-control" id="bankName">
                                            </div>
                                        </div>

                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{
              trans('lang.branch_name')}}</label>
                                            <div class="col-7">
                                                <input type="text" name="branch_name" class="form-control"
                                                       id="branchName">
                                            </div>
                                        </div>


                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{
              trans('lang.holer_name')}}</label>
                                            <div class="col-7">
                                                <input type="text" name="holer_name" class="form-control"
                                                       id="holderName">
                                            </div>
                                        </div>

                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{
              trans('lang.account_number')}}</label>
                                            <div class="col-7">
                                                <input type="text" name="account_number" class="form-control"
                                                       id="accountNumber">
                                            </div>
                                        </div>

                                        <div class="form-group row width-100">
                                            <label class="col-4 control-label">{{
              trans('lang.other_information')}}</label>
                                            <div class="col-7">
                                                <input type="text" name="other_information" class="form-control"
                                                       id="otherDetails">
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset class="special_offer" style="display: none">
                                    <legend>{{trans('lang.special_offer')}}</legend>
                                    <div class="form-check width-100">
                                        <input type="checkbox" id="specialDiscountEnable">
                                        <label class="col-3 control-label"
                                               for="specialDiscountEnable">{{trans('lang.special_discount_enable')}}</label>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-12 control-label"
                                               style="color:red;font-size:15px;">{{trans('lang.special_discount_note')}}</label>
                                        <div class="form-group row width-100">
                                            <div class="col-7">
                                                <button type="button"
                                                        class="btn btn-primary  add_special_offer_restaurant_btn">
                                                    <i></i>{{trans('lang.add_special_offer')}}
                                                </button>
                                            </div>
                                        </div>
                                        <div class="special_offer_div" style="display:none">


                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.sunday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary add_more_sunday"
                                                            onclick="addMoreButton('Sunday','sunday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>


                                            <div class="restaurant_discount_options_Sunday_div restaurant_discount form-group row mt-2"
                                                 style="display:none">

                                                <div class="col-12">
                                                    <table class="booking-table" id="special_offer_table_Sunday">
                                                        <tr>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.coupon_discount')}}
                                                                    {{trans('lang.type')}}</label></th>

                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                            </th>
                                                        </tr>

                                                    </table>
                                                </div>

                                            </div>

                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.monday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary add_more_sunday"
                                                            onclick="addMoreButton('Monday','monday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="restaurant_discount_options_Monday_div restaurant_discount form-group row mt-2"
                                                 style="display:none">

                                                <div class="col-12">
                                                    <table class="booking-table" id="special_offer_table_Monday">
                                                        <tr>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.coupon_discount')}}
                                                                    {{trans('lang.type')}}</label></th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.tuesday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="addMoreButton('Tuesday','tuesday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="restaurant_discount_options_Tuesday_div restaurant_discount form-group row mt-2"
                                                 style="display:none">
                                                <div class="col-12">
                                                    <table class="booking-table" id="special_offer_table_Tuesday">
                                                        <tr>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.coupon_discount')}}
                                                                    {{trans('lang.type')}}</label></th>

                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                            </th>
                                                        </tr>

                                                    </table>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.wednesday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="addMoreButton('Wednesday','wednesday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>


                                            <div class="restaurant_discount_options_Wednesday_div restaurant_discount form-group row mt-2"
                                                 style="display:none">
                                                <div class="col-12">
                                                    <table class="booking-table" id="special_offer_table_Wednesday">
                                                        <tr>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.coupon_discount')}}
                                                                    {{trans('lang.type')}}</label></th>

                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                            </th>
                                                        </tr>

                                                    </table>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.thursday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="addMoreButton('Thursday','thursday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="restaurant_discount_options_Thursday_div restaurant_discount form-group row mt-2"
                                                 style="display:none">
                                                <div class="col-12">
                                                    <table class="booking-table" id="special_offer_table_Thursday">
                                                        <tr>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.coupon_discount')}}
                                                                    {{trans('lang.type')}}</label></th>

                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                            </th>
                                                        </tr>

                                                    </table>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.friday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="addMoreButton('Friday','friday', '1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>

                                            <div class="restaurant_discount_options_Friday_div restaurant_discount form-group row mt-2"
                                                 style="display:none">
                                                <div class="col-12">
                                                    <table class="booking-table" id="special_offer_table_Friday">
                                                        <tr>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.coupon_discount')}}
                                                                    {{trans('lang.type')}}</label></th>

                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                            </th>
                                                        </tr>

                                                    </table>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-1 control-label">{{trans('lang.Saturday')}}</label>
                                                <div class="col-12">
                                                    <button type="button" class="btn btn-primary"
                                                            onclick="addMoreButton('Saturday','Saturday','1')">
                                                        {{trans('lang.add_more')}}
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="restaurant_discount_options_Saturday_div restaurant_discount form-group row mt-2"
                                                 style="display:none">
                                                <div class="col-12">
                                                    <table class="booking-table" id="special_offer_table_Saturday">
                                                        <tr>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.Opening_Time')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.Closing_Time')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.coupon_discount')}}</label>
                                                            </th>
                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.coupon_discount')}}
                                                                    {{trans('lang.type')}}</label></th>

                                                            <th>
                                                                <label class="col-3 control-label">{{trans('lang.actions')}}</label>
                                                            </th>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </fieldset>

                                <fieldset id="story_upload_div" style="display: none;">
                                    <legend>Story</legend>
                                    <div class="form-group row">
                                        <label class="col-12 control-label" style="color:red;font-size:15px;">NOTE :
                                            Please Click on Save Button After Making Changes in Image Or Video, Otherwise Data may not Save!! </label>
                                    </div>

                                    <div class="form-group row width-50 vendor_image">
                                        <label class="col-3 control-label">Choose humbling GIF/Image</label>
                                        <div class="col-12">
                                            <div id="story_thumbnail"></div>
                                        </div>
                                    </div>


                                    <div class="form-group row">
                                        <div class="col-12">
                                            <input type="file" id="file"
                                                   onChange="handleStoryThumbnailFileSelect(event)">
                                            <div id="uploding_story_thumbnail"></div>
                                        </div>
                                    </div>


                                    <div class="form-group row vendor_image">
                                        <label class="col-3 control-label">Select Story Video</label>
                                        <div class="col-12">
                                            <div id="story_vedios" class="row"></div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <div class="col-12">
                                            <input type="file" id="video_file" onChange="handleStoryFileSelect(event)">
                                            <div id="uploding_story_video"></div>
                                        </div>
                                    </div>

                                </fieldset>
                            </div>


                        </div>
                    </div>
                </div>

            </div>
            <div class="form-group col-12 text-center btm-btn">
                <button type="button" class="btn btn-primary  save_restaurant_btn"><i
                            class="fa fa-save"></i> {{trans('lang.save')}}</button>
                <a href="{!! route('dashboard') !!}" class="btn btn-default"><i
                            class="fa fa-undo"></i>{{trans('lang.cancel')}}</a>
            </div>

        </div>
    </div>
    </div>


@endsection

@section('scripts')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/compressorjs/1.1.1/compressor.min.js"
            integrity="sha512-VaRptAfSxXFAv+vx33XixtIVT9A/9unb1Q8fp63y1ljF+Sbka+eMJWoDAArdm7jOYuLQHVx5v60TQ+t3EA8weA=="
            crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.26.0/moment.min.js"></script>

    <script>

        var database = firebase.firestore();
        var geoFirestore = new GeoFirestore(database);
        var storageRef = firebase.storage().ref('images');
        var storage = firebase.storage();
        var photo = "";
        var menuPhotoCount = 0;
        var restaurantMenuPhotos = "";
        var restaurant_menu_photos = [];
        var new_added_restaurant_menu_filename = [];
        var new_added_restaurant_menu = [];
        var menuImageToDelete = [];
        var restaurantPhoto = '';
        var resPhotoFileName = '';
        var resPhotoOldImageFile = '';
        var restaurnt_photos = [];
        var new_added_restaurant = "";
        photos_filename = [];
        var new_added_restaurant_photos = [];
        var new_added_restaurant_photos_filename=[];
        var new_added_restaurant_story_filename = [];
        var new_added_restaurant_story = [];
        var galleryImageToDelete = [];
        var ownerphoto = '';
        var ownerFileName = '';
        var ownerOldImageFile = '';

        var restaurantOwnerId = "";
        var restaurantOwnerOnline = false;
        var photocount = 0;
        var ownerPhoto = '';
        var ownerId = '';
        var vendorUserId = "<?php echo $id; ?>";
        var id = '';
        var restaurantOwnerPhoto = '';
        var placeholderImage = '';
        var adminAllowtoChangeFivein;

        var workingHours = [];
        var timeslotworkSunday = [];
        var timeslotworkMonday = [];
        var timeslotworkTuesday = [];
        var timeslotworkWednesday = [];
        var timeslotworkFriday = [];
        var timeslotworkSaturday = [];
        var timeslotworkThursday = [];

        var specialDiscount = [];
        var timeslotSunday = [];
        var timeslotMonday = [];
        var timeslotTuesday = [];
        var timeslotWednesday = [];
        var timeslotFriday = [];
        var timeslotSaturday = [];
        var timeslotThursday = [];
        var story_upload_time = [];
        var story_vedios = [];
        var story_thumbnail = '';
        var story_thumbnail_filename = '';
        var story_thumbnail_oldfile = '';
        var storyCount = 0;
        var isStory = database.collection('settings').doc('story');
        var storyRef = firebase.storage().ref('Story');
        var storyImagesRef = firebase.storage().ref('Story/images');

        var ref_deliverycharge = database.collection('settings').doc("DeliveryCharge");
        var placeholder = database.collection('settings').doc('placeHolderImage');
        placeholder.get().then(async function (snapshotsimage) {
            var placeholderImageData = snapshotsimage.data();
            placeholderImage = placeholderImageData.image;
        })
        
        database.collection('settings').doc("specialDiscountOffer").get().then(async function (snapshots) {
            var specialDiscountOffer = snapshots.data();
            specialDiscountOfferisEnable = specialDiscountOffer.isEnable;
        });

        database.collection('zone').where('publish', '==', true).orderBy('name','asc').get().then(async function (snapshots) {
            snapshots.docs.forEach((listval) => {
                var data = listval.data();
                var area = [];
                data.area.forEach((location) => {
                    area.push({'latitude': location.latitude,'longitude': location.longitude});
                });
                $('#zone').append($("<option></option>")
                    .attr("value", data.id)
                    .attr("data-area", JSON.stringify(area))
                    .text(data.name));
            })
        });
        
        var currentCurrency = '';
        var currencyAtRight = false;
        var decimal_degits = '';
        var refCurrency = database.collection('currencies').where('isActive', '==', true);
        refCurrency.get().then(async function (snapshots) {
            var currencyData = snapshots.docs[0].data();
            currentCurrency = currencyData.symbol;
            decimal_degits = currencyData.decimal_degits;
            currencyAtRight = currencyData.symbolAtRight;
        });

        ref_deliverycharge.get().then(async function (snapshots_charge) {
            var deliveryChargeSettings = snapshots_charge.data();
            try {
                if (deliveryChargeSettings.vendor_can_modify) {
                    $("#delivery_charges_per_km").val(deliveryChargeSettings.delivery_charges_per_km);
                    $("#minimum_delivery_charges").val(deliveryChargeSettings.minimum_delivery_charges);
                    $("#minimum_delivery_charges_within_km").val(deliveryChargeSettings.minimum_delivery_charges_within_km);
                } else {
                    $("#delivery_charges_per_km").val(deliveryChargeSettings.delivery_charges_per_km);
                    $("#minimum_delivery_charges").val(deliveryChargeSettings.minimum_delivery_charges);
                    $("#minimum_delivery_charges_within_km").val(deliveryChargeSettings.minimum_delivery_charges_within_km);
                    $("#delivery_charges_per_km").prop('disabled', true);
                    $("#minimum_delivery_charges").prop('disabled', true);
                    $("#minimum_delivery_charges_within_km").prop('disabled', true);
                }
            } catch (error) {

            }
        });

        var refDineInRestaurant = database.collection('settings').doc("DineinForRestaurant");

        refDineInRestaurant.get().then(async function (snapshotsDinein) {
            var enableddineinRestaurant = snapshotsDinein.data();
            adminAllowtoChangeFivein = enableddineinRestaurant.isEnabled;
        })

        getVendorId(vendorUserId).then(data => {

            vendorId = data;
            id = vendorId;
            var ref = database.collection('vendors').where("id", "==", vendorId);
            $(document).ready(function () {
                jQuery("#data-table_processing").show();
                if (specialDiscountOfferisEnable) {
                    $(".special_offer").show();
                }
                $(document).on("click", ".remove-btn", function () {
                    var id = $(this).attr('data-id');
                    var photo_remove = $(this).attr('data-img');
                    var status = $(this).attr('data-status');
                    if (status == "old") {
                        galleryImageToDelete.push(firebase.storage().refFromURL(photo_remove));
                    }
                    $("#photo_" + id).remove();
                    index = restaurnt_photos.indexOf(photo_remove);
                    if (index > -1) {
                        restaurnt_photos.splice(index, 1); // 2nd parameter means remove one item only
                    }
                    index = new_added_restaurant_photos.indexOf(photo_remove);
                    if (index > -1) {
                        new_added_restaurant_photos.splice(index, 1); // 2nd parameter means remove one item only
                        new_added_restaurant_photos_filename.splice(index, 1);
                    }


                });
                $(document).on("click", ".remove-menu-btn", function () {
                    var id = $(this).attr('data-id');
                    var photo_remove = $(this).attr('data-img');
                    var status = $(this).attr('data-status');
                    if (status == "old") {
                        menuImageToDelete.push(firebase.storage().refFromURL(photo_remove));
                    }
                    $("#photo_menu_" + id).remove();
                    index = restaurant_menu_photos.indexOf(photo_remove);
                    if (index > -1) {
                        restaurant_menu_photos.splice(index, 1); // 2nd parameter means remove one item only
                    }
                    index = new_added_restaurant_menu.indexOf(photo_remove);
                    if (index > -1) {
                        new_added_restaurant_menu.splice(index, 1); // 2nd parameter means remove one item only
                        new_added_restaurant_menu_filename.splice(index, 1);
                    }

                });

                database.collection('settings').doc("DineinForRestaurant").get().then(async function (settingSnapshots) {
                    if (settingSnapshots.data()) {
                        var settingData = settingSnapshots.data();
                        var enabledDineInFuture = settingData.isEnabled;
                        if (enabledDineInFuture) {
                            $('.dineInFuture').show();
                        } else {
                            $('.dineInFuture').hide();
                        }
                    }
                })

                isStory.get().then(async function (snapshots) {
                    var story_data = snapshots.data();
                    if (story_data.isEnabled) {
                        $("#story_upload_div").show();
                    }
                    storevideoDuration = story_data.videoDuration;
                });
                ref.get().then(async function (snapshots) {

                    try {

                        var restaurant = snapshots.docs[0].data();
                        var name = restaurant.authorName.split(" ");
                        $(".user_first_name").val(name[0]);
                        $(".user_last_name").val(name[1]);
                        $(".user_phone").val(restaurant.phonenumber);
                        if (restaurant.hasOwnProperty('zoneId') && restaurant.zoneId != '') {
                            $("#zone").val(restaurant.zoneId);
                        }
                        $(".restaurant_name").val(restaurant.title);
                        $(".restaurant_address").val(restaurant.location);
                        $(".restaurant_latitude").val(restaurant.latitude);
                        $(".restaurant_longitude").val(restaurant.longitude);
                        $(".restaurant_description").val(restaurant.description);
                        if (restaurant.photo != '' && restaurant.photo !=null) {
                            restaurantPhoto = restaurant.photo;
                            resPhotoOldImageFile = restaurant.photo;
                            $("#uploaded_image").attr('src', restaurant.photo);
                        } else {
                            $("#uploaded_image").attr('src', placeholderImage);
                        }
                        $(".uploaded_image").show();
                        restaurantPhoto = restaurant.photo;

                        try {
                            if (restaurant.openDineTime) {
                                restaurant.openDineTime = moment(restaurant.openDineTime, 'hh:mm A').format('HH:mm');
                            }

                            if (restaurant.closeDineTime) {
                                restaurant.closeDineTime = moment(restaurant.closeDineTime, 'hh:mm A').format('HH:mm');
                            }

                            $("#openDineTime").val(restaurant.openDineTime);
                            $("#closeDineTime").val(restaurant.closeDineTime);

                        } catch (error) {

                        }

                        if (restaurant.hasOwnProperty('restaurantCost')) {
                            $(".restaurant_cost").val(restaurant.restaurantCost);
                        }

                        var menuCardPhotos = ''
                        if (restaurant.hasOwnProperty('restaurantMenuPhotos')) {
                            restaurant_menu_photos = restaurant.restaurantMenuPhotos;
                            var paddingClass = '';
                            restaurant.restaurantMenuPhotos.forEach((photo) => {
                                menuPhotoCount++;
                                if (menuPhotoCount == 1) {
                                    paddingClass = "pl-0";
                                }
                                menuCardPhotos = menuCardPhotos + '<span class="image-item" id="photo_menu_' + menuPhotoCount + '"><span class="remove-menu-btn" data-id="' + menuPhotoCount + '" data-img="' + photo + '" data-status="old"><i class="fa fa-remove"></i></span><img onerror="this.onerror=null;this.src=\'' + placeholderImage + '\'" width="100px" id="" height="auto" src="' + photo + '"></span>';
                            })
                        }

                        if (menuCardPhotos!="" && menuCardPhotos!=null) {
                            $("#photos_menu_card").html(menuCardPhotos);
                        } else {
                            $("#photos_menu_card").html('<p>Menu card photos not available.</p>');
                        }

                        if (restaurant.hasOwnProperty('enabledDiveInFuture') && restaurant.enabledDiveInFuture == true) {
                            $(".divein_div").show();
                        }

                        if (restaurant.reststatus) {
                            $("#is_open").prop("checked", true);
                        }
                        if (restaurant.hasOwnProperty('enabledDiveInFuture')) {

                            if (adminAllowtoChangeFivein == false) {
                                $('#dine_in_feature').attr('disabled', 'disabled');
                            }
                            if (restaurant.enabledDiveInFuture) {
                                $("#dine_in_feature").prop("checked", true);
                            }
                        }

                        for (var key in restaurant.filters) {

                            if (key == "Free Wi-Fi" && restaurant.filters[key] == "Yes") {
                                $("#Free_Wi_Fi").prop("checked", true);
                            }
                            if (key == "Good for Breakfast" && restaurant.filters[key] == "Yes") {
                                $("#Good_for_Breakfast").prop("checked", true);
                            }
                            if (key == "Good for Dinner" && restaurant.filters[key] == "Yes") {
                                $("#Good_for_Dinner").prop("checked", true);
                            }
                            if (key == "Good for Lunch" && restaurant.filters[key] == "Yes") {
                                $("#Good_for_Lunch").prop("checked", true);
                            }
                            if (key == "Live Music" && restaurant.filters[key] == "Yes") {
                                $("#Live_Music").prop("checked", true);
                            }
                            if (key == "Outdoor Seating" && restaurant.filters[key] == "Yes") {
                                $("#Outdoor_Seating").prop("checked", true);
                            }
                            if (key == "Takes Reservations" && restaurant.filters[key] == "Yes") {
                                $("#Takes_Reservations").prop("checked", true);
                            }
                            if (key == "Vegetarian Friendly" && restaurant.filters[key] == "Yes") {
                                $("#Vegetarian_Friendly").prop("checked", true);
                            }


                        }

                        restaurnt_photos = restaurant.photos;
                        var photos = '';
                        var menuCardPhotos = ''
                        restaurant.photos.forEach((photo) => {

                            photocount++;
                            photos = photos + '<span class="image-item" id="photo_' + photocount + '"><span class="remove-btn" data-id="' + photocount + '" data-img="' + photo + '" data-status="old"><i class="fa fa-remove"></i></span><img onerror="this.onerror=null;this.src=\'' + placeholderImage + '\'" width="100px" id="" height="auto" src="' + photo + '"></span>';
                        })
                        if (photos!="" && photos != null) {
                            $("#photos").html(photos);
                        } else {
                            $("#photos").html('<p>photos not available.</p>');
                        }


                        restaurantOwnerOnline = restaurant.isActive;
                        photo = restaurant.photo;
                        restaurantOwnerId = restaurant.author;

                        await database.collection('users').where("id", "==", restaurant.author).get().then(async function (snapshots) {
                            snapshots.docs.forEach((listval) => {
                                var user = listval.data();

                                ownerId = user.id;
                                $(".user_first_name").val(user.firstName);
                                $(".user_last_name").val(user.lastName);
                                $(".user_email").val(user.email);
                                $(".user_phone").val(user.phoneNumber);
                                restaurantOwnerPhoto = user.profilePictureURL;
                                if (user.profilePictureURL != '') {
                                    ownerphoto = user.profilePictureURL
                                    ownerOldImageFile = user.profilePictureURL;

                                    $("#uploaded_image_owner").attr('src', user.profilePictureURL);
                                } else {

                                    $("#uploaded_image_owner").attr('src', placeholderImage);
                                }

                                $(".uploaded_image_owner").show();

                                if (user.userBankDetails) {
                                    if (user.userBankDetails.bankName != undefined) {
                                        $("#bankName").val(user.userBankDetails.bankName);
                                    }
                                    if (user.userBankDetails.branchName != undefined) {
                                        $("#branchName").val(user.userBankDetails.branchName);
                                    }
                                    if (user.userBankDetails.holderName != undefined) {
                                        $("#holderName").val(user.userBankDetails.holderName);
                                    }
                                    if (user.userBankDetails.accountNumber != undefined) {
                                        $("#accountNumber").val(user.userBankDetails.accountNumber);
                                    }
                                    if (user.userBankDetails.otherDetails != undefined) {
                                        $("#otherDetails").val(user.userBankDetails.otherDetails);
                                    }
                                }

                                if (user.wallet_amount != undefined) {
                                    var wallet = user.wallet_amount;
                                } else {
                                    var wallet = 0;

                                }
                                if (currencyAtRight) {
                                    var price_val = parseFloat(wallet).toFixed(decimal_degits) + "" + currentCurrency;

                                } else {
                                    var price_val = currentCurrency + "" + parseFloat(wallet).toFixed(decimal_degits);

                                }
                                $('#wallet_balance').html(price_val);

                            })
                        });

                        await database.collection('vendor_categories').get().then(async function (snapshots) {
                            snapshots.docs.forEach((listval) => {
                                var data = listval.data();
                                if (data.id == restaurant.categoryID) {
                                    $('#restaurant_cuisines').append($("<option selected></option>")
                                        .attr("value", data.id)
                                        .text(data.title));
                                } else {
                                    $('#restaurant_cuisines').append($("<option></option>")
                                        .attr("value", data.id)
                                        .text(data.title));
                                }
                            })

                        });


                        if (restaurant.hasOwnProperty('phonenumber')) {
                            $(".restaurant_phone").val(restaurant.phonenumber);
                        }
                        if (restaurant.DeliveryCharge) {
                            $("#delivery_charges_per_km").val(restaurant.DeliveryCharge.delivery_charges_per_km);
                            $("#minimum_delivery_charges").val(restaurant.DeliveryCharge.minimum_delivery_charges);
                            $("#minimum_delivery_charges_within_km").val(restaurant.DeliveryCharge.minimum_delivery_charges_within_km);
                        }
                        await getRestaurantStory(restaurant.id);

                        if (story_vedios.length > 0) {
                            var html = '';
                            for (var i = 0; i < story_vedios.length; i++) {
                                html += '<div class="col-md-3" id="story_div_' + i + '">\n' +
                                    '<div class="video-inner"><video width="320px" height="240px"\n' +
                                    '                                   controls="controls">\n' +
                                    '                            <source src="' + story_vedios[i] + '"\n' +
                                    '            type="video/mp4"></video><span class="remove-story-video" data-id="' + i + '" data-img="' + story_vedios[i] + '"><i class="fa fa-remove"></i></span></div></div>';

                            }
                            jQuery("#story_vedios").append(html);
                        }
                        if (story_thumbnail) {

                            html = '<div class="col-md-3"><div class="thumbnail-inner"><span class="remove-story-thumbnail" data-img="' + story_thumbnail + '"><i class="fa fa-remove"></i></span><img onerror="this.onerror=null;this.src=\'' + placeholderImage + '\'" id="story_thumbnail_image" src="' + story_thumbnail + '" width="150px" height="150px;"></div></div>';
                            jQuery("#story_thumbnail").html(html);

                        }

                    } catch (error) {

                    }

                    if(restaurant.hasOwnProperty('specialDiscountEnable')){
                        if (restaurant.specialDiscountEnable)
                            $("#specialDiscountEnable").prop("checked", true);
                    }
                    if (restaurant.hasOwnProperty('specialDiscount')) {
                        for (i = 0; i < restaurant.specialDiscount.length; i++) {
                            var day = restaurant.specialDiscount[i]['day'];
                            if (restaurant.specialDiscount[i]['timeslot'].length != 0) {
                                for (j = 0; j < restaurant.specialDiscount[i]['timeslot'].length; j++) {
                                    $(".restaurant_discount_options_" + day + "_div").show();

                                    if (restaurant.specialDiscount[i]) {
                                        if (restaurant.specialDiscount[i]['timeslot']) {

                                            if (restaurant.specialDiscount[i]['timeslot'].length > 0) {
                                                if (restaurant.specialDiscount[i]['timeslot'][j]) {
                                                    var timeslot = restaurant.specialDiscount[i]['timeslot'][j];

                                                    if (timeslot['discount']) {
                                                        var discount = timeslot['discount'];

                                                        var TimeslotVar = {
                                                            'discount': timeslot[`discount`],
                                                            'from': timeslot[`from`],
                                                            'to': timeslot[`to`],
                                                            'type': timeslot[`type`],
                                                            'discount_type': timeslot[`discount_type`]
                                                        };
                                                        if (day == 'Sunday') {
                                                            timeslotSunday.push(TimeslotVar);
                                                        } else if (day == 'Monday') {
                                                            timeslotMonday.push(TimeslotVar);
                                                        } else if (day == 'Tuesday') {
                                                            timeslotTuesday.push(TimeslotVar);
                                                        } else if (day == 'Wednesday') {
                                                            timeslotWednesday.push(TimeslotVar);
                                                        } else if (day == 'Thursday') {
                                                            timeslotThursday.push(TimeslotVar);
                                                        } else if (day == 'Friday') {
                                                            timeslotFriday.push(TimeslotVar);
                                                        } else if (day == 'Saturday') {
                                                            timeslotSaturday.push(TimeslotVar);
                                                        }


                                                        $('#special_offer_table_' + day + ' tr:last').after('<tr>' +
                                                            '<td class="" style="width:10% !important;"><input type="time" class="form-control ' + i + '_' + j + '_row" value="' + timeslot[`from`] + '" id="openTime' + day + j + i + '" ></td>' +
                                                            '<td class="" style="width:10% !important;"><input type="time" class="form-control ' + i + '_' + j + '_row" value="' + timeslot[`to`] + '" id="closeTime' + day + j + i + '" ></td>' +
                                                            '<td class="" style="width:30% !important;">' +
                                                            '<input type="number" class="form-control ' + i + '_' + j + '_row" value="' + timeslot[`discount`] + '" style="width:60%;" id="discount' + day + j + i + '" >' +
                                                            '<select id="discount_type' + day + j + i + '" class="form-control ' + i + '_' + j + '_row"  style="width:40%;" ><option value="percentage">%</option><option value="amount">' + currentCurrency + '</option></select></td>' +
                                                            '<td style="width:30% !important;"><select id="type' + day + j + i + '" class="form-control ' + i + '_' + j + '_row" ><option value="delivery">Delivery Discount</option><option value="dinein">Dine-In Discount</option></select>' +
                                                            '</td>' +
                                                            '<td class="action-btn" style="width:20%;">' +
                                                            '<button type="button" class="btn btn-primary ' + i + '_' + j + '_row  specialDiscount_' + i + '_' + j + '"  onclick="updateMoreFunctionButton(`' + day + '`,`' + j + '`,`' + i + '`)" ><i class="fa fa-edit"></i></button>' +
                                                            '&nbsp;&nbsp;<button type="button" class="btn btn-primary ' + i + '_' + j + '_row" onclick="deleteOffer(`' + day + '`,`' + j + '`,`' + i + '`)" ><i class="fa fa-trash"></i></button>' +
                                                            '</td></tr>');

                                                        if (timeslot[`type`] == 'amount') {
                                                            $('#discount_type' + day + j + i).val(timeslot[`type`]);
                                                        }
                                                        if (timeslot[`discount_type`] == 'dinein') {
                                                            $('#type' + day + j + i).val(timeslot[`discount_type`]);
                                                        }
                                                    }
                                                    $('.special_offer_div').css('display', 'block');

                                                }
                                            }

                                        }
                                    }

                                }
                            }
                        }
                    }


                    if (restaurant.hasOwnProperty('workingHours')) {
                        for (i = 0; i < restaurant.workingHours.length; i++) {
                            var day = restaurant.workingHours[i]['day'];
                            if (restaurant.workingHours[i]['timeslot'].length != 0) {
                                for (j = 0; j < restaurant.workingHours[i]['timeslot'].length; j++) {
                                    $(".restaurant_working_hour_" + day + "_div").show();
                                    var timeslot = restaurant.workingHours[i]['timeslot'][j];

                                    var discount = restaurant.workingHours[i]['timeslot'][j]['discount'];
                                    var TimeslotHourVar = {'from': timeslot[`from`], 'to': timeslot[`to`]};
                                    if (day == 'Sunday') {
                                        timeslotworkSunday.push(TimeslotHourVar);
                                    } else if (day == 'Monday') {
                                        timeslotworkMonday.push(TimeslotHourVar);
                                    } else if (day == 'Tuesday') {
                                        timeslotworkTuesday.push(TimeslotHourVar);
                                    } else if (day == 'Wednesday') {
                                        timeslotworkWednesday.push(TimeslotHourVar);
                                    } else if (day == 'Thursday') {
                                        timeslotworkThursday.push(TimeslotHourVar);
                                    } else if (day == 'Friday') {
                                        timeslotworkFriday.push(TimeslotHourVar);
                                    } else if (day == 'Saturday') {
                                        timeslotworkSaturday.push(TimeslotHourVar);
                                    }


                                    $('#working_hour_table_' + day + ' tr:last').after('<tr>' +
                                        '<td class="" style="width:50%;"><input type="time" class="form-control ' + i + '_' + j + '_row" value="' + timeslot[`from`] + '" id="from' + day + j + i + '" ></td>' +
                                        '<td class="" style="width:50%;"><input type="time" class="form-control ' + i + '_' + j + '_row" value="' + timeslot[`to`] + '" id="to' + day + j + i + '" ></td>' +
                                        '<td class="action-btn" style="width:20%;">' +
                                        '<button type="button" class="btn btn-primary ' + i + '_' + j + '_row workingHours_' + i + '_' + j + '"  onclick="updatehoursFunctionButton(`' + day + '`,`' + j + '`,`' + i + '`)" ><i class="fa fa-edit"></i></button>' +
                                        '&nbsp;&nbsp;<button type="button" class="btn btn-primary ' + i + '_' + j + '_row" onclick="deleteWorkingHour(`' + day + '`,`' + j + '`,`' + i + '`)" ><i class="fa fa-trash"></i></button>' +
                                        '</td></tr>');


                                }
                                $('.working_hours_div').css('display', 'block');
                            }
                        }
                    }
                    jQuery("#data-table_processing").hide();

                })

                async function getRestaurantStory(restaurantId) {
                    await database.collection('story').where('vendorID', '==', restaurantId).get().then(async function (snapshots) {

                        if (snapshots.docs.length > 0) {

                            var story_data = snapshots.docs[0].data();

                            story_vedios = story_data.videoUrl;
                            story_thumbnail = story_data.videoThumbnail;
                            story_thumbnail = story_data.videoThumbnail;
                            story_thumbnail_oldfile = story_data.videoThumbnail;
                        }else{
                            story_thumbnail = "";
                        }
                    });
                }

            })

            $(".change_user_password").click(function () {
                var userOldPassword = $(".user_old_password").val();
                var userNewPassword = $(".user_new_password").val();
                var userEmail = $(".user_email").val();

                if (userOldPassword == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.old_password_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (userNewPassword == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.new_password_error')}}</p>");
                    window.scrollTo(0, 0);
                } else {

                    var user = firebase.auth().currentUser;

                    firebase.auth().signInWithEmailAndPassword(userEmail, userOldPassword)
                        .then((userCredential) => {
                            var user = userCredential.user;
                            user.updatePassword(userNewPassword).then(() => {
                                $(".error_top").show();
                                $(".error_top").html("");
                                $(".error_top").append("<p>{{trans('lang.password_updated_successfully')}}</p>");
                                window.scrollTo(0, 0);
                            }).catch((error) => {
                                $(".error_top").show();
                                $(".error_top").html("");
                                $(".error_top").append("<p>" + error + "</p>");
                                window.scrollTo(0, 0);
                            });
                        })
                        .catch((error) => {
                            var errorCode = error.code;
                            var errorMessage = error.message;
                            $(".error_top").show();
                            $(".error_top").html("");
                            $(".error_top").append("<p>" + errorMessage + "</p>");
                            window.scrollTo(0, 0);
                        });


                }
            })
            var input = document.getElementById('accountNumber');
            input.addEventListener('keypress', function (event) {

                // Get the key code
                let keycode = event.which || event.keyCode;

                // Check if key pressed is a special character
                if (keycode < 48 ||
                    (keycode > 57 && keycode < 65) ||
                    (keycode > 90 && keycode < 97) ||
                    keycode > 122
                ) {
                    // Restrict the special characters
                    event.preventDefault();
                    return false;
                }
            });
           
        });

        function checkLocationInZone(area,address_lng,address_lat){
            var vertices_x = [];
            var vertices_y = [];
            for (j = 0; j < area.length; j++) {
                var geopoint = area[j];
                vertices_x.push(geopoint.longitude);
                vertices_y.push(geopoint.latitude);
            }
            var points_polygon = (vertices_x.length)-1; 
            if(is_in_polygon(points_polygon, vertices_x, vertices_y, address_lng, address_lat)){
                return true;
            }else{
                return false;
            }
        }

        function is_in_polygon($points_polygon, $vertices_x, $vertices_y, $longitude_x, $latitude_y){
            $i = $j = $c = $point = 0;
            for ($i = 0, $j = $points_polygon ; $i < $points_polygon; $j = $i++) {
                $point = $i;
                if( $point == $points_polygon )
                    $point = 0;
                if ( (($vertices_y[$point]  >  $latitude_y != ($vertices_y[$j] > $latitude_y)) && ($longitude_x < ($vertices_x[$j] - $vertices_x[$point]) * ($latitude_y - $vertices_y[$point]) / ($vertices_y[$j] - $vertices_y[$point]) + $vertices_x[$point]) ) )
                    $c = !$c;
            }
            return $c;
        }
        
         $(".save_restaurant_btn").click(async function () {

                var restaurantname = $(".restaurant_name").val();
                var cuisines = $("#restaurant_cuisines option:selected").val();
                var address = $(".restaurant_address").val();
                var latitude = parseFloat($(".restaurant_latitude").val());
                var longitude = parseFloat($(".restaurant_longitude").val());
                var description = $(".restaurant_description").val();
                var phonenumber = $(".restaurant_phone").val();
                var categoryTitle = $("#restaurant_cuisines option:selected").text();
                var userFirstName = $(".user_first_name").val();
                var userLastName = $(".user_last_name").val();
                var email = $(".user_email").val();
                var userPhone = $(".user_phone").val();
                var reststatus = false;
                var specialDiscountEnable = false;
                var enabledDiveInFuture = $("#dine_in_feature").is(':checked');

                var zoneId = $('#zone option:selected').val();
                var zoneArea = $('#zone option:selected').data('area');
                var isInZone = false;
                if(zoneId && zoneArea){
                    isInZone = checkLocationInZone(zoneArea,longitude,latitude);
                }
                
                if ($("#is_open").is(':checked')) {
                    reststatus = true;
                }

                var openDineTime = $("#openDineTime").val();
                var openDineTime_val = $("#openDineTime").val();

                if (openDineTime) {
                    openDineTime = new Date('1970-01-01T' + openDineTime + 'Z')
                        .toLocaleTimeString('en-US',
                            {timeZone: 'UTC', hour12: true, hour: 'numeric', minute: 'numeric'}
                        );
                }

                var closeDineTime = $("#closeDineTime").val();
                var closeDineTime_val = $("#closeDineTime").val();
                if (closeDineTime) {
                    closeDineTime = new Date('1970-01-01T' + closeDineTime + 'Z')
                        .toLocaleTimeString('en-US',
                            {timeZone: 'UTC', hour12: true, hour: 'numeric', minute: 'numeric'}
                        );
                }
                 if ($("#specialDiscountEnable").is(':checked')) {
                     specialDiscountEnable = true;
                 }
                var specialDiscount = [];

                var sunday = {'day': 'Sunday', 'timeslot': timeslotSunday};
                var monday = {'day': 'Monday', 'timeslot': timeslotMonday};
                var tuesday = {'day': 'Tuesday', 'timeslot': timeslotTuesday};
                var wednesday = {'day': 'Wednesday', 'timeslot': timeslotWednesday};
                var thursday = {'day': 'Thursday', 'timeslot': timeslotThursday};
                var friday = {'day': 'Friday', 'timeslot': timeslotFriday};
                var Saturday = {'day': 'Saturday', 'timeslot': timeslotSaturday};

                specialDiscount.push(monday);
                specialDiscount.push(tuesday);
                specialDiscount.push(wednesday);
                specialDiscount.push(thursday);
                specialDiscount.push(friday);
                specialDiscount.push(Saturday);
                specialDiscount.push(sunday);


                var workingHours = [];

                var sunday = {'day': 'Sunday', 'timeslot': timeslotworkSunday};
                var monday = {'day': 'Monday', 'timeslot': timeslotworkMonday};
                var tuesday = {'day': 'Tuesday', 'timeslot': timeslotworkTuesday};
                var wednesday = {'day': 'Wednesday', 'timeslot': timeslotworkWednesday};
                var thursday = {'day': 'Thursday', 'timeslot': timeslotworkThursday};
                var friday = {'day': 'Friday', 'timeslot': timeslotworkFriday};
                var Saturday = {'day': 'Saturday', 'timeslot': timeslotworkSaturday};

                workingHours.push(monday);
                workingHours.push(tuesday);
                workingHours.push(wednesday);
                workingHours.push(thursday);
                workingHours.push(friday);
                workingHours.push(Saturday);
                workingHours.push(sunday);

                coordinates = new firebase.firestore.GeoPoint(latitude, longitude);

                var restaurantCost = $(".restaurant_cost").val();

                var Free_Wi_Fi = "No";
                if ($("#Free_Wi_Fi").is(':checked')) {
                    Free_Wi_Fi = "Yes";
                }
                var Good_for_Breakfast = "No";
                if ($("#Good_for_Breakfast").is(':checked')) {
                    Good_for_Breakfast = "Yes";
                }
                var Good_for_Dinner = "No";
                if ($("#Good_for_Dinner").is(':checked')) {
                    Good_for_Dinner = "Yes";
                }
                var Good_for_Lunch = "No";
                if ($("#Good_for_Lunch").is(':checked')) {
                    Good_for_Lunch = "Yes";
                }
                var Live_Music = "No";
                if ($("#Live_Music").is(':checked')) {
                    Live_Music = "Yes";
                }
                var Outdoor_Seating = "No";
                if ($("#Outdoor_Seating").is(':checked')) {
                    Outdoor_Seating = "Yes";
                }
                var Takes_Reservations = "No";
                if ($("#Takes_Reservations").is(':checked')) {
                    Takes_Reservations = "Yes";
                }
                var Vegetarian_Friendly = "No";
                if ($("#Vegetarian_Friendly").is(':checked')) {
                    Vegetarian_Friendly = "Yes";
                }

                var filters_new = {
                    "Free Wi-Fi": Free_Wi_Fi,
                    "Good for Breakfast": Good_for_Breakfast,
                    "Good for Dinner": Good_for_Dinner,
                    "Good for Lunch": Good_for_Lunch,
                    "Live Music": Live_Music,
                    "Outdoor Seating": Outdoor_Seating,
                    "Takes Reservations": Takes_Reservations,
                    "Vegetarian Friendly": Vegetarian_Friendly
                };


                if (userFirstName == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.enter_owners_name_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (email == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.enter_owners_email')}}</p>");
                    window.scrollTo(0, 0);
                } else if (userPhone == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.enter_owners_phone')}}</p>");
                    window.scrollTo(0, 0);
                } else if (restaurantname == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.restaurant_name_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (cuisines == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.restaurant_cuisine_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (phonenumber == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.restaurant_phone_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (address == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.restaurant_address_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (zoneId == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.select_zone_help')}}</p>");
                    window.scrollTo(0, 0);
                } else if (isNaN(latitude)) {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.restaurant_lattitude_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (latitude < -90 || latitude > 90) {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.restaurant_lattitude_limit_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (isNaN(longitude)) {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.restaurant_longitude_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (longitude < -180 || longitude > 180) {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.restaurant_longitude_limit_error')}}</p>");
                    window.scrollTo(0, 0);
                } else if (isInZone == false) {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.invalid_location_zone')}}</p>");
                    window.scrollTo(0, 0);
                } else if (description == '') {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>{{trans('lang.restaurant_description_error')}}</p>");
                    window.scrollTo(0, 0);
                } else {
                    jQuery("#data-table_processing").show();

                    var bankName = $("#bankName").val();
                    var branchName = $("#branchName").val();
                    var holderName = $("#holderName").val();
                    var accountNumber = $("#accountNumber").val();
                    var otherDetails = $("#otherDetails").val();
                    var userBankDetails = {
                        'bankName': bankName,
                        'branchName': branchName,
                        'holderName': holderName,
                        'accountNumber': accountNumber,
                        'accountNumber': accountNumber,
                        'otherDetails': otherDetails,
                    }; 

                await storeStoryData().then(async (resStoryVid) => {
                    await storeImageData().then(async (IMG) => 
                    {
                        await storeGalleryImageData().then(async (GalleryIMG) => 
                        {
                            await storeMenuImageData().then(async (MenuIMG) => 
                            {

                                    database.collection('users').doc(ownerId).update({
                                        'firstName': userFirstName,
                                        'lastName': userLastName,
                                        'email': email,
                                        'phoneNumber': userPhone,
                                        'profilePictureURL': IMG.ownerImage,
                                        'userBankDetails': userBankDetails
                                    }).then(function (result) {

                                        var delivery_charges_per_km = parseInt($("#delivery_charges_per_km").val());
                                        var minimum_delivery_charges = parseInt($("#minimum_delivery_charges").val());
                                        var minimum_delivery_charges_within_km = parseInt($("#minimum_delivery_charges_within_km").val());
                                        var DeliveryCharge = {
                                            'delivery_charges_per_km': delivery_charges_per_km,
                                            'minimum_delivery_charges': minimum_delivery_charges,
                                            'minimum_delivery_charges_within_km': minimum_delivery_charges_within_km
                                        };


                                        geoFirestore.collection('vendors').doc(id).update({
                                            'title': restaurantname,
                                            'description': description,
                                            'latitude': latitude,
                                            'longitude': longitude,
                                            'location': address,
                                            'authorProfilePic':IMG.ownerImage,
                                            'photo': (Array.isArray(GalleryIMG) && GalleryIMG.length > 0) ? GalleryIMG[0] : null,
                                            'photos': GalleryIMG,
                                            'categoryID': cuisines,
                                            'phonenumber': phonenumber,
                                            'categoryTitle': categoryTitle,
                                            'coordinates': coordinates,
                                            'filters': filters_new,
                                            'reststatus': reststatus,
                                            'authorName': userFirstName,
                                            'enabledDiveInFuture': enabledDiveInFuture,
                                            'restaurantMenuPhotos': MenuIMG,
                                            'restaurantCost': restaurantCost,
                                            'openDineTime': openDineTime,
                                            'closeDineTime': closeDineTime,
                                            'DeliveryCharge': DeliveryCharge,
                                            'specialDiscount': specialDiscount,
                                            'specialDiscountEnable':specialDiscountEnable,
                                            'workingHours': workingHours,
                                            'zoneId': zoneId
                                        }).then(function (result) {
                                            if (resStoryVid.length > 0 || story_thumbnail != '') {

                                                if (resStoryVid.length > 0 && story_thumbnail == '') {
                                                    jQuery("#data-table_processing").hide();
                                                    $(".error_top").show();
                                                    $(".error_top").html("");
                                                    $(".error_top").append("<p>{{trans('lang.story_error')}}</p>");
                                                    window.scrollTo(0, 0);
                                                } else if (story_thumbnail && resStoryVid.length == 0) {
                                                    jQuery("#data-table_processing").hide();
                                                    $(".error_top").show();
                                                    $(".error_top").html("");
                                                    $(".error_top").append("<p>{{trans('lang.story_error')}}</p>");
                                                    window.scrollTo(0, 0);
                                                } else {

                                                    database.collection('story').doc(id).set({
                                                        'createdAt': new Date(),
                                                        'vendorID': id,
                                                        'videoThumbnail': IMG.storyThumbnailImage,
                                                        'videoUrl': resStoryVid,
                                                    }).then(function (result) {
                                                        window.location.href = '{{ route("user.profile")}}';
                                                    });
                                                }

                                            } else {
                                                window.location.href = '{{ route("user.profile")}}';
                                            }


                                        });
                                    });
                            }).catch(err => {
                                jQuery("#data-table_processing").hide();
                                $(".error_top").show();
                                $(".error_top").html("");
                                $(".error_top").append("<p>" + err + "</p>");
                                window.scrollTo(0, 0);
                            });
                        }).catch(err => {
                            jQuery("#data-table_processing").hide();
                            $(".error_top").show();
                            $(".error_top").html("");
                            $(".error_top").append("<p>" + err + "</p>");
                            window.scrollTo(0, 0);
                        });
                    }).catch(err => {
                        jQuery("#data-table_processing").hide();
                        $(".error_top").show();
                        $(".error_top").html("");
                        $(".error_top").append("<p>" + err + "</p>");
                        window.scrollTo(0, 0);
                    });
                }).catch(err => {
                    jQuery("#data-table_processing").hide();
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>" + err + "</p>");
                    window.scrollTo(0, 0);
                });
            }
        })


        function handleStoryFileSelect(evt) {
            var f = evt.target.files[0];
            var reader = new FileReader();
            var isVideo = document.getElementById('video_file');
            var videoValue = isVideo.value;
            var allowedExtensions = /(\.mp4)$/i;
            ;

            if (!allowedExtensions.exec(videoValue)) {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>Error: Invalid video type</p>");
                window.scrollTo(0, 0);
                isVideo.value = '';
                return false;
            }

            var video = document.createElement('video');
            video.preload = 'metadata';
            video.onloadedmetadata = function () {
                window.URL.revokeObjectURL(video.src);

                if (video.duration > storevideoDuration) {
                    $(".error_top").show();
                    $(".error_top").html("");
                    $(".error_top").append("<p>Error: Story video duration maximum allow to " + story_video_duration + " seconds</p>");
                    window.scrollTo(0, 0);
                    evt.target.value = '';
                    return false;
                }

                // $(".error_top").html("");
                reader.onload = (function (theFile) {

                    return function (e) {

                        var filePayload = e.target.result;
                        var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
                        var val = f.name;
                        var ext = val.split('.')[1];
                        var docName = val.split('fakepath')[1];
                        var filename = (f.name).replace(/C:\\fakepath\\/i, '')

                        var timestamp = Number(new Date());
                        var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;

                        var nextCount = $("#story_vedios").children().length;
                        html = '<div class="col-md-3" id="story_div_' + nextCount + '">\n' +
                            '<div class="video-inner"><video width="320px" height="240px"\n' +
                            '                                   controls="controls">\n' +
                            '                            <source src="' + filePayload + '"\n' +
                            '            type="video/mp4"></video><span class="remove-story-video" data-id="' + nextCount + '" data-img="' + filePayload + '"><i class="fa fa-remove"></i></span></div></div>';

                        jQuery("#story_vedios").append(html);
                        // story_vedios.push(downloadURL);
                        $("#video_file").val('');

                        new_added_restaurant_story.push(theFile);
                        new_added_restaurant_story_filename.push(filename);
                    };
                })(f);

                reader.readAsDataURL(f);
            }
            video.src = URL.createObjectURL(f);
        }

        $(document).on("click", ".remove-story-video", function () {
            var id = $(this).attr('data-id');
            var photo_remove = $(this).attr('data-img');

            var story_remove_videos = (photo_remove && /^data:video\/(mp4|webm|ogg);base64,/.test(photo_remove)) ? null : (photo_remove && /^https?:\/\/[^ "]+$/.test(photo_remove)) ? firebase.storage().refFromURL(photo_remove) : console.error("Invalid video format.");
            if(story_remove_videos) {
                story_remove_videos.getMetadata()
                    .then((metadata) => {
                        var storyBucket = story_remove_videos.bucket;
                        var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";

                        if (storyBucket === envBucket) {
                            story_remove_videos.delete().then(() => {
                                console.log("Old file deleted!");
                            }).catch((error) => {
                                console.log("Error deleting file:", error);
                            });
                        } else {
                            console.log('Bucket not matched');
                        }
                    })
                    .catch((error) => {
                        if (error.code === 'storage/object-not-found') {
                            console.log("File does not exist");
                        } else {
                            console.log("Error retrieving file metadata:", error);
                        }
                    });
            }

            $("#story_div_" + id).remove();
            index = story_vedios.indexOf(photo_remove);
            $("#video_file").val('');
            if (index > -1) {
                story_vedios.splice(index, 1); // 2nd parameter means remove one item only
            }

            var newhtml = '';
            if (story_vedios.length > 0) {
                for (var i = 0; i < story_vedios.length; i++) {
                    newhtml += '<div class="col-md-3" id="story_div_' + i + '">\n' +
                        '<div class="video-inner"><video width="320px" height="240px"\n' +
                        'controls="controls">\n' +
                        '<source src="' + story_vedios[i] + '"\n' +
                        'type="video/mp4"></video><span class="remove-story-video" data-id="' + i + '" data-img="' + story_vedios[i] + '"><i class="fa fa-remove"></i></span></div></div>';
                }
            }
            else{
                alert("{{trans('lang.story_video_alert')}}");
            }
            jQuery("#story_vedios").html(newhtml);
            deleteStoryfromCollection();
        });

        $(document).on("click", ".remove-story-thumbnail", function () {
            var photo_remove = $(this).attr('data-img');
            var storyImageUrl = (photo_remove && /^https?:\/\/[^ "]+$/.test(photo_remove)) ? firebase.storage().refFromURL(photo_remove) : null;
            if (storyImageUrl) {
                imageBucket = storyImageUrl.bucket;
                var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";
                if (imageBucket == envBucket) {
                    storyImageUrl.delete().then(() => {
                        alert("{{trans('lang.story_humbling_image_alert')}}");
                        console.log("Old file deleted!")
                    }).catch((error) => {
                        console.log("ERR File delete ===", error);
                    });
                } else {
                    console.log('Bucket not matched');
                }
            }

            $("#story_thumbnail").empty();
            if (storyImageUrl) {
                database.collection('story').doc(id).update({
                    'videoThumbnail': ""
                });
            }
            story_thumbnail = '';
            deleteStoryfromCollection();
        });

        function deleteStoryfromCollection() {
            if (story_vedios.length == 0 && story_thumbnail == '') {
                database.collection('story').where('vendorID', '==', id).get().then(async function (snapshot) {
                    if (snapshot.docs.length > 0) {
                        database.collection('story').doc(id).delete();
                    }
                });
            }
        }

        function handleStoryThumbnailFileSelect(evt) {


            var f = evt.target.files[0];
            var reader = new FileReader();
            var fileInput =
                document.getElementById('file');

            var filePath = fileInput.value;


            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            

            if (!allowedExtensions.exec(filePath)) {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>Error: Invalid File type</p>");
                window.scrollTo(0, 0);
                fileInput.value = '';
                return false;
            }


            reader.onload = (function (theFile) {
                return function (e) {

                    var filePayload = e.target.result;
                    var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
                    var val = f.name;
                    var ext = val.split('.')[1];
                    var docName = val.split('fakepath')[1];
                    var filename = (f.name).replace(/C:\\fakepath\\/i, '')

                    var timestamp = Number(new Date());
                    var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                    story_thumbnail = filePayload;
                    story_thumbnail_filename = filename;
                    var html = '<div class="col-md-3"><div class="thumbnail-inner"><span class="remove-story-thumbnail" data-img="' + story_thumbnail + '"><i class="fa fa-remove"></i></span><img onerror="this.onerror=null;this.src=\'' + placeholderImage + '\'" id="story_thumbnail_image" src="' + story_thumbnail + '" width="150px" height="150px;"></div></div>';
                    jQuery("#story_thumbnail").html(html);
                };
            })(f);
            reader.readAsDataURL(f);
        }

        function handleFileSelect(evt, type) {

            var f = evt.target.files[0];
            var reader = new FileReader();

            new Compressor(f, {
                quality: <?php echo env('IMAGE_COMPRESSOR_QUALITY', 0.8); ?>,
                success(result) {
                    f = result;

                    reader.onload = (function (theFile) {
                        return function (e) {

                            var filePayload = e.target.result;
                            var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
                            var val = f.name;
                            var ext = val.split('.')[1];
                            var docName = val.split('fakepath')[1];
                            var filename = (f.name).replace(/C:\\fakepath\\/i, '')

                            var timestamp = Number(new Date());
                            var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                            photo = filePayload;
                            // if (type == "photo") {
                            //     restaurantPhoto = filePayload;
                            //     resPhotoFileName = filename;
                            // }
                            if (photo!="" && photo!=null) {
                                // if (type == 'photo') {
                                //     $("#uploaded_image").attr('src', photo);
                                //     $(".uploaded_image").show();
                                // } else 
                                if (type == 'photos') {

                                    photocount++;
                                    photos_html = '<span class="image-item" id="photo_' + photocount + '"><span class="remove-btn" data-id="' + photocount + '" data-img="' + photo + '" data-status="new"><i class="fa fa-remove"></i></span><img onerror="this.onerror=null;this.src=\'' + placeholderImage + '\'" width="100px" id="" height="auto" src="' + photo + '"></span>';
                                    $("#photos").append(photos_html);
                                    new_added_restaurant_photos.push(photo);
                                    new_added_restaurant_photos_filename.push(filename);
                                }
                            }
                        };
                    })(f);
                    reader.readAsDataURL(f);

                },
                error(err) {
                    console.log(err.message);
                },
            });

        }
        async function storeImageData() {
            var newPhoto = [];
            newPhoto['ownerImage'] = ownerphoto;
            // newPhoto['restaurantImage'] = restaurantPhoto;
            newPhoto['storyThumbnailImage'] = story_thumbnail;

            try {
                if (ownerphoto != '' && ownerphoto != null) {
                    if (ownerOldImageFile != "" && ownerphoto != ownerOldImageFile) {
                        var ownerOldImageUrlRef = await storage.refFromURL(ownerOldImageFile);
                        imageBucket = ownerOldImageUrlRef.bucket;
                        var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";
                        if (imageBucket == envBucket) {
                            await ownerOldImageUrlRef.delete().then(() => {
                                console.log("Old file deleted!")
                            }).catch((error) => {
                                console.log("ERR File delete ===", error);
                            });
                        } else {
                            console.log('Bucket not matched');  
                        }
                    }

                    if (ownerphoto != ownerOldImageFile) {

                        ownerphoto = ownerphoto.replace(/^data:image\/[a-z]+;base64,/, "")
                        var uploadTask = await storageRef.child(ownerFileName).putString(ownerphoto, 'base64', {contentType: 'image/jpg'});
                        var downloadURL = await uploadTask.ref.getDownloadURL();
                        newPhoto['ownerImage'] = downloadURL;
                        ownerphoto = downloadURL;
                    }
                }
                // if (restaurantPhoto != '' && restaurantPhoto != null) {
                //     if (resPhotoOldImageFile != "" && resPhotoOldImageFile != null && restaurantPhoto != resPhotoOldImageFile) {

                //         var resOldImageUrlRef = await storage.refFromURL(resPhotoOldImageFile);
                //         imageBucket = resOldImageUrlRef.bucket;
                //         var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";
                //         if (imageBucket == envBucket) {
                //             await resOldImageUrlRef.delete().then(() => {
                //                 console.log("Old file deleted!")
                //             }).catch((error) => {
                //                 console.log("ERR File delete ===", error);
                //             });
                //         } else {
                //             console.log('Bucket not matched');  
                //         }

                //     }
                //     if (restaurantPhoto != resPhotoOldImageFile) {

                //         restaurantPhoto = restaurantPhoto.replace(/^data:image\/[a-z]+;base64,/, "")
                //         var uploadTask = await storageRef.child(resPhotoFileName).putString(restaurantPhoto, 'base64', {contentType: 'image/jpg'});
                //         var downloadURL = await uploadTask.ref.getDownloadURL();
                //         newPhoto['restaurantImage'] = downloadURL;
                //     }
                // }
                if (story_thumbnail != '') {
                    if (story_thumbnail_oldfile != "" && story_thumbnail != story_thumbnail_oldfile) {

                        var thumbnailOldImageUrlRef = await storage.refFromURL(story_thumbnail_oldfile);
                        imageBucket = thumbnailOldImageUrlRef.bucket;
                        var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";
                        if (imageBucket == envBucket) {
                            await thumbnailOldImageUrlRef.delete().then(() => {
                                console.log("Old file deleted!")
                            }).catch((error) => {
                                console.log("ERR File delete ===", error);
                            });
                        } else {
                            console.log('Bucket not matched');  
                        }

                    }
                    if (story_thumbnail != '' && story_thumbnail != null && story_thumbnail_filename != '') {

                        story_thumbnail = story_thumbnail.replace(/^data:image\/[a-z]+;base64,/, "")
                        var uploadTask = await storageRef.child(story_thumbnail_filename).putString(story_thumbnail, 'base64', {contentType: 'image/jpg'});
                        var downloadURL = await uploadTask.ref.getDownloadURL();
                        newPhoto['storyThumbnailImage'] = downloadURL;
                    }
                }
            } catch (error) {
                console.log("ERR ===", error);
            }
            return newPhoto;
        }

        async function storeGalleryImageData() 
        {
            var newPhoto = [];
            if (restaurnt_photos.length > 0) {
                newPhoto = restaurnt_photos;
            }
            if (new_added_restaurant_photos.length > 0) {
            
                const photoPromises = new_added_restaurant_photos.map(async (resPhoto, index) => {
                    resPhoto = resPhoto.replace(/^data:image\/[a-z]+;base64,/, "");
                    const uploadTask = await storageRef.child(new_added_restaurant_photos_filename[index]).putString(resPhoto, 'base64', {
                        contentType: 'image/jpg'
                    });
                    const downloadURL = await uploadTask.ref.getDownloadURL();
                    return { index, downloadURL };
                });
                const photoResults = await Promise.all(photoPromises);
                photoResults.sort((a, b) => a.index - b.index);
                uploadedPhoto = photoResults.map(photo => photo.downloadURL);
                newPhoto = [...newPhoto, ...uploadedPhoto];

            }
            if (galleryImageToDelete.length > 0) {
                await Promise.all(galleryImageToDelete.map(async (delImage) => {
                    imageBucket = delImage.bucket;

                    var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";

                    if (imageBucket == envBucket) {

                        await delImage.delete().then(() => {

                            console.log("Old file deleted!")

                        }).catch((error) => {

                            console.log("ERR File delete ===", error);

                        });

                    } else {

                        console.log('Bucket not matched');

                    }

                }));

            }
            return newPhoto;
        }

    async function storeStoryData() {
        var newStory = [];
        if (story_vedios.length > 0) {
            newStory = story_vedios;
        }
        if (new_added_restaurant_story.length > 0) {
            await Promise.all(new_added_restaurant_story.map((resStory, index) => {
                return new Promise((resolve, reject) => {
                    var uploadTask = storyRef.child(new_added_restaurant_story_filename[index]).put(resStory);

                    uploadTask.on('state_changed', function (snapshot) {
                        var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                        console.log('Upload is ' + progress + '% done');
                        jQuery("#uploding_story_video").text("video is uploading...");
                    }, function (error) {
                        console.error('Upload failed:', error);
                        reject(error);
                    }, function () {
                        uploadTask.snapshot.ref.getDownloadURL().then(function (downloadURL) {
                            jQuery("#uploding_story_video").text("Upload is completed");
                            setTimeout(function () {
                                jQuery("#uploding_story_video").empty();
                            }, 3000);

                            newStory.push(downloadURL);
                            $("#video_file").val('');

                            resolve();  // Resolve the promise when done
                        }).catch(reject);
                    });
                });
            }));
        }
        return newStory;
    }

        async function storeMenuImageData() {
            var newPhoto = [];
            if (restaurant_menu_photos.length > 0) {
                newPhoto = restaurant_menu_photos;
            }
            if (new_added_restaurant_menu.length > 0) {
                await Promise.all(new_added_restaurant_menu.map(async (menuPhoto, index) => {
                    menuPhoto = menuPhoto.replace(/^data:image\/[a-z]+;base64,/, "");
                    var uploadTask = await storageRef.child(new_added_restaurant_menu_filename[index]).putString(menuPhoto, 'base64', {contentType: 'image/jpg'});
                    var downloadURL = await uploadTask.ref.getDownloadURL();
                    newPhoto.push(downloadURL);
                }));
            }
            if (menuImageToDelete.length > 0) {
                await Promise.all(menuImageToDelete.map(async (delImage) => {
                    imageBucket = delImage.bucket;

                    var envBucket = "<?php echo env('FIREBASE_STORAGE_BUCKET'); ?>";

                    if (imageBucket == envBucket) {

                        await delImage.delete().then(() => {

                            console.log("Old file deleted!")

                        }).catch((error) => {

                            console.log("ERR File delete ===", error);

                        });

                    } else {

                        console.log('Bucket not matched');

                    }

                }));
            }

            return newPhoto;
        }


        function handleFileSelectowner(evt) {
            var f = evt.target.files[0];
            var reader = new FileReader();

            new Compressor(f, {
                quality: <?php echo env('IMAGE_COMPRESSOR_QUALITY', 0.8); ?>,
                success(result) {
                    f = result;
                    reader.onload = (function (theFile) {
                        return function (e) {
                            var filePayload = e.target.result;
                            var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
                            var val = f.name;
                            var ext = val.split('.')[1];
                            var docName = val.split('fakepath')[1];
                            var filename = (f.name).replace(/C:\\fakepath\\/i, '');
                            var timestamp = Number(new Date());
                            var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                            ownerphoto = filePayload;
                            ownerFileName = filename;
                            $("#uploaded_image_owner").attr('src', ownerphoto);
                            $(".uploaded_image_owner").show();
                        };

                    })(f);
                    reader.readAsDataURL(f);
                },
                error(err) {
                    console.log(err.message);
                },
            });
        }


        async function getVendorId(vendorUser) {
            var vendorId = '';
            var ref;
            await database.collection('vendors').where('author', "==", vendorUser).get().then(async function (vendorSnapshots) {
                var vendorData = vendorSnapshots.docs[0].data();
                vendorId = vendorData.id;
            })

            return vendorId;
        }

        function handleFileSelectMenuCard(evt) {
            var f = evt.target.files[0];
            var reader = new FileReader();

            new Compressor(f, {
                quality: <?php echo env('IMAGE_COMPRESSOR_QUALITY', 0.8); ?>,
                success(result) {
                    f = result;

                    reader.onload = (function (theFile) {
                        return function (e) {

                            var filePayload = e.target.result;
                            var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
                            var val = f.name;
                            var ext = val.split('.')[1];
                            var docName = val.split('fakepath')[1];
                            var filename = (f.name).replace(/C:\\fakepath\\/i, '')

                            var timestamp = Number(new Date());
                            var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                            photo = filePayload;

                            if (photo != "" && photo != null) {

                                menuPhotoCount++;
                                photos_html = '<span class="image-item" id="photo_menu_' + menuPhotoCount + '"><span class="remove-menu-btn" data-id="' + menuPhotoCount + '" data-img="' + photo + '" data-status="new"><i class="fa fa-remove"></i></span><img onerror="this.onerror=null;this.src=\'' + placeholderImage + '\'" width="100px" id="" height="auto" src="' + photo + '"></span>';
                                $("#photos_menu_card").append(photos_html);
                                new_added_restaurant_menu.push(photo);
                                new_added_restaurant_menu_filename.push(filename);
                            }
                        };
                    })(f);
                    reader.readAsDataURL(f);

                },
                error(err) {
                    console.log(err.message);
                },
            });

        }

        $("#dine_in_feature").change(function () {
            if (this.checked) {
                $(".divein_div").show();
            } else {
                $(".divein_div").hide();
            }
        });


        $(".add_special_offer_restaurant_btn").click(function () {
            if (specialDiscountOfferisEnable) {
                $(".special_offer_div").show();
            } else {
                alert("{{trans('lang.special_offer_disabled')}}");
                return false;
            }
        })

        var countAddButton = 1;

        function addMoreButton(day, day2, count) {
            count = countAddButton;
            $(".restaurant_discount_options_" + day + "_div").show();

            $('#special_offer_table_' + day + ' tr:last').after('<tr>' +
                '<td class="" style="width:10% !important;"><input type="time" class="form-control" id="openTime' + day + count + '"></td>' +
                '<td class="" style="width:10% !important;"><input type="time" class="form-control" id="closeTime' + day + count + '"></td>' +
                '<td class="" style="width:30% !important;">' +
                '<input type="number" class="form-control" id="discount' + day + count + '" style="width:60%;">' +
                '<select id="discount_type' + day + count + '" class="form-control" style="width:40%;"><option value="percentage">%</option><option value="amount">' + currentCurrency + '</option></select>' +
                '</td>' +
                '<td style="width:30% !important;"><select id="type' + day + count + '" class="form-control"><option value="delivery">Delivery Discount</option><option value="dinein">Dine-In Discount</option></select></td>' +
                '<td class="action-btn" style="width:20%;">' +
                '<button type="button" class="btn btn-primary save_option_day_button' + day + count + '" onclick="addMoreFunctionButton(`' + day2 + '`,`' + day + '`,' + countAddButton + ')" style="width:62%;">Save</button>' +
                '</td></tr>');
            countAddButton++;

        }

        function deleteOffer(day, count, i) {
            $('.' + i + '_' + count + '_row').hide();
            if (day == 'Sunday') {
                timeslotSunday.splice(count, 1);
            } else if (day == 'Monday') {
                timeslotMonday.splice(count, 1);
            } else if (day == 'Tuesday') {
                timeslotTuesday.splice(count, 1);
            } else if (day == 'Wednesday') {
                timeslotWednesday.splice(count, 1);
            } else if (day == 'Thursday') {
                timeslotThursday.splice(count, 1);
            } else if (day == 'Friday') {
                timeslotFriday.splice(count, 1);
            } else if (day == 'Saturday') {
                timeslotSaturday.splice(count, 1);
            }

            var specialDiscount = [];
            var sunday = {'day': 'Sunday', 'timeslot': timeslotSunday};
            var monday = {'day': 'Monday', 'timeslot': timeslotMonday};
            var tuesday = {'day': 'Tuesday', 'timeslot': timeslotTuesday};
            var wednesday = {'day': 'Wednesday', 'timeslot': timeslotWednesday};
            var thursday = {'day': 'Thursday', 'timeslot': timeslotThursday};
            var friday = {'day': 'Friday', 'timeslot': timeslotFriday};
            var Saturday = {'day': 'Saturday', 'timeslot': timeslotSaturday};

            specialDiscount.push(monday);
            specialDiscount.push(tuesday);
            specialDiscount.push(wednesday);
            specialDiscount.push(thursday);
            specialDiscount.push(friday);
            specialDiscount.push(Saturday);
            specialDiscount.push(sunday);


            database.collection('vendors').doc(id).update({'specialDiscount': specialDiscount}).then(function (result) {

            });
        }

        function addMoreFunctionButton(day1, day2, count) {
            var discount = $("#discount" + day2 + count).val();
            var discount_type = $('#discount_type' + day2 + count).val();
            var type = $('#type' + day2 + count).val();
            var closeTime = $("#closeTime" + day2 + count).val();
            var openTime = $("#openTime" + day2 + count).val();
            if(openTime == ''){
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>Please enter special offer open time</p>");
                window.scrollTo(0, 0);
            } 
            else if(closeTime == ''){
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>Please enter special offer close time</p>");
                window.scrollTo(0, 0);
            }
            else if (discount == "") {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>Please Enter discount</p>");
                window.scrollTo(0, 0);  
            } else if (discount > 100 || discount == 0) {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>Please Enter valid discount</p>");
                window.scrollTo(0, 0);
            } else {

                var timeslotVar = {
                    'discount': discount,
                    'from': openTime,
                    'to': closeTime,
                    'type': discount_type,
                    'discount_type': type
                };

                if (day1 == 'sunday') {
                    timeslotSunday.push(timeslotVar);
                } else if (day1 == 'monday') {
                    timeslotMonday.push(timeslotVar);
                } else if (day1 == 'tuesday') {
                    timeslotTuesday.push(timeslotVar);
                } else if (day1 == 'wednesday') {
                    timeslotWednesday.push(timeslotVar);
                } else if (day1 == 'thursday') {
                    timeslotThursday.push(timeslotVar);
                } else if (day1 == 'friday') {
                    timeslotFriday.push(timeslotVar);
                } else if (day1 == 'Saturday') {
                    timeslotSaturday.push(timeslotVar);
                }

                $(".save_option_day_button" + day2 + count).hide();
                $("#discount" + day2 + count).attr('disabled', "true");
                $("#discount_type" + day2 + count).attr('disabled', "true");
                $("#type" + day2 + count).attr('disabled', "true");
                $("#closeTime" + day2 + count).attr('disabled', "true");
                $("#openTime" + day2 + count).attr('disabled', "true");
            }

        }

        function updateMoreFunctionButton(day, rowCount, dayCount) {
            var discount = $("#discount" + day + rowCount + dayCount + "").val();
            var discount_type = $('#discount_type' + day + rowCount + dayCount + "").val();
            var type = $('#type' + day + rowCount + dayCount + "").val();
            var closeTime = $("#closeTime" + day + rowCount + dayCount + "").val();
            var openTime = $("#openTime" + day + rowCount + dayCount + "").val();
            if(openTime == ''){
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>Please Enter valid open time</p>");
                window.scrollTo(0, 0);
            } 
            else if(closeTime == ''){
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>Please Enter valid close time</p>");
                window.scrollTo(0, 0);
            }
            else if (discount == "") {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>Please Enter discount</p>");
                window.scrollTo(0, 0);
            } else if (discount > 100 || discount == 0) {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>Please Enter valid discount</p>");
                window.scrollTo(0, 0);
            } else {

                var timeslotVar = {
                    'discount': discount,
                    'from': openTime,
                    'to': closeTime,
                    'type': discount_type,
                    'discount_type': type
                };
                if (day == 'Sunday') {
                    timeslotSunday[rowCount] = timeslotVar;
                } else if (day == 'Monday') {
                    timeslotMonday[rowCount] = timeslotVar;

                } else if (day == 'Tuesday') {

                    timeslotTuesday[rowCount] = timeslotVar;
                } else if (day == 'Wednesday') {
                    timeslotWednesday[rowCount] = timeslotVar;


                } else if (day == 'Thursday') {
                    timeslotThursday[rowCount] = timeslotVar;

                } else if (day == 'Friday') {
                    timeslotFriday[rowCount] = timeslotVar;

                } else if (day == 'Saturday') {
                    timeslotSaturday[rowCount] = timeslotVar;
                }
            }

        }


        $(".add_working_hours_restaurant_btn").click(function () {
            $(".working_hours_div").show();
        })
        var countAddhours = 1;

        function addMorehour(day, day2, count) {
            count = countAddhours;
            $(".restaurant_working_hour_" + day + "_div").show();

            $('#working_hour_table_' + day + ' tr:last').after('<tr>' +
                '<td class="" style="width:50%;"><input type="time" class="form-control" id="from' + day + count + '"></td>' +
                '<td class="" style="width:50%;"><input type="time" class="form-control" id="to' + day + count + '"></td>' +
                '<td><button type="button" class="btn btn-primary save_option_day_button' + day + count + '" onclick="addMoreFunctionhour(`' + day2 + '`,`' + day + '`,' + countAddhours + ')" style="width:62%;"><i class="fa fa-save" title="Save""></i></button>' +
                '</td></tr>');
            countAddhours++;

        }

        function addMoreFunctionhour(day1, day2, count) {
            var to = $("#to" + day2 + count).val();
            var from = $("#from" + day2 + count).val();
            if (from == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>Please enter restaurant open time</p>");
                window.scrollTo(0, 0);
            }
            else if(to == ''){
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>Please enter restaurant close time</p>");
                window.scrollTo(0, 0);

            } else {

                var timeslotworkVar = {'from': from, 'to': to,};

                if (day1 == 'sunday') {
                    timeslotworkSunday.push(timeslotworkVar);
                } else if (day1 == 'monday') {
                    timeslotworkMonday.push(timeslotworkVar);
                } else if (day1 == 'tuesday') {
                    timeslotworkTuesday.push(timeslotworkVar);
                } else if (day1 == 'wednesday') {
                    timeslotworkWednesday.push(timeslotworkVar);
                } else if (day1 == 'thursday') {
                    timeslotworkThursday.push(timeslotworkVar);
                } else if (day1 == 'friday') {
                    timeslotworkFriday.push(timeslotworkVar);
                } else if (day1 == 'Saturday') {
                    timeslotworkSaturday.push(timeslotworkVar);
                }

                $(".save_option_day_button" + day2 + count).hide();
                $("#to" + day2 + count).attr('disabled', "true");
                $("#from" + day2 + count).attr('disabled', "true");
            }

        }

        function deleteWorkingHour(day, count, i) {
            $('.' + i + '_' + count + '_row').hide();
            if (day == 'Sunday') {
                timeslotworkSunday.splice(count, 1);
            } else if (day == 'Monday') {
                timeslotworkMonday.splice(count, 1);
            } else if (day == 'Tuesday') {
                timeslotworkTuesday.splice(count, 1);
            } else if (day == 'Wednesday') {
                timeslotworkWednesday.splice(count, 1);
            } else if (day == 'Thursday') {
                timeslotworkThursday.splice(count, 1);
            } else if (day == 'Friday') {
                timeslotworkFriday.splice(count, 1);
            } else if (day == 'Saturday') {
                timeslotworkSaturday.splice(count, 1);
            }

            var workingHours = [];
            var sunday = {'day': 'Sunday', 'timeslot': timeslotworkSunday};
            var monday = {'day': 'Monday', 'timeslot': timeslotworkMonday};
            var tuesday = {'day': 'Tuesday', 'timeslot': timeslotworkTuesday};
            var wednesday = {'day': 'Wednesday', 'timeslot': timeslotworkWednesday};
            var thursday = {'day': 'Thursday', 'timeslot': timeslotworkThursday};
            var friday = {'day': 'Friday', 'timeslot': timeslotworkFriday};
            var Saturday = {'day': 'Saturday', 'timeslot': timeslotworkSaturday};

            workingHours.push(monday);
            workingHours.push(tuesday);
            workingHours.push(wednesday);
            workingHours.push(thursday);
            workingHours.push(friday);
            workingHours.push(Saturday);
            workingHours.push(sunday);


            database.collection('vendors').doc(id).update({'workingHours': workingHours}).then(function (result) {

            });
        }

        function updatehoursFunctionButton(day, rowCount, dayCount) {
            var to = $("#to" + day + rowCount + dayCount + "").val();
            var from = $("#from" + day + rowCount + dayCount + "").val();
            if (from == '') {
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>Please Enter valid open time</p>");
                window.scrollTo(0, 0);
            }
            else if(to == ''){
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>Please Enter valid close time</p>");
                window.scrollTo(0, 0);

            } else {

                var timeslotworkVar = {'from': from, 'to': to};
                if (day == 'Sunday') {
                    timeslotworkSunday[rowCount] = timeslotworkVar;
                } else if (day == 'Monday') {
                    timeslotworkMonday[rowCount] = timeslotworkVar;

                } else if (day == 'Tuesday') {

                    timeslotworkTuesday[rowCount] = timeslotworkVar;
                } else if (day == 'Wednesday') {
                    timeslotworkWednesday[rowCount] = timeslotworkVar;


                } else if (day == 'Thursday') {
                    timeslotworkThursday[rowCount] = timeslotworkVar;

                } else if (day == 'Friday') {
                    timeslotworkFriday[rowCount] = timeslotworkVar;

                } else if (day == 'Saturday') {
                    timeslotworkSaturday[rowCount] = timeslotworkVar;
                }
            }

        }
    </script>

@endsection
