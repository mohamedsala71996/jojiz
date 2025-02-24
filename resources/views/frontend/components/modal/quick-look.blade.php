<div class="modal fade  " id="quick-look">

    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modal--shadow">
        <button
          class="btn dismiss-button fas fa-times"
          type="button"
          data-dismiss="modal"
        ></button>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-5">
              <!--====== Product Breadcrumb ======-->
              <div class="pd-breadcrumb u-s-m-b-30">
                <ul class="pd-breadcrumb__list">
                  <li class="has-separator">
                    <a href="{{route('index')}}">@lang("frontend.Home")</a>
                  </li>
                  <li class="">
                    <a href="javascript:void(0)" class="product_name"></a>
                  </li>

                </ul>
              </div>
              <!--====== End - Product Breadcrumb ======-->

              <!--====== Product Detail ======-->
              <div class="pd u-s-m-b-30">
                <div class="slider-fouc pd-wrap" style="display: inline">
                    <div id="pd-o-initiate">
                    </div>
                </div>
                <div class="u-s-m-t-15">
                    <div class="slider-fouc" style="display: inline">
                        <div id="pd-o-thumbnail">

                        </div>
                    </div>
                </div>
              </div>
              <!--====== End - Product Detail ======-->
            </div>
            <div class="col-lg-7" id="quick2nd">

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

