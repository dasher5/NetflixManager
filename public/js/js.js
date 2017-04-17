//Jake Clark
//CS 4704
//Netflix Manager
$(document).ready(function() {
  var shuffle_btn = document.getElementById('shuffle');
  var links = document.getElementsByClassName("content-links");
  var i = 0;

  shuffle_btn.addEventListener('click', function(event) {
    launchShow(links[i].id, 5000);
  });


  //Launches a netflix show by ID, Not yet integrated (3/29/2017)
  //second parameter is the duration after which to close the window
  function launchShow(showID, Duration) {
    var URL = 'https://www.netflix.com/watch/' + showID;
    //console.log('URL: ' + URL);
    //console.log('Duration(ms): ' + Duration);

    var child = window.open( URL, '_blank');

    //Will close the window after Duration has elapsed
    window.setTimeout( function closeWindow() {
      if (!child.closed)  {
        //console.log('Closing the child...');
        child.close();
      }
    }, Duration);

    //Starts listening for the window to close, checks every 1000ms
    window.setTimeout( function checkClosed() {
      if (child.closed)  {
        closeDetected();
        i+=1;
        launchShow(links[i].id, 5000)
      }
      else  {
        setTimeout(checkClosed, 1000);
      }
    }, 1000);
  }

  //Stub method for when it is detected that the child is closed
  function closeDetected() {
    console.log('The child is now closed');
  }
  //-------------------TESTS--------------------------------
  //Will launch "The Crow" for a duration of 10 seconds
  //launchShow(408911, 10000);

  //-------------------NOTES--------------------------------
  //Make sure to factor in time to load, maybe do duration + 10s
  //Is there any way to open a dialogue/confirmation box before closing?
});
