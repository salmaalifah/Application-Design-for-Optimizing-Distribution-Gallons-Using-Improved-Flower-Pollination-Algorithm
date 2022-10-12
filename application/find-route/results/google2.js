function initMap() {
  const directionsService = new google.maps.DirectionsService();
  const directionsRenderer = new google.maps.DirectionsRenderer();
  const map = new google.maps.Map(document.getElementById("map"), {
    zoom: 7,
    center: { lat: -7.3601311, lng: 112.7788957 },
  });

  directionsRenderer.setMap(map);
    calculateAndDisplayRoute(directionsService, directionsRenderer);
}

function calculateAndDisplayRoute(directionsService, directionsRenderer) {
  const waypts = [];
  const checkboxArray = document.getElementsByClassName("waypoints");

  for (var i = 0; i < checkboxArray.length; i++) {
      var address = checkboxArray[i].value;
      if (address !== '') {
        waypts.push({
          location: address,
          stopover: true
        });
      }
    }

  directionsService
    .route({
      origin: document.getElementById("start").value,
      destination: document.getElementById("end").value,
      waypoints: waypts,
      optimizeWaypoints: false,
      travelMode: google.maps.TravelMode.DRIVING,
    })
    .then((response) => {
      directionsRenderer.setDirections(response);

      const route = response.routes[0];
      const summaryPanel = document.getElementById("directions-panel");

      summaryPanel.innerHTML = "";

      // For each route, display summary information.
      for (let i = 0; i < route.legs.length; i++) {
        const routeSegment = i + 1;

        summaryPanel.innerHTML +=
          "<b>Route Segment: " + routeSegment + "</b><br>";
        summaryPanel.innerHTML += route.legs[i].start_address + "<br/>ke<br/>";
        summaryPanel.innerHTML += route.legs[i].end_address + "<br><br/>";
        summaryPanel.innerHTML += route.legs[i].distance.text + "<br><br>";
      }
    })
    .catch((e) => window.alert("Directions request failed due to " + status));
}

window.initMap = initMap;