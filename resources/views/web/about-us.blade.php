@extends('layouts.web')
@push('page-title', 'Giới thiệu')
@section('page-content')
    <div class="inner-heading">
        <div class="container">
            <h1>@stack('page-title')</h1>
        </div>
    </div>

    <div class="inner-content aboutWrp">
        <div class="container">
            <h3 class="mb-5">{{$needle->title}}</h3>

            {!! $needle->content !!}
        </div>

        <!--Team Start-->
        <div class="team-wrap">
            <div class="container">
                <div class="title">
                    <h3>Đội ngũ <span>ưu tú</span></h3>
                </div>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam quam nisi, sollicitudin venenatis nisl id, iaculis pharetra quam. <span>Vivamus cursus est vel sagittis tristique. Nunc vel ligula mollis, imperdiet dolor quis, consectetur magna. Duis facilisis tempor lectus tempus dignissim. Praesent lacus ante, mattis sit amet purus non, suscipit pellentesque odio.</span>
                </p>
                <div class="clearfix"></div>
                <ul class="row">
                    @foreach($teamMembers as $teamMember)
                    <li class="col-md-3 col-sm-6">
                        <div class="teamImg"><img src="{{$teamMember->avatar_path}}">
                            <ul class="social-icons">
                                @if ($teamMember->facebook != '')
                                <li><a href="#"><i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                                @endif
                                    @if ($teamMember->twitter != '')
                                <li><a href="#"><i class="fab fa-twitter" aria-hidden="true"></i></a></li>
                                    @endif
                                    @if ($teamMember->linkedin != '')
                                <li><a href="#"><i class="fab fa-linkedin" aria-hidden="true"></i></a></li>
                                    @endif
                            </ul>
                        </div>
                        <div class="teamInfo">
                            <h3>{{$teamMember->full_name}}</h3>
                            <div class="designation">{{$teamMember->title}}</div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!--Team End-->

        <!--About End-->

    </div>
@stop
@push('extra-css')
    <style>
        /**********************************
		Team Css
**********************************/
        .team-wrap{padding:60px 0;}
        .team-wrap .title{ margin-bottom:50px;
            border-right: 1px solid #a58838;
            float: left;
            padding-right: 50px;
            margin-right: 50px;
        }

        .team-wrap p{margin-top:24px;}
        .team-wrap ul{list-style:none;}
        .teamInfo{background:#FFF; box-shadow:0 0 16px rgba(0, 0, 0, 0.23); padding:15px; margin:0 15px; text-align:center; margin-top:-20px; z-index:1000; position:relative;}
        .teamInfo h3{margin-top:0; font-weight:bold; margin-bottom:6px; font-size:20px;}
        .social-icons{list-style:none; display:block; text-align:center; position:absolute; top:20px; right:20px; z-index:1000;}
        .social-icons li{padding:5px 0;}
        .social-icons li a{text-decoration:none; width:35px; height:35px; text-align:center; line-height:35px; border:1px solid #a58838; color:#a58838; font-size:18px; display:block; border-radius:100%;}
        .social-icons li:nth-child(1) a{color:#3b5998; border:1px solid #3b5998;}
        .social-icons li:nth-child(1) a:hover{background:#3b5998;}
        .social-icons li:nth-child(2) a{color:#1da1f2; border:1px solid #1da1f2;}
        .social-icons li:nth-child(2) a:hover{background:#1da1f2;}
        .social-icons li:nth-child(3) a{color:#0174b5; border:1px solid #0174b5;}
        .social-icons li:nth-child(3) a:hover{background:#0174b5;}
        .team-wrap ul li:hover li a{color:#fff; border:1px solid #fff;}
        .teamImg{position:relative; overflow:hidden;}
        .teamImg:before {
            position: absolute;
            content: "";
            width: 100%;
            left: 0;
            height: 100%;
            bottom: 100%;
            background-color: rgba(0, 0, 0, 0.4);
            visibility: hidden;
            transition: all 0.4s ease-in-out 0s;
            text-align: center;
        }
        .team-wrap ul li:hover .teamImg:before {
            z-index: 1000;
            visibility: visible;
            transition: all 0.4s ease-in-out 0s;
            bottom: 0px;
        }
        .title h3{font-size:24px; font-weight:bold; text-transform:uppercase;}
        .title h3 span{display:block; font-size:62px; font-style:italic; color:#a58838; }
        .title h3 strong{color:#a58838;}
    </style>
@endpush
