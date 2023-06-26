jQuery(document).ready(function ($) {
  $("input[data-autocomplete]").each(function () {
    var input = $(this);
    var name = input.data("autocomplete");

    var autocomplete = new google.maps.places.Autocomplete(input[0]);

    autocomplete.setTypes(["establishment"]);

    autocomplete.addListener("place_changed", function () {
      var place = autocomplete.getPlace();

      var placeName = place.name;
      var placeLatLng = place.geometry.location;
      input.val(placeName);
    });
    // input.val(name);
  });
});
