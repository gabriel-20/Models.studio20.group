<nav class="navbar navbar-default">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="{{ route('home') }}">Back To Dashboard</a>
        </div>
        <ul class="nav navbar-nav">
            <li>
                <a onclick="location.href='{{ route('analytics', 'date') }}'">
                    <span class="nav-text">{{ trans('backLang.visitorsAnalyticsBydate') }}</span>
                </a>
            </li> |
            <li>
                <a onclick="location.href='{{ route('analytics', 'modelname') }}'">
                    <span class="nav-text">{{ trans('backLang.visitorsAnalyticsBymodel') }}</span>
                </a>
            </li> |
            <li>
                <a onclick="location.href='{{ route('analytics', 'source') }}'">
                    <span class="nav-text">{{ trans('backLang.visitorsAnalyticsBysource') }}</span>
                </a>
            </li> |
            <li>
                <a onclick="location.href='{{ route('analytics', 'medium') }}'">
                    <span class="nav-text">{{ trans('backLang.visitorsAnalyticsByMedium') }}</span>
                </a>
            </li> |
            <li>
                <a onclick="location.href='{{ route('analytics', 'campaign') }}'">
                    <span class="nav-text">{{ trans('backLang.visitorsAnalyticsByCampaign') }}</span>
                </a>
            </li> |
            {{--<li>--}}
                {{--<a onclick="location.href='{{ route('visitors') }}'">--}}
                    {{--<span class="nav-text">{{ trans('backLang.visitorsAnalyticsVisitorsHistory') }}</span>--}}
                {{--</a>--}}
            {{--</li> |--}}
            <li>
                <a href="{{ route('visitorsByIp') }}">
                    <span class="nav-text">Ip Count</span>
                </a>
            </li> |
            <li>
                <a href="{{ route('visitorsIP') }}">
                    <span class="nav-text">{{ trans('backLang.visitorsAnalyticsIPInquiry') }}</span>
                </a>
            </li> |

            <li>
                <a href="{{ route('visitorsBanner') }}">
                    <span class="nav-text">Banner</span>
                </a>
            </li>


            <style>
                .nav {
                    padding: 15px;
                }
                li {
                    display: inline-block;
                }
            </style>
        </ul>
    </div>
</nav>