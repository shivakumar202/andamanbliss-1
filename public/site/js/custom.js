// menu toggle icon cross icon function
document
  .getElementById("navbarTogglerButton")
  .addEventListener("click", function () {
    var icon = this.querySelector(".navbar-toggler-icon");
    icon.classList.toggle("cross");
  });
// menu toggle icon cross icon function end
$(document).ready(function () {
  //Enable Tooltips
  var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-toggle="tooltip"]')
  );
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  //Advance Tabs
  $(".next").click(function () {
    const nextTabLinkEl = $(".nav-tabs .active")
      .closest("li")
      .next("li")
      .find("a")[0];
    const nextTab = new bootstrap.Tab(nextTabLinkEl);
    nextTab.show();
  });

  $(".previous").click(function () {
    const prevTabLinkEl = $(".nav-tabs .active")
      .closest("li")
      .prev("li")
      .find("a")[0];
    const prevTab = new bootstrap.Tab(prevTabLinkEl);
    prevTab.show();
  });
});

// model input count
function incrementValue(e) {
  e.preventDefault();
  var fieldName = $(e.target).data("field");
  var parent = $(e.target).closest("div");
  var currentVal = parseInt(
    parent.find("input[name=" + fieldName + "]").val(),
    10
  );

  if (!isNaN(currentVal)) {
    parent.find("input[name=" + fieldName + "]").val(currentVal + 1);
  } else {
    parent.find("input[name=" + fieldName + "]").val(1);
  }
}

function decrementValue(e) {
  e.preventDefault();
  var fieldName = $(e.target).data("field");
  var parent = $(e.target).closest("div");
  var currentVal = parseInt(
    parent.find("input[name=" + fieldName + "]").val(),
    10
  );

  if (!isNaN(currentVal) && currentVal > 1) {
    parent.find("input[name=" + fieldName + "]").val(currentVal - 1);
  } else {
    parent.find("input[name=" + fieldName + "]").val(1);
  }
}

$(".input-group").on("click", ".button-plus", function (e) {
  incrementValue(e);
});

$(".input-group").on("click", ".button-minus", function (e) {
  decrementValue(e);
});

// // bike selection funtion
// $(document).ready(function () {
//   // Function to check if at least one bike is selected
//   function isAtLeastOneBikeSelected() {
//     return $("input[name='bike[]']:checked").length > 0;
//   }

//   // Hide the "Check Availability" button initially
//   $("#checkAvailabilityBtn").hide();

//   // Click event handler for the bike checkboxes
//   $("input[name='bike[]']").on("change", function () {
//     // Check if at least one bike is selected
//     if (isAtLeastOneBikeSelected()) {
//       // If bikes are selected, show the "Check Availability" button
//       $("#checkAvailabilityBtn").show();
//     } else {
//       // If no bikes are selected, hide the "Check Availability" button
//       $("#checkAvailabilityBtn").hide();
//     }
//   });
// });

/* this function for price slider in custom booking page*/
const rangeInput = document.querySelectorAll(".range-input input"),
  priceInput = document.querySelectorAll(".price-input input"),
  range = document.querySelector(".priceSlider .progress");
let priceGap = 1000;

priceInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minPrice = parseInt(priceInput[0].value),
      maxPrice = parseInt(priceInput[1].value);

    if (maxPrice - minPrice >= priceGap && maxPrice <= rangeInput[1].max) {
      if (e.target.className === "input-min") {
        rangeInput[0].value = minPrice;
        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
      } else {
        rangeInput[1].value = maxPrice;
        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
      }
    }
  });
});

rangeInput.forEach((input) => {
  input.addEventListener("input", (e) => {
    let minVal = parseInt(rangeInput[0].value),
      maxVal = parseInt(rangeInput[1].value);

    if (maxVal - minVal < priceGap) {
      if (e.target.className === "range-min") {
        rangeInput[0].value = maxVal - priceGap;
      } else {
        rangeInput[1].value = minVal + priceGap;
      }
    } else {
      priceInput[0].value = minVal;
      priceInput[1].value = maxVal;
      range.style.left = (minVal / rangeInput[0].max) * 100 + "%";
      range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + "%";
    }
  });
});

let items = document.querySelectorAll(".carousel .carousel-item");
items.forEach((el) => {
  const minPerSlide = 4;
  let next = el.nextElementSibling;
  for (var i = 1; i < minPerSlide; i++) {
    if (!next) {
      // wrap carousel by using first child
      next = items[0];
    }
    let cloneChild = next.cloneNode(true);
    el.appendChild(cloneChild.children[0]);
    next = next.nextElementSibling;
  }
});

