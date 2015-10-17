<?php ?>
<html>

<p id="state">Unknown</p>
<input id="cb" type="checkbox"/>
<button onclick="state()">Handler</button>
<script>
function state(){
	document.getElementById('state').innerHTML=document.getElementById('cb').checked;
}
</script>
</html>