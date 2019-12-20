<div style="padding-bottom: 20px;">
    <div style="padding-bottom: 30px;">
        <div class="col-lg-1">
            {!! Form::open(array('url' => route('location'), 'method' => 'GET', 'id' => 'location')) !!}
            {!! Form::select('location', ['ketintang'=>'Ketintang', 'lidah'=>'Lidah Wetan'], Session::get('ss_location'), ['onChange'=>'this.form.submit();', 'class'=>'form-control', 'style'=>'width: 100px;', 'placeholder'=>'- Pilih -']) !!}
            <button type="submit" style="display: none;">simpan</button>
            {!! Form::close() !!}
        </div>
    
        <div class="col-lg-1">
            {!! Form::open(array('url' => route('showmarker'), 'method' => 'GET', 'id' => 'showmarker')) !!}
            {!! Form::select('marker', [true=>'Show Marker', false=>'Hide Marker'], Session::get('ss_showmarker'), ['onChange'=>'this.form.submit();', 'class'=>'form-control', 'style'=>'width: 100px;', 'placeholder'=>'- Pilih -']) !!}
            <button type="submit" style="display: none;">simpan</button>
            {!! Form::close() !!}
        </div>
    
        <div class="col-lg-1">
            {!! Form::open(array('url' => route('showlayer'), 'method' => 'GET', 'id' => 'showlayer')) !!}
            {!! Form::select('layer', [true=>'Show Layer', false=>'Hide Layer'], Session::get('ss_showlayer'), ['onChange'=>'this.form.submit();', 'class'=>'form-control', 'style'=>'width: 100px;', 'placeholder'=>'- Pilih -']) !!}
            <button type="submit" style="display: none;">simpan</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>

{!! Mapper::render() !!}

<div id="legend" style="background-color: white; padding:10px;"><h6 class="font-weight-bold">Legend</h6></div>

@section('script')
@if (Session::get('ss_showlayer') == true)
    @if (Session::get('ss_location') == 'lidah')
        <script src="{{asset('maplidah.geojson')}}" type="text/javascript"></script>
    @endif
    @if (Session::get('ss_location') == 'ketintang')
        <script src="{{asset('mapketintang.geojson')}}" type="text/javascript"></script>
    @endif
@endif
<script>
    function newPopup(url) {
        popupWindow = window.open(
            url,'popUpWindow','height=300,width=800,left=10,top=10,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
    }

    $(document).ready(function() {
        function initMap() {
            var building = {!! json_encode($ap->toArray(), JSON_HEX_TAG) !!};
            var geo = maps[0].map.data;
            geo.addGeoJson(area);
            geo.setStyle(function(feature) {
                var gedung = feature.getProperty('name');
                var color = "grey";
                building.forEach(function(element) {
                    if (element.r_ap_count >= 10) {
                        if (gedung == element.name) {
                            color = "#d95f0e";
                        }
                    }
                    if (element.r_ap_count >= 4 && element.r_ap_count < 10) {
                        if (gedung == element.name) {
                            color = "#fec44f";
                        }
                    }
                    if (element.r_ap_count >= 1 && element.r_ap_count < 4) {
                        if (gedung == element.name) {
                            color = "#fff7bc";
                        }
                    }
                });

                return {
                    fillColor: color,
                    fillOpacity: 1,
                    strokeWeight: 1
                }
            });
            

            // InfoWindow
            var infowindow = new google.maps.InfoWindow();
            geo.addListener('click', function(data_mouseEvent) {
                var feature = data_mouseEvent.feature;
                feature.toGeoJson(function(geojson){
                    var name = geojson.properties.name;
                    building.forEach(element => {
                        if (name == element.name) {
                            var ap = element.count;
                            var url = window.location.origin + '/building/' + element.name;
                            var myHTMLss = '<div>'+ name + '</div>' +
                            '<div style="padding-bottom: 10px;">Count Access Point: '+ element.r_ap_count + '</div>' +
                            '<div style="text-align: center;"><a href="JavaScript:newPopup(\'' + url + '\');" class="btn btn-xs btn-primary">Lihat Detail</a></div>';
                            infowindow.setContent(myHTMLss);
                            infowindow.setPosition(data_mouseEvent.latLng);
                            infowindow.open(maps[0].map);
                        }
                    });
                });
            });

            // Legend
            var legend = document.getElementById('legend');
            var div4 = document.createElement('div');
            div4.innerHTML = '<i class="fa fa-2x fa-circle" style="color:#808080;"></i> ' + 'Access Point = 0';
            var div = document.createElement('div');
            div.innerHTML = '<i class="fa fa-2x fa-circle" style="color:#fff7bc;"></i> ' + 'Access Point > 3';
            var div2 = document.createElement('div');
            div2.innerHTML = '<i class="fa fa-2x fa-circle" style="color:#fec44f;"></i> ' + 'Access Point > 4';
            var div3 = document.createElement('div');
            div3.innerHTML = '<i class="fa fa-2x fa-circle" style="color:#d95f0e;"></i> ' + 'Access Point > 10';
            legend.appendChild(div4);
            legend.appendChild(div);
            legend.appendChild(div2);
            legend.appendChild(div3);
            maps[0].map.controls[google.maps.ControlPosition.LEFT_BOTTOM].push(legend);
        }
        google.maps.event.addDomListener(window, 'load', initMap);
    });
</script>
@endsection