$(document).ready(function () {
  // Navbar toggle
  $("#navbarTogglerButton").click(function () {
    $("#navbarNav").slideToggle();
  });

  // Function for hotel category select option custom booking page
  $(".radio-wrapper").on("click", function () {
    // Hide all radio icons
    $(".radio-icon2 i").hide();

    // Show the radio icon inside the clicked radio-wrapper custom booking page
    $(this).find(".radio-icon2 i").show();
  });

  // Function for flight select option in custom booking page
  $(".radio-wrapper-flight").on("click", function () {
    // Hide all radio icons
    $(".radio-icon3 i").hide();

    // Show the radio icon inside the clicked radio-wrapper custom booking page
    $(this).find(".radio-icon3 i").show();
  });

  // Function for duration of tour box selecting custom booking page
  $(".formCheck").click(function () {
    // Hide all radio-icons
    $(".radio-icon").hide();

    // Show the radio-icon within the clicked formCheck
    $(this).find(".radio-icon").show();
  });
});

$(document).ready(function () {
  $(".more-menu-lst").click(function () {
    $(this).next(".submenu").toggle();
  });
});

$(document).ready(function () {
  function isMobile() {
    return window.innerWidth <= 768;
  }

  $(".nav-link").on("click", function (e) {
    if (isMobile()) {
      e.preventDefault();
      $(this).next(".mega-menu").toggle();
    }
  });

  $(window).on("resize", function () {
    if (!isMobile()) {
      $(".mega-menu").removeAttr("style");
    }
  });
});

// $(document).ready(function () {
//   // popular beach carousel
//   $(".beach-carousel").slick({
//     slidesToShow: 3,
//     slidesToScroll: 1,
//     arrows: false,
//     dots: true,
//     speed: 300,
//     infinite: true,
//     autoplaySpeed: 2000,
//     autoplay: true,
//     responsive: [
//       {
//         breakpoint: 991,
//         settings: {
//           slidesToShow: 3,
//         },
//       },
//       {
//         breakpoint: 767,
//         settings: {
//           slidesToShow: 1,
//         },
//       },
//     ],
//   });
//   // popular beach carousel end

//   // our partner logos carousel
//   $(".customer-logos").slick({
//     slidesToShow: 6,
//     slidesToScroll: 1,
//     autoplay: true,
//     autoplaySpeed: 1500,
//     arrows: false,
//     dots: false,
//     pauseOnHover: false,
//     responsive: [
//       {
//         breakpoint: 768,
//         settings: {
//           slidesToShow: 4,
//         },
//       },
//       {
//         breakpoint: 520,
//         settings: {
//           slidesToShow: 3,
//         },
//       },
//     ],
//   });
// });

// our partner logos carousel end

// popular cruise carousel  start
// $(document).ready(function () {
//   $(".carousel-cruise").slick({
//     slidesToShow: 3,
//     slidesToScroll: 1,
//     arrows: false,
//     dots: true,
//     speed: 400,
//     infinite: true,
//     autoplaySpeed: 2500,
//     autoplay: true,
//     responsive: [
//       {
//         breakpoint: 991,
//         settings: {
//           slidesToShow: 3,
//         },
//       },
//       {
//         breakpoint: 767,
//         settings: {
//           slidesToShow: 1,
//         },
//       },
//     ],
//   });
// });

// popular cruise carousel and beach slider end

//popular treand activites slider start
var swiper = new Swiper(".swiper", {
  effect: "coverflow",
  grabCursor: true,
  centeredSlides: true,
  coverflowEffect: {
    rotate: 0,
    stretch: 0,
    depth: 100,
    modifier: 3,
    slideShadows: true,
  },
  keyboard: {
    enabled: true,
  },
  mousewheel: {
    thresholdDelta: 70,
  },
  loop: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    640: {
      slidesPerView: 2,
    },
    768: {
      slidesPerView: 1,
    },
    1024: {
      slidesPerView: 2,
    },
    1560: {
      slidesPerView: 3,
    },
  },
});
// popular treanding slider end*****

//testimonial section

