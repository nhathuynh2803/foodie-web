@include('layouts.app')



@include('layouts.header')
<div class="siddhi-profile">
   
    <div class="container position-relative">
        <div class="py-5 siddhi-profile row">
            <div class="col-md-4 mb-3">
                <div class="bg-white rounded shadow-sm sticky_sidebar overflow-hidden">
                    <a href="{!! url('profile') !!}" class="">
                        <div class="d-flex align-items-center p-3">
                            <div class="left mr-3 user_image">                               
                            </div>
                            <div class="right">
                                <h6 class="mb-1 font-weight-bold user_full_name"></h6>
                                <p class="text-muted m-0 small"><span class="user_email_show"></span></p>
                            </div>
                        </div>
                    </a>
                    <div class="siddhi-credits d-flex align-items-center p-3 bg-light">
                        <p class="m-0">{{trans('lang.wallet_amount')}}</p>
                        <h5 class="m-0 ml-auto text-primary user_wallet"></h5>
                    </div>
                    <div class="bg-white profile-details">                      
                        <a data-toggle="modal" data-target="#change_password" class="d-flex w-100 align-items-center border-bottom p-3">
                            <div class="left mr-3">
                                <h6 class="font-weight-bold mb-1 text-dark">{{trans('lang.change_password')}}</h6>
                            </div>
                            <div class="right ml-auto">
                                <h6 class="font-weight-bold m-0"><i class="feather-chevron-right"></i></h6>
                            </div>
                        </a>                       
                    </div>
                </div>
            </div>
            <div class="col-md-8 mb-3">
                <div class="rounded shadow-sm p-4 bg-white">
                    <h5 class="mb-4">{{trans('lang.my_account')}}</h5>
                    <div id="edit_profile">
                        <div class="error_top"></div>
                        <div>
                            <div class="form-group">
                                <label>{{trans('lang.first_name')}}</label>
                                <input type="text" class="form-control user_first_name" value="">
                            </div>
                            <div class="form-group">
                                <label>{{trans('lang.last_name')}}</label>
                                <input type="text" class="form-control user_last_name">
                            </div>
                            <div class="form-group">
                                <label>{{trans('lang.email')}}</label>
                                <input type="text" class="form-control user_email">
                            </div>
                            <div class="form-group">
                                <label>{{trans('lang.user_phone')}}</label>
                                <input type="text" class="form-control user_phone" value="">
                            </div>
                           
                            <div class="form-group">
                                <label>{{trans('lang.restaurant_image')}}</label>
                                <input type="file" onChange="handleFileSelect(event)">
                            </div>
                            <div class="form-group">
                               <div class="placeholder_img_thumb user_image"></div>
                                <div id="uploding_image"></div>
                            </div>
                            
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary btn-block save_user_btn">{{ trans('lang.save')}}</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
</div>

<div class="modal fade" id="change_password" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">{{trans('lang.change_password')}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                    <div class="form-row">
                        <div class="col-md-12 error_top_pass"></div>

                        <div class="col-md-12 form-group">
                            <label class="form-label">{{trans('lang.old_password')}}</label>
                            <input type="password" class="form-control user_old_password">
                        </div>
                        <div class="col-md-12 form-group">
                            <label class="form-label">{{trans('lang.new_password')}}</label>
                            <input type="password" class="form-control user_new_password">
                        </div>                       
                    </div>
            </div>
            <div class="modal-footer p-0 border-0">
                <div class="col-6 m-0 p-0">
                    <button type="button" class="btn border-top btn-lg btn-block" data-dismiss="modal">{{ trans('lang.cancel')}}</button>
                </div>
                <div class="col-6 m-0 p-0">
                    <button type="button" class="btn btn-primary btn-lg btn-block change_user_password">{{ trans('lang.save')}}</button>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')

@include('layouts.nav')
       
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/3.1.9-1/crypto-js.js"></script>

