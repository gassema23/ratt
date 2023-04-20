@props([
    'url',
    'color' => 'primary',
    'align' => 'center',
])
<table class="action" align="{{ $align }}" width="100%" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table width="100%" border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td align="{{ $align }}">
<table border="0" cellpadding="0" cellspacing="0" role="presentation">
<tr>
<td>
<!--[if mso]>
<v:roundrect
xmlns:v="urn:schemas-microsoft-com:vml"
xmlns:w="urn:schemas-microsoft-com:office:word" href="" style="height:47px; v-text-anchor:middle; width:177px;" arcsize="2%"  stroke="f" fillcolor="#334155">
<w:anchorlock/>
<center style="color:#FFFFFF;font-family:'Lato',sans-serif;">
<![endif]-->
<a href="{{ $url }}" target="_blank" class="v-button" style="
box-sizing: border-box;
display: inline-block;
font-family: 'Lato', sans-serif;
text-decoration: none;
-webkit-text-size-adjust: none;
text-align: center;
color: #ffffff;
background-color: #334155;
border-radius: 1px;
-webkit-border-radius: 1px;
-moz-border-radius: 1px;
width: auto;
max-width: 100%;
overflow-wrap: break-word;
word-break: break-word;
word-wrap: break-word;
mso-border-alt: none;
font-size: 14px;">
<span style="
display: block;
padding: 15px 40px;
line-height: 120%;">
<span style="line-height: 16.8px">{{ $slot }}</span>
</span>
</a>
<!--[if mso]>
</center>
</v:roundrect>
<![endif]-->
</td>
</tr>
</table>
</td>
</tr>
</table>
</td>
</tr>
</table>