// Our traveller section form start
$(document).ready(function () {
  // Select elements for adult count
  const adultMinus = $(".adult .quantity__minus");
  const adultPlus = $(".adult .quantity__plus");
  const adultInput = $(".adult .quantity__input");

  // Select elements for child count
  const childMinus = $(".child .quantity__minus");
  const childPlus = $(".child .quantity__plus");
  const childInput = $(".child .quantity__input");

  // Select elements for infant count
  const infantMinus = $(".infant .quantity__minus");
  const infantPlus = $(".infant .quantity__plus");
  const infantInput = $(".infant .quantity__input");

  // Event handlers for adult count
  adultMinus.click(function (e) {
    e.preventDefault();
    var value = adultInput.val();
    if (value > 1) {
      value--;
    }
    adultInput.val(value);
  });

  adultPlus.click(function (e) {
    e.preventDefault();
    var value = adultInput.val();
    value++;
    adultInput.val(value);
  });

  // Event handlers for child count
  childMinus.click(function (e) {
    e.preventDefault();
    var value = childInput.val();
    if (value > 0) {
      value--;
    }
    childInput.val(value);
  });

  childPlus.click(function (e) {
    e.preventDefault();
    var value = childInput.val();
    value++;
    childInput.val(value);
  });

  // Event handlers for infant count
  infantMinus.click(function (e) {
    e.preventDefault();
    var value = infantInput.val();
    if (value > 0) {
      value--;
    }
    infantInput.val(value);
  });

  infantPlus.click(function (e) {
    e.preventDefault();
    var value = infantInput.val();
    value++;
    infantInput.val(value);
  });
});
// Our traveller section form end


document.addEventListener("DOMContentLoaded", function () {
  var currentIndex = 0;
  var totalSlides = document.querySelectorAll(".main-slider img").length;
  function changeMainImage(index) {
    currentIndex = index;
    updateSlider();
  }

  function nextSlide() {
    currentIndex = (currentIndex + 1) % totalSlides;
    updateSlider();
  }

  function updateSlider() {
    var mainSlider = document.getElementById("mainSlider");
    if (mainSlider) {
      var transformValue = -currentIndex * 100 + "%";
      mainSlider.style.transform = "translateX(" + transformValue + ")";
    }
  }

  // Auto slide every 3 seconds (adjust the interval as needed)
  setInterval(nextSlide, 3000);

  // single page view slider end***
});

// hotel menu single page slider start***************************
$(document).ready(function () {
  var mainImages = $(".hotel-inner-main ul li");
  var thumbnailImages = $(".hotel-inner-thumbnail ul li");

  // Initially hide all main images except the first one
  mainImages.not(":first-child").hide();

  // Click event for thumbnail images
  thumbnailImages.on("click", function () {
    var index = $(this).index();

    // Hide all main images
    mainImages.hide();

    // Show the selected main image
    mainImages.eq(index).fadeIn(200);

    // Add/remove active class for styling (optional)
    thumbnailImages.removeClass("active");
    $(this).addClass("active");
  });
});
// hotel menu single page slider end
// back to top
var amountScrolled = 200;
var amountScrolledNav = 25;

$(window).scroll(function () {
  if ($(window).scrollTop() > amountScrolled) {
    $("button.back-to-top").addClass("show");
  } else {
    $("button.back-to-top").removeClass("show");
  }
});

