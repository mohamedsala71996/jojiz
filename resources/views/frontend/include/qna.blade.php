
    @foreach($qna as $qa)
    <div class="question d-flex p-4">
        <img src="{{asset('public/profile.png')}}" style="width:46px;border-radius:50%" alt="">
        <p style="margin-left: 14px;font-size: 16px;">{{$qa->question}}<br>{{date('d M Y H:i:s',strtotime($qa->created_at))}}</p>
    </div>
        @if(isset($qa->answer))
            <div class="row">
                <div class="col-2">

                </div>
                <div class="col-10">
                    <div class="question d-flex p-4 ps-0 pt-0">
                        <img src="{{asset('public/profile.png')}}" style="width:46px;border-radius:50%" alt="">
                        <p style="margin-left: 14px;font-size: 16px;">{{$qa->answer}}<br>Seller <button class="btn btn-info btn-sm" style="padding: 0px 3px;font-size: 12px;">replay</button></p>
                    </div>
                </div>
            </div>
        @endif
    @php
    $replays=App\Models\User\QA::where('product_id', $qa->product_id)->where('qna_id',$qa->id)->where('type', 're-question')->get();
    @endphp

    @if(count($replays)>0)
        <div class="row">
            <div class="col-2">

            </div>
            <div class="col-10">
                @foreach($replays as $re)
                    <div class="question d-flex p-4 ps-0 pt-0">
                        <img src="{{asset('public/profile.png')}}" style="width:46px;border-radius:50%" alt="">
                        <p style="margin-left: 14px;font-size: 16px;">{{$re->question}}<br>{{date('d M Y H:i:s',strtotime($re->created_at))}}</p>
                    </div>
                    @if(isset($re->answer))
                        <div class="question d-flex p-4 ps-0 pt-0">
                            <img src="{{asset('public/profile.png')}}" style="width:46px;border-radius:50%" alt="">
                            <p style="margin-left: 14px;font-size: 16px;">{{$re->answer}}<br>Seller <button class="btn btn-info btn-sm" style="padding: 0px 3px;font-size: 12px;">replay</button></p>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    @endif

    <div class="row">
        <div class="col-2">

        </div>
        <div class="col-10">
            <div class="replay">
                <form name="form" id="replayform" method="GET">
                    <label for="">@lang("frontend.Replay here") !</label>
                    <div class="form-group d-flex">
                        <input type="text" class="form-control" style="width: 160px;height: 28px;" name="question" id="question_re{{$qa->id}}">
                        <input type="hidden" class="form-control" value="{{$qa->product_id}}" name="product_id" id="product_id_re{{$qa->id}}">
                        <input type="hidden" class="form-control" value="{{$qa->id}}" name="qna_id" id="qna_id{{$qa->id}}">
                        @if(Auth::id())
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}" id="user_id_re{{$qa->id}}">
                        @else
                            <input type="hidden" name="user_id" id="user_id_re{{$qa->id}}">
                        @endif
                        <button type="button" style="padding: 0px 6px;height: 28px;" class="btn btn-sm btn-primary" onclick="submitrena({{$qa->id}})" style="margin-left: -10px;border-radius: 0px 4px 4px 0px;font-size:15px;padding: 14px 18px;">@lang("frontend.SUBTOTAL")</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endforeach
