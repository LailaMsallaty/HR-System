
<div class="row justify-content-center">

    <div class="card card-statistics">
        <div class="card-body text-center ">
        
                <div style=" font-family: freeserif ;font-feature-settings: ss07; width:800px; height:600px; padding:20px; text-align:center; border: 10px solid #008080; ">
                    <div style="width:750px; height:550px; padding:20px; text-align:center; border: 5px solid #008080">
                           <span style="font-size:50px; font-weight:bold">{{ trans('awards-trans.Certificate') }}</span>
                           <br>
                           {{-- <i class="fa fa-certificate" style="font-size:80px ;color:#8b008b"></i> --}}
                            <img src="assets/images/PngItem_1329806.png" width="90" height="90" alt="">
                           <br><br>
                           <span style=" font-size:25px">{{ trans('awards-trans.Certify_That') }}</span>
                           <br><br>
                           <span style="font-size:30px"><b> {{$employee->FName}} {{$employee->LName}}</b></span><br/><br/>
                           <span style="font-size:25px; color:#8b008b">{{ trans('awards-trans.Deserve_Award') }}</span> <br/><br/>
                           <span style="font-size:30px">({{ $award->Name }})</span> <br/><br/>
                           <span style="font-size:25px">{{ trans('awards-trans.Date') }}</span><br>
                           <span style="font-size:30px">  {{ $EmployeeAward->created_at }}</span><br/>
                           <span style="font-size:20px;  color: #8b008b">  LLJ Company </span>

                    </div>
                    </div>

        </div>
    </div>

</div>