<script>
    var id = user_uuid;
    var database = firebase.firestore();
    var ref = database.collection('users').where("id","==",id);

    var photo ="";
    var placeholderImage = '';
    var placeholder = database.collection('settings').doc('placeHolderImage');
 
    placeholder.get().then( async function(snapshotsimage){
        var placeholderImageData = snapshotsimage.data();
        placeholderImage = placeholderImageData.image;
    })

    var currentCurrency = '';
    var currencyAtRight = false;
    var refCurrency = database.collection('currencies').where('isActive', '==' , true);
    var decimal=0;
    refCurrency.get().then( async function(snapshots){  
        var currencyData = snapshots.docs[0].data();
        currentCurrency = currencyData.symbol;
        decimal=currencyData.decimal_degits;
        
        currencyAtRight = currencyData.symbolAtRight;
    }); 
        
    $(document).ready(function(){

        ref.get().then( async function(snapshots){

            var user = snapshots.docs[0].data();
            var wallet_amount_user = '';
            $(".user_email_show").html(user.email);
            $(".user_full_name").html(user.firstName+' '+user.lastName);

            if(user.hasOwnProperty('wallet_amount') && user.wallet_amount != '' && user.wallet_amount != '0' ){
                if(currencyAtRight){
                    wallet_amount_user=user.wallet_amount.toFixed(decimal)+''+currentCurrency;
                }else{
                     wallet_amount_user=currentCurrency+''+user.wallet_amount.toFixed(decimal);
                }
            
            }else{    
                wallet_amount=0;
                if(currencyAtRight){
                    wallet_amount_user=wallet_amount.toFixed(decimal)+currentCurrency;
                }else{
                      wallet_amount_user=currentCurrency+wallet_amount.toFixed(decimal);
                }
            }
            $(".user_wallet").html(wallet_amount_user);

            $(".user_first_name").val(user.firstName);
            $(".user_last_name").val(user.lastName);
            $(".user_email").val(user.email);
            $(".user_phone").val(user.phoneNumber);

         
            photo = user.profilePictureURL;
            if (photo!='' && photo!=null) {

                $(".user_image").append('<img onerror="this.onerror=null;this.src=\'' + placeholderImage + '\'" class="rounded" style="width:50px" src="'+photo+'" alt="image">');
            }else{

                $(".user_image").append('<img class="rounded" style="width:50px" src="'+placeholderImage+'" alt="image">');
            }
            
            jQuery("#data-table_processing").hide();
     
        })

        $(".change_user_password").click(function(){

            var userOldPassword =  $(".user_old_password").val();
            var userNewPassword = $(".user_new_password").val();
            var userEmail = $(".user_email").val();

            if(userOldPassword == ''){
                $(".error_top_pass").show();
                $(".error_top_pass").html("");
                $(".error_top_pass").append("<p>{{trans('lang.old_password_error')}}</p>");
                window.scrollTo(0, 0);
            }else if(userNewPassword == ''){
                $(".error_top_pass").show();
                $(".error_top_pass").html("");
                $(".error_top_pass").append("<p>{{trans('lang.new_password_error')}}</p>");
                window.scrollTo(0, 0);
            }else{
                
                var user = firebase.auth().currentUser;

                firebase.auth().signInWithEmailAndPassword(userEmail, userOldPassword).then((userCredential) => {
                    var user = userCredential.user;
                        user.updatePassword(userNewPassword).then(() => {
                            $(".error_top_pass").show();
                            $(".error_top_pass").html("");
                            $(".error_top_pass").append("<p>{{trans('lang.password_updated_successfully')}}</p>");
                            window.scrollTo(0, 0);
                            $("#change_password .close").trigger( "click" );
                            }).catch((error) => { 
                            $(".error_top_pass").show();
                            $(".error_top_pass").html("");
                            $(".error_top_pass").append("<p>"+error+"</p>");
                            window.scrollTo(0, 0);
                            });
                    }).catch((error) => {
                        var errorCode = error.code;
                        var errorMessage = error.message;
                        $(".error_top_pass").show();
                        $(".error_top_pass").html("");
                        $(".error_top_pass").append("<p>"+errorMessage+"</p>");
                        window.scrollTo(0, 0);
                    });


                }
             
          });
  
        $(".save_user_btn").click(function(){
 
            var userFirstName = $(".user_first_name").val();
            var userLastName = $(".user_last_name").val();
            var email = $(".user_email").val();
            var userPhone = $(".user_phone").val();
            var active = $(".user_active").is(":checked");
            var password = $(".user_password").val();
            var user_name = userFirstName+" "+userLastName;

           
            if(userFirstName == ''){
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.user_firstname_error')}}</p>");
                window.scrollTo(0, 0);

            }else if(email == ''){
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.user_email_error')}}</p>");
                window.scrollTo(0, 0);
            } else if(userPhone == '' ){
                $(".error_top").show();
                $(".error_top").html("");
                $(".error_top").append("<p>{{trans('lang.user_phone_error')}}</p>");
                window.scrollTo(0, 0);
            }
         
           else{
         
               database.collection('users').doc(id).update({'firstName':userFirstName,'lastName':userLastName,'email':email,'phoneNumber':userPhone,'profilePictureURL':photo,'role':'customer','active':active}).then(function(result) {
                        window.location.href = '{{ url("/")}}';
                     }); 
           }
            
        })


    })
    var storageRef = firebase.storage().ref('images');
    function handleFileSelect(evt) {
      var f = evt.target.files[0];
      var reader = new FileReader();

      reader.onload = (function(theFile) {
        return function(e) {
            
          var filePayload = e.target.result;
          var hash = CryptoJS.SHA256(Math.random() + CryptoJS.SHA256(filePayload));
            var val =f.name;       
          var ext=val.split('.')[1];
          var docName=val.split('fakepath')[1];
          var filename = (f.name).replace(/C:\\fakepath\\/i, '')

          var timestamp = Number(new Date());
          var filename = filename.split('.')[0] + "_" + timestamp + '.' + ext;
                
          var uploadTask = storageRef.child(filename).put(theFile);
          uploadTask.on('state_changed', function(snapshot){
          var progress = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
          console.log('Upload is ' + progress + '% done');
          jQuery("#uploding_image").text("Image is uploading...");
        }, function(error) {
        }, function() {
            uploadTask.snapshot.ref.getDownloadURL().then(function(downloadURL) {
                jQuery("#uploding_image").text("Upload is completed");
                photo = downloadURL;
                $(".user_image").empty();
                $(".user_image").append('<img onerror="this.onerror=null;this.src=\'' + placeholderImage + '\'" class="rounded" style="width:50px" src="'+photo+'" alt="image">');


          });   
        });
        
        };
      })(f);
      reader.readAsDataURL(f);
    }

</script>