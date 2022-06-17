<!DOCTYPE html>
<html>
<body>
<script type="text/javascript">
function form()
{
var selectvalue=$('input[name=link]:checked','#form').val();
if(selectvalue==central){
    window.open('GovernmentLogin.php', '_self');
}
else(selectvalue==state){
    window.open('#', '_self');
}
}
</script>
<form id=form()>
  <p>Please select central or state:</p>
  <input type="radio" onclick="form()" name="link" value="central"\>Central
  <input type="radio"  onclick="form()" name="link" value="state"\>State
</form>
</body>
</html>
