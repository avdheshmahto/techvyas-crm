<?php $this->load->view('header.php'); ?>
<style type="text/css">
  .tab-panel.active {
  display: block;   
  }
  .tab-panel {
  display: none;
  }
  .textarea{
  height: 100px !important;
  }  
</style>
<?php
  $usr=$this->db->query("select * from tbl_user_mst where user_id='".$this->session->userdata('user_id')."' ");
  $getUsr=$usr->row();
  $bname=$getUsr->buseiness_name;
  
  $cst=$this->db->query("select * from tbl_customers where maker_id='".$this->session->userdata('user_id')."' ");
  $count=$cst->num_rows();
  
  $brth=$this->db->query("select * from tbl_customers where date_of_birth !='N/A' AND maker_id='".$this->session->userdata('user_id')."' ");
  $countBirth=$brth->num_rows();
  
  $ann=$this->db->query("select * from tbl_customers where anniversary !='N/A' AND maker_id='".$this->session->userdata('user_id')."' ");
  $countAnniversary=$ann->num_rows();
  ?>
<section id="content">
  <div class="page page-tables-bootstrap">
    <div class="row">
      <div class="col-md-12">
        <section class="tile">
          <div class="pageheader tile-bg" style="margin-bottom:0px;">
            <h3>DASHBOARD - <?=$bname?></h3>
          </div>
          <!-- tile body -->
          <div class="add-nav">
            <div role="tabpanel">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs pt-15-" role="tablist">
                <li role="presentation" class="active"><a href="#dashboard" aria-controls="dashboard" role="tab" data-toggle="tab">Dashboard</a></li>
                <li role="presentation"><a href="#calender" aria-controls="calender" role="tab" data-toggle="tab">Calender</a></li>
                <li role="presentation"><a href="#registrations_" aria-controls="registrations" role="tab" data-toggle="tab">Registration</a></li>
                <li role="presentation"><a href="#chart" aria-controls="chart" role="tab" data-toggle="tab">Loyality</a></li>
                <li role="presentation"><a href="#source" aria-controls="source" role="tab" data-toggle="tab">Source</a></li>
              </ul>
              <div class="tab-content pb-0">
                <div role="tabpanel" class="tab-pane active pb-0" id="dashboard">
                  <div class="row">
                    <div class="col-md-12">
                      <section class="time-simple">
                        <div class="tile-body pb-0">
                          <div class="table-responsive">
                            <table class="table dashboard-table mb-0" id="usersList">
                              <tr>
                                <th rowspan="4">CRM</th>
                                <td class="dashboard-text">Connects</td>
                                <td colspan="2">N/A</td>
                              </tr>
                              <tr class="record">
                                <td class="dashboard-text">Data</td>
                                <td colspan="2"><?=$count?></td>
                              </tr>
                              <tr class="record">
                                <td rowspan="2" class="dashboard-text">campaigns</td>
                                <td>6</td>
                                <td>N/A</td>
                              </tr>
                              <tr>
                                <td>N/A</td>
                                <td>N/A</td>
                              </tr>
                              <tr>
                                <th rowspan="3">DATA SERVICES</th>
                                <td class="dashboard-text">white listed</td>
                                <td colspan="2">N/A</td>
                              </tr>
                              <tr class="record">
                                <td class="dashboard-text">Birthday added</td>
                                <td colspan="2"><?=$countBirth?></td>
                              </tr>
                              <tr class="record">
                                <td class="dashboard-text">Annieversaries added</td>
                                <td colspan="2"><?=$countAnniversary?></td>
                              </tr>
                              <tr>
                                <th rowspan="3">CUSTOMER SERVICES</th>
                                <td class="dashboard-text">Field Visits</td>
                                <td colspan="2">N/A</td>
                              </tr>
                              <tr class="record">
                                <td class="dashboard-text">Phone calls </td>
                                <td colspan="2">N/A</td>
                              </tr>
                              <tr class="record">
                                <td class="dashboard-text">Requests Closed</td>
                                <td colspan="2">N/A</td>
                              </tr>
                            </table>
                          </div>
                        </div>
                      </section>
                    </div>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane pb-0" id="calender">
                  <div class="row">
                    <div class="col-md-12">
                      <section class="time-simple">
                        <div class="tile-body">
                        </div>
                      </section>
                    </div>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane pb-0" id="registrations">
                  <div class="row">
                    <div class="col-md-12">
                      <section class="time-simple">
                        <div class="tile-body">
                          <div id="totalregister" class="cleargraph">
                            <div id="total-registergraph">
                              <span id="total-registerchart186" class="fusioncharts-container" style="position: relative; text-align: left; line-height: normal; display: inline-block; zoom: 1; font-weight: normal; font-variant: normal; font-style: normal; text-decoration: none; padding: 0px; margin: 0px; border: none; direction: ltr; width: 0px; height: 400px;">
                                <svg height="400" version="1.1" width="1060" xmlns="http://www.w3.org/2000/svg" id="raphael-paper-92" style="overflow: hidden; -webkit-tap-highlight-color: rgba(0, 0, 0, 0); user-select: none; cursor: default; position: relative; background-color: rgb(255, 255, 255);">
                                  <desc>Column Chart</desc>
                                  <defs>
                                    <clipPath id="8B898E04-3396-42AD-B18D-DE252F9D6714">
                                      <rect x="34" y="15" width="1111" height="350" transform="matrix(1,0,0,1,0,0)"></rect>
                                    </clipPath>
                                  </defs>
                                  <g class="raphael-group-93-background">
                                    <rect x="0" y="0" width="1160" height="400" stroke="none" fill-opacity="0.5" fill="#ffffff" rx="0" ry="0" style="stroke: none; fill-opacity: 0.5; fill: rgb(255, 255, 255);"></rect>
                                    <rect x="0" y="0" width="1160" height="400" stroke="#767575" stroke-opacity="0.5" stroke-width="0" fill="none" rx="0" ry="0" style="stroke: rgb(118, 117, 117); stroke-opacity: 0.5; fill: none;"></rect>
                                  </g>
                                  <g class="raphael-group-100-canvas">
                                    <rect x="34" y="15" width="1111" height="350" rx="0" ry="0" stroke-width="0" stroke="#545454" stroke-opacity="1" stroke-linejoin="miter" fill="none" style="stroke: rgb(84, 84, 84); stroke-opacity: 1; stroke-linejoin: miter; fill: none;"></rect>
                                    <rect x="34" y="15" width="1111" height="350" rx="0" ry="0" stroke-width="0" stroke="none" fill-opacity="1" fill="#ffffff" style="stroke: none; fill-opacity: 1; fill: rgb(255, 255, 255);"></rect>
                                  </g>
                                  <g class="raphael-group-103-axisbottom">
                                    <g class="raphael-group-106-x-axis-bands"></g>
                                    <g class="raphael-group-112-y-axis-bands">
                                      <rect x="34" y="301.3636363636364" width="1111" height="31.818181818181813" fill-opacity="0" fill="#eeeeee" stroke-width="0" rx="0" ry="0" stroke="#000000" style="fill-opacity: 0; fill: rgb(238, 238, 238); stroke: rgb(0, 0, 0);"></rect>
                                      <rect x="34" y="237.72727272727275" width="1111" height="31.818181818181813" fill-opacity="0" fill="#eeeeee" stroke-width="0" rx="0" ry="0" stroke="#000000" style="fill-opacity: 0; fill: rgb(238, 238, 238); stroke: rgb(0, 0, 0);"></rect>
                                      <rect x="34" y="174.0909090909091" width="1111" height="31.818181818181813" fill-opacity="0" fill="#eeeeee" stroke-width="0" rx="0" ry="0" stroke="#000000" style="fill-opacity: 0; fill: rgb(238, 238, 238); stroke: rgb(0, 0, 0);"></rect>
                                      <rect x="34" y="110.45454545454547" width="1111" height="31.818181818181813" fill-opacity="0" fill="#eeeeee" stroke-width="0" rx="0" ry="0" stroke="#000000" style="fill-opacity: 0; fill: rgb(238, 238, 238); stroke: rgb(0, 0, 0);"></rect>
                                      <rect x="34" y="46.81818181818181" width="1111" height="31.818181818181813" fill-opacity="0" fill="#eeeeee" stroke-width="0" rx="0" ry="0" stroke="#000000" style="fill-opacity: 0; fill: rgb(238, 238, 238); stroke: rgb(0, 0, 0);"></rect>
                                    </g>
                                    <g class="raphael-group-118-y-axis-bands"></g>
                                    <g class="raphael-group-108-x-axis-lines"></g>
                                    <g class="raphael-group-114-y-axis-lines">
                                      <path d="M34,333.5L1145,333.5" stroke="#ececec" stroke-opacity="0.4" stroke-width="1" stroke-dasharray="4,0" fill="none" shape-rendering="crispEdges" style="stroke: rgb(236, 236, 236); stroke-opacity: 0.4; fill: none; shape-rendering: crispedges;"></path>
                                      <path d="M34,301.5L1145,301.5" stroke="#ececec" stroke-opacity="0.4" stroke-width="1" stroke-dasharray="4,0" fill="none" shape-rendering="crispEdges" style="stroke: rgb(236, 236, 236); stroke-opacity: 0.4; fill: none; shape-rendering: crispedges;"></path>
                                      <path d="M34,270.5L1145,270.5" stroke="#ececec" stroke-opacity="0.4" stroke-width="1" stroke-dasharray="4,0" fill="none" shape-rendering="crispEdges" style="stroke: rgb(236, 236, 236); stroke-opacity: 0.4; fill: none; shape-rendering: crispedges;"></path>
                                      <path d="M34,238.5L1145,238.5" stroke="#ececec" stroke-opacity="0.4" stroke-width="1" stroke-dasharray="4,0" fill="none" shape-rendering="crispEdges" style="stroke: rgb(236, 236, 236); stroke-opacity: 0.4; fill: none; shape-rendering: crispedges;"></path>
                                      <path d="M34,206.5L1145,206.5" stroke="#ececec" stroke-opacity="0.4" stroke-width="1" stroke-dasharray="4,0" fill="none" shape-rendering="crispEdges" style="stroke: rgb(236, 236, 236); stroke-opacity: 0.4; fill: none; shape-rendering: crispedges;"></path>
                                      <path d="M34,174.5L1145,174.5" stroke="#ececec" stroke-opacity="0.4" stroke-width="1" stroke-dasharray="4,0" fill="none" shape-rendering="crispEdges" style="stroke: rgb(236, 236, 236); stroke-opacity: 0.4; fill: none; shape-rendering: crispedges;"></path>
                                      <path d="M34,142.5L1145,142.5" stroke="#ececec" stroke-opacity="0.4" stroke-width="1" stroke-dasharray="4,0" fill="none" shape-rendering="crispEdges" style="stroke: rgb(236, 236, 236); stroke-opacity: 0.4; fill: none; shape-rendering: crispedges;"></path>
                                      <path d="M34,110.5L1145,110.5" stroke="#ececec" stroke-opacity="0.4" stroke-width="1" stroke-dasharray="4,0" fill="none" shape-rendering="crispEdges" style="stroke: rgb(236, 236, 236); stroke-opacity: 0.4; fill: none; shape-rendering: crispedges;"></path>
                                      <path d="M34,79.5L1145,79.5" stroke="#ececec" stroke-opacity="0.4" stroke-width="1" stroke-dasharray="4,0" fill="none" shape-rendering="crispEdges" style="stroke: rgb(236, 236, 236); stroke-opacity: 0.4; fill: none; shape-rendering: crispedges;"></path>
                                      <path d="M34,47.5L1145,47.5" stroke="#ececec" stroke-opacity="0.4" stroke-width="1" stroke-dasharray="4,0" fill="none" shape-rendering="crispEdges" style="stroke: rgb(236, 236, 236); stroke-opacity: 0.4; fill: none; shape-rendering: crispedges;"></path>
                                      <path d="M34,15.5L1145,15.5" stroke="#ececec" stroke-opacity="0.4" stroke-width="1" stroke-dasharray="4,0" fill="none" shape-rendering="crispEdges" style="stroke: rgb(236, 236, 236); stroke-opacity: 0.4; fill: none; shape-rendering: crispedges;"></path>
                                    </g>
                                    <g class="raphael-group-120-y-axis-lines"></g>
                                    <g class="fusioncharts-xaxis-0-gridlabels" style="">
                                      <text class="fusioncharts-label" fill-opacity="1" fill="#555555" x="219.16666666666666" y="386" text-anchor="middle" transform="matrix(1,0,0,1,0,0)" stroke="none" style="fill-opacity: 1; fill: rgb(85, 85, 85); text-anchor: middle; stroke: none; font-family: Roboto, sans-serif; font-size: 13px; font-weight: bold; font-style: normal;" font-family="Roboto,sans-serif" font-size="13px" font-weight="bold" font-style="normal">
                                        <tspan dy="-3.3046875" x="219.16666666666666">Week 1</tspan>
                                      </text>
                                      <text class="fusioncharts-label" fill-opacity="1" fill="#555555" x="589.5" y="386" text-anchor="middle" transform="matrix(1,0,0,1,0,0)" stroke="none" style="fill-opacity: 1; fill: rgb(85, 85, 85); text-anchor: middle; stroke: none; font-family: Roboto, sans-serif; font-size: 13px; font-weight: bold; font-style: normal;" font-family="Roboto,sans-serif" font-size="13px" font-weight="bold" font-style="normal">
                                        <tspan dy="-3.3046875" x="589.5">Week 2</tspan>
                                      </text>
                                      <text class="fusioncharts-label" fill-opacity="1" fill="#555555" x="959.8333333333333" y="386" text-anchor="middle" transform="matrix(1,0,0,1,0,0)" stroke="none" style="fill-opacity: 1; fill: rgb(85, 85, 85); text-anchor: middle; stroke: none; font-family: Roboto, sans-serif; font-size: 13px; font-weight: bold; font-style: normal;" font-family="Roboto,sans-serif" font-size="13px" font-weight="bold" font-style="normal">
                                        <tspan dy="-3.3046875" x="959.8333333333333">Week 3</tspan>
                                      </text>
                                    </g>
                                    <g class="fusioncharts-yaxis-0-gridlabels" style="">
                                      <text class="fusioncharts-label" fill="#555555" x="27" y="365" text-anchor="end" transform="matrix(1,0,0,1,0,0)" stroke="none" style="fill: rgb(85, 85, 85); text-anchor: end; stroke: none; font-family: Roboto, sans-serif; font-size: 10px;" font-family="Roboto,sans-serif" font-size="10px" font-weight="undefined" font-style="undefined">
                                        <tspan dy="3.5" x="27">0</tspan>
                                      </text>
                                      <text class="fusioncharts-label" fill="#555555" x="27" y="333.1818181818182" text-anchor="end" transform="matrix(1,0,0,1,0,0)" stroke="none" style="fill: rgb(85, 85, 85); text-anchor: end; stroke: none; font-family: Roboto, sans-serif; font-size: 10px;" font-family="Roboto,sans-serif" font-size="10px" font-weight="undefined" font-style="undefined">
                                        <tspan dy="3.502130681818187" x="27">6</tspan>
                                      </text>
                                      <text class="fusioncharts-label" fill="#555555" x="27" y="301.3636363636364" text-anchor="end" transform="matrix(1,0,0,1,0,0)" stroke="none" style="fill: rgb(85, 85, 85); text-anchor: end; stroke: none; font-family: Roboto, sans-serif; font-size: 10px;" font-family="Roboto,sans-serif" font-size="10px" font-weight="undefined" font-style="undefined">
                                        <tspan dy="3.496448863636374" x="27">12</tspan>
                                      </text>
                                      <text class="fusioncharts-label" fill="#555555" x="27" y="269.54545454545456" text-anchor="end" transform="matrix(1,0,0,1,0,0)" stroke="none" style="fill: rgb(85, 85, 85); text-anchor: end; stroke: none; font-family: Roboto, sans-serif; font-size: 10px;" font-family="Roboto,sans-serif" font-size="10px" font-weight="undefined" font-style="undefined">
                                        <tspan dy="3.506392045454561" x="27">18</tspan>
                                      </text>
                                      <text class="fusioncharts-label" fill="#555555" x="27" y="237.72727272727275" text-anchor="end" transform="matrix(1,0,0,1,0,0)" stroke="none" style="fill: rgb(85, 85, 85); text-anchor: end; stroke: none; font-family: Roboto, sans-serif; font-size: 10px;" font-family="Roboto,sans-serif" font-size="10px" font-weight="undefined" font-style="undefined">
                                        <tspan dy="3.500710227272748" x="27">24</tspan>
                                      </text>
                                      <text class="fusioncharts-label" fill="#555555" x="27" y="205.9090909090909" text-anchor="end" transform="matrix(1,0,0,1,0,0)" stroke="none" style="fill: rgb(85, 85, 85); text-anchor: end; stroke: none; font-family: Roboto, sans-serif; font-size: 10px;" font-family="Roboto,sans-serif" font-size="10px" font-weight="undefined" font-style="undefined">
                                        <tspan dy="3.4950284090909065" x="27">30</tspan>
                                      </text>
                                      <text class="fusioncharts-label" fill="#555555" x="27" y="174.0909090909091" text-anchor="end" transform="matrix(1,0,0,1,0,0)" stroke="none" style="fill: rgb(85, 85, 85); text-anchor: end; stroke: none; font-family: Roboto, sans-serif; font-size: 10px;" font-family="Roboto,sans-serif" font-size="10px" font-weight="undefined" font-style="undefined">
                                        <tspan dy="3.5049715909090935" x="27">36</tspan>
                                      </text>
                                      <text class="fusioncharts-label" fill="#555555" x="27" y="142.27272727272728" text-anchor="end" transform="matrix(1,0,0,1,0,0)" stroke="none" style="fill: rgb(85, 85, 85); text-anchor: end; stroke: none; font-family: Roboto, sans-serif; font-size: 10px;" font-family="Roboto,sans-serif" font-size="10px" font-weight="undefined" font-style="undefined">
                                        <tspan dy="3.4992897727272805" x="27">42</tspan>
                                      </text>
                                      <text class="fusioncharts-label" fill="#555555" x="27" y="110.45454545454547" text-anchor="end" transform="matrix(1,0,0,1,0,0)" stroke="none" style="fill: rgb(85, 85, 85); text-anchor: end; stroke: none; font-family: Roboto, sans-serif; font-size: 10px;" font-family="Roboto,sans-serif" font-size="10px" font-weight="undefined" font-style="undefined">
                                        <tspan dy="3.4936079545454675" x="27">48</tspan>
                                      </text>
                                      <text class="fusioncharts-label" fill="#555555" x="27" y="78.63636363636363" text-anchor="end" transform="matrix(1,0,0,1,0,0)" stroke="none" style="fill: rgb(85, 85, 85); text-anchor: end; stroke: none; font-family: Roboto, sans-serif; font-size: 10px;" font-family="Roboto,sans-serif" font-size="10px" font-weight="undefined" font-style="undefined">
                                        <tspan dy="3.503551136363626" x="27">54</tspan>
                                      </text>
                                      <text class="fusioncharts-label" fill="#555555" x="27" y="46.81818181818181" text-anchor="end" transform="matrix(1,0,0,1,0,0)" stroke="none" style="fill: rgb(85, 85, 85); text-anchor: end; stroke: none; font-family: Roboto, sans-serif; font-size: 10px;" font-family="Roboto,sans-serif" font-size="10px" font-weight="undefined" font-style="undefined">
                                        <tspan dy="3.497869318181813" x="27">60</tspan>
                                      </text>
                                      <text class="fusioncharts-label" fill="#555555" x="27" y="15" text-anchor="end" transform="matrix(1,0,0,1,0,0)" stroke="none" style="fill: rgb(85, 85, 85); text-anchor: end; stroke: none; font-family: Roboto, sans-serif; font-size: 10px;" font-family="Roboto,sans-serif" font-size="10px" font-weight="undefined" font-style="undefined">
                                        <tspan dy="3.5" x="27">66</tspan>
                                      </text>
                                    </g>
                                    <g class="fusioncharts-yaxis-1-gridlabels" style=""></g>
                                    <g class="raphael-group-123-axis-name"></g>
                                    <g class="raphael-group-152-axis-lines">
                                      <path d="M33.5,365L33.5,15" stroke="#ececec" stroke-opacity="1" stroke-width="1" fill="none" style="stroke: rgb(236, 236, 236); stroke-opacity: 1; fill: none;"></path>
                                    </g>
                                    <g class="raphael-group-157-axis-lines">
                                      <path d="M33,365.5L1145,365.5" stroke="#ececec" stroke-opacity="1" stroke-width="1" fill="none" style="stroke: rgb(236, 236, 236); stroke-opacity: 1; fill: none;"></path>
                                    </g>
                                  </g>
                                  <g class="raphael-group-94-dataset">
                                    <g class="raphael-group-159-columns" clip-path="url('#8B898E04-3396-42AD-B18D-DE252F9D6714')" style="">
                                      <rect x="194.5" y="73.5" width="50" height="292" rx="0" ry="0" fill-opacity="1" fill="#40c1c6" stroke="#333333" stroke-opacity="1" stroke-width="1" stroke-dasharray="0" stroke-linejoin="miter" style="fill-opacity: 1; fill: rgb(64, 193, 198); stroke: rgb(51, 51, 51); stroke-opacity: 1; stroke-linejoin: miter;"></rect>
                                      <rect x="564.5" y="105.5" width="50" height="260" rx="0" ry="0" fill-opacity="1" fill="#40c1c6" stroke="#333333" stroke-opacity="1" stroke-width="1" stroke-dasharray="0" stroke-linejoin="miter" style="fill-opacity: 1; fill: rgb(64, 193, 198); stroke: rgb(51, 51, 51); stroke-opacity: 1; stroke-linejoin: miter;"></rect>
                                      <rect x="934.5" y="322.5" width="50" height="43" rx="0" ry="0" fill-opacity="1" fill="#40c1c6" stroke="#333333" stroke-opacity="1" stroke-width="1" stroke-dasharray="0" stroke-linejoin="miter" style="fill-opacity: 1; fill: rgb(64, 193, 198); stroke: rgb(51, 51, 51); stroke-opacity: 1; stroke-linejoin: miter;"></rect>
                                    </g>
                                  </g>
                                  <g class="raphael-group-104-axistop">
                                    <g class="raphael-group-105-x-axis-bands"></g>
                                    <g class="raphael-group-111-y-axis-bands"></g>
                                    <g class="raphael-group-117-y-axis-bands"></g>
                                    <g class="raphael-group-107-x-axis-lines"></g>
                                    <g class="raphael-group-113-y-axis-lines"></g>
                                    <g class="raphael-group-119-y-axis-lines"></g>
                                    <g class="fusioncharts-xaxis-0-gridlabels" style=""></g>
                                    <g class="fusioncharts-yaxis-0-gridlabels" style=""></g>
                                    <g class="fusioncharts-yaxis-1-gridlabels" style=""></g>
                                  </g>
                                  <g class="fusioncharts-datalabels" transform="matrix(1,0,0,1,0,0)" style="">
                                    <text class="fusioncharts-label" x="219.5" y="60" fill-opacity="1" fill="#000000" font-size="13px" stroke="none" text-anchor="middle" style="fill-opacity: 1; fill: rgb(0, 0, 0); font-size: 13px; stroke: none; text-anchor: middle;">
                                      <tspan dy="4.5" x="219.5">55</tspan>
                                    </text>
                                    <text class="fusioncharts-label" x="589.5" y="92" fill-opacity="1" fill="#000000" font-size="13px" stroke="none" text-anchor="middle" style="fill-opacity: 1; fill: rgb(0, 0, 0); font-size: 13px; stroke: none; text-anchor: middle;">
                                      <tspan dy="4.5" x="589.5">49</tspan>
                                    </text>
                                    <text class="fusioncharts-label" x="959.5" y="309" fill-opacity="1" fill="#000000" font-size="13px" stroke="none" text-anchor="middle" style="fill-opacity: 1; fill: rgb(0, 0, 0); font-size: 13px; stroke: none; text-anchor: middle;">
                                      <tspan dy="4.5" x="959.5">8</tspan>
                                    </text>
                                  </g>
                                  <g class="raphael-group-95-hot">
                                    <rect x="194.5" y="73.5" width="50" height="292" rx="0" ry="0" stroke="#c0c0c0" stroke-opacity="0.000001" stroke-width="1" fill-opacity="0.000001" fill="#c0c0c0" style="stroke: rgb(192, 192, 192); stroke-opacity: 1e-06; fill-opacity: 1e-06; fill: rgb(192, 192, 192);"></rect>
                                    <rect x="564.5" y="105.5" width="50" height="260" rx="0" ry="0" stroke="#c0c0c0" stroke-opacity="0.000001" stroke-width="1" fill-opacity="0.000001" fill="#c0c0c0" style="stroke: rgb(192, 192, 192); stroke-opacity: 1e-06; fill-opacity: 1e-06; fill: rgb(192, 192, 192);"></rect>
                                    <rect x="934.5" y="322.5" width="50" height="43" rx="0" ry="0" stroke="#c0c0c0" stroke-opacity="0.000001" stroke-width="1" fill-opacity="0.000001" fill="#c0c0c0" style="stroke: rgb(192, 192, 192); stroke-opacity: 1e-06; fill-opacity: 1e-06; fill: rgb(192, 192, 192);"></rect>
                                  </g>
                                  <g class="raphael-group-98-buttons"></g>
                                  <text x="6" y="396" stroke="none" fill="#000000" text-anchor="start" style="stroke: none; fill: rgb(0, 0, 0); text-anchor: start; fill-opacity: 0.5; font-size: 9px; font-family: Roboto, sans-serif; cursor: pointer;" fill-opacity="0.5" font-size="9px" font-family="Roboto,sans-serif">
                                    <tspan dy="-2.3984375" x="6" xml:space="preserve"> </tspan>
                                  </text>
                                </svg>
                              </span>
                            </div>
                          </div>
                        </div>
                      </section>
                    </div>
                  </div>
                </div>
                <div role="tabpanel" class="tab-pane" id="chart">
                  <div class="row">
                    <div class="col-md-12">
                      <section class="time-simple">
                        <div class="tile-body">
                        </div>
                      </section>
                    </div>
                  </div>
                </div>
              </div>
              <div role="tabpanel" class="tab-pane" id="source">
                <div class="row">
                  <div class="col-md-12">
                    <section class="time-simple">
                      <div class="tile-body">
                      </div>
                    </section>
                  </div>
                </div>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
  </section>
  </div>
  </div>
  </div>
</section>
<!-- close -->
<?php $this->load->view('footer.php'); ?>
<script>
  $(function() {
    $('.tab-wrapper .tabs a').click(function() {
      //$(".tile-body").css('display','none');
      $(this).parent().siblings().removeClass('active');
      $(this).parent().addClass('active');
      var currPanel = $(this).data('target');
      $('.tab-panel').removeClass('active');
      $("#"+currPanel).addClass('active');
    });
  })
</script>