<html style="--status-bar-height: 0px; --top-window-height: 0px; --window-left: 0px; --window-right: 0px; --window-margin: 0px; --window-top: calc(var(--top-window-height) + calc(44px + env(safe-area-inset-top))); --window-bottom: 0px;">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Team</title>
    <meta property="og:title" content="Agridevelop Plus">
    <meta property="og:image" content="{{asset('public')}}/static/login/logo.png">
    <meta name="description"
          content="In the previous Agridevelop project, many people made their first pot of gold through the Agridevelop App. The new AgriDevelop Plus App has just opened registration in March 2024. We will build the best and most long-lasting online money-making application in India. Join AgriDevelop as soon as possible and you will have the best opportunity to make money.	">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, viewport-fit=cover">
    <link rel="stylesheet" href="{{asset('public')}}/static/index.2da1efab.css">
    <link rel="stylesheet" href="{{asset('public/team.css')}}">
</head>
<body class="uni-body pages-index-team">
<uni-app class="uni-app--maxwidth">
    <uni-page data-page="pages/index/team">
        <uni-page-head uni-page-head-type="default">
            <div class="uni-page-head" style="background-color: rgb(13, 165, 97); color: rgb(255, 255, 255);">
                <div class="uni-page-head-hd">
                    <div class="uni-page-head-btn"><i class="uni-btn-icon"
                                                      style="color: rgb(255, 255, 255); font-size: 27px;"></i></div>
                    <div class="uni-page-head-ft"></div>
                </div>
                <div class="uni-page-head-bd">
                    <div class="uni-page-head__title" style="font-size: 16px; opacity: 1;"> Team</div>
                </div>
                <div class="uni-page-head-ft"></div>
            </div>
            <div class="uni-placeholder"></div>
        </uni-page-head>
        <uni-page-wrapper>
            <uni-page-body>
                <uni-view data-v-461042ca="" class="content">
                    <uni-view data-v-461042ca="" class="team">
                        <uni-view data-v-461042ca="" class="hz">
                            <uni-view data-v-461042ca="" class="item">
                                <uni-view data-v-461042ca="" class="count">{{$team_size}}</uni-view>
                                <uni-view data-v-461042ca="" class="title">Team Size</uni-view>
                            </uni-view>
                            <uni-view data-v-461042ca="" class="item">
                                <uni-view data-v-461042ca="" class="count">
                                    {{price(\App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'daily_income')->sum('amount'))}}
                                </uni-view>
                                <uni-view data-v-461042ca="" class="title">Received Income</uni-view>
                            </uni-view>
                            <uni-view data-v-461042ca="" class="item">
                                <uni-view data-v-461042ca="" class="count">{{price($levelTotalCommission1 + $levelTotalCommission2 + $levelTotalCommission3)}}</uni-view>
                                <uni-view data-v-461042ca="" class="title">Purchase commission</uni-view>
                            </uni-view>
                            <uni-view data-v-461042ca="" class="item">
                                <uni-view data-v-461042ca="" class="count">
                                    {{price(\App\Models\UserLedger::where('user_id', auth()->id())->where('reason', 'Claim')->sum('amount'))}}
                                </uni-view>
                                <uni-view data-v-461042ca="" class="title">Treasure Income</uni-view>
                            </uni-view>
                        </uni-view>
                        <?php
                        $rebate = \App\Models\Rebate::first();
                        ?>
                        <uni-view data-v-461042ca="" class="team_2">
                            <uni-view data-v-461042ca="" class="team_box">
                                <uni-view data-v-461042ca="" class="team_t">
                                    <uni-text data-v-461042ca=""><span>LV.1</span></uni-text>
                                </uni-view>
                                <uni-view data-v-461042ca="" class="team_con">
                                    <uni-view data-v-461042ca="" class="hz">
                                        <uni-view data-v-461042ca="" class="item">
                                            <uni-view data-v-461042ca="" class="count">{{$first_level_users->count()}}</uni-view>
                                            <uni-view data-v-461042ca="" class="title">Team Size</uni-view>
                                        </uni-view>
                                        <uni-view data-v-461042ca="" class="item">
                                            <uni-view data-v-461042ca="" class="count">{{$first_level_users->where('investor', 1)->count()}}</uni-view>
                                            <uni-view data-v-461042ca="" class="title">Number of Investors</uni-view>
                                        </uni-view>
                                        <uni-view data-v-461042ca="" class="item">
                                            <uni-view data-v-461042ca="" class="count">{{price($lv1Recharge)}}</uni-view>
                                            <uni-view data-v-461042ca="" class="title">Team Recharge</uni-view>
                                        </uni-view>
                                        <uni-view data-v-461042ca="" class="item">
                                            <uni-view data-v-461042ca="" class="count">{{$rebate->interest_commission1}} %</uni-view>
                                            <uni-view data-v-461042ca="" class="title">Investment Rate</uni-view>
                                        </uni-view>
                                    </uni-view>
                                </uni-view>
                            </uni-view>
                            <uni-view data-v-461042ca="" class="team_box">
                                <uni-view data-v-461042ca="" class="team_t">
                                    <uni-text data-v-461042ca=""><span>LV.2</span></uni-text>
                                </uni-view>
                                <uni-view data-v-461042ca="" class="team_con">
                                    <uni-view data-v-461042ca="" class="hz">
                                        <uni-view data-v-461042ca="" class="item">
                                            <uni-view data-v-461042ca="" class="count">{{$second_level_users->count()}}</uni-view>
                                            <uni-view data-v-461042ca="" class="title">Team Size</uni-view>
                                        </uni-view>
                                        <uni-view data-v-461042ca="" class="item">
                                            <uni-view data-v-461042ca="" class="count">{{$second_level_users->where('investor', 1)->count()}}</uni-view>
                                            <uni-view data-v-461042ca="" class="title">Number of Investors</uni-view>
                                        </uni-view>
                                        <uni-view data-v-461042ca="" class="item">
                                            <uni-view data-v-461042ca="" class="count">{{price($lv2Recharge)}}</uni-view>
                                            <uni-view data-v-461042ca="" class="title">Team Recharge</uni-view>
                                        </uni-view>
                                        <uni-view data-v-461042ca="" class="item">
                                            <uni-view data-v-461042ca="" class="count">{{$rebate->interest_commission2}} %</uni-view>
                                            <uni-view data-v-461042ca="" class="title">Investment Rate</uni-view>
                                        </uni-view>
                                    </uni-view>
                                </uni-view>
                            </uni-view>
                            <uni-view data-v-461042ca="" class="team_box">
                                <uni-view data-v-461042ca="" class="team_t">
                                    <uni-text data-v-461042ca=""><span>LV.3</span></uni-text>
                                </uni-view>
                                <uni-view data-v-461042ca="" class="team_con">
                                    <uni-view data-v-461042ca="" class="hz">
                                        <uni-view data-v-461042ca="" class="item">
                                            <uni-view data-v-461042ca="" class="count">{{$third_level_users->count()}}</uni-view>
                                            <uni-view data-v-461042ca="" class="title">Team Size</uni-view>
                                        </uni-view>
                                        <uni-view data-v-461042ca="" class="item">
                                            <uni-view data-v-461042ca="" class="count">{{$third_level_users->where('investor', 1)->count()}}</uni-view>
                                            <uni-view data-v-461042ca="" class="title">Number of Investors</uni-view>
                                        </uni-view>
                                        <uni-view data-v-461042ca="" class="item">
                                            <uni-view data-v-461042ca="" class="count">{{price($lv3Recharge)}}</uni-view>
                                            <uni-view data-v-461042ca="" class="title">Team Recharge</uni-view>
                                        </uni-view>
                                        <uni-view data-v-461042ca="" class="item">
                                            <uni-view data-v-461042ca="" class="count">{{$rebate->interest_commission3}} %</uni-view>
                                            <uni-view data-v-461042ca="" class="title">Investment Rate</uni-view>
                                        </uni-view>
                                    </uni-view>
                                </uni-view>
                            </uni-view>
                        </uni-view>
                    </uni-view>

                    @include('app.layout.manu')
                </uni-view>
            </uni-page-body>
        </uni-page-wrapper>
    </uni-page>
</uni-app>
</body>
</html>
