<!-- jquery -->
<script src="{{ URL::asset('assets/js/jquery-3.3.1.min.js') }}"></script>
<!-- plugins-jquery -->
<script src="{{ URL::asset('assets/js/plugins-jquery.js') }}"></script>
<!-- plugin_path -->
<script type="text/javascript">var plugin_path = '{{ asset('assets/js') }}/';</script>


<!-- chart -->
<script src="{{ URL::asset('assets/js/chart-init.js') }}"></script>
<!-- calendar -->
<!-- charts sparkline -->
<script src="{{ URL::asset('assets/js/sparkline.init.js') }}"></script>
<!-- charts morris -->
<script src="{{ URL::asset('assets/js/morris.init.js') }}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('assets/js/datepicker.js') }}"></script>
<!-- sweetalert2 -->
<script src="{{ URL::asset('assets/js/sweetalert2.js') }}"></script>
<!-- toastr -->
@yield('js')
<script src="{{ URL::asset('assets/js/toastr.js') }}"></script>
<!-- validation -->
<script src="{{ URL::asset('assets/js/validation.js') }}"></script>
<!-- lobilist -->
<script src="{{ URL::asset('assets/js/lobilist.js') }}"></script>
<!-- custom -->
<script src="{{ URL::asset('assets/js/custom.js') }}"></script>
{{--
<script src="{{ URL::asset('assets/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/dataTables.buttons.min') }}"></script>
<script src="{{ URL::asset('assets/js/pdfmake.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/buttons.print.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/vfs_fonts.js') }}"></script>
<script src="{{ URL::asset('assets/js/buttons.html5.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/jszip.min.js') }}"></script> --}}

{{-- <script type="text/javascript" src="{{ URL::asset('assets/js/materialize.js') }}"></script> --}}


<script>
    function CheckAll(className, elem) {
        var elements = document.getElementsByClassName(className);
        var l = elements.length;
        if (elem.checked) {
            for (var i = 0; i < l; i++) {
                elements[i].checked = true;
            }
        } else {
            for (var i = 0; i < l; i++) {
                elements[i].checked = false;
            }
        }
    }

    function imagepreview(input){

if(input.files && input.files[0]) {

  var filerd = new FileReader();

  filerd.onload = function(e){

    $('#idForm + #imagepreview').remove();
    $('#imagepreview').attr('src',e.target.result);



  };

  filerd.readAsDataURL(input.files[0]);
}

}

$('#idupload').change(function(){

imagepreview(this);

});


// setInterval(function() {
//         $("#notifications_count").load(window.location.href + " #notifications_count");
//         $("#unreadNotifications").load(window.location.href + " #unreadNotifications");
//     }, 5000);


</script>