$("button.back-to-top").click(function () {
  $("html, body").animate(
    {
      scrollTop: 0,
    },
    800
  );
  return false;
});$(function () {
  var today = new Date();

  function showBackdrop() {
    $("body").addClass("no-scroll");
    $("#datepicker-backdrop").fadeIn(200);
  }

  function hideBackdrop() {
    $("body").removeClass("no-scroll");
    $("#datepicker-backdrop").fadeOut(200);
  }

  $('input[name="checkin"]').datepicker({
    dateFormat: "dd-mm-yy",
    minDate: today,
    beforeShow: showBackdrop,
    onClose: hideBackdrop,
    onSelect: function (dateText) {
      var parts = dateText.split("-");
      var selectedDate = new Date(parts[2], parts[1] - 1, parts[0]);

      // add 1 day
      var minCheckout = new Date(selectedDate);
      minCheckout.setDate(minCheckout.getDate() + 1);

      $('input[name="checkout"]').datepicker("option", "minDate", minCheckout);

      // also auto-fill checkout if it's empty or before minCheckout
      var currentCheckout = $('input[name="checkout"]').datepicker("getDate");
      if (!currentCheckout || currentCheckout <= selectedDate) {
        $('input[name="checkout"]').datepicker("setDate", minCheckout);
      }
    }
  });


  $('input[name="pickupdate"]').datepicker({
    dateFormat: "dd-mm-yy",
    minDate: today,
    beforeShow: showBackdrop,
    onClose: hideBackdrop,
    onSelect: function (dateText) {
      var parts = dateText.split("-");
      var selectedDate = new Date(parts[2], parts[1] - 1, parts[0]);
      var minDropDate = new Date(selectedDate);
      minDropDate.setDate(minDropDate.getDate() + 1);

      $('input[name="dropdate"]').datepicker("option", "minDate", minDropDate);
      $('input[name="dropdate"]').datepicker("setDate", minDropDate); // auto-select next day
    }
  });

  $('input[name="dropdate"]').datepicker({
    dateFormat: "dd-mm-yy",
    minDate: today,
    beforeShow: showBackdrop,
    onClose: hideBackdrop
  });

  $('#tourcheckin').datepicker({
    dateFormat: "dd-mm-yy",
    minDate: today,
    beforeShow: showBackdrop,
    onClose: hideBackdrop,
    onSelect: function (dateText) {
      var parts = dateText.split("-");
      var selectedDate = new Date(parts[2], parts[1] - 1, parts[0]);

      // force +1 day for minDate if you also have a tour checkout
      var minCheckout = new Date(selectedDate);
      minCheckout.setDate(minCheckout.getDate() + 1);
      $('#tourcheckout').datepicker("option", "minDate", minCheckout);
    }
  });

  $('input[name="checkout"]').datepicker({
    dateFormat: "dd-mm-yy",
    minDate: today,
    beforeShow: showBackdrop,
    onClose: hideBackdrop
  });

  $(".datepicker").datepicker({
    dateFormat: "dd-mm-yy",
    minDate: today,
    beforeShow: showBackdrop,
    onClose: hideBackdrop
  });





   $(".datetime-select").datetimepicker({
        dateFormat: "yy-mm-dd",
        minDate: today,
        timeFormat: "hh:mm tt",
        controlType: "select", // select dropdowns for time
        oneLine: true,
        beforeShow: showBackdrop,
        onClose: hideBackdrop,
    });

});


  

// our branch sidebar toggle
$(document).ready(function () {
  $(".branch-call").click(function () {
    $(".our-office").toggle();
  });
});
// end our branch

$(document).ready(function () {
  var today = new Date();
  var maxDuplicates = 1;
  var duplicateCount = 0;

  $("body").append(
    '<div id="datepicker-backdrop" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background-color:rgba(0,0,0,0.4); z-index:998;"></div>'
  );

  function showBackdrop() {
    $("body").addClass("no-scroll");
    $("#datepicker-backdrop").fadeIn(200);
  }

  function hideBackdrop() {
    $("body").removeClass("no-scroll");
    $("#datepicker-backdrop").fadeOut(200);
  }

  // Initialize datepicker with scroll lock and backdrop on given element(s)
  function initDatepicker($elements) {
    $elements.datepicker({
      dateFormat: "dd-mm-yy",
      minDate: today,
      beforeShow: function () {
        showBackdrop();
      },
      onClose: function () {
        hideBackdrop();
      },
    });
  }

  // Hide remove button in original section
  $(".tour_search_form_multiple .remove-sector").hide();

  // Initialize datepicker on existing inputs
  initDatepicker($(".tour_search_form_multiple .datepicker"));

  // Add More Sector button click event
  $("#add-more-button").click(function (e) {
    e.preventDefault();

    if (duplicateCount < maxDuplicates) {
      duplicateCount++;

      var clonedSection = $(".tour_search_form_multiple").first().clone();

      clonedSection.find("input[type=text], select").val("");

      clonedSection.find(".remove-sector").css("display", "inline-block");

      var removeButton = $(
        '<button class="btn remove-sector bg-danger"><i class="fa-regular fa-circle-xmark"></i> Remove Sector</button>'
      );

      removeButton.click(function () {
        clonedSection.remove();
        duplicateCount--;
        $("#add-more-button").prop("disabled", false);
      });

      clonedSection.find(".text-center.my-4").html(removeButton);

      $(".tour_search_form_multiple").last().after(clonedSection);

      // Initialize datepicker on the cloned section's inputs
      initDatepicker(clonedSection.find(".datepicker"));

      if (duplicateCount >= maxDuplicates) {
        $("#add-more-button").prop("disabled", true);
      }
    }
  });

  // Remove button functionality for dynamically added elements (redundant with above but kept for safety)
  $("body").on("click", ".remove-sector", function () {
    $(this).closest(".tour_search_form_multiple").remove();
    duplicateCount--;
    $("#add-more-button").prop("disabled", false);
  });
});

