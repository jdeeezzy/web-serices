<html>
<head>
<title>Bond Web Service Demo</title>
<style>
	body {font-family:georgia;}
  
   .film{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }
  
  .pic img{
	max-width:115px;
  }

</style>
<script src="https://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">

  function bondTemplate(film){

    return `
    <div class="film">
            <b>Year</b>: ${film.Year}<br /> 
            <b>Winner</b>: ${film.Winner}<br /> 
            <b>Teams</b>: ${film.Teams}<br /> 
            <b>MVP</b>: ${film.MVP}<br /> 
            <b>Half Time</b>: ${film.HalfTime}<br /> 
            <div class="pic"><img src="images/${film.Image}" /></div>
      </div>
    `;
    
  }
  
$(document).ready(function() { 

 $('.category').click(function(e){
   e.preventDefault(); //stop default action of the link
   cat = $(this).attr("href");  //get category from URL
  
   var request = $.ajax({
     url: "api.php?cat=" + cat,
     method: "GET",
     dataType: "json"
   });
   request.done(function( data ) {
    console.log(data);

     // place data.title on page 

     $("#filmtitle").html(data.title);

     // clear previous data
     $("#films").html("");

     // loop thru data.films and place on page
     $.each(data.films,function(i,item){

      let myData = bondTemplate(item);
       $("<div></div>").html(myData).appendTo("#films");
       
     });

     // let myData = JSON.stringify(data,null,4);
     // myData = "<pre>" + myData + "</pre>";
     // $("#output").html(myData);

   });
   request.fail(function(xhr, status, error ) {
alert('Error - ' + xhr.status + ': ' + xhr.statusText);
   });

  });
}); 



</script>
</head>
	<body>
	<h1>Super Bowl Winners in the past 10 years</h1>
		<a href="year" class="category">2011 - 2015</a><br />
		<a href="box" class="category">2016 - 2020</a>
		<h3 id="filmtitle">Superbowl Winners</h3>
		<div id="films">
      <!--
			<div class="film">
        
            <b>Film</b>: 1<br /> 
            <b>Title</b>: Dr. No<br /> 
            <b>Year</b>: 1962<br /> 
            <b>Director</b>: Terence Young<br /> 
            <b>Producers</b>: Harry Saltzman and Albert R. Broccoli<br /> 
            <b>Writers</b>: Richard Maibaum, Johanna Harwood and Berkely Mather<br /> 
            <b>Composer</b>: Monty Norman<br /> 
            <b>Bond</b>: Sean Connery<br /> 
            <b>Budget</b>: $1,000,000.00<br /> 
            <b>BoxOffice</b>: $59,567,035.00<br /> 
            <div class="pic"><img src="thumbnails/dr-no.jpg" /></div>
      </div>
        -->
		</div>
		<div id="output"></div>
	</body>
</html>
