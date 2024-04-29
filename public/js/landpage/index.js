// script.js
document.addEventListener('DOMContentLoaded', function() {
    var button = document.getElementById('bookNowButton');
    button.addEventListener('click', function() {
        var redirectTo = 'users/login'; // Replace with your desired URL
        window.location.href = redirectTo;
    });
});

document.addEventListener('DOMContentLoaded', function() {
    var button = document.getElementById('bookNowButton1');
    button.addEventListener('click', function() {
        var redirectTo = 'users/login'; // Replace with your desired URL
        window.location.href = redirectTo;
    });
});
document.addEventListener('DOMContentLoaded', function() {
    var button = document.getElementById('bookNowButton2');
    button.addEventListener('click', function() {
        var redirectTo = 'users/login'; // Replace with your desired URL
        window.location.href = redirectTo;
    });
});

function clickSearch() {
    // Set the new URL you want to navigate to
    const newPageURL = "landpage/searchPage"; // Replace with your desired URL//wada krnne na login ek illnw56;pt[l0;;]
  
    // Use window.location to navigate to the new page
    window.location.href = newPageURL;
  }
  
  // Attach the clickSearch function to the button's click event
  const kbutton = document.getElementById("searchbut");
  kbutton.addEventListener("click", clickSearch);
  /////////////////////////
  function StartPlan() {
    // Set the new URL you want to navigate to
    const newPageURL = "../users/login"; // Replace with your desired URL
  
    // Use window.location to navigate to the new page
    window.location.href = newPageURL;
  }
  
  // Attach the clickSearch function to the button's click event
  const startPlanning = document.getElementById("startPlanning");
  startPlanning.addEventListener("click", StartPlan);

  const planbutton = document.getElementById("planbutton");
  planbutton.addEventListener("click", StartPlan);

  function Tripdetails(id) {
    // Corrected implementation
    window.location.href = `landpage/tripfurtherdetail/${id}`;
  }