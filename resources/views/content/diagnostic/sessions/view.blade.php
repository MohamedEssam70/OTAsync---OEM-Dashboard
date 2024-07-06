@php
  
@endphp

@extends('layouts/contentNavbarLayout',['navbarBreadcrumb' => true, 'navbarBreadcrumbPrev' => 'Diagnostic Sessions', 'navbarBreadcrumbActive' => 'Session: #'.$session->id, 'breadcrumbLink'=> route("sessions")])
@section('title', 'Diagnositic')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('page-style')
@endsection

@section('content')

@livewire('session-component', ['session' => $session])

@endsection




@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
<script src="{{asset('assets/vendor/libs/chartjs/chart.js')}}"></script>
@endsection

@section('page-script')
<script>

  var session_isActive = @json($session->status == \App\Enums\SessionStatus::Active);
  let frame_tabs = $('#frames_nav');
  let frame_content = $('#frames_content');
  let confirmed_table = $('#confirmed_data_table');
  let pending_table = $('#pending_data_table');
  let logs_table = $('#logs_data_table');
  let confirmed_counter = $('#confirmed_counter');
  let dtc_counter = $('#dtc_counter');
  let monitors_counter = $('#monitors_counter');
  let frames_counter = $('#frames_counter');

  let sensors_table = $('#sensor_data_table');

  let sensorChart;
  let hiddenDatasets = new Set();
  
  $(function () {
      // Init. in case session closed
      if(!session_isActive)
      {
        optionsDisable();
        clearDisable();
        cip_offline();
      }

      // Initial update
      keepAlive();
      
      // Update every 5 seconds if session active
      if(session_isActive)
      {
        setInterval(keepAlive, 5000);
      }
  });

  // Handel frames table
  function updateData_frames(frames)
  {
    // Store the currently active tab
    let activeTabId = frame_tabs.find('.frames-nav.nav-link.active').attr('data-bs-target');

    frame_tabs.empty();
    frame_content.empty();

    frames.forEach((frame, index) => {
        let tabId = `#navs-pills-${index}`;
        let isActive = (tabId === activeTabId) || (!activeTabId && index === 0);

        frame_tabs.append(`<li class="nav-item" role="presentation">
            <button type="button" class="frames-nav nav-link justify-content-center ${isActive ? 'active' : ''}" 
            role="tab" data-bs-toggle="tab" data-bs-target="${tabId}" 
            aria-controls="navs-pills-${index}" aria-selected="${isActive}">${frame.dtc}</button>
            </li>`);
        
        let sensorContent = '';
        frame.data.forEach(sensor => {
            sensorContent += `
              <div class="row">
                  <span class="">${(sensor.name)}</span>
                  <div>
                      <span class="text-warning w-auto">${(sensor.value)}</span>
                  </div>
              </div>
              <hr class="mt-1">
            `;
        });

        frame_content.append(`<div class="tab-pane fade ${isActive ? 'show active' : ''}" 
        id="navs-pills-${index}" role="tabpanel">
            <h5>Freeze Frame Sensor Snapshot</h5>
            ${sensorContent}
            </div>`);
    });

    if (!frame_tabs.find('.nav-link.active').length) {
        frame_tabs.find('button:first').addClass('active');
        frame_content.find('.tab-pane:first').addClass('show active');
    }
  }

  // Handel troubles tables
  function updateData_troubles(data, tableID)
  {
    tableID.empty();
    let confirmedRows = '';

    data.forEach((item, index) => {
      confirmedRows +=
      `
        <tr>
          <td>
            <span class="me-1 text-danger">${item.dtcs.type}</span> ${item.dtcs.code}
          </td>
          <td>
            <span>${item.dtcs.system}</span> 
          </td>
          <td>
            <span>${item.dtcs.manufactor}</span> 
          </td>
          <td>
            <span>${item.dtcs.description}</span> 
          </td>
          <td>
            <span>
              ${!item.cleard ? 
                        '<button type="button" class="btn btn-success btn-sm ms-2 clear-btn" data-target="'+item.id+'"><span><span class="">Clear</span></span></button>' 
                        : ''}
            </span> 
          </td>
        </tr>
      `
    });
    tableID.append(confirmedRows);

    if(!session_isActive)
    {
      clearDisable();
    }
  }

  // Handel DTCs logs table
  function updateData_logs(data)
  {
    logs_table.empty();
    let rows = '';

    data.forEach((item, index) => {
      if (item.dtcs) {  // Ensure dtcs data is present
        const createdAt = new Date(item.created_at);
        const timeString = createdAt.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', second: '2-digit' });
        const dateString = createdAt.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
        rows +=
        `
          <tr>
            <td>
              <span class="me-1 text-danger">${item.dtcs.type}</span>
              ${item.dtcs.code}
            </td>
            <td>
              <span>${item.type}</span> 
            </td>
            <td>
              <span class="text-truncate d-flex lh-1">${dateString}</span>
              <small class="text-muted">${dateString}</small> 
            </td>
            <td>
              ${item.cleard ? 
                '<div class="align-items-center row"><div class="col-2"><i class="fa-solid fa-circle-check text-success" style="font-size: 25px;"></i></div><div class="col"><span class="text-truncate d-flex lh-1">'+dateString+'</span><small class="text-muted">'+dateString+'</small></div></div>'
                : 
                '<i class="fa-solid fa-circle-xmark text-danger" style="font-size: 25px;"></i>'
              }
                
            </td>
          </tr>
        `
      }
    });
    logs_table.append(rows);
  }

  // Handel sensors data
  function updateData_sensors(data)
  {
    let table_data = data.table
    let graph_data = data.graph

    // Table Data Handeler
    sensors_table.empty();
    let sensorRows = '';

    table_data.forEach((sensor, index) => {
      sensorRows +=
      `
        <tr>
          <td>
            <span class="me-1 text-primary">${sensor.pid}</span> ${sensor.description}
          </td>
          <td>
            <span>${sensor.val}</span> ${sensor.unit}
          </td>
          <td>
            <span>${sensor.min}</span> ${sensor.unit}
          </td>
          <td>
            <span>${sensor.avg}</span> ${sensor.unit}
          </td>
          <td>
            <span>${sensor.max}</span> ${sensor.unit}
          </td>
        </tr>
      `
    });
    sensors_table.append(sensorRows);

    // Graph Drawing Handler
    const ctx = document.getElementById('sensorChart');
    if (!ctx) {
        console.error('Cannot find canvas element with id "sensorChart"');
        return;
    }

    // Prepare datasets
    const datasets = graph_data.map((sensor, index) => ({
        label: sensor.name,
        data: sensor.values,
        borderColor: getColor(index),
        backgroundColor: getColor(index, 0.2),
        yAxisID: `y-axis-${index}`,
        fill: false,
        tension: 0.4,
        hidden: hiddenDatasets.has(sensor.name)
    }));

    // Prepare scales
    const scales = {};
    graph_data.forEach((sensor, index) => {
        scales[`y-axis-${index}`] = {
            type: 'linear',
            display: true,
            position: index % 2 === 0 ? 'left' : 'right',
            grid: {
                drawOnChartArea: false,
            },
            title: {
                display: true,
                text: sensor.name
            }
        };
    });

    const chartConfig = {
        type: 'line',
        data: {
            labels: Array.from({length: graph_data[0].values.length}, (_, i) => i + 1),
            datasets: datasets
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            stacked: false,
            scales: scales,
            animation: {
                duration: 0 // general animation time
            },
            hover: {
                animationDuration: 0 // duration of animations when hovering an item
            },
            responsiveAnimationDuration: 0 // animation duration after a resize
        }
    };

    if (!sensorChart || typeof sensorChart.update !== 'function') {
        if (sensorChart) {
            sensorChart.destroy();
        }
        sensorChart = new Chart(ctx, chartConfig);

        // Add event listener for legend item click
        sensorChart.options.plugins.legend.onClick = (e, legendItem, legend) => {
            const index = legendItem.datasetIndex;
            const ci = legend.chart;
            const meta = ci.getDatasetMeta(index);

            meta.hidden = meta.hidden === null ? !ci.data.datasets[index].hidden : null;

            // Update hiddenDatasets Set
            if (meta.hidden) {
                hiddenDatasets.add(ci.data.datasets[index].label);
            } else {
                hiddenDatasets.delete(ci.data.datasets[index].label);
            }

            ci.update();
        };

    } else {
        // Update existing chart
        sensorChart.data.labels = chartConfig.data.labels;
        sensorChart.options.scales = chartConfig.options.scales;

        // Update datasets while preserving hidden state
        sensorChart.data.datasets.forEach((dataset, i) => {
            Object.assign(dataset, chartConfig.data.datasets[i]);
            dataset.hidden = hiddenDatasets.has(dataset.label);
        });

        sensorChart.update();
    }
    
  }

  // Handel counters in the page
  function updateData_counter(data)
  {
    confirmed_counter.html(data.confirmed);
    dtc_counter.html(data.dtcs);
    monitors_counter.html(data.monitors);
    frames_counter.html(data.frames);
  }

  // Call all updating methods
  function updateData(isActive, counter, frames, sensors, confirmed, pending, logs)
  {
    session_isActive = isActive;
    updateData_frames(frames),
    updateData_troubles(confirmed, confirmed_table),
    updateData_troubles(pending, pending_table),
    updateData_logs(logs),
    updateData_sensors(sensors),
    updateData_counter(counter)
  }

  // Perform update ajax
  function keepAlive()
  {  
      $.ajax({
        url: "{{ route('data.live', $session->id) }}",
        method: 'GET',
        success: function(data) {
          updateData(data.isActive, data.counter, data.frames, data.sensors, data.confirmed, data.pending,  data.logs)
        },
        error: function(xhr, status, error) {
            console.error("Error fetching updates:", error);
        }
    });

    if(!session_isActive)
    {
      optionsDisable();
      clearDisable();
      cip_offline();
    }
  }

  // Helper function to generate colors
  function getColor(index, alpha = 1)
  {
    const colors = [
        `rgba(255, 99, 132, ${alpha})`,
        `rgba(54, 162, 235, ${alpha})`,
        `rgba(255, 206, 86, ${alpha})`,
        `rgba(75, 192, 192, ${alpha})`,
        `rgba(153, 102, 255, ${alpha})`,
        `rgba(255, 159, 64, ${alpha})`
    ];
    return colors[index % colors.length];
  }

  // Disable options of active session (Refresh, Clear all, Disconnect, ...)
  function optionsDisable()
  {
    let activeOptions = document.querySelectorAll('.active-options');
    activeOptions.forEach(button => {
        button.disabled = true;
    });
  }

  // Disable clear buttons
  function clearDisable()
  {
    let clearButtons = document.querySelectorAll('.clear-btn');
    clearButtons.forEach(button => {
        button.disabled = true;
    });
  }

  // Handel connection, intrface, protocol status
  function cip_offline()
  {
    $('#cip').empty();
    $('#cip').html(`
      <h6 class="mb-2">CONNECTION: <span class="ms-2 text-muted">OFFLINE</span></h6></h6>
      <h6 class="mb-2">INTERFACE: <span class="ms-2 text-danger">NA</span></h6>
      <h6 class="mb-3">PROTOCOL: <span class="ms-2 text-danger">NA</span></h6>
    `)
  }

</script>

@endsection