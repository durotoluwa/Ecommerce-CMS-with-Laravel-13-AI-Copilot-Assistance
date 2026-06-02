 
 @if($homesectionConfig->actionboxstatus == 1)
 <div class="container">
                <div class="owl-carousel owl-theme icon-box" data-toggle="owl" data-owl-options='{
                    "dots": false,
                    "nav": false, 
                    "margin": 20,
                    "responsive": {
                        "0": {
                            "items": 1
                        },
                        "576": {
                            "items": 2
                        },
                        "768": {
                            "items": 3
                        },
                        "992": {
                            "items": 4
                        }
                    }
                }'>        
                
                
                    <div class="icon-box-side">
                        <span class="icon-box-icon">
                           {!! $homesectionConfig->boxicon1 !!}
                        </span><!--End .icon-box-icon-->

                        <div class="icon-box-content">
                            <h3 class="">{!! $homesectionConfig->boxheading1 !!}</h3><!-- End .icon-box-title -->
                            <p>{!! $homesectionConfig->boxtext1 !!}</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box-side -->
                              
                    

                    <div class="icon-box-side">
                        <span class="icon-box-icon">
                               {!! $homesectionConfig->boxicon2 !!}
                         </span><!--End .icon-box-icon-->

                        <div class="icon-box-content">
                            <h3 class="icon-box-title font-weight-semibold ">{!! $homesectionConfig->boxheading2 !!}</h3><!-- End .icon-box-title -->
                             <p>{!! $homesectionConfig->boxtext2 !!}</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box-side -->
                                      
                    


                    <div class="icon-box-side">
                        <span class="icon-box-icon">
                        {!! $homesectionConfig->boxicon3 !!}
                        </span><!--End .icon-box-icon-->

                        <div class="icon-box-content">
                            <h3 class="icon-box-title font-weight-semibold ">{!! $homesectionConfig->boxheading3 !!}</h3><!-- End .icon-box-title -->
                             <p>{!! $homesectionConfig->boxtext3 !!}</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box -->
                                     
                    


                    <div class="icon-box-side">
                        <span class="icon-box-icon">
                              {!! $homesectionConfig->boxicon4 !!}
                        </span><!--End .icon-box-icon-->

                        <div class="icon-box-content">
                            <h3 class="icon-box-title font-weight-semibold ">  {!! $homesectionConfig->boxheading4 !!}</h3><!-- End .icon-box-title -->
                              <p>{!! $homesectionConfig->boxtext4 !!}</p>
                        </div><!-- End .icon-box-content -->
                    </div><!-- End .icon-box-side -->   
                    
                    


                </div><!--End .owl-carousel-->
 </div>
              @endif