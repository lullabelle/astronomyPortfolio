$(document).ready(function() {


document.getElementById("Go").addEventListener("submit", validateForm);

 
 function validateForm(evt) {

  evt.preventDefault();  // Stop the form from reloading the page 
  evt.stopPropagation();  // Stop the form from reloading the page

              var From = document.getElementById("from").value;
               var Subject = document.getElementById("subject").value;
               var Message = document.getElementById("message").value;
            

      var MB = $('#MessageBox');
      var SB = $('#SubjectBox');
      var FB = $('#FromBox');

$("#MessageBox").css ({
                "display" : "inline",
                "float" : "right",
                "color": " #ff0000",
                "font-weight" : "bold"
                });
$("#SubjectBox").css ({
                "display" : "inline",
                "float" : "right",
                "color": " #ff0000",
                "font-weight" : "bold"

                });
$("#FromBox").css ({
                "display" : "inline",
                "float" : "right",
                "color": " #ff0000",
                "font-weight" : "bold"

                });

              
            if (From.length <= 2){
              $("#FromBox").empty();
              FB.append('Please Enter a name with more than two characters');
            }

            if (Subject.length <= 2){
              $("#SubjectBox").empty();
              SB.append('Please Enter a subject with more than two characters');
            }

            if (Message.length <= 5){
                $("#MessageBox").empty();
              MB.append('Please have a message with more than 5 characters');
            }

          var posting = $.post( url, {Name: From, Sub: Subject, Comment: Message } );
          alert('Your Message has been sent');
          location.reload();
            }
 });