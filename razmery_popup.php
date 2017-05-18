<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php"); ?>

<script>

$(document).ready( function() {

	// bind event handler
	$(".tab_nav li a").on( "click", function() {
		$(".tab_nav li a").removeClass("active");
		$(".tab_content li").hide();
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
ul.tab_nav li a {display:inline-block; text-decoration:none; background-color:#DDD; margin:0 3px; padding:2px 20px; border:1px solid #FFF; border-bottom:1px solid #000; color:#999;}
ul.tab_nav li a:hover {background-color:#CCC; color:#FFF; text-decoration:none;}
ul.tab_nav li a.active {background-color: #e04472; color:#FFF; border:1px solid #e04472; text-decoration:none;}
</style>




<ul class="tab_nav">
	<li><a href="#women">Размеры женские</a></li>
	<li><a href="#children">Размеры детские</a></li>
</ul>

<ul class="tab_content" style="margin-top:10px;">
	
	<li id="women">
		<!--<h1 style="border-bottom:none;">Женские размеры</h1>-->
		<table class="content_table">
		<tr><th>Обхват груди</th><th>Обхват бёдер</th><th>Рост<br>мал.разм.<br>ниже 165 см</th><th>Рост<br>норм.разм.<br>от 165 до 172 см</th><th>Рост<br>бол.разм.<br>выше 172 см</th></tr>
		<tr><td colspan="2"></td><td colspan="3">Размер</td></tr>
		<tr><td>74-77</td><td>84-87</td><td>16</td><td>32</td><td>-</td></tr>
		<tr><td>78-81</td><td>88-91</td><td>17</td><td>34</td><td>68</td></tr>
		<tr><td>82-85</td><td>92-95</td><td>18</td><td>36</td><td>72</td></tr>
		<tr><td>86-89</td><td>96-98</td><td>19</td><td>38</td><td>76</td></tr>
		<tr><td>90-93</td><td>99-101</td><td>20</td><td>40</td><td>80</td></tr>
		<tr><td>94-97</td><td>102-104</td><td>21</td><td>42</td><td>84</td></tr>
		<tr><td>98-102</td><td>105-108</td><td>22</td><td>44</td><td>88</td></tr>
		<tr><td>103-107</td><td>109-112</td><td>23</td><td>46</td><td>92</td></tr>
		<tr><td>108-113</td><td>113-116</td><td>24</td><td>48</td><td>96</td></tr>
		<tr><td>114-119</td><td>117-121</td><td>25</td><td>50</td><td>100</td></tr>
		<tr><td>120-125</td><td>122-126</td><td>26</td><td>52</td><td>104</td></tr>
		<tr><td>126-131</td><td>127-132</td><td>27</td><td>54</td><td>108</td></tr>
		<tr><td>132-137</td><td>133-138</td><td>28</td><td>56</td><td>112</td></tr>
		<tr><td>138-143</td><td>139-144</td><td>29</td><td>58</td><td>116</td></tr>
		<tr><td>144-149</td><td>145-150</td><td>-</td><td>60</td><td>-</td></tr>
		<tr><td>150-155</td><td>151-156</td><td>-</td><td>62</td><td>-</td></tr>
		</table>
	
	</li>
	<li id="children">
		<!--<h1 style="border-bottom:none;">Детские размеры</h1>-->
		<h2>Жилеты для девочек</h2>
		<table class="content_table">
			<tr><th>Размер</th><th>30</th><th>32</th><th>34</th><th>36</th><th>38</th><th>40</th><th>42</th><th>44</th><th>46</th><th>48</th><th>50</th><th>Допустимое отклонение</th></tr>
			<tr><td>Длина изделия</td><td>46</td><td>48</td><td>50</td><td>52</td><td>54</td><td>56</td><td>58</td><td>60</td><td>60</td><td>60</td><td>60</td><td>+/-2</td></tr>
			<tr><td>Ширина изделия</td><td>30</td><td>32</td><td>34</td><td>36</td><td>38</td><td>40</td><td>42</td><td>44</td><td>46</td><td>48</td><td>50</td><td>+/-1</td></tr>
		</table>
		
		<h2>Жилеты для мальчиков</h2>
		<table class="content_table">
			<tr><th>Рост</th><th>122</th><th>128</th><th>134</th><th>140</th><th>146</th><th>152</th><th>158</th><th>158<br/>164</th><th>158<br/>164</th><th>158<br/>164</th><th>170<br/>176</th><th>Допустимое отклонение</th></tr>
			<tr class="second_header_row"><th>Размер</th><th>30</th><th>32</th><th>34</th><th>36</th><th>38</th><th>40</th><th>42</th><th>44</th><th>46</th><th>48</th><th>50</th><th></th></tr>
			<tr><td>Длина изделия</td><td>44</td><td>46</td><td>48</td><td>50</td><td>52</td><td>54</td><td>56</td><td>58</td><td>62</td><td>64</td><td>66</td><td>+/-2</td></tr>
			<tr><td>Ширина изделия</td><td>32</td><td>34</td><td>36</td><td>38</td><td>40</td><td>42</td><td>44</td><td>46</td><td>48</td><td>50</td><td>52</td><td>+/-1</td></tr>
		</table>
	
	
	</li>
</ul>




<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>