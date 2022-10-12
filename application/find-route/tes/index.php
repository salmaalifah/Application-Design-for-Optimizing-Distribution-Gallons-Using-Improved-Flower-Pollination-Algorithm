<!DOCTYPE html>
<html>
  <head>
    <title>Waypoints in Directions</title>
    <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script type="module" src="google2.js"></script>
    <style>
        /* Optional: Makes the sample page fill the window. */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#container {
  height: 100%;
  display: flex;
}

#sidebar {
  flex-basis: 15rem;
  flex-grow: 1;
  padding: 1rem;
  max-width: 30rem;
  height: 100%;
  box-sizing: border-box;
  overflow: auto;
}

#map {
  flex-basis: 0;
  flex-grow: 4;
  height: 100%;
}

#directions-panel {
  margin-top: 10px;
}
    </style>
  </head>
  <body>
    <div id="container">
      <div id="map"></div>
      <div id="sidebar">
        <div>
          <b>Start:</b>
          <select id="start" >
            <option value="0.881867,104.451129">0.881867,104.451129</option>
          </select>
          <br />
          <b>Waypoints:</b> <br />
          <select class="waypoints">
            <option value="0.900638,104.458902">Opsi 1</option>
            <option value="0.908686,104.456697">Opsi 2</option>
          </select>
          <select class="waypoints">
            <option value="0.900638,104.458902">Opsi 1</option>
            <option value="0.908686,104.456697">Opsi 2</option>
          </select>
          <br />
          <b>End:</b>
          <select id="end">
            <option value="0.881867,104.451120">0.881867,104.451120</option>
          </select>
          <br />
          <input type="submit" id="submit" />
        </div>
        <div id="directions-panel"></div>
      </div>
    </div>

    <!-- 
     The `defer` attribute causes the callback to execute after the full HTML
     document has been parsed. For non-blocking uses, avoiding race conditions,
     and consistent behavior across browsers, consider loading using Promises
     with https://www.npmjs.com/package/@googlemaps/js-api-loader.
    -->
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA1Z4tGtjX1AZd2dULNW-R1U4vAY_T3CRQ&callback=initMap&v=weekly"
      defer
    ></script>
  </body>
</html>