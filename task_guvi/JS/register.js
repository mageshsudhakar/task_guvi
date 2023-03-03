alert ("hi");


$(document).ready(function(){
    $("#register-frm").validate({
        rules:{
            cpass:{
                equalTo:"#pass",
            }
        }
    });
    
    $("#register").click(function(e){
        if (document.getElementById("register-frm").checkValidity()){
            e.preventDefault();
            $.ajax({
                url:"../PHP/action.php",
                method:'post',
                data:$("register-frm").serialize()+'&action=register',
                success:function(response){
                    $("#alert").show();
                    $("#result").html(response);
                }
            });
          }
        return true;
    });
});