// user dashboard menu drop down function
document.addEventListener("DOMContentLoaded", function () {
  var dropdownContent = document.getElementById("show_dropdown_item");

  // Keep the dropdown open by default
  dropdownContent.style.display = "block";

  // Prevent default behavior of anchor tags inside the dropdown
  var dropdownLinks = dropdownContent.getElementsByTagName("a");
  for (var i = 0; i < dropdownLinks.length; i++) {
    dropdownLinks[i].addEventListener("click", function (event) {
      event.stopPropagation(); // Prevent event from bubbling up to the parent li
    });
  }

  // Prevent closing the dropdown when clicking inside it
  dropdownContent.addEventListener("click", function (event) {
    event.stopPropagation();
  });
});

// // user dashboard menu drop down function end*************

// tour single page addons count function
function incrementQuantity(inputId, price) {
  var quantityInput = document.getElementById(inputId);
  var currentValue = parseInt(quantityInput.value);
  quantityInput.value = currentValue + 1;
  calculateTotal(inputId, price);
}

function decrementQuantity(inputId, price) {
  var quantityInput = document.getElementById(inputId);
  var currentValue = parseInt(quantityInput.value);
  if (currentValue > 1) {
    quantityInput.value = currentValue - 1;
    calculateTotal(inputId, price);
  }
}

function calculateTotal(inputId, price) {
  var quantityInput = document.getElementById(inputId);
  var quantity = parseInt(quantityInput.value);
  var total = price * quantity;
  document.getElementById(inputId + "_total").innerText =
    "₹ " + total.toFixed(2);
}
// tour single page addons count function end*****************

// guest review video modal home page video play****
document.addEventListener("DOMContentLoaded", function () {
  var modals = document.querySelectorAll(".modal");

  modals.forEach(function (modal) {
    modal.addEventListener("hidden.bs.modal", function () {
      var videos = modal.querySelectorAll(".video-player");
      videos.forEach(function (video) {
        video.pause();
        video.currentTime = 0; // Optional: reset video to the start
      });
    });
  });
});

// ferry modal search function Edit Trip/s modal seach filter ferry listing page
document.addEventListener("DOMContentLoaded", function () {
  document.body.addEventListener("click", function (event) {
    if (event.target.classList.contains("adults-decrement")) {
      var adultsInput = event.target.nextElementSibling;
      if (adultsInput.value > 1) {
        adultsInput.value--;
      }
    } else if (event.target.classList.contains("adults-increment")) {
      var adultsInput = event.target.previousElementSibling;
      adultsInput.value++;
    } else if (event.target.classList.contains("infants-decrement")) {
      var infantsInput = event.target.nextElementSibling;
      if (infantsInput.value > 0) {
        infantsInput.value--;
      }
    } else if (event.target.classList.contains("infants-increment")) {
      var infantsInput = event.target.previousElementSibling;
      infantsInput.value++;
    }
  });
});

//adons selected
// Toggle active class on label when checkbox is selected
//  function toggleSelection(element) {
//    const checkbox = element.querySelector('.addon-checkbox');
//   if (checkbox.checked) {
//       checkbox.checked = false;
//       element.classList.remove('selected');
//   } else {
//        checkbox.checked = true;
//        element.classList.add('selected');
//    }
//  }

let selectedCakeCount = 1; // Default cake count

function toggleSelection(element) {
  const checkbox = element.querySelector(".addon-checkbox");
  const isCake = element.querySelector("img[alt='birthday-cake']") !== null;

  if (isCake) {
    // Handle cake-specific behavior
    if (!checkbox.checked) {
      openPopup(); // Show the popup when selecting the cake for the first time or reselecting
    } else {
      // Maintain the selection and count when re-clicking the cake
      checkbox.checked = false;
      element.classList.remove("selected");
    }
  } else {
    // Toggle logic for non-cake addons
    if (checkbox.checked) {
      checkbox.checked = false;
      element.classList.remove("selected");
    } else {
      checkbox.checked = true;
      element.classList.add("selected");
    }
  }
}

function openPopup() {
  document.getElementById("cakePopup").style.display = "flex";
}

