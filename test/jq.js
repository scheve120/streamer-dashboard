$(document).ready(function  $('form1').find("input[type=textarea], input[type=password], textarea").each(function()
{
    if(!$(this).val()) { 
   $(this).attr("placeholder", "Type your answer here");
}
});
});