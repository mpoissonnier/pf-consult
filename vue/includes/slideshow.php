<div class="slideshow" >
	<ul>
		<li><img src="vue/img/slide1.jpeg" alt="" width="640" height="310" /></li>
		<li><img src="vue/img/slide2.jpeg" alt="" width="640" height="310" /></li>
		<li><img src="vue/img/slide3.jpeg" alt="" width="640" height="310" /></li>
		<li><img src="vue/img/slide4.jpeg" alt="" width="640" height="310" /></li>
	</ul>
</div>

<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>

<script type="text/javascript">
   $(function(){
      setInterval(function(){
         $(".slideshow ul").animate({marginLeft:-640},800,function(){
            $(this).css({marginLeft:0}).find("li:last").after($(this).find("li:first"));
         })
      }, 3500);
   });
</script>