function closePopup() {
  document.getElementById("cakePopup").style.display = "none";
}

function updateCakeCount(change) {
  selectedCakeCount = Math.max(1, selectedCakeCount + change);
  document.getElementById("cakeCount").innerText = selectedCakeCount;
}

function confirmCakeSelection() {
  const cakeItem = document
    .querySelector(".addon-item img[alt='birthday-cake']")
    .closest(".addon-item");
  const checkbox = cakeItem.querySelector(".addon-checkbox");
  checkbox.checked = true;
  cakeItem.classList.add("selected");

  // Add or update the count indicator
  let countIndicator = cakeItem.querySelector(".cake-count-indicator");
  if (!countIndicator) {
    countIndicator = document.createElement("div");
    countIndicator.className = "cake-count-indicator";
    cakeItem.appendChild(countIndicator);
  }
  countIndicator.innerText = selectedCakeCount; // Display the count
  closePopup();
}

// onclick loaction select car summar price sidebar
//

function selectLocation(element) {
  // Remove 'selected' class from all items
  const items = document.querySelectorAll(".nearest-location p");
  items.forEach((item) => item.classList.remove("selected"));

  // Add 'selected' class to the clicked item
  element.classList.add("selected");
}

// island page real time weather
!(function (d, s, id) {
  var js,
    fjs = d.getElementsByTagName(s)[0];
  if (!d.getElementById(id)) {
    js = d.createElement(s);
    js.id = id;
    js.src = "https://weatherwidget.io/js/widget.min.js";
    fjs.parentNode.insertBefore(js, fjs);
  }
})(document, "script", "weatherwidget-io-js");
//ferry modal search function Edit Trip/s modal seach filter ferry listing page end
function toggleFaq(element) {
  const faqItem = element.parentElement;
  if (faqItem.classList.contains("active")) {
    faqItem.classList.remove("active");
  } else {
    // Close all other FAQs
    document.querySelectorAll(".faq-item.active").forEach((item) => {
      item.classList.remove("active");
    });
    // Open this FAQ
    faqItem.classList.add("active");
  }
}

document.addEventListener("DOMContentLoaded", function () {
  const adultCountInput = document.getElementById("adultCount");
  const childCountInput = document.getElementById("childCount");
  const totalPriceDisplay = document.getElementById("totalPriceDisplay");
  const basePrice = 1500;

  function calculateTotalPrice() {
    const adultCount = parseInt(adultCountInput.value) || 0;
    const childCount = parseInt(childCountInput.value) || 0;
    const total = (adultCount + childCount) * basePrice;
    totalPriceDisplay.textContent = `₹${total.toLocaleString()}`;
  }

  // Adult count controls
  document.getElementById("adultPlus").addEventListener("click", function () {
    adultCountInput.value = parseInt(adultCountInput.value) + 1;
    calculateTotalPrice();
  });

  document.getElementById("adultMinus").addEventListener("click", function () {
    const currentValue = parseInt(adultCountInput.value);
    if (currentValue > 1) {
      adultCountInput.value = currentValue - 1;
      calculateTotalPrice();
    }
  });

  // Child count controls
  document.getElementById("childPlus").addEventListener("click", function () {
    childCountInput.value = parseInt(childCountInput.value) + 1;
    calculateTotalPrice();
  });

  document.getElementById("childMinus").addEventListener("click", function () {
    const currentValue = parseInt(childCountInput.value);
    if (currentValue > 0) {
      childCountInput.value = currentValue - 1;
      calculateTotalPrice();
    }
  });
});
document
  .querySelectorAll(".overview-description button, .read-more-container button")
  .forEach((button) => {
    button.addEventListener("click", function () {
      const moreText = this.closest(
        ".overview-description, .read-more-container"
      ).querySelector(".more-text");
      moreText.classList.toggle("show"); // Toggle the 'show' class
      if (moreText.classList.contains("show")) {
        this.textContent = "read less"; // Change button text to 'read less'
      } else {
        this.textContent = "read more"; // Change button text back to 'read more'
      }
    });
  });
function toggleFaq(element) {
  const faqItem = element.parentElement;
  if (faqItem.classList.contains("active")) {
    faqItem.classList.remove("active");
  } else {
    // Close all other FAQs
    document.querySelectorAll(".faq-item.active").forEach((item) => {
      item.classList.remove("active");
    });
    // Open this FAQ
    faqItem.classList.add("active");
  }
}
