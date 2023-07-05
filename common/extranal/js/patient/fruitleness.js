$(document).ready(function () {

    // $('#male_fruitleness').hide();
    $('#female_fruitleness').hide();

    // $('#edit_male_fruitleness').hide();
    $('#edit_female_fruitleness').hide();

    // $('select').on('chane',function () {
    //     console.log($(this).val());
    // });

    $('#sex').change(function() {
        var selectedValue = $(this).val();
        console.log(selectedValue);
        if(selectedValue =='Female')
{
       $('#male_fruitleness').hide();

    $('#female_fruitleness').show();
   
}        else{
    $('#male_fruitleness').show();

    $('#female_fruitleness').hide();
        }
      });


    $('#edit_sex').change(function() {
        var selectedValue = $(this).val();
        console.log(selectedValue);
        if(selectedValue =='Female')
{
       $('#edit_male_fruitleness').hide();

    $('#edit_female_fruitleness').show();
   
}        else{
    $('#edit_male_fruitleness').show();

    $('#edit_female_fruitleness').hide();
        }
      });
      

});