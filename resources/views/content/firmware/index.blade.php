@extends('layouts/contentNavbarLayout',['navbarBreadcrumb' => true, 'navbarBreadcrumbPrev' => '', 'navbarBreadcrumbActive' => 'Upload Firmware', 'breadcrumbLink'=> route("home")])
@section('title', 'Firmwares Updates')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('page-style')
@endsection

@section('content')
<div class="row">
  <div class="col-lg-8 col-md-8 mb-4">
    <div class="col-12 h-100">
      <div class="card h-100">
        <div class="d-flex align-items-end row">
          <div class="col-sm-7">
            <div class="card-body">
              <h5 class="card-title text-primary">New Updateds!</h5>
              <p class="mb-4">Assign a new software updates for whole vehicle model or assign to specific vehicle.</p>
  
              <a href="javascript:;" class="btn btn-sm btn-primary">New Software Update</a>
            </div>
          </div>
          <div class="col-sm-5 text-center text-sm-left">
            <div class="card-body pb-0 pt-0 px-0 px-md-4">
              <img src="../../assets/img/illustrations/undraw_Server_push_re_303w.png" height="180" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- <div class="col-12">
      <div class="card">
        <div class="card-body">
          <span class="d-block fw-medium">Sales</span>
          <h3 class="card-title mb-2">482k</h3>
          <span class="badge bg-label-info mb-3">+34%</span>
          <small class="text-muted d-block">Sales Target</small>
          <div class="d-flex align-items-center">
            <div class="progress w-75 me-2" style="height: 8px;">
              <div class="progress-bar bg-info" style="width: 78%" role="progressbar" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <span>78%</span>
          </div>
        </div>
      </div>
    </div> --}}
  </div>
  <div class="col-lg-4 col-md-4 mb-4">
    <div class="card h-100">
      <div class="card-body">
        <h4 class="mb-2 pb-1">Upcoming Update</h4>
        <p class="small">Next Generation Frontend Architecture Using Layout Engine And React Native Web.</p>
        <div class="row mb-3 g-3">
          <div class="col-6">
            <div class="d-flex">
              <div class="avatar flex-shrink-0 me-2">
                <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-calendar-exclamation bx-sm"></i></span>
              </div>
              <div>
                <h6 class="mb-0 text-nowrap">17 Nov 23</h6>
                <small>Date</small>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="d-flex">
              <div class="avatar flex-shrink-0 me-2">
                <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-time-five bx-sm"></i></span>
              </div>
              <div>
                <h6 class="mb-0 text-nowrap">32 minutes</h6>
                <small>Duration</small>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    {{-- <div class="card h-100">
      <div class="card-body">
        <div class="bg-label-primary rounded-3 text-center mb-3 pt-4">
          <img class="img-fluid w-60" src="../../assets/img/illustrations/sitting-girl-with-laptop-dark.png" alt="Card girl image">
        </div>
        <h4 class="mb-2 pb-1">Upcoming Webinar</h4>
        <p class="small">Next Generation Frontend Architecture Using Layout Engine And React Native Web.</p>
        <div class="row mb-3 g-3">
          <div class="col-6">
            <div class="d-flex">
              <div class="avatar flex-shrink-0 me-2">
                <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-calendar-exclamation bx-sm"></i></span>
              </div>
              <div>
                <h6 class="mb-0 text-nowrap">17 Nov 23</h6>
                <small>Date</small>
              </div>
            </div>
          </div>
          <div class="col-6">
            <div class="d-flex">
              <div class="avatar flex-shrink-0 me-2">
                <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-time-five bx-sm"></i></span>
              </div>
              <div>
                <h6 class="mb-0 text-nowrap">32 minutes</h6>
                <small>Duration</small>
              </div>
            </div>
          </div>
        </div>
        <a href="javascript:void(0);" class="btn btn-primary w-100">Join the event</a>
      </div>
    </div> --}}
    {{-- <div class="col-12 mb-4">
      <div class="card">
        <div class="card-body">
          <div class="d-flex justify-content-between flex-sm-row flex-column gap-3">
            <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
              <div class="card-title">
                <h5 class="text-nowrap mb-2">Profile Report</h5>
                <span class="badge bg-label-warning rounded-pill">Year 2021</span>
              </div>
              <div class="mt-sm-auto">
                <small class="text-success text-nowrap fw-medium"><i class='bx bx-chevron-up'></i> 68.2%</small>
                <h3 class="mb-0">$84,686k</h3>
              </div>
            </div>
            <div id="profileReportChart"></div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12">
      <div class="card h-100">
        <div class="card-header d-flex align-items-center justify-content-between">
          <h5 class="card-title m-0 me-2">Assignment Progress</h5>
        </div>
        <div class="card-body">
          <ul class="ps-0 m-0">
            <li class="d-flex mb-3 pb-2" style="position: relative;">
              <div class="chart-progress me-3" data-color="success" data-series="48" data-progress_variant="true" style="min-height: 62.7px;"><div id="apexchartsch5627vih" class="apexcharts-canvas apexchartsch5627vih apexcharts-theme-light" style="width: 58px; height: 62.7px;"><svg id="SvgjsSvg1598" width="58" height="62.7" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1600" class="apexcharts-inner apexcharts-graphical" transform="translate(-18, -12)"><defs id="SvgjsDefs1599"><clipPath id="gridRectMaskch5627vih"><rect id="SvgjsRect1602" width="98" height="91" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskch5627vih"></clipPath><clipPath id="nonForecastMaskch5627vih"></clipPath><clipPath id="gridRectMarkerMaskch5627vih"><rect id="SvgjsRect1603" width="96" height="93" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG1604" class="apexcharts-radialbar"><g id="SvgjsG1605"><g id="SvgjsG1606" class="apexcharts-tracks"><g id="SvgjsG1607" class="apexcharts-radialbar-track apexcharts-track" rel="1"><path id="apexcharts-radialbarTrack-0" d="M 46 20.01890243902438 A 24.48109756097562 24.48109756097562 0 1 1 45.995727242452276 20.018902811892815" fill="none" fill-opacity="1" stroke="#8897aa1a" stroke-opacity="1" stroke-linecap="round" stroke-width="5.130353658536585" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 46 20.01890243902438 A 24.48109756097562 24.48109756097562 0 1 1 45.995727242452276 20.018902811892815"></path></g></g><g id="SvgjsG1609"><g id="SvgjsG1614" class="apexcharts-series apexcharts-radial-series" seriesName="" rel="1" data:realIndex="0"><path id="SvgjsPath1615" d="M 46 20.01890243902438 A 24.48109756097562 24.48109756097562 0 0 1 48.983495285593456 68.79861917210211" fill="none" fill-opacity="0.85" stroke="rgba(113,221,55,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="5.2890243902439025" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="173" data:value="48" index="0" j="0" data:pathOrig="M 46 20.01890243902438 A 24.48109756097562 24.48109756097562 0 0 1 48.983495285593456 68.79861917210211"></path></g><circle id="SvgjsCircle1610" r="16.915920731707327" cx="46" cy="44.5" class="apexcharts-radialbar-hollow" fill="transparent"></circle><g id="SvgjsG1611" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)" style="opacity: 1;"><text id="SvgjsText1612" font-family="Helvetica, Arial, sans-serif" x="46" y="44.5" text-anchor="middle" dominant-baseline="auto" font-size="16px" font-weight="500" fill="#71dd37" class="apexcharts-text apexcharts-datalabel-label" style="font-family: Helvetica, Arial, sans-serif;"></text><text id="SvgjsText1613" font-family="Public Sans" x="46" y="50.5" text-anchor="middle" dominant-baseline="auto" font-size="15px" font-weight="500" fill="#566a7f" class="apexcharts-text apexcharts-datalabel-value" style="font-family: &quot;Public Sans&quot;;">48%</text></g></g></g></g><line id="SvgjsLine1616" x1="0" y1="0" x2="92" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1617" x1="0" y1="0" x2="92" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG1601" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div></div></div>
              <div class="row w-100 align-items-center">
                <div class="col-9">
                  <div class="me-2">
                    <h6 class="mb-2">Basic fundamentals</h6>
                    <small>32 Tasks</small>
                  </div>
                </div>
                <div class="col-3 text-end">
                  <button type="button" class="btn btn-sm btn-icon btn-label-secondary">
                    <i class="bx bx-chevron-right scaleX-n1-rtl"></i>
                  </button>
                </div>
              </div>
            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 400px; height: 72px;"></div></div><div class="contract-trigger"></div></div></li>
            <li class="d-flex mb-3 pb-2" style="position: relative;">
              <div class="chart-progress me-3" data-color="danger" data-series="15" data-progress_variant="true" style="min-height: 62.7px;"><div id="apexcharts82s5rnim" class="apexcharts-canvas apexcharts82s5rnim apexcharts-theme-light" style="width: 58px; height: 62.7px;"><svg id="SvgjsSvg1618" width="58" height="62.7" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1620" class="apexcharts-inner apexcharts-graphical" transform="translate(-18, -12)"><defs id="SvgjsDefs1619"><clipPath id="gridRectMask82s5rnim"><rect id="SvgjsRect1622" width="98" height="91" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMask82s5rnim"></clipPath><clipPath id="nonForecastMask82s5rnim"></clipPath><clipPath id="gridRectMarkerMask82s5rnim"><rect id="SvgjsRect1623" width="96" height="93" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG1624" class="apexcharts-radialbar"><g id="SvgjsG1625"><g id="SvgjsG1626" class="apexcharts-tracks"><g id="SvgjsG1627" class="apexcharts-radialbar-track apexcharts-track" rel="1"><path id="apexcharts-radialbarTrack-0" d="M 46 20.01890243902438 A 24.48109756097562 24.48109756097562 0 1 1 45.995727242452276 20.018902811892815" fill="none" fill-opacity="1" stroke="#8897aa1a" stroke-opacity="1" stroke-linecap="round" stroke-width="5.130353658536585" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 46 20.01890243902438 A 24.48109756097562 24.48109756097562 0 1 1 45.995727242452276 20.018902811892815"></path></g></g><g id="SvgjsG1629"><g id="SvgjsG1634" class="apexcharts-series apexcharts-radial-series" seriesName="" rel="1" data:realIndex="0"><path id="SvgjsPath1635" d="M 46 20.01890243902438 A 24.48109756097562 24.48109756097562 0 0 1 65.80562396778035 30.110371893725297" fill="none" fill-opacity="0.85" stroke="rgba(255,62,29,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="5.2890243902439025" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="54" data:value="15" index="0" j="0" data:pathOrig="M 46 20.01890243902438 A 24.48109756097562 24.48109756097562 0 0 1 65.80562396778035 30.110371893725297"></path></g><circle id="SvgjsCircle1630" r="16.915920731707327" cx="46" cy="44.5" class="apexcharts-radialbar-hollow" fill="transparent"></circle><g id="SvgjsG1631" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)" style="opacity: 1;"><text id="SvgjsText1632" font-family="Helvetica, Arial, sans-serif" x="46" y="44.5" text-anchor="middle" dominant-baseline="auto" font-size="16px" font-weight="500" fill="#ff3e1d" class="apexcharts-text apexcharts-datalabel-label" style="font-family: Helvetica, Arial, sans-serif;"></text><text id="SvgjsText1633" font-family="Public Sans" x="46" y="50.5" text-anchor="middle" dominant-baseline="auto" font-size="15px" font-weight="500" fill="#566a7f" class="apexcharts-text apexcharts-datalabel-value" style="font-family: &quot;Public Sans&quot;;">15%</text></g></g></g></g><line id="SvgjsLine1636" x1="0" y1="0" x2="92" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1637" x1="0" y1="0" x2="92" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG1621" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div></div></div>
              <div class="row w-100 align-items-center">
                <div class="col-9">
                  <div class="me-2">
                    <h6 class="mb-2">React native components</h6>
                    <small>182 Tasks</small>
                  </div>
                </div>
                <div class="col-3 text-end">
                  <button type="button" class="btn btn-sm btn-icon btn-label-secondary">
                    <i class="bx bx-chevron-right scaleX-n1-rtl"></i>
                  </button>
                </div>
              </div>
            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 400px; height: 72px;"></div></div><div class="contract-trigger"></div></div></li>
            <li class="d-flex" style="position: relative;">
              <div class="chart-progress me-3" data-color="info" data-series="24" data-progress_variant="true" style="min-height: 62.7px;"><div id="apexchartsfm8nwjnf" class="apexcharts-canvas apexchartsfm8nwjnf apexcharts-theme-light" style="width: 58px; height: 62.7px;"><svg id="SvgjsSvg1638" width="58" height="62.7" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;"><g id="SvgjsG1640" class="apexcharts-inner apexcharts-graphical" transform="translate(-18, -12)"><defs id="SvgjsDefs1639"><clipPath id="gridRectMaskfm8nwjnf"><rect id="SvgjsRect1642" width="98" height="91" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath><clipPath id="forecastMaskfm8nwjnf"></clipPath><clipPath id="nonForecastMaskfm8nwjnf"></clipPath><clipPath id="gridRectMarkerMaskfm8nwjnf"><rect id="SvgjsRect1643" width="96" height="93" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect></clipPath></defs><g id="SvgjsG1644" class="apexcharts-radialbar"><g id="SvgjsG1645"><g id="SvgjsG1646" class="apexcharts-tracks"><g id="SvgjsG1647" class="apexcharts-radialbar-track apexcharts-track" rel="1"><path id="apexcharts-radialbarTrack-0" d="M 46 20.01890243902438 A 24.48109756097562 24.48109756097562 0 1 1 45.995727242452276 20.018902811892815" fill="none" fill-opacity="1" stroke="#8897aa1a" stroke-opacity="1" stroke-linecap="round" stroke-width="5.130353658536585" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 46 20.01890243902438 A 24.48109756097562 24.48109756097562 0 1 1 45.995727242452276 20.018902811892815"></path></g></g><g id="SvgjsG1649"><g id="SvgjsG1654" class="apexcharts-series apexcharts-radial-series" seriesName="" rel="1" data:realIndex="0"><path id="SvgjsPath1655" d="M 46 20.01890243902438 A 24.48109756097562 24.48109756097562 0 0 1 70.42146283773275 42.79228496076043" fill="none" fill-opacity="0.85" stroke="rgba(3,195,236,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="5.2890243902439025" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="86" data:value="24" index="0" j="0" data:pathOrig="M 46 20.01890243902438 A 24.48109756097562 24.48109756097562 0 0 1 70.42146283773275 42.79228496076043"></path></g><circle id="SvgjsCircle1650" r="16.915920731707327" cx="46" cy="44.5" class="apexcharts-radialbar-hollow" fill="transparent"></circle><g id="SvgjsG1651" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)" style="opacity: 1;"><text id="SvgjsText1652" font-family="Helvetica, Arial, sans-serif" x="46" y="44.5" text-anchor="middle" dominant-baseline="auto" font-size="16px" font-weight="500" fill="#03c3ec" class="apexcharts-text apexcharts-datalabel-label" style="font-family: Helvetica, Arial, sans-serif;"></text><text id="SvgjsText1653" font-family="Public Sans" x="46" y="50.5" text-anchor="middle" dominant-baseline="auto" font-size="15px" font-weight="500" fill="#566a7f" class="apexcharts-text apexcharts-datalabel-value" style="font-family: &quot;Public Sans&quot;;">24%</text></g></g></g></g><line id="SvgjsLine1656" x1="0" y1="0" x2="92" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine1657" x1="0" y1="0" x2="92" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line></g><g id="SvgjsG1641" class="apexcharts-annotations"></g></svg><div class="apexcharts-legend"></div></div></div>
              <div class="row w-100 align-items-center">
                <div class="col-9">
                  <div class="me-2">
                    <h6 class="mb-2">Basic of music theory</h6>
                    <small>56 Tasks</small>
                  </div>
                </div>
                <div class="col-3 text-end">
                  <button type="button" class="btn btn-sm btn-icon btn-label-secondary">
                    <i class="bx bx-chevron-right scaleX-n1-rtl"></i>
                  </button>
                </div>
              </div>
            <div class="resize-triggers"><div class="expand-trigger"><div style="width: 400px; height: 64px;"></div></div><div class="contract-trigger"></div></div></li>
          </ul>
        </div>
      </div>
    </div> --}}
  </div>

  <div class="col-12">
    <div class="card mb-4 p-4">
      @livewire("firmwares-table", ["theme" => "bootstrap-5"])
    </div>
  </div>
  
</div>


@endsection


@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
<script>
  Livewire.on('openModal', currnetStatus => {
    $('#statusModal').modal('show');
    // Fetch data or perform other actions based on the currnetStatus
    $('#statusModal').find('#status option[value="'+currnetStatus[0]+'"]').prop("selected", true);
    // on save status
    $('#statusModal').find('#update-status').on('click', function() {
      var status = $('#statusModal').find('#status').val();
      Livewire.dispatch('updateStatus', { status: status });
      $('#statusModal').modal('hide');
    });
  });

  $('#statusModal').on('hidden.bs.modal', function () {
    Livewire.dispatch('resetModal');
  });
</script>
@endsection