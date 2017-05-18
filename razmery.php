<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords", "Размерные ряды");
$APPLICATION->SetPageProperty("description", "Размерные ряды");
$APPLICATION->SetPageProperty("title", "Размерные ряды | Фемина Трейд");
$APPLICATION->SetTitle("Размерные ряды"); ?> 
<script>

$(document).ready( function() {

	// bind event handler
	$(".tab_nav li a").on( "click", function() {
		$(".tab_nav li a").removeClass("active");
		$("li#women, li#children, li#man").hide();
		var cnt = $(this).attr("href");
		$(cnt).show();
		$(this).addClass("active");
		return false;
		});

	// check if is initial tab or first is activating
	var str=document.location.href;
	if(str.indexOf('#')>0) {
		str=str.substr(str.indexOf('#'));
		$(".tab_nav li a[href='"+str+"']").click();
		}
	else {
		$(".tab_nav li a:first").click();
		}
	
});

</script>
 
<style>
ul.tab_nav li {display:inline-block; margin:0; padding:0;}
ul.tab_nav li a {display:inline-block; text-decoration:none; background-color:#666; margin:0 3px; padding:2px 20px; border:1px solid #000; border-bottom:1px solid #FFF; color:#FFF;}
ul.tab_nav li a:hover {background-color:#333; color:#FFF; text-decoration:none;}
ul.tab_nav li a.active {background-color: #e04472; color:#FFF; border:1px solid #e04472; text-decoration:none;}
</style>
 
<ul class="tab_nav"> 	 
<!--<li><a id="bxid_2930" href="#men" >Размеры мужские</a></li>-->
 	 
  <li><a href="#women" >Размеры женские</a></li>
 <li><a href="#man" >Размеры мужские</a></li>
  <li><a href="#children" >Размеры детские</a></li>
 </ul>
 
<ul class="tab_content"> 	 
  <li id="women"> 		 
<!--<h1 style="border-bottom:none;">Женские размеры</h1>-->
 		 
    <br />
   		 
<!--<tr><td colspan="2"><br _moz_editor_bogus_node='on'></td><td colspan="3">Размер</td></tr>-->
 
	<p style="padding:5px;">Снимите мерки. Все мерки снимаются в положении стоя. Измерительная лента должна плотно прилегать к коже, но не давить.</p>
	<ul style="margin-left:20px;">
		<li><b>Объём груди</b> - мерка снимается по вытупающим точкам груди спереди и по нижнем выступающему краю лопаток сзади.</li>
		<li><b>Объём талии</b> - по самой узкой части туловища.</li>
		<li><b>Объём бёдер</b> - по наиболее вытупающим сбоку и сзади точкам.</li>
	</ul>
	<br/>
 
    <table class="content_table" style="border-collapse: collapse;"> 		 
      <tbody> 
        <tr><th>Размер</th><th>Обхват груди (см)</th><th>Обхват талии (см)</th><th>Обхват бёдер (см)</th></tr>
       		 		 
        <tr><td>42</td><td>84</td><td>66</td><td>92</td></tr>
       		 
        <tr><td>44</td><td>88</td><td>70</td><td>96</td></tr>
       		 
        <tr><td>46</td><td>92</td><td>74</td><td>100</td></tr>
       		 
        <tr><td>48</td><td>96</td><td>78</td><td>104</td></tr>
       		 
        <tr><td>50</td><td>100</td><td>82</td><td>108</td></tr>
       		 
        <tr><td>52</td><td>104</td><td>86</td><td>112</td></tr>
       		 
        <tr><td>54</td><td>108</td><td>90</td><td>116</td></tr>
       		 
        <tr><td>56</td><td>112</td><td>94</td><td>120</td></tr>
       		 
        <tr><td>58</td><td>116</td><td>98</td><td>124</td></tr>
       		 
        <tr><td>60</td><td>120</td><td>102</td><td>128</td></tr>
       		 
        <tr><td>62</td><td>124</td><td>106</td><td>132</td></tr>
       		  		  		  		  		  		</tbody>
     </table>
   	 	</li>
 	 
	<li id="man">
		<br/>
		<h2>Размеры верхних трикотажных изделий для мужчин</h2>
		<table class="content_table" style="border-collapse: collapse;"> 			 
			<tbody>
				<tr><th>Размер российский</th><th>44</th><th>46</th><th>48</th><th>50</th><th>52</th><th>54</th><th>56</th><th>58</th></tr>
				<tr><th>Размер международный</th><th>XS</th><th>S</th><th>M</th><th>L</th><th>XL</th><th>XXL</th><th>3XL</th><th>4XL</th></tr>
				<tr><td>Рост</td><td>176-182</td><td>176-182</td><td>176-182</td><td>176-182</td><td>176-182</td><td>176-182</td><td>176-182</td><td>176-182</td></tr>
				<tr><td>Обхват груди</td><td>96</td><td>100</td><td>104</td><td>108</td><td>112</td><td>116</td><td>120</td><td>124</td></tr>
			</tbody>
		</table>
	</li>
	 
	 
  <li id="children"> 		 
<!--<h1 style="border-bottom:none;">Детские размеры</h1>-->


	<br/>
	<h2>Размерная таблица ВЕСНУШКИ (в см)  для определения плечевых изделий<br/>(жилеты, жакеты, джемпера)</h2>
	<table class="content_table" style="border-collapse: collapse;"> 			 
		<tbody> 
			<tr><th>Возраст</th><th>Рост</th><th>Двойные значения</th><th>Российский размер</th><th>Объем груди, см</th><th>Объем талии, см</th><th>Объем бёдер, см</th></tr>	
			<tr><td>2 года</td><td>92</td><td>86-92</td><td>26</td><td>52-54</td><td>50-52</td><td>56-58</td></tr>
			<tr><td>3 года</td><td>98</td><td>98-104</td><td>28</td><td>54-56</td><td>52</td><td>58-60</td></tr>
			<tr><td>4 года</td><td>104</td><td>104-110</td><td>28-30</td><td>54-56</td><td>52-54</td><td>60-62</td></tr>
			<tr><td>5 года</td><td>110</td><td>110-116</td><td>30</td><td>56-58</td><td>54</td><td>62-64</td></tr>
			<tr><td>6 года</td><td>116</td><td>116-122</td><td>30-32</td><td>58-60</td><td>54-56</td><td>64-66</td></tr>
			<tr><td>7 года</td><td>120</td><td>122-128</td><td>32</td><td>60-62</td><td>56-58</td><td>66-68</td></tr>
		</tbody>
	</table>
	
	
	<br/>
	<h2>Размерная таблица VAY KIDS (в см)  для определения плечевых изделий<br/>(жилеты, жакеты, джемпера)</h2>
	<table class="content_table" style="border-collapse: collapse;"> 			 
		<tbody> 
			<tr><th>Размер</th><th>Рост</th><th>Обхват груди</th></tr>	
			<tr><td>30</td><td>122</td><td>60</td></tr>
			<tr><td>32</td><td>128</td><td>64</td></tr>
			<tr><td>34</td><td>134</td><td>68</td></tr>
			<tr><td>36</td><td>140</td><td>72</td></tr>
			<tr><td>38</td><td>146</td><td>76</td></tr>
			<tr><td>40</td><td>152</td><td>80</td></tr>
			<tr><td>42</td><td>158</td><td>84</td></tr>
		</tbody>
	</table>
	
	
	<br/>
	<h2>Размерная таблица школьных жилетов (см). Допустимое отклонение +/-2см</h2>
	<table class="content_table" style="border-collapse: collapse;"> 			 
		<tbody> 
		
			<tr><th></th><th>Размер</th><th>Рост</th><th>Длина изделия</th><th>Ширина изделия</th></tr>	
			<tr><td rowspan="11">Мальчики</td><td>30</td><td>122</td><td>44</td><td>32</td></tr>
			<tr><td>32</td><td>128</td><td>46</td><td>34</td></tr>
			<tr><td>34</td><td>134</td><td>48</td><td>36</td></tr>
			<tr><td>36</td><td>140</td><td>50</td><td>38</td></tr>
			<tr><td>38</td><td>146</td><td>52</td><td>40</td></tr>
			<tr><td>40</td><td>152</td><td>54</td><td>42</td></tr>
			<tr><td>42</td><td>158</td><td>56</td><td>44</td></tr>
			<tr><td>44</td><td>158-164</td><td>58</td><td>46</td></tr>
			<tr><td>46</td><td>158-164</td><td>62</td><td>48</td></tr>
			<tr><td>48</td><td>158-164</td><td>64</td><td>50</td></tr>
			<tr><td>50</td><td>170-175</td><td>66</td><td>52</td></tr>
			
			<tr><td rowspan="11">Девочки</td><td>30</td><td>122</td><td>46</td><td>30</td></tr>
			<tr><td>32</td><td>128</td><td>48</td><td>32</td></tr>
			<tr><td>34</td><td>134</td><td>50</td><td>34</td></tr>
			<tr><td>36</td><td>140</td><td>52</td><td>38</td></tr>
			<tr><td>38</td><td>146</td><td>54</td><td>40</td></tr>
			<tr><td>40</td><td>152</td><td>56</td><td>42</td></tr>
			<tr><td>42</td><td>158</td><td>58</td><td>44</td></tr>
			<tr><td>44</td><td>158-164</td><td>60</td><td>46</td></tr>
			<tr><td>46</td><td>158-164</td><td>60</td><td>48</td></tr>
			<tr><td>48</td><td>158-164</td><td>60</td><td>50</td></tr>
			<tr><td>50</td><td>170-175</td><td>60</td><td>50</td></tr>
			
		</tbody>
	</table>
	
	
 	
   	 	</li>
 </ul>
 <